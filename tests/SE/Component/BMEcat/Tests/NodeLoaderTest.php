<?php
/**
 * This file is part of the BMEcat php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\BMEcat\Tests;

/**
 *
 * @package SE\Component\BMEcat\Tests
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class NodeLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var \SE\Component\BMEcat\NodeLoader
     */
    protected $loader;

    /**
     *
     * Sets up a default loader instance
     */
    public function setUp()
    {
        $this->loader = new \SE\Component\BMEcat\NodeLoader;
    }

    /**
     *
     * @test
     */
    public function Can_Be_Instantiated()
    {
        $this->assertInstanceOf('SE\Component\BMEcat\NodeLoader', $this->loader);
    }

    /**
     *
     * @test
     */
    public function Default_Mapping_Is_Ensured()
    {
        $map = [
            $this->loader->get(\SE\Component\BMEcat\NodeLoader::ARTICLE_DETAILS_NODE),
            $this->loader->get(\SE\Component\BMEcat\NodeLoader::ARTICLE_FEATURE_NODE),
            $this->loader->get(\SE\Component\BMEcat\NodeLoader::ARTICLE_PRICE_NODE),
            $this->loader->get(\SE\Component\BMEcat\NodeLoader::ARTICLE_NODE),
            $this->loader->get(\SE\Component\BMEcat\NodeLoader::CATALOG_NODE),
            $this->loader->get(\SE\Component\BMEcat\NodeLoader::DOCUMENT_NODE),
            $this->loader->get(\SE\Component\BMEcat\NodeLoader::NEW_CATALOG_NODE),
            $this->loader->get(\SE\Component\BMEcat\NodeLoader::HEADER_NODE),
            $this->loader->get(\SE\Component\BMEcat\NodeLoader::SUPPLIER_NODE),
        ];

        $this->assertSame([
            '\SE\Component\BMEcat\Node\ArticleDetailsNode',
            '\SE\Component\BMEcat\Node\ArticleFeatureNode',
            '\SE\Component\BMEcat\Node\ArticlePriceNode',
            '\SE\Component\BMEcat\Node\ArticleNode',
            '\SE\Component\BMEcat\Node\CatalogNode',
            '\SE\Component\BMEcat\Node\DocumentNode',
            '\SE\Component\BMEcat\Node\NewCatalogNode',
            '\SE\Component\BMEcat\Node\HeaderNode',
            '\SE\Component\BMEcat\Node\SupplierNode',
        ], $map);
    }

    /**
     *
     * @test
     */
    public function Custom_Mapping_Returns_Custom_Class()
    {
       $class = '\SE\Component\BMEcat\Tests\Fixtures\CustomArticleNodeFixture';
       $this->loader->set(\SE\Component\BMEcat\NodeLoader::ARTICLE_NODE, $class);
       $this->assertSame($class, $this->loader->get(\SE\Component\BMEcat\NodeLoader::ARTICLE_NODE));

       $instance = $this->loader->getInstance(\SE\Component\BMEcat\NodeLoader::ARTICLE_NODE);
       $this->assertInstanceOf($class, $instance);
       $this->assertInstanceOf('\SE\Component\BMEcat\Node\ArticleNode', $instance);
    }

}