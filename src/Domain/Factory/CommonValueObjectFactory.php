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

class CommonValueObjectFactory implements CommonValueObjectFactoryInterface
{
    public function makeProcessUuid(?string $processUuid = null): ProcessUuid
    {
        return ProcessUuid::fromNative($processUuid);
    }

    public function makeUuid(?string $uuid = null): Uuid
    {
        return Uuid::fromNative($uuid);
    }

    public function makeId(int $id): Id
    {
        return Id::fromNative($id);
    }

    public function makeFindCriteria(array $criteria): FindCriteria
    {
        return FindCriteria::fromNative($criteria);
    }

    public function makeCreatedAt(string $createdAt): CreatedAt
    {
        return CreatedAt::fromNative($createdAt);
    }

    public function makeUpdatedAt(string $updatedAt): UpdatedAt
    {
        return UpdatedAt::fromNative($updatedAt);
    }

    public function makeNullValue(): NullValue
    {
        return NullValue::create();
    }

    public function makeDeletedFlag(int $deleted): Deleted
    {
        return Deleted::fromNative($deleted);
    }

    public function makeLanguage(string $language): Language
    {
        return Language::fromNative($language);
    }

    public function makePayload(array $payload): Payload
    {
        return Payload::fromNative($payload);
    }
}
