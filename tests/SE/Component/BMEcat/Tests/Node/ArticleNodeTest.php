<?php
/**
 * This file is part of the BMEcat php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\BMEcat\Tests\Node;

/**
 *
 * @package SE\Component\BMEcat\Tests
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class ArticleNodeTest  extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->serializer = \JMS\Serializer\SerializerBuilder::create()->build();
    }

    /**
     *
     * @test
     */
    public function Set_Get_Id()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getId());
        $node->setId($value);
        $this->assertEquals($value, $node->getId());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Details()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleNode();
        $details = new \SE\Component\BMEcat\Node\ArticleDetailsNode();

        $this->assertNull($node->getDetails());
        $node->setDetails($details);
        $this->assertEquals($details, $node->getDetails());
    }

    /**
     *
     * @test
     */
    public function Add_Get_Features()
    {

        $features = [
            new \SE\Component\BMEcat\Node\ArticleFeatureNode(),
            new \SE\Component\BMEcat\Node\ArticleFeatureNode(),
            new \SE\Component\BMEcat\Node\ArticleFeatureNode(),
        ];

        $node = new \SE\Component\BMEcat\Node\ArticleNode();
        $this->assertEmpty($node->getFeatures());
        $node->nullFeatures();
        $this->assertEquals([], $node->getFeatures());

        foreach($features as $feature) {
            $node->addFeature($feature);
        }

        $this->assertSame($features, $node->getFeatures());
    }

    /**
     *
     * @test
     */
    public function Add_Get_Prices()
    {
        $prices = [
            new \SE\Component\BMEcat\Node\ArticlePriceNode(),
            new \SE\Component\BMEcat\Node\ArticlePriceNode(),
            new \SE\Component\BMEcat\Node\ArticlePriceNode(),
        ];

        $node = new \SE\Component\BMEcat\Node\ArticleNode();
        $this->assertEmpty($node->getPrices());
        $node->nullPrices();
        $this->assertEquals([], $node->getPrices());

        foreach($prices as $price) {
            $node->addPrice($price);
        }

        $this->assertSame($prices, $node->getPrices());
    }

    /**
     *
     * @test
     */
    public function Serialize_With_Null_Values()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleNode();
        $this->serializer->setSerializeNull(true);

        $expected = file_get_contents(__DIR__.'/../Fixtures/empty_article_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml');

        $this->assertEquals($expected, $actual);
    }

    /**
     *
     * @test
     */
    public function Serialize_Without_Null_Values()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleNode();
        $this->serializer->setSerializeNull(false);

        $expected = file_get_contents(__DIR__.'/../Fixtures/empty_article_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml');

        $this->assertEquals($expected, $actual);
    }
} 