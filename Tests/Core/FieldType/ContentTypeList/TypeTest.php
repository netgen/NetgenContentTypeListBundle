<?php

declare(strict_types=1);

namespace Netgen\Bundle\ContentTypeListBundle\Tests\Core\FieldType\ContentTypeList;

use Ibexa\Core\Base\Exceptions\InvalidArgumentType;
use Ibexa\Core\FieldType\FieldType;
use Ibexa\Core\Repository\Values\ContentType\FieldDefinition;
use Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList\Type;
use Netgen\Bundle\ContentTypeListBundle\Core\FieldType\ContentTypeList\Value;
use PHPUnit\Framework\TestCase;
use function implode;

final class TypeTest extends TestCase
{
    /**
     * @var Type
     */
    private $type;

    /**
     * @var array
     */
    private $identifiers = ['identifier0', 'identifier1'];

    /**
     * @var Value
     */
    private $value;

    /**
     * @var Value
     */
    private $emptyValue;

    protected function setUp(): void
    {
        $this->type = new Type();
        $this->value = new Value($this->identifiers);
        $this->emptyValue = new Value();
    }

    public function testInstanceOfFieldType(): void
    {
        self::assertInstanceOf(FieldType::class, $this->type);
    }

    public function testToHash(): void
    {
        self::assertSame($this->identifiers, $this->type->toHash($this->value));
    }

    public function testGetFieldTypeIdentifier(): void
    {
        self::assertSame('ngclasslist', $this->type->getFieldTypeIdentifier());
    }

    public function testGetEmptyValue(): void
    {
        self::assertSame($this->emptyValue->identifiers, $this->type->getEmptyValue()->identifiers);
    }

    public function testGetName(): void
    {
        self::assertSame(implode(', ', $this->identifiers), $this->type->getName($this->value, new FieldDefinition(), 'eng-GB'));
    }

    public function testIsEmptyValue(): void
    {
        self::assertFalse($this->type->isEmptyValue($this->value));
        self::assertTrue($this->type->isEmptyValue($this->emptyValue));
    }

    public function testFromHashWithStringArgument(): void
    {
        self::assertSame($this->emptyValue->identifiers, $this->type->fromHash('test')->identifiers);
    }

    public function testFromHashWithArrayOfNumbers(): void
    {
        self::assertSame($this->emptyValue->identifiers, $this->type->fromHash([123, 456])->identifiers);
    }

    public function testFromHash(): void
    {
        self::assertSame($this->value->identifiers, $this->type->fromHash($this->identifiers)->identifiers);
    }

    public function testAcceptValueWithArrayOfStringIdentifiers(): void
    {
        $this->type->acceptValue($this->identifiers);
    }

    public function testAcceptValueWithArrayOfNumbers(): void
    {
        $this->expectException(InvalidArgumentType::class);
        $this->expectExceptionMessage("Argument '\$value' is invalid: value must be of type 'Netgen\\Bundle\\ContentTypeListBundle\\Core\\FieldType\\ContentTypeList\\Value', not 'array'");

        $this->type->acceptValue([123, 456]);
    }

    public function testAcceptValueWithValueIdentifiersAsString(): void
    {
        $this->expectException(InvalidArgumentType::class);
        $this->expectExceptionMessage("Argument '\$value->identifiers' is invalid: value must be of type 'array', not 'string'");

        $this->value->identifiers = 'test';

        $this->type->acceptValue($this->value);
    }

    public function testAcceptValueWithValueIdentifiersAsArrayOfNumbers(): void
    {
        $this->expectException(InvalidArgumentType::class);
        $this->expectExceptionMessage("Argument '123' is invalid: value must be of type 'Netgen\\Bundle\\ContentTypeListBundle\\Core\\FieldType\\ContentTypeList\\Value', not 'integer'");

        $this->value->identifiers = [123, 456];

        $this->type->acceptValue($this->value);
    }

    public function testToPersistenceValue(): void
    {
        $this->type->toPersistenceValue($this->value);
    }
}
