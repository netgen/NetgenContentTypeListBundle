<?php

declare(strict_types=1);

namespace Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList;

use Ibexa\Core\FieldType\Value as BaseValue;

use function implode;

final class Value extends BaseValue
{
    /**
     * The list of content type identifiers.
     *
     * @param string[] $identifiers
     */
    public function __construct(
        public array $identifiers = [],
    ) {}

    public function __toString(): string
    {
        return implode(', ', $this->identifiers);
    }
}
