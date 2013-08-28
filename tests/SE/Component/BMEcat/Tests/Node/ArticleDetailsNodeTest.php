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
class ArticleDetailsNodeTest  extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function Set_Get_Description_Long()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleDetailsNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getDescriptionLong());
        $node->setDescriptionLong($value);
        $this->assertEquals($value, $node->getDescriptionLong());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Description_Short()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleDetailsNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getDescriptionShort());
        $node->setDescriptionShort($value);
        $this->assertEquals($value, $node->getDescriptionShort());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Ean()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleDetailsNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getEan());
        $node->setEan($value);
        $this->assertEquals($value, $node->getEan());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Manufacturer_Name()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleDetailsNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getManufacturerName());
        $node->setManufacturerName($value);
        $this->assertEquals($value, $node->getManufacturerName());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Description_Segment()
    {
        $node = new \SE\Component\BMEcat\Node\ArticleDetailsNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getSegment());
        $node->setSegment($value);
        $this->assertEquals($value, $node->getSegment());
    }

    /**
     *
     * @test
     */
    public function Serialize_With_Null_Values()
    {
        $this->markTestIncomplete();
    }

    /**
     *
     * @test
     */
    public function Serialize_Without_Null_Values()
    {
        $this->markTestIncomplete();
    }
} 