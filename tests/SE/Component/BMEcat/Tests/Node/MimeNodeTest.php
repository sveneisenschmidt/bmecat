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
 * @author Jan Kahnt <j.kahnt@impericon.com>
 */
class MimeNodeTest extends \PHPUnit_Framework_TestCase
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
        $node = new \SE\Component\BMEcat\Node\MimeNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getType());
        $node->setType($value);
        $this->assertEquals($value, $node->getType());
    }

    /**
     * @test
     */
    public function Set_Get_Source()
    {
        $node = new \SE\Component\BMEcat\Node\MimeNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getSource());
        $node->setSource($value);
        $this->assertEquals($value, $node->getSource());
    }

    /**
     * @test
     */
    public function Set_Get_Purpose()
    {
        $node = new \SE\Component\BMEcat\Node\MimeNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getPurpose());
        $node->setPurpose($value);
        $this->assertEquals($value, $node->getPurpose());
    }

    /**
     *
     * @test
     */
    public function Serialize_With_Null_Values()
    {
        $node = new \SE\Component\BMEcat\Node\MimeNode();
        $context = \JMS\Serializer\SerializationContext::create()->setSerializeNull(true);

        $expected = file_get_contents(__DIR__.'/../Fixtures/empty_mime_info_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
    }

    /**
     *
     * @test
     */
    public function Serialize_Without_Null_Values()
    {
        $node = new \SE\Component\BMEcat\Node\MimeNode();
        $context = \JMS\Serializer\SerializationContext::create()->setSerializeNull(false);

        $expected = file_get_contents(__DIR__.'/../Fixtures/empty_mime_info_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml', $context);

        $this->assertEquals($expected, $actual);
    }
}
