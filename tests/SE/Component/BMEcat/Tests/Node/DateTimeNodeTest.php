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
class DateTimeNodeTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->serializer = \JMS\Serializer\SerializerBuilder::create()->build();
    }

    /**
     *
     * @test
     */
    public function Set_Get_Date()
    {
        $node = new \SE\Component\BMEcat\Node\DateTimeNode();
        $value = '1979-01-10';

        $this->assertNull($node->getDate());
        $node->setDate($value);
        $this->assertEquals($value, $node->getDate());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Time()
    {
        $node = new \SE\Component\BMEcat\Node\DateTimeNode();
        $value = '10:59:54';

        $this->assertNull($node->getTime());
        $node->setTime($value);
        $this->assertEquals($value, $node->getTime());
    }

    /**
     *
     * @test
     */
    public function Set_Get_TimeZone()
    {
        $node = new \SE\Component\BMEcat\Node\DateTimeNode();
        $value = '-01:00';

        $this->assertNull($node->getTimeZone());
        $node->setTimeZone($value);
        $this->assertEquals($value, $node->getTimeZone());
    }

    /**
     *
     * @test
     */
    public function Serialize_With_Null_Values()
    {
        $node = new \SE\Component\BMEcat\Node\DateTimeNode();
        $this->serializer->setSerializeNull(true);

        $expected = file_get_contents(__DIR__.'/../Fixtures/empty_datetime_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml');

        $this->assertEquals($expected, $actual);
    }

    /**
     *
     * @test
     */
    public function Serialize_Without_Null_Values()
    {
        $node = new \SE\Component\BMEcat\Node\DateTimeNode();
        $this->serializer->setSerializeNull(false);

        $expected = file_get_contents(__DIR__.'/../Fixtures/empty_datetime_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml');

        $this->assertEquals($expected, $actual);
    }
}