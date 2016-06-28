<?php

namespace Netgen\Bundle\ContentTypeListBundle\Tests\Core\Persistence\Legacy\Content\FieldValue\Converter;

use eZ\Publish\Core\Persistence\Legacy\Content\StorageFieldDefinition;
use eZ\Publish\Core\Persistence\Legacy\Content\StorageFieldValue;
use eZ\Publish\SPI\Persistence\Content\FieldValue;
use eZ\Publish\SPI\Persistence\Content\Type\FieldDefinition;
use Netgen\Bundle\ContentTypeListBundle\Core\Persistence\Legacy\Content\FieldValue\Converter\ContentTypeListConverter;
use eZ\Publish\Core\Persistence\Legacy\Content\FieldValue\Converter;

class ContentTypeListConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContentTypeListConverter
     */
    protected $converter;

    public function setUp()
    {
        $this->converter = new ContentTypeListConverter();
    }

    public function testInstanceOfConverterInterface()
    {
        $this->assertInstanceOf(Converter::class, $this->converter);
    }

    public function testCreate()
    {
        $this->assertEquals($this->converter, ContentTypeListConverter::create());
    }

    public function testToStorageFieldDefinition()
    {
        $fieldDefinition = new FieldDefinition();
        $storageDefinition = new StorageFieldDefinition();

        $this->converter->toStorageFieldDefinition($fieldDefinition, $storageDefinition);
    }

    public function testToFieldDefinition()
    {
        $fieldDefinition = new FieldDefinition();
        $storageDefinition = new StorageFieldDefinition();

        $this->converter->toFieldDefinition($storageDefinition, $fieldDefinition);
    }

    public function testGetIndexColumn()
    {
        $this->assertFalse($this->converter->getIndexColumn());
    }

    public function testToFieldValue()
    {
        $fieldDefinition = new FieldValue();
        $storageDefinition = new StorageFieldValue();

        $this->converter->toFieldValue($storageDefinition, $fieldDefinition);
    }

    public function testToStorageValue()
    {
        $fieldDefinition = new FieldValue();
        $storageDefinition = new StorageFieldValue();

        $this->converter->toStorageValue($fieldDefinition, $storageDefinition);
    }
}
