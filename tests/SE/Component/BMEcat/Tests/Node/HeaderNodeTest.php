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
class HeaderNodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function Set_Get_Generator_Info()
    {
        $node = new \SE\Component\BMEcat\Node\HeaderNode();
        $value = sha1(uniqid(microtime(false), true));

        $this->assertNull($node->getGeneratorInfo());
        $node->setGeneratorInfo($value);
        $this->assertEquals($value, $node->getGeneratorInfo());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Supplier()
    {
        $header = new \SE\Component\BMEcat\Node\HeaderNode();
        $supplier = new \SE\Component\BMEcat\Node\SupplierNode();

        $this->assertNull($header->getSupplier());
        $header->setSupplier($supplier);
        $this->assertEquals($supplier, $header->getSupplier());
    }

    /**
     *
     * @test
     */
    public function Set_Get_Catalog()
    {
        $header = new \SE\Component\BMEcat\Node\HeaderNode();
        $catalog = new \SE\Component\BMEcat\Node\CatalogNode();

        $this->assertNull($header->getCatalog());
        $header->setCatalog($catalog);
        $this->assertEquals($catalog, $header->getCatalog());
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