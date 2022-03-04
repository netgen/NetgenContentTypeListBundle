<?php

declare(strict_types=1);

namespace Netgen\Bundle\ContentTypeListBundle\Tests\Core\Persistence\Legacy\Content\FieldValue\Converter;

use Ibexa\Contracts\Core\Persistence\Content\FieldValue;
use Ibexa\Contracts\Core\Persistence\Content\Type\FieldDefinition;
use Ibexa\Core\Persistence\Legacy\Content\FieldValue\Converter;
use Ibexa\Core\Persistence\Legacy\Content\StorageFieldDefinition;
use Ibexa\Core\Persistence\Legacy\Content\StorageFieldValue;
use Netgen\Bundle\ContentTypeListBundle\Core\Persistence\Legacy\Content\FieldValue\Converter\ContentTypeListConverter;
use PHPUnit\Framework\TestCase;

final class ContentTypeListConverterTest extends TestCase
{
    private ContentTypeListConverter $converter;

    protected function setUp(): void
    {
        $this->converter = new ContentTypeListConverter();
    }

    public function testInstanceOfConverterInterface(): void
    {
        self::assertInstanceOf(Converter::class, $this->converter);
    }

    public function testToStorageFieldDefinition(): void
    {
        $fieldDefinition = new FieldDefinition();
        $storageDefinition = new StorageFieldDefinition();

        $this->converter->toStorageFieldDefinition($fieldDefinition, $storageDefinition);
    }

    public function testToFieldDefinition(): void
    {
        $fieldDefinition = new FieldDefinition();
        $storageDefinition = new StorageFieldDefinition();

        $this->converter->toFieldDefinition($storageDefinition, $fieldDefinition);
    }

    public function testGetIndexColumn(): void
    {
        self::assertFalse($this->converter->getIndexColumn());
    }

    public function testToFieldValue(): void
    {
        $fieldDefinition = new FieldValue();
        $storageDefinition = new StorageFieldValue();

        $this->converter->toFieldValue($storageDefinition, $fieldDefinition);
    }

    public function testToStorageValue(): void
    {
        $fieldDefinition = new FieldValue();
        $storageDefinition = new StorageFieldValue();

        $this->converter->toStorageValue($fieldDefinition, $storageDefinition);
    }
}
