<?php

declare(strict_types=1);

namespace Netgen\Bundle\ContentTypeListBundle\Form\Type\FieldType;

use eZ\Publish\API\Repository\FieldType;
use eZ\Publish\SPI\FieldType\Value;
use Symfony\Component\Form\DataTransformerInterface;

final class FieldValueTransformer implements DataTransformerInterface
{
    /**
     * @var \eZ\Publish\API\Repository\FieldType
     */
    private $fieldType;

    public function __construct(FieldType $fieldType)
    {
        $this->fieldType = $fieldType;
    }

    public function transform($value): ?array
    {
        if (!$value instanceof Value) {
            return null;
        }

        return $this->fieldType->toHash($value);
    }

    public function reverseTransform($value): Value
    {
        if ($value === null) {
            return $this->fieldType->getEmptyValue();
        }

        return $this->fieldType->fromHash($value);
    }
}
