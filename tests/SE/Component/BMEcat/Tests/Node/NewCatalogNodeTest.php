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
class NewCatalogNodeTest  extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function Add_Get_Article_Node()
    {
        $articles = [
            new \SE\Component\BMEcat\Node\ArticleNode(),
            new \SE\Component\BMEcat\Node\ArticleNode(),
            new \SE\Component\BMEcat\Node\ArticleNode(),
        ];

        $node = new \SE\Component\BMEcat\Node\NewCatalogNode();
        $this->assertEmpty($node->getArticles());
        $node->nullArticles();
        $this->assertEquals([], $node->getArticles());

        foreach($articles as $article) {
            $node->addArticle($article);
        }

        $this->assertSame($articles, $node->getArticles());
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