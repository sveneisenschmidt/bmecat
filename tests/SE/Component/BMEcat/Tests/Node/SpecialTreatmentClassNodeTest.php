<?php

namespace SE\Component\BMEcat\Tests\Node;


/**
 * @package SE\Component\BMEcat\Tests
 * @author Jochen Pfaeffle <jochen.pfaeffle.dev@gmail.com>
 */
class SpecialTreatmentClassNodeTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->serializer = \JMS\Serializer\SerializerBuilder::create()->build();
    }

    /**
     * @test
     */
    public function Serialize_With_Null_Values()
    {
        $node = new \SE\Component\BMEcat\Node\SpecialTreatmentClassNode();
        $context = \JMS\Serializer\SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__.'/../Fixtures/empty_special_treatment_class_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function Serialize_Without_Null_Values()
    {
        $node = new \SE\Component\BMEcat\Node\SpecialTreatmentClassNode();
        $context = \JMS\Serializer\SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__.'/../Fixtures/empty_special_treatment_class_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
    }
}