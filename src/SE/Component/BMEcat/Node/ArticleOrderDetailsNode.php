<?php

namespace SE\Component\BMEcat\Node;

use \JMS\Serializer\Annotation as Serializer;

/**
 *
 * @package SE\Component\BMEcat
 * @author Jochen Pfaeffle <jochen.pfaeffle.dev@gmail.com>
 *
 * @Serializer\XmlRoot("ARTICLE_ORDER_DETAILS")
 */
class ArticleOrderDetailsNode extends AbstractNode
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("ORDER_UNIT")
     *
     * @var string
     */
    protected $orderUnit;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("CONTENT_UNIT")
     *
     * @var string
     */
    protected $contentUnit;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("NO_CU_PER_OU")
     *
     * @var float
     */
    protected $noCuPerOu = 1;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("PRICE_QUANTITY")
     *
     * @var float
     */
    protected $priceQuantity = 1;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("QUANTITY_MIN")
     *
     * @var int
     */
    protected $quantityMin = 1;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("QUANTITY_INTERVAL")
     *
     * @var int
     */
    protected $quantityInterval = 1;

    /**
     * @return string
     */
    public function getOrderUnit()
    {
        return $this->orderUnit;
    }

    /**
     * @param string $orderUnit
     */
    public function setOrderUnit($orderUnit)
    {
        $this->orderUnit = $orderUnit;
    }

    /**
     * @return string
     */
    public function getContentUnit()
    {
        return $this->contentUnit;
    }

    /**
     * @param string $contentUnit
     */
    public function setContentUnit($contentUnit)
    {
        $this->contentUnit = $contentUnit;
    }

    /**
     * @return float
     */
    public function getNoCuPerOu()
    {
        return $this->noCuPerOu;
    }

    /**
     * @param float $noCuPerOu
     */
    public function setNoCuPerOu($noCuPerOu)
    {
        $this->noCuPerOu = $noCuPerOu;
    }

    /**
     * @return float
     */
    public function getPriceQuantity()
    {
        return $this->priceQuantity;
    }

    /**
     * @param float $priceQuantity
     */
    public function setPriceQuantity($priceQuantity)
    {
        $this->priceQuantity = $priceQuantity;
    }

    /**
     * @return int
     */
    public function getQuantityMin()
    {
        return $this->quantityMin;
    }

    /**
     * @param int $quantityMin
     */
    public function setQuantityMin($quantityMin)
    {
        $this->quantityMin = $quantityMin;
    }

    /**
     * @return int
     */
    public function getQuantityInterval()
    {
        return $this->quantityInterval;
    }

    /**
     * @param int $quantityInterval
     */
    public function setQuantityInterval($quantityInterval)
    {
        $this->quantityInterval = $quantityInterval;
    }
}