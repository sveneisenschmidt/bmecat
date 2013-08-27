<?php
/**
 * This file is part of the BMEcat php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\BMEcat\Tests;

/**
 *
 * @package SE\Component\BMEcat\Tests
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class DataLoaderTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->serializer = $this->getMock('\JMS\Serializer\Serializer', [], [], '', false);
        $this->loader     = new \SE\Component\BMEcat\NodeLoader;
        $this->builder    = new \SE\Component\BMEcat\DocumentBuilder($this->serializer, $this->loader);
    }

    /**
     *
     * @test
     */
    public function Can_Create_Default_Document()
    {
        \SE\Component\BMEcat\DataLoader::load([], $this->builder);
    }

    /**
     *
     * @test
     */
    public function Applies_Passed_In_Loader_Mapping()
    {
        $class = '\SE\Component\BMEcat\Tests\Fixtures\CustomDocumentNodeFixture';
        $data  = [
            'loader' => [
                \SE\Component\BMEcat\NodeLoader::DOCUMENT_NODE => $class
            ]
        ];

        \SE\Component\BMEcat\DataLoader::load($data, $this->builder);

        $node = $this->builder->getLoader()->get(\SE\Component\BMEcat\NodeLoader::DOCUMENT_NODE);
        $this->assertEquals($class, $node);
    }

    /**
     *
     * @test
     */
    public function Converts_Attribute_Name_To_Method_Name()
    {
        $attribute = 'my_test__attribute';
        $method    = \SE\Component\BMEcat\DataLoader::formatAttribute($attribute);

        $this->assertEquals('MyTestAttribute', $method);
    }

    /**
     *
     * @test
     */
    public function Scalar_Attribute_Is_Set()
    {
        $name  = 'id';
        $value = sprintf('Test_Id_%s', sha1(uniqid(microtime(false), true)));

        $stub = $this->getMock('\SE\Component\BMEcat\Node\ArticleNode');

        $stub->expects($this->once())
            ->method('setId')
            ->with($value);

        $stub->expects($this->once())
            ->method('getId')
            ->will($this->returnValue($value));

        \SE\Component\BMEcat\DataLoader::loadScalarData($name, $value, $stub);
        $this->assertSame($value, $stub->getId());
    }

    /**
     *
     * @test
     */
    public function Array_Of_Attributes_Are_Set()
    {
        $data = [
            'id'       => sha1(uniqid(microtime(false), true)),
            'language' => sha1(uniqid(microtime(false), true)),
            'version'  => sha1(uniqid(microtime(false), true)),
        ];

        $stub = $this->getMock('\SE\Component\BMEcat\Node\CatalogNode');

        $stub->expects($this->once())
            ->method('setId')
            ->with($data['id']);

        $stub->expects($this->once())
            ->method('getId')
            ->will($this->returnValue($data['id']));

        $stub->expects($this->once())
            ->method('setVersion')
            ->with($data['version']);

        $stub->expects($this->once())
            ->method('getVersion')
            ->will($this->returnValue($data['version']));

        $stub->expects($this->once())
            ->method('setLanguage')
            ->with($data['language']);

        $stub->expects($this->once())
            ->method('getLanguage')
            ->will($this->returnValue($data['language']));

        \SE\Component\BMEcat\DataLoader::loadArrayData($data, $stub);

        $this->assertSame($data['id'], $stub->getId());
        $this->assertSame($data['version'], $stub->getVersion());
        $this->assertSame($data['language'], $stub->getLanguage());
    }

    /**
     *
     * @test
     */
    public function Load_Header_Attributes()
    {
        $data = [
            'generator_info' => sha1(uniqid(microtime(false), true))
        ];

        $stub = $this->getMock('\SE\Component\BMEcat\Node\HeaderNode');

        $stub->expects($this->once())
            ->method('setGeneratorInfo')
            ->with($data['generator_info']);

        $stub->expects($this->once())
            ->method('getGeneratorInfo')
            ->will($this->returnValue($data['generator_info']));

        \SE\Component\BMEcat\DataLoader::loadHeader($data, $stub);

        $this->assertSame($data['generator_info'], $stub->getGeneratorInfo());
    }

    /**
     *
     * @test
     */
    public function Load_Header_Children()
    {
        $data = [
            'catalog' => [
                'id' => sha1(uniqid(microtime(false), true)),
            ],
            'supplier' => [
                'name' => sha1(uniqid(microtime(false), true)),
            ]
        ];

        $catalog = $this->getMock('\SE\Component\BMEcat\Node\CatalogNode');
        $catalog->expects($this->once())
            ->method('setId')
            ->with($data['catalog']['id']);
        $catalog->expects($this->once())
            ->method('getId')
            ->will($this->returnValue($data['catalog']['id']));


        $supplier = $this->getMock('\SE\Component\BMEcat\Node\SupplierNode');
        $supplier->expects($this->once())
            ->method('setName')
            ->with($data['supplier']['name']);
        $supplier->expects($this->once())
            ->method('getName')
            ->will($this->returnValue($data['supplier']['name']));

        $header = new \SE\Component\BMEcat\Node\HeaderNode;
        $header->setCatalog($catalog);
        $header->setSupplier($supplier);

        \SE\Component\BMEcat\DataLoader::loadHeader($data, $header);

        $this->assertSame($data['catalog']['id'], $catalog->getId());
        $this->assertSame($data['supplier']['name'], $supplier->getName());



    }
}