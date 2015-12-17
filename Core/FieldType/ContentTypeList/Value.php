<?php

namespace Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList;

use eZ\Publish\Core\FieldType\Value as BaseValue;

class Value extends BaseValue
{
    /**
     * The list of content type identifiers.
     *
     * @var string[]
     */
    public $identifiers = array();

    /**
     * Constructor.
     *
     * @param string[] $identifiers
     */
    public function __construct($identifiers = null)
    {
        if (is_array($identifiers)) {
            $this->identifiers = $identifiers;
        }
    }

    /**
     * Returns a string representation of the field value.
     *
     * @return string
     */
    public function __toString()
    {
        return implode(', ', $this->identifiers);
    }
}
