<?php
/**
 * This file is part of the BMEcat php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\BMEcat;

use SE\Component\BMEcat\Exception\UnknownNodeException;
use SE\Component\BMEcat\Exception\UnknownNodeTypeException;

/**
 *
 * @package SE\Component\BMEcat
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class NodeLoader
{
    const DOCUMENT_NODE         = 'document.node';
    const HEADER_NODE           = 'header.node';
    const NEW_CATALOG_NODE      = 'newcatalog.node';
    const SUPPLIER_NODE         = 'supplier.node';
    const CATALOG_NODE          = 'catalog.node';
    const ARTICLE_NODE          = 'article.node';
    const ARTICLE_FEATURE_NODE  = 'article.feature.node';
    const ARTICLE_DETAILS_NODE  = 'article.details.node';
    const ARTICLE_PRICE_NODE    = 'article.price.node';
    const DATE_TIME_NODE        = 'datetime.node';

    /**
     *
     * @var array
     */
    protected $default = [
        self::DOCUMENT_NODE             => '\SE\Component\BMEcat\Node\DocumentNode',
        self::HEADER_NODE               => '\SE\Component\BMEcat\Node\HeaderNode',
        self::NEW_CATALOG_NODE          => '\SE\Component\BMEcat\Node\NewCatalogNode',
        self::SUPPLIER_NODE             => '\SE\Component\BMEcat\Node\SupplierNode',
        self::CATALOG_NODE              => '\SE\Component\BMEcat\Node\CatalogNode',
        self::ARTICLE_NODE              => '\SE\Component\BMEcat\Node\ArticleNode',
        self::ARTICLE_FEATURE_NODE      => '\SE\Component\BMEcat\Node\ArticleFeatureNode',
        self::ARTICLE_DETAILS_NODE      => '\SE\Component\BMEcat\Node\ArticleDetailsNode',
        self::ARTICLE_PRICE_NODE        => '\SE\Component\BMEcat\Node\ArticlePriceNode',
        self::DATE_TIME_NODE            => '\SE\Component\BMEcat\Node\DateTimeNode',
    ];

    /**
     *
     * @var array
     */
    protected $custom = [];

    /**
     *
     * @param string $nodeName
     * @throws \SE\Component\BMEcat\Exception\UnknownNodeException
     * @return \SE\Component\BMEcat\Node\AbstractNode
     */
    public function getInstance($nodeName)
    {
        if(isset($this->custom[$nodeName]) === true) {
            return new $this->custom[$nodeName];
        }

        if(isset($this->default[$nodeName]) === true) {
            return new $this->default[$nodeName];
        }

        throw new UnknownNodeException(sprintf('Node %s not found.', $nodeName));
    }

    /**
     *
     * @param string $nodeName
     * @param string $class
     * @throws \SE\Component\BMEcat\Exception\UnknownNodeTypeException
     */
    public function set($nodeName, $class)
    {
        if(isset($this->default[$nodeName]) === false) {
            throw new UnknownNodeTypeException(sprintf('Node name %s not found.', $nodeName));
        }

        $this->custom[$nodeName] = $class;
    }

    /**
     *
     * @param string $nodeName
     * @throws \SE\Component\BMEcat\Exception\UnknownNodeTypeException
     * @return $class
     */
    public function get($nodeName)
    {
        if(isset($this->custom[$nodeName]) === true) {
            return $this->custom[$nodeName];
        }

        if(isset($this->default[$nodeName]) === true) {
            return $this->default[$nodeName];
        }

        throw new UnknownNodeTypeException(sprintf('Node name %s not found.', $nodeName));
    }
}