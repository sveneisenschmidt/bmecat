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
class ArticleFeaturesNodeTest  extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->serializer = \JMS\Serializer\SerializerBuilder::create()->build();
    }

    /**
     *
     * @test
     */
    public function Add_Get_Feature()
    {
        $features = [
            new \SE\Component\BMEcat\Node\ArticleFeatureNode(),
            new \SE\Component\BMEcat\Node\ArticleFeatureNode(),
            new \SE\Component\BMEcat\Node\ArticleFeatureNode(),
        ];

        $node = new \SE\Component\BMEcat\Node\ArticleFeaturesNode();
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
    public function Set_Get_Reference_Feature_System_Name()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleFeaturesNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getReferenceFeatureSystemName());
        $node->setReferenceFeatureSystemName($value);
        $this->assertEquals($value, $node->getReferenceFeatureSystemName());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Reference_Feature_Group_Name()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleFeaturesNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getReferenceFeatureGroupName());
        $node->setReferenceFeatureGroupName($value);
        $this->assertEquals($value, $node->getReferenceFeatureGroupName());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Reference_Feature_Group_Id()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleFeaturesNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getReferenceFeatureGroupId());
        $node->setReferenceFeatureGroupId($value);
        $this->assertEquals($value, $node->getReferenceFeatureGroupId());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Serial_Number_Required()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleFeaturesNode();
        $value = rand(10,1000);

        $this->assertNull($node->getSerialNumberRequired());
        $node->setSerialNumberRequired($value);
        $this->assertEquals($value, $node->getSerialNumberRequired());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Customs_Tariff_Number()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleFeaturesNode();
        $value = rand(10,1000);

        $this->assertNull($node->getCustomsTariffNumber());
        $node->setCustomsTariffNumber($value);
        $this->assertEquals($value, $node->getCustomsTariffNumber());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Customs_Country_Of_Origin()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleFeaturesNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getCustomsCountryOfOrigin());
        $node->setCustomsCountryOfOrigin($value);
        $this->assertEquals($value, $node->getCustomsCountryOfOrigin());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Customs_Tariff_Text()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleFeaturesNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getCustomsTariffText());
        $node->setCustomsTariffText($value);
        $this->assertEquals($value, $node->getCustomsTariffText());
    }

    /**
     *
     * @test
     */
    public function Serialize_With_Null_Values()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleFeaturesNode();
        $context = \JMS\Serializer\SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__.'/../Fixtures/empty_article_features_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
    }

    /**
     *
     * @test
     */
    public function Serialize_Without_Null_Values()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleFeaturesNode();
        $context = \JMS\Serializer\SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__.'/../Fixtures/empty_article_features_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
    }
} 