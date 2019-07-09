<?php

namespace Netgen\Bundle\ContentTypeListBundle\Tests\Core\FieldType\ContentTypeList;

use eZ\Publish\Core\Base\Exceptions\InvalidArgumentType;
use eZ\Publish\Core\FieldType\FieldType;
use eZ\Publish\Core\Repository\Values\ContentType\FieldDefinition;
use Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList\Type;
use Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList\Value;
use PHPUnit\Framework\TestCase;

class TypeTest extends TestCase
{
    /**
     * @var Type
     */
    protected $type;

    /**
     * @var array
     */
    protected $identifiers = array('identifier0', 'identifier1');

    /**
     * @var Value
     */
    protected $value;

    /**
     * @var Value
     */
    protected $emptyValue;

    public function setUp(): void
    {
        $this->type = new Type();
        $this->value = new Value($this->identifiers);
        $this->emptyValue = new Value();
    }

    public function testInstanceOfFieldType()
    {
        $this->assertInstanceOf(FieldType::class, $this->type);
    }

    public function testToHash()
    {
        $this->assertEquals($this->identifiers, $this->type->toHash($this->value));
    }

    public function testGetFieldTypeIdentifier()
    {
        $this->assertEquals('ngclasslist', $this->type->getFieldTypeIdentifier());
    }

    public function testGetEmptyValue()
    {
        $this->assertEquals($this->emptyValue, $this->type->getEmptyValue());
    }

    public function testGetName()
    {
        $this->assertEquals(implode(', ', $this->identifiers), $this->type->getName($this->value, new FieldDefinition(), 'eng-GB'));
    }

    public function testIsEmptyValue()
    {
        $this->assertFalse($this->type->isEmptyValue($this->value));
        $this->assertTrue($this->type->isEmptyValue($this->emptyValue));
    }

    public function testFromHashWithStringArgument()
    {
        $this->assertEquals($this->emptyValue, $this->type->fromHash('test'));
    }

    public function testFromHashWithArrayOfNumbers()
    {
        $this->assertEquals($this->emptyValue, $this->type->fromHash(array(123, 456)));
    }

    public function testFromHash()
    {
        $this->assertEquals($this->value, $this->type->fromHash($this->identifiers));
    }

    public function testAcceptValueWithArrayOfStringIdentifiers()
    {
        $this->type->acceptValue($this->identifiers);
    }

    public function testAcceptValueWithArrayOfNumbers()
    {
        $this->expectException(InvalidArgumentType::class);
        $this->expectExceptionMessage("Argument '\$value' is invalid: expected value to be of type 'Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList\Value', got 'array'");

        $this->type->acceptValue(array(123, 456));
    }

    public function testAcceptValueWithValueIdentifiersAsString()
    {
        $this->expectException(InvalidArgumentType::class);
        $this->expectExceptionMessage("Argument '\$value->identifiers' is invalid: expected value to be of type 'array', got 'string'");

        $this->value->identifiers = 'test';

        $this->type->acceptValue($this->value);
    }

    public function testAcceptValueWithValueIdentifiersAsArrayOfNumbers()
    {
        $this->expectException(InvalidArgumentType::class);
        $this->expectExceptionMessage("Argument '123' is invalid: expected value to be of type 'Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList\Value', got 'integer'");

        $this->value->identifiers = array(123, 456);

        $this->type->acceptValue($this->value);
    }

    public function testToPersistenceValue()
    {
        $this->type->toPersistenceValue($this->value);
    }
}
