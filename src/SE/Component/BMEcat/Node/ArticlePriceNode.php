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

use JMS\Serializer\Annotation as Serializer;

use SE\Component\BMEcat\Node\AbstractNode;

/**
 *
 * @package SE\Component\BMEcat
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * @Serializer\XmlRoot("ARTICLE_PRICE")
 */
class ArticlePriceNode extends AbstractNode
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("price_type")
     * @Serializer\XmlAttribute
     *
     * @var float
     */
    protected $type = 'gros_list';

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("PRICE_AMOUNT")
     *
     * @var float
     */
    protected $price;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("SUPPLPRICE_AMOUNT")
     *
     * @var float
     */

    protected $supplierPrice;
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("PRICE_CURRENCY")
     *
     * @var string
     */
    protected $currency;

    /**
     *
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     *
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     *
     * @param float $supplierPrice
     */
    public function setSupplierPrice($supplierPrice)
    {
        $this->supplierPrice = $supplierPrice;
    }

    /**
     *
     * @return float
     */
    public function getSupplierPrice()
    {
        return $this->supplierPrice;
    }
}