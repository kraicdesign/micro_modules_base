<?php

declare(strict_types=1);

namespace DddModule\Base\Domain\Factory;

use DddModule\Base\Domain\ValueObject\CreatedAt;
use DddModule\Base\Domain\ValueObject\FindCriteria;
use DddModule\Base\Domain\ValueObject\Flag\Deleted;
use DddModule\Base\Domain\ValueObject\Id;
use DddModule\Base\Domain\ValueObject\NullValue;
use DddModule\Base\Domain\ValueObject\Payload;
use DddModule\Base\Domain\ValueObject\ProcessUuid;
use DddModule\Base\Domain\ValueObject\Translation\Language;
use DddModule\Base\Domain\ValueObject\UpdatedAt;
use DddModule\Base\Domain\ValueObject\Uuid;

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
