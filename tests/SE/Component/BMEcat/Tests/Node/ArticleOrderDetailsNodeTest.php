<?php

namespace SE\Component\BMEcat\Tests\Node;


/**
 * @package SE\Component\BMEcat\Tests
 * @author Jochen Pfaeffle <jochen.pfaeffle.dev@gmail.com>
 */
class ArticleOrderDetailsNodeTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->serializer = \JMS\Serializer\SerializerBuilder::create()->build();
    }

    /**
     * @test
     */
    public function Set_Get_Order_Unit()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleOrderDetailsNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getOrderUnit());
        $node->setOrderUnit($value);
        $this->assertEquals($value, $node->getOrderUnit());
    }

    /**
     * @test
     */
    public function Set_Get_Content_Unit()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleOrderDetailsNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getContentUnit());
        $node->setContentUnit($value);
        $this->assertEquals($value, $node->getContentUnit());
    }

    /**
     * @test
     */
    public function Set_Get_No_Cu_Per_Ou()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleOrderDetailsNode();
        $value = rand(10,1000);

        $this->assertEquals(1, $node->getNoCuPerOu());
        $node->setNoCuPerOu($value);
        $this->assertEquals($value, $node->getNoCuPerOu());
    }

    /**
     * @test
     */
    public function Set_Get_Price_Quantity()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleOrderDetailsNode();
        $value = rand(10,1000);

        $this->assertEquals(1, $node->getPriceQuantity());
        $node->setPriceQuantity($value);
        $this->assertEquals($value, $node->getPriceQuantity());
    }

    /**
     * @test
     */
    public function Set_Get_Quantity_Min()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleOrderDetailsNode();
        $value = rand(10,1000);

        $this->assertEquals(1, $node->getQuantityMin());
        $node->setQuantityMin($value);
        $this->assertEquals($value, $node->getQuantityMin());
    }

    /**
     * @test
     */
    public function Set_Get_Quantity_Interval()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleOrderDetailsNode();
        $value = rand(10,1000);

        $this->assertEquals(1, $node->getQuantityInterval());
        $node->setQuantityInterval($value);
        $this->assertEquals($value, $node->getQuantityInterval());
    }

    /**
     * @test
     */
    public function Serialize_With_Null_Values()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleOrderDetailsNode();
        $context = \JMS\Serializer\SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__.'/../Fixtures/empty_article_order_details_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function Serialize_Without_Null_Values()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleOrderDetailsNode();
        $context = \JMS\Serializer\SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__.'/../Fixtures/empty_article_order_details_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
    }
}