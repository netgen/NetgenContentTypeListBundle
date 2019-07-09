<?php

declare(strict_types=1);

namespace Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList;

use eZ\Publish\Core\FieldType\Value as BaseValue;

class Value extends BaseValue
{
    /**
     * The list of content type identifiers.
     *
     * @var string[]
     */
    public $identifiers = [];

    /**
     * @param string[] $identifiers
     */
    public function __construct(array $identifiers = [])
    {
        $this->identifiers = $identifiers;
    }

    public function __toString(): string
    {
        return implode(', ', $this->identifiers);
    }
}
