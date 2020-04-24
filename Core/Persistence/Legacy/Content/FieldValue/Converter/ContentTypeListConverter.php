<?php

declare(strict_types=1);

namespace Netgen\Bundle\ContentTypeListBundle\Core\Persistence\Legacy\Content\FieldValue\Converter;

use eZ\Publish\Core\Persistence\Legacy\Content\FieldValue\Converter;
use eZ\Publish\Core\Persistence\Legacy\Content\StorageFieldDefinition;
use eZ\Publish\Core\Persistence\Legacy\Content\StorageFieldValue;
use eZ\Publish\SPI\Persistence\Content\FieldValue;
use eZ\Publish\SPI\Persistence\Content\Type\FieldDefinition;
use function explode;
use function implode;
use function trim;

final class ContentTypeListConverter implements Converter
{
    public function toStorageValue(FieldValue $value, StorageFieldValue $storageFieldValue): void
    {
        $storageFieldValue->dataText = empty($value->data) ? '' : implode(',', $value->data);
    }

    public function toFieldValue(StorageFieldValue $value, FieldValue $fieldValue): void
    {
        $data = trim($value->dataText ?? '');
        $fieldValue->data = empty($data) ? [] : explode(',', $data);
    }

    public function toStorageFieldDefinition(FieldDefinition $fieldDef, StorageFieldDefinition $storageDef): void
    {
    }

    public function toFieldDefinition(StorageFieldDefinition $storageDef, FieldDefinition $fieldDef): void
    {
    }

    public function getIndexColumn()
    {
        return false;
    }
}
