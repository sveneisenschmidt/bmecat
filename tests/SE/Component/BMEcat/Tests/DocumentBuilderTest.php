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
class DocumentBuilderTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->serializer = $this->getMock('\JMS\Serializer\Serializer', [], [], '', false);
        $this->loader = new \SE\Component\BMEcat\NodeLoader;
    }

    /**
     *
     * @test
     */
    public function Can_Be_Instantiated()
    {
        $builder = new \SE\Component\BMEcat\DocumentBuilder($this->serializer, $this->loader);
    }

    /**
     *
     * @test
     */
    public function Sets_Up_Default_Dependencies()
    {
        $builder = new \SE\Component\BMEcat\DocumentBuilder();
        $this->assertInstanceOf('\JMS\Serializer\Serializer', $builder->getSerializer());
        $this->assertInstanceOf('\SE\Component\BMEcat\NodeLoader', $builder->getLoader());
    }

    /**
     *
     * @test
     */
    public function Instantiate_Via_Static_Method()
    {
        $builder = \SE\Component\BMEcat\DocumentBuilder::create($this->serializer, $this->loader);
        $this->assertInstanceOf('\JMS\Serializer\Serializer', $builder->getSerializer());
        $this->assertInstanceOf('\SE\Component\BMEcat\NodeLoader', $builder->getLoader());
    }

    /**
     *
     * @test
     */
    public function To_String_Returns_Default_Document_Without_Null_Values()
    {
        $builder = new \SE\Component\BMEcat\DocumentBuilder;
        $builder->build();
        $builder->setSerializeNull(false);

        $expected = file_get_contents(__DIR__.'/Fixtures/empty_document_without_null_values.xml');
        $this->assertEquals($expected, $builder->toString());

    }

    /**
     *
     * @test
     */
    public function To_String_Returns_Default_Document_With_Null_Values()
    {
        $builder = new \SE\Component\BMEcat\DocumentBuilder;
        $builder->build();
        $builder->setSerializeNull(true);

        $expected = file_get_contents(__DIR__.'/Fixtures/empty_document_with_null_values.xml');
        $this->assertEquals($expected, $builder->toString());
    }

    /**
     *
     * @test
     * @expectedException \SE\Component\BMEcat\Exception\MissingDocumentException
     */
    public function To_String_Throws_Exception()
    {
        $builder = new \SE\Component\BMEcat\DocumentBuilder;
        $builder->toString();
    }
}