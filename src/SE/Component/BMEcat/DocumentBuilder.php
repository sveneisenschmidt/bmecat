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

use \JMS\Serializer\Serializer;
use \JMS\Serializer\SerializerBuilder;

use \SE\Component\BMEcat\DataLoader;
use \SE\Component\BMEcat\NodeLoader;
use \SE\Component\BMEcat\Node\DocumentNode;
use \SE\Component\BMEcat\Exception\MissingDocumentException;

/**
 *
 * @package SE\Component\BMEcat
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class DocumentBuilder
{
    /**
     *
     * @var \JMS\Serializer\Serializer
     */
    protected $serializer;

    /**
     *
     * @var \SE\Component\BMEcat\NodeLoader
     */
    protected $loader;

    /**
     *
     * @var \SE\Component\BMEcat\Node\DocumentNode
     */
    protected $document;

    /**
     *
     * @param \JMS\Serializer\Serializer $serializer
     * @param \SE\Component\BMEcat\NodeLoader $loader
     */
    public function __construct(Serializer $serializer = null, NodeLoader $loader = null)
    {
        if($serializer === null) {
            $serializer = SerializerBuilder::create()->build();
        }

        if($loader === null) {
            $loader = new NodeLoader();
        }

        $this->serializer = $serializer;
        $this->loader     = $loader;
    }

    /**
     *
     * @param \JMS\Serializer\Serializer $serializer
     * @param \SE\Component\BMEcat\NodeLoader $loader
     * @return \SE\Component\BMEcat\DocumentBuilder
     */
    public static function create(Serializer $serializer = null, NodeLoader $loader = null)
    {
        return new self($serializer, $loader);
    }

    /**
     *
     * @return \SE\Component\BMEcat\NodeLoader
     */
    public function getLoader()
    {
        return $this->loader;
    }

    /**
     *
     * @return \JMS\Serializer\Serializer
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     *
     * @param Node\DocumentNode $document
     * @return \SE\Component\BMEcat\NodeLoader
     */
    public function setDocument(DocumentNode $document)
    {
        $this->document = $document;
    }

    /**
     *
     * @return \SE\Component\BMEcat\Node\DocumentNode
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Builds the BMEcat document tree
     *
     * @return \SE\Component\BMEcat\Node\DocumentNode
     */
    public function build()
    {
        if(($document = $this->getDocument()) === null) {
            $document = $this->loader->getInstance(NodeLoader::DOCUMENT_NODE);
            $this->setDocument($document);
        }

        if(($header = $document->getHeader()) === null) {
            $header = $this->loader->getInstance(NodeLoader::HEADER_NODE);
            $document->setHeader($header);
        }

        if(($supplier = $header->getSupplier()) === null) {
            $supplier = $this->loader->getInstance(NodeLoader::SUPPLIER_NODE);
            $header->setSupplier($supplier);
        }

        if(($catalog = $header->getCatalog()) === null) {
            $catalog = $this->loader->getInstance(NodeLoader::CATALOG_NODE);
            $header->setCatalog($catalog);
        }

        if(($newCatalog = $document->getNewCatalog()) === null) {
            $newCatalog = $this->loader->getInstance(NodeLoader::NEW_CATALOG_NODE);
            $document->setNewCatalog($newCatalog);
        }

        return $document;
    }

    /**
     *
     * @param array $data
     */
    public function load(array $data)
    {
        DataLoader::load($data, $this);
    }

    /**
     *
     * @param boolean $serializeNull
     */
    public function setSerializeNull($serializeNull)
    {
        $this->getSerializer()->setSerializeNull($serializeNull);
    }

    /**
     *
     * @throws \SE\Component\BMEcat\Exception\MissingDocumentException
     * @return string
     */
    public function toString()
    {
        if(($document = $this->getDocument()) === null) {
            throw new MissingDocumentException('No Document built. Please call ::build first.');
        }

        return $this->serializer->serialize($document, 'xml');
    }
}