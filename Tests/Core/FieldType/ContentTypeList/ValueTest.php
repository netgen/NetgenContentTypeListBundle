<?php

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

    public function setUp()
    {
        $this->value = new Value(
            array(
                'identifier0', 'identifier1',
            )
        );
    }

    public function testInstanceOfFieldTypeValue()
    {
        $this->assertInstanceOf(BaseValue::class, $this->value);
    }

    public function testToStringMethod()
    {
        $identifiers = 'identifier0, identifier1';

        $this->assertEquals($identifiers, (string) ($this->value));
    }
}
