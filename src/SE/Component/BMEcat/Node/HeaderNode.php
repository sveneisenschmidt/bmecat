<?php
/**
 * This file is part of the BMEcat php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\BMEcat\Node;

use \JMS\Serializer\Annotation as Serializer;

use \SE\Component\BMEcat\Node\AbstractNode;
use \SE\Component\BMEcat\Node\CatalogNode;
use \SE\Component\BMEcat\Node\SupplierNode;

/**
 *
 * @package SE\Component\BMEcat
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * @Serializer\XmlRoot("HEADER")
 */
class HeaderNode extends AbstractNode
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("GENERATOR_INFO")
     *
     * @var string
     */
    protected $generatorInfo;

    /**
     * @param string $generatorInfo
     * @return void
     */
    public function setGeneratorInfo($generatorInfo)
    {
        $this->generatorInfo = $generatorInfo;
    }

    /**
     * @Serializer\Expose
     * @Serializer\Type("SE\Component\BMEcat\Node\CatalogNode")
     * @Serializer\SerializedName("CATALOG")
     *
     * @var \SE\Component\BMEcat\Node\CatalogNode
     */
    protected $catalog;

    /**
     * @param \SE\Component\BMEcat\Node\CatalogNode $catalog
     * @return void
     */
    public function setCatalog(CatalogNode $catalog)
    {
        $this->catalog = $catalog;
    }

    /**
     * @return \SE\Component\BMEcat\Node\CatalogNode $catalog
     */
    public function getCatalog()
    {
        return $this->catalog;
    }

    /**
     * @Serializer\Expose
     * @Serializer\Type("SE\Component\BMEcat\Node\SupplierNode")
     * @Serializer\SerializedName("SUPPLIER")
     *
     * @var \SE\Component\BMEcat\Node\SupplierNode
     */
    protected $supplier;

    /**
     * @param \SE\Component\BMEcat\Node\SupplierNode $supplier
     * @return void
     */
    public function setSupplier(SupplierNode $supplier)
    {
        $this->supplier = $supplier;
    }

    /**
     * @return \SE\Component\BMEcat\Node\SupplierNode
     */
    public function getSupplier()
    {
        return $this->supplier;
    }
}