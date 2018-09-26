<?php

namespace SE\Component\BMEcat\Tests\Node;


/**
 * @package SE\Component\BMEcat\Tests
 * @author Jochen Pfaeffle <jochen.pfaeffle.dev@gmail.com>
 */
class ArticleMimeNodeTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->serializer = \JMS\Serializer\SerializerBuilder::create()->build();
    }

    /**
     * @test
     */
    public function Set_Get_Type()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleMimeNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getType());
        $node->setType($value);
        $this->assertEquals($value, $node->getType());
    }

    /**
     * @test
     */
    public function Set_Get_Description()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleMimeNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getDescription());
        $node->setDescription($value);
        $this->assertEquals($value, $node->getDescription());
    }

    /**
     * @test
     */
    public function Set_Get_Source()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleMimeNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getSource());
        $node->setSource($value);
        $this->assertEquals($value, $node->getSource());
    }

    /**
     * @test
     */
    public function Set_Get_Alt()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleMimeNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getAlt());
        $node->setAlt($value);
        $this->assertEquals($value, $node->getAlt());
    }

    /**
     * @test
     */
    public function Set_Get_Purpose()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleMimeNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getPurpose());
        $node->setPurpose($value);
        $this->assertEquals($value, $node->getPurpose());
    }

    /**
     * @test
     */
    public function Serialize_With_Null_Values()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleMimeNode();
        $context = \JMS\Serializer\SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__.'/../Fixtures/empty_article_mime_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function Serialize_Without_Null_Values()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleMimeNode();
        $context = \JMS\Serializer\SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__.'/../Fixtures/empty_article_mime_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
    }
}