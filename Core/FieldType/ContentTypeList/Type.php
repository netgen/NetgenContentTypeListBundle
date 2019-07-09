<?php

declare(strict_types=1);

namespace Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList;

use eZ\Publish\API\Repository\Values\ContentType\FieldDefinition;
use eZ\Publish\Core\Base\Exceptions\InvalidArgumentType;
use eZ\Publish\Core\FieldType\FieldType;
use eZ\Publish\Core\FieldType\Value as BaseValue;
use eZ\Publish\SPI\FieldType\Value as SPIValue;

class Type extends FieldType
{
    public function getFieldTypeIdentifier(): string
    {
        return 'ngclasslist';
    }

    public function getName(SPIValue $value, FieldDefinition $fieldDefinition, string $languageCode): string
    {
        return (string) $value;
    }

    /**
     * @return \eZ\Publish\SPI\FieldType\Value|\Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList\Value
     */
    public function getEmptyValue(): SPIValue
    {
        return new Value();
    }

    /**
     * @param mixed $hash
     *
     * @return \eZ\Publish\SPI\FieldType\Value|\Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList\Value
     */
    public function fromHash($hash): SPIValue
    {
        if (!is_array($hash)) {
            return new Value();
        }

        $contentTypeIdentifiers = [];
        foreach ($hash as $hashItem) {
            if (!is_string($hashItem)) {
                continue;
            }

            $contentTypeIdentifiers[] = $hashItem;
        }

        return new Value($contentTypeIdentifiers);
    }

    /**
     * @param \eZ\Publish\SPI\FieldType\Value|\Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList\Value $value
     *
     * @return mixed
     */
    public function toHash(SPIValue $value)
    {
        return $value->identifiers;
    }

    /**
     * @param \eZ\Publish\SPI\FieldType\Value|\Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList\Value $value
     */
    public function isEmptyValue(SPIValue $value): bool
    {
        return $value === null || $value->identifiers === $this->getEmptyValue()->identifiers;
    }

    protected function createValueFromInput($inputValue)
    {
        if (is_array($inputValue)) {
            foreach ($inputValue as $inputValueItem) {
                if (!is_string($inputValueItem)) {
                    return $inputValue;
                }
            }

            $inputValue = new Value($inputValue);
        }

        return $inputValue;
    }

    /**
     * @param \eZ\Publish\Core\FieldType\Value|\Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList\Value $value
     */
    protected function checkValueStructure(BaseValue $value): void
    {
        if (!is_array($value->identifiers)) {
            throw new InvalidArgumentType(
                '$value->identifiers',
                'array',
                $value->identifiers
            );
        }

        foreach ($value->identifiers as $identifier) {
            if (!is_string($identifier)) {
                throw new InvalidArgumentType(
                    (string) $identifier,
                    Value::class,
                    $identifier
                );
            }
        }
    }

    protected function getSortInfo(BaseValue $value)
    {
        return false;
    }
}
