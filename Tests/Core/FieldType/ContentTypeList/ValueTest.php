<?php

declare(strict_types=1);

namespace Netgen\Bundle\ContentTypeListBundle\Tests\Core\FieldType\ContentTypeList;

use eZ\Publish\Core\FieldType\Value as BaseValue;
use Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList\Value;
use PHPUnit\Framework\TestCase;

class ValueTest extends TestCase
{
    /**
     * @var Value
     */
    protected $value;

    protected function setUp(): void
    {
        $this->value = new Value(
            [
                'identifier0', 'identifier1',
            ]
        );
    }

    public function testInstanceOfFieldTypeValue()
    {
        self::assertInstanceOf(BaseValue::class, $this->value);
    }

    public function testToStringMethod()
    {
        $identifiers = 'identifier0, identifier1';

        self::assertSame($identifiers, (string) ($this->value));
    }
}
