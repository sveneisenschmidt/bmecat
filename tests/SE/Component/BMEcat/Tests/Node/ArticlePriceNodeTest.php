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
class ArticlePriceNodeTest  extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function Set_Get_Price()
    {
        $node = new \SE\Component\BMEcat\Node\ArticlePriceNode();
        $value = rand(10,1000);

        $this->assertNull($node->getPrice());
        $node->setPrice($value);
        $this->assertEquals($value, $node->getPrice());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Supplier_Price()
    {
        $node = new \SE\Component\BMEcat\Node\ArticlePriceNode();
        $value = rand(10,1000);

        $this->assertNull($node->getSupplierPrice());
        $node->setSupplierPrice($value);
        $this->assertEquals($value, $node->getSupplierPrice());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Currency()
    {
        $node = new \SE\Component\BMEcat\Node\ArticlePriceNode();
        $value = substr(sha1(uniqid(microtime(false), true)),0,3);

        $this->assertNull($node->getCurrency());
        $node->setCurrency($value);
        $this->assertEquals($value, $node->getCurrency());
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