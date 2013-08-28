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
class CatalogNodeTest extends \PHPUnit_Framework_TestCase
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
        $node = new \SE\Component\BMEcat\Node\CatalogNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getId());
        $node->setId($value);
        $this->assertEquals($value, $node->getId());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Version()
    {
        $node = new \SE\Component\BMEcat\Node\CatalogNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getVersion());
        $node->setVersion($value);
        $this->assertEquals($value, $node->getVersion());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Language()
    {
        $node = new \SE\Component\BMEcat\Node\CatalogNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getLanguage());
        $node->setLanguage($value);
        $this->assertEquals($value, $node->getLanguage());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Date_Time()
    {
        $node = new \SE\Component\BMEcat\Node\CatalogNode();
        $dateTime = new \SE\Component\BMEcat\Node\DateTimeNode();

        $this->assertNull($node->getDateTime());
        $node->setDateTime($dateTime);
        $this->assertEquals($dateTime, $node->getDateTime());
    }

    /**
     *
     * @test
     */
    public function Serialize_With_Null_Values()
    {
        $node = new \SE\Component\BMEcat\Node\CatalogNode();
        $this->serializer->setSerializeNull(true);

        $expected = file_get_contents(__DIR__.'/../Fixtures/empty_catalog_with_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml');

        $this->assertEquals($expected, $actual);
    }

    /**
     *
     * @test
     */
    public function Serialize_Without_Null_Values()
    {
        $node = new \SE\Component\BMEcat\Node\CatalogNode();
        $this->serializer->setSerializeNull(false);

        $expected = file_get_contents(__DIR__.'/../Fixtures/empty_catalog_without_null_values.xml');
        $actual = $this->serializer->serialize($node, 'xml');

        $this->assertEquals($expected, $actual);
    }
}