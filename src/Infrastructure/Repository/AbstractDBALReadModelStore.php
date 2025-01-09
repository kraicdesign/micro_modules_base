<?php

declare(strict_types=1);

namespace DddModule\Base\Infrastructure\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception as DBALException;
use Doctrine\DBAL\Statement as DriverStatement;
use DddModule\Base\Domain\ReadModel\ReadModelInterface;
use DddModule\Base\Domain\Repository\ReadModelStoreInterface;
use DddModule\Base\Infrastructure\Repository\Exception\DBALEventStoreException;
use DddModule\Base\Infrastructure\Repository\Exception\NotFoundException;
use DddModule\Base\Infrastructure\Service\DataMapper\DataMapperInterface;

/**
 * @SuppressWarnings(PHPMD)
 */
abstract class AbstractDBALReadModelStore implements ReadModelStoreInterface
{
    public function __construct(
        protected Connection $connection,
        protected string $tableName,
        protected string $primaryKey,
        protected DataMapperInterface $dataMapper
    ) {
    }

    public function findOne(string $uuid): array
    {
        $statement = $this->prepareSelectStatement([
            $this->primaryKey => $uuid,
        ]);
        $result = $statement->executeQuery();
        $row = $result->fetchAssociative();

        if ($row === false) {
            throw new NotFoundException(
                sprintf("ReadModel not found for aggregate with id %s for table %s", $uuid, $this->tableName)
            );
        }

        return $row;
    }

    /**
     * Finds objects by a set of criteria.
     *
     * Optionally sorting and limiting details can be passed. An implementation may throw
     * an UnexpectedValueException if certain values of the sorting or limiting details are
     * not supported.
     */
    public function findBy(array $criteria, ?array $orderBy = null, ?int $limit = null, ?int $offset = null): array
    {
        $criteria = $this->dataMapper->mapToStorage($criteria);
        $statement = $this->prepareSelectStatement($criteria, $orderBy, $limit, $offset);

        return $statement->executeQuery()
            ->fetchAllAssociative();
    }

    public function findOneBy(array $criteria): array
    {
        $criteria = $this->dataMapper->mapToStorage($criteria);
        $statement = $this->prepareSelectStatement($criteria, null, 1);
        $result = $statement->executeQuery();
        $row = $result->fetchAssociative();

        if ($row === false) {
            throw new NotFoundException(
                sprintf(
                    "ReadModel not found for aggregate with id %s for table %s",
                    implode(", ", $criteria),
                    $this->tableName
                )
            );
        }

        return $row;
    }

    public function insertOne(ReadModelInterface $readModel): void
    {
        $this->connection->beginTransaction();

        try {
            $this->insert($this->connection, $readModel->getPrimaryKeyValue(), $readModel->normalize());
            $this->connection->commit();
        } catch (DBALException $exception) {
            $this->connection->rollBack();

            throw new DBALEventStoreException($exception->getMessage(), (int) $exception->getCode(), $exception);
        }
    }

    public function updateOne(ReadModelInterface $readModel): void
    {
        $this->connection->beginTransaction();

        try {
            $this->update(
                $this->connection,
                $readModel->normalize(),
                [
                    $this->primaryKey => $readModel->getPrimaryKeyValue(),
                ]
            );
            $this->connection->commit();
        } catch (DBALException $exception) {
            $this->connection->rollBack();

            throw new DBALEventStoreException($exception->getMessage(), (int) $exception->getCode(), $exception);
        }
    }

    public function deleteOne(ReadModelInterface $readModel): void
    {
        $this->connection->beginTransaction();

        try {
            $this->delete($this->connection, [
                $this->primaryKey => $readModel->getPrimaryKeyValue(),
            ]);
            $this->connection->commit();
        } catch (DBALException $exception) {
            $this->connection->rollBack();

            throw new DBALEventStoreException($exception->getMessage(), (int) $exception->getCode(), $exception);
        }
    }

    /**
     * Prepare query
     */
    protected function prepareSelectStatement(
        array $criteria,
        ?array $orderBy = null,
        ?int $limit = null,
        ?int $offset = null
    ): DriverStatement {
        $query = $this->getDefaultQuery();
        [$values, $conditions] = $this->gatherConditions($criteria);

        if ($conditions) {
            $query .= "
                WHERE " . implode(" AND ", $conditions);
        }
        if ($orderBy !== null) {
            $query .= " ORDER BY " . implode(", ", $orderBy);
        }
        if ($limit !== null) {
            $query .= " LIMIT " . $limit;
        }
        if ($offset > 0) {
            $query .= " OFFSET " . $offset;
        }

        $statement = $this->connection->prepare($query);

        foreach ($values as $param => $value) {
            $statement->bindValue($param, $value);
        }

        return $statement;
    }

    /**
     * Return Default query
     */
    abstract protected function getDefaultQuery(): string;

    /**
     * Gathers conditions for an update or delete call.
     *
     * @param mixed[] $identifiers Input array of columns to values
     *
     * @return string[][] a triplet with:
     *                    - the second key being the values
     *                    - the third key being the conditions
     */
    protected function gatherConditions(array $identifiers): array
    {
        $values = [];
        $conditions = [];
        $valueKey = 0;

        foreach ($identifiers as $columnName => $value) {
            if (! is_array($value)) {
                $value = [
                    "condition" => "=",
                    "value" => $value,
                ];
            }
            if (! isset($value["condition"])) {
                $value = [
                    "condition" => "IN",
                    "value" => $value,
                ];
            }
            $condition = [];

            if (! is_array($value["condition"])) {
                $value["condition"] = [$value["condition"]];
                $value["value"] = [$value["value"]];
            }
            foreach ($value["condition"] as $i => $cond) {
                ++$valueKey;

                if ($cond === "IN") {
                    $condition[] = $columnName . " IN (?)";
                    $value["value"][$i] = implode(",", $value["value"][$i]);
                } else {
                    $condition[] = $columnName . " " . $cond . " ?";
                }
                $values[$valueKey] = $value["value"][$i];
            }
            $conditions[$valueKey] = "(" . implode(" OR ", $condition) . ")";
        }

        return [$values, $conditions];
    }

    /**
     * Insert new user data to store
     */
    protected function insert(Connection $connection, string $primaryKeyValue, array $data): void
    {
        $insert = $this->dataMapper->mapToStorage($data);
        $insert[$this->primaryKey] = $primaryKeyValue;
        $connection->insert($this->tableName, $insert);
    }

    /**
     * Update data to store
     */
    protected function update(Connection $connection, array $data, array $conditions): void
    {
        $update = $this->dataMapper->mapToStorage($data);
        $connection->update($this->tableName, $update, $conditions);
    }

    /**
     * Delete user from store
     */
    protected function delete(Connection $connection, array $conditions): void
    {
        $connection->delete($this->tableName, $conditions);
    }

    /**
     * Prepare query conditions
     */
    protected function prepareQueryConditions(
        string $query,
        array $conditions,
        ?array $orderBy = null,
        ?int $limit = null,
        ?int $offset = null
    ): string {
        $query .= " WHERE " . implode(" AND ", $conditions);

        if ($orderBy !== null) {
            $query .= " ORDER BY " . implode(", ", $orderBy);
        }

        if ($limit !== null) {
            $query .= " LIMIT " . $limit;
        }

        if ($offset !== null && $offset > 0) {
            $query .= " OFFSET " . $offset;
        }

        return $query;
    }
}
