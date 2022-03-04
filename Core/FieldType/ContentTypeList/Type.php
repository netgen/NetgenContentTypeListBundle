<?php

declare(strict_types=1);

namespace Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList;

use Ibexa\Contracts\Core\FieldType\Value as SPIValue;
use Ibexa\Contracts\Core\Repository\Values\ContentType\FieldDefinition;
use Ibexa\Core\Base\Exceptions\InvalidArgumentType;
use Ibexa\Core\FieldType\FieldType;
use Ibexa\Core\FieldType\Value as BaseValue;
use function is_array;
use function is_string;

final class Type extends FieldType
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
     * @return \Ibexa\Contracts\Core\FieldType\Value|\Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList\Value
     */
    public function getEmptyValue(): SPIValue
    {
        return new Value();
    }

    /**
     * @param mixed $hash
     *
     * @return \Ibexa\Contracts\Core\FieldType\Value|\Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList\Value
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
     * @param \Ibexa\Contracts\Core\FieldType\Value|\Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList\Value $value
     *
     * @return mixed
     */
    public function toHash(SPIValue $value)
    {
        return $value->identifiers;
    }

    /**
     * @param \Ibexa\Contracts\Core\FieldType\Value|\Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList\Value $value
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
     * @param \Ibexa\Core\FieldType\Value|\Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList\Value $value
     */
    protected function checkValueStructure(BaseValue $value): void
    {
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
