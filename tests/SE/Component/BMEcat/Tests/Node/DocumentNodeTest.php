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
class DocumentNodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function Set_Get_Version()
    {
        $document = new \SE\Component\BMEcat\Node\DocumentNode();

        $this->assertEquals('1.0', $document->getVersion());
        $document->setVersion('1.1');
        $this->assertEquals('1.1', $document->getVersion());
    }

    /**
     *
     * @test
     */
    public function Set_Get_New_Catalog()
    {
        $document = new \SE\Component\BMEcat\Node\DocumentNode();
        $catalog  = new \SE\Component\BMEcat\Node\NewCatalogNode();

        $this->assertNull($document->getNewCatalog());
        $document->setNewCatalog($catalog);
        $this->assertSame($catalog, $document->getNewCatalog());
    }

    /**
     *
     * @test
     */
    public function Set_Get_New_Header()
    {
        $document = new \SE\Component\BMEcat\Node\DocumentNode();
        $header  = new \SE\Component\BMEcat\Node\HeaderNode();

        $this->assertNull($document->getHeader());
        $document->setHeader($header);
        $this->assertSame($header, $document->getHeader());
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