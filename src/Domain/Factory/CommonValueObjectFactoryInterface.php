<?php

declare(strict_types=1);

namespace MicroModule\Base\Domain\Factory;

use MicroModule\Base\Domain\ValueObject\CreatedAt;
use MicroModule\Base\Domain\ValueObject\FindCriteria;
use MicroModule\Base\Domain\ValueObject\Flag\Deleted;
use MicroModule\Base\Domain\ValueObject\Id;
use MicroModule\Base\Domain\ValueObject\NullValue;
use MicroModule\Base\Domain\ValueObject\Payload;
use MicroModule\Base\Domain\ValueObject\ProcessUuid;
use MicroModule\Base\Domain\ValueObject\Translation\Language;
use MicroModule\Base\Domain\ValueObject\UpdatedAt;
use MicroModule\Base\Domain\ValueObject\Uuid;

interface CommonValueObjectFactoryInterface
{
    /**
     * Create Process Uuid value object
     */
    public function makeProcessUuid(?string $processUuid = null): ProcessUuid;

    /**
     * Create Uuid value object
     */
    public function makeUuid(?string $uuid = null): Uuid;

    /**
     * Create Id value object
     */
    public function makeId(int $id): Id;

    /**
     * Create FindCriteria value object
     */
    public function makeFindCriteria(array $criteria): FindCriteria;

    /**
     * Create CreatedAt value object
     */
    public function makeCreatedAt(string $createdAt): CreatedAt;

    /**
     * Create UpdatedAt value object
     */
    public function makeUpdatedAt(string $updatedAt): UpdatedAt;

    /**
     * Create NullValue value object
     */
    public function makeNullValue(): NullValue;

    /**
     * Create deleted value object
     */
    public function makeDeletedFlag(int $deleted): Deleted;

    /**
     * Create Language value object
     */
    public function makeLanguage(string $language): Language;

    /**
     * Create Payload value object
     */
    public function makePayload(array $payload): Payload;
}
