<?php

declare(strict_types=1);

namespace DddModule\Base\Infrastructure\Service\DataMapper;

interface DataMapperInterface
{
    /**
     * Map data to storage
     */
    public function mapToStorage(array $data): array;

    /**
     * Map data from storage
     */
    public function mapFromStorage(array $data): array;
}
