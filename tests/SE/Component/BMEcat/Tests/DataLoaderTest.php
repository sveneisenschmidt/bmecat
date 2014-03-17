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
    public function Load_From_Builder()
    {
        $info = sha1(uniqid(microtime(false), true));
        $data = [
            'document' => [
                'header' => [
                    'generator_info' => $info,
                ]
            ]
        ];

        $this->builder->load($data);

        $header = $this->builder->getDocument()->getHeader();
        $this->assertEquals($info, $header->getGeneratorInfo());
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
            'generator_info' => sha1(uniqid(microtime(false), true)),
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
    public function Load_Catalog_Children()
    {
        $data = [
            'datetime' => [
                'date' => '2001-01-01'
            ],
        ];

        $datetime = $this->getMock('\SE\Component\BMEcat\Node\DateTimeNode');
        $datetime->expects($this->once())
            ->method('setDate')
            ->with($data['datetime']['date']);
        $datetime->expects($this->once())
            ->method('getDate')
            ->will($this->returnValue($data['datetime']['date']));

        $catalog = new \SE\Component\BMEcat\Node\CatalogNode;
        $catalog->setDateTime($datetime);

        \SE\Component\BMEcat\DataLoader::loadCatalog($data, $catalog);

        $this->assertSame($data['datetime']['date'], $datetime->getDate());
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

    /**
     *
     * @test
     */
    public function Load_Empty_Document()
    {
        $data = [
            'document' => []
        ];

        $builder = $this->getMock('\SE\Component\BMEcat\DocumentBuilder', ['getDocument']);
        $builder->expects($this->exactly(2))
            ->method('getDocument');

        \SE\Component\BMEcat\DataLoader::load($data, $builder);
    }

    /**
     *
     * @test
     */
    public function Load_Document_Children()
    {
        $data = [
            'header' => [
                'generator_info' => sha1(uniqid(microtime(false), true)),
            ]
        ];

        $header   = $this->getMock('\SE\Component\BMEcat\Node\HeaderNode');
        $document = $this->getMock('\SE\Component\BMEcat\Node\DocumentNode');
        $document->setHeader($header);

        $header->expects($this->exactly(1))
            ->method('setGeneratorInfo')
            ->with($data['header']['generator_info']);

        $document->expects($this->exactly(2))
            ->method('getHeader')
            ->will($this->returnValue($header));

        \SE\Component\BMEcat\DataLoader::loadDocument($data, $document);
    }

    /**
     *
     * @test
     */
    public function Load_Document_Attributes()
    {
        $data = [
            'attributes' => [
                'version' => sha1(uniqid(microtime(false), true)),
            ]

        ];

        $document = $this->getMock('\SE\Component\BMEcat\Node\DocumentNode');
        $document->expects($this->exactly(1))
            ->method('setVersion')
            ->with($data['attributes']['version']);

        $document->expects($this->exactly(1))
            ->method('getVersion')
            ->will($this->returnValue($data['attributes']['version']));

        \SE\Component\BMEcat\DataLoader::loadDocument($data, $document);
        $this->assertSame($data['attributes']['version'], $document->getVersion());
    }

    /**
     *
     * @test
     */
    public function Nullable_Is_Handled_Correctly()
    {
        $data = [
            'nullable' => true
        ];

        $context = $this->getMock('\JMS\Serializer\SerializationContext', [], [], '', false);
        $context->expects($this->exactly(2))
            ->method('setSerializeNull')
            ->with($data['nullable']);

        $builder = new \SE\Component\BMEcat\DocumentBuilder(null, null, $context);
        $builder->setSerializeNull($data['nullable']);

        \SE\Component\BMEcat\DataLoader::load($data, $builder);
    }

    /**
     *
     * @test
     */
    public function Nullable_Has_Wrong_Value_And_Is_Ignored()
    {
        $data = [
            'nullable' => sha1(uniqid(microtime(false), true)),
        ];

        $serializer = $this->getMock('\JMS\Serializer\Serializer', [], [], '', false);
        $serializer->expects($this->exactly(0))
            ->method('setSerializeNull');

        $builder = new \SE\Component\BMEcat\DocumentBuilder($serializer);
        \SE\Component\BMEcat\DataLoader::load($data, $builder);
    }

    /**
     *
     * @test
     * @expectedException \SE\Component\BMEcat\Exception\UnknownKeyException
     */
    public function Unknown_Option_Key_Exceptions_Get_Thrown()
    {
        $data = [
            sha1(uniqid(microtime(false), true)) => []
        ];

        $builder = $this->getMock('\SE\Component\BMEcat\DocumentBuilder', ['getDocument']);
        \SE\Component\BMEcat\DataLoader::load($data, $builder);
    }

    /**
     *
     * @test
     * @expectedException \SE\Component\BMEcat\Exception\UnknownKeyException
     */
    public function Unknown_Document_Key_Exceptions_Get_Thrown()
    {
        $data = [
            sha1(uniqid(microtime(false), true)) => []
        ];

        $document = $this->getMock('\SE\Component\BMEcat\Node\DocumentNode');
        \SE\Component\BMEcat\DataLoader::loadDocument($data, $document);
    }

    /**
     *
     * @test
     * @expectedException \SE\Component\BMEcat\Exception\UnknownKeyException
     */
    public function Unknown_Header_Key_Exceptions_Get_Thrown()
    {
        $data = [
            sha1(uniqid(microtime(false), true)) => []
        ];

        $header = $this->getMock('\SE\Component\BMEcat\Node\HeaderNode');
        \SE\Component\BMEcat\DataLoader::loadHeader($data, $header);
    }

    /**
     *
     * @test
     * @expectedException \SE\Component\BMEcat\Exception\UnknownKeyException
     */
    public function Unknown_Catalog_Key_Exceptions_Get_Thrown()
    {
        $data = [
            sha1(uniqid(microtime(false), true)) => []
        ];

        $catalog = $this->getMock('\SE\Component\BMEcat\Node\CatalogNode');
        \SE\Component\BMEcat\DataLoader::loadCatalog($data, $catalog);
    }
}