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

/**
 *
 * @package SE\Component\BMEcat
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * @Serializer\XmlRoot("ARTICLE_DETAILS")
 */
class ArticleDetailsNode extends AbstractNode
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("DESCRIPTION_SHORT")
     *
     * @var string
     */
    protected $descriptionShort;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("DESCRIPTION_LONG")
     *
     * @var string
     */
    protected $descriptionLong;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("EAN")
     *
     * @var string
     */
    protected $ean;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("SUPPLIER_ALT_AID")
     *
     * @var string
     */
    protected $supplierAltAid;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<SE\Component\BMEcat\Node\BuyerAidNode>")
     * @Serializer\XmlList(inline=true, entry="BUYER_AID")
     *
     * @var \SE\Component\BMEcat\Node\BuyerAidNode[]
     */
    protected $buyerAids;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("MANUFACTURER_AID")
     *
     * @var string
     */
    protected $manufacturerAid;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("MANUFACTURER_NAME")
     *
     * @var string
     */
    protected $manufacturerName;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("MANUFACTURER_TYPE_DESCR")
     *
     * @var string
     */
    protected $manufacturerTypeDescription;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("ERP_GROUP_BUYER")
     *
     * @var string
     */
    protected $erpGroupBuyer;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("ERP_GROUP_SUPPLIER")
     *
     * @var string
     */
    protected $erpGroupSupplier;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("float")
     * @Serializer\SerializedName("DELIVERY_TIME")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var float
     */
    protected $deliveryTime;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<SE\Component\BMEcat\Node\SpecialTreatmentClassNode>")
     * @Serializer\XmlList(inline=true, entry="SPECIAL_TREATMENT_CLASS")
     *
     * @var \SE\Component\BMEcat\Node\SpecialTreatmentClassNode[]
     */
    protected $specialTreatmentClasses;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<SE\Component\BMEcat\Node\ArticleKeywordNode>")
     * @Serializer\XmlList(inline=true, entry="KEYWORD")
     *
     * @var \SE\Component\BMEcat\Node\ArticleKeywordNode[]
     */
    protected $keywords;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("REMARKS")
     *
     * @var string
     */
    protected $remarks;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("SEGMENT")
     *
     * @var string
     */
    protected $segment;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("int")
     * @Serializer\SerializedName("ARTICLE_ORDER")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var int
     */
    protected $articleOrder;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<SE\Component\BMEcat\Node\ArticleStatusNode>")
     * @Serializer\XmlList(inline=true, entry="ARTICLE_STATUS")
     *
     * @var \SE\Component\BMEcat\Node\ArticleStatusNode[]
     */
    protected $articleStatus;

    /**
     * Only For PIXI Imports
     *
     * @Serializer\Expose
     * @Serializer\Type("int")
     * @Serializer\SerializedName("WEIGHT")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SkipWhenEmpty
     *
     * @var int
     */
    protected $weight;

    /**
     * @param BuyerAidNode $buyerAid
     */
    public function addBuyerAid(BuyerAidNode $buyerAid)
    {
        if ($this->buyerAids === null) {
            $this->buyerAids = [];
        }
        $this->buyerAids[] = $buyerAid;
    }

    /**
     * @param SpecialTreatmentClassNode $specialTreatmentClass
     */
    public function addSpecialTreatmentClass(SpecialTreatmentClassNode $specialTreatmentClass)
    {
        if ($this->specialTreatmentClasses === null) {
            $this->specialTreatmentClasses = [];
        }
        $this->specialTreatmentClasses[] = $specialTreatmentClass;
    }

    /**
     * @param ArticleKeywordNode $keyword
     */
    public function addKeyword(ArticleKeywordNode $keyword)
    {
        if ($this->keywords === null) {
            $this->keywords = [];
        }
        $this->keywords[] = $keyword;
    }

    /**
     * @param ArticleStatusNode $articleStatus
     */
    public function addArticleStatus(ArticleStatusNode $articleStatus)
    {
        if ($this->articleStatus === null) {
            $this->articleStatus = [];
        }
        $this->articleStatus[] = $articleStatus;
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     */
    public function nullBuyerAids()
    {
        if (empty($this->buyerAids) === true) {
            $this->buyerAids = null;
        }
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     */
    public function nullSpecialTreatmentClasses()
    {
        if (empty($this->specialTreatmentClasses) === true) {
            $this->specialTreatmentClasses = null;
        }
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     */
    public function nullKeywords()
    {
        if (empty($this->keywords) === true) {
            $this->keywords = null;
        }
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     */
    public function nullArticleStatus()
    {
        if (empty($this->articleStatus) === true) {
            $this->articleStatus = null;
        }
    }

    /**
     * @param string $descriptionShort
     */
    public function setDescriptionShort($descriptionShort)
    {
        $this->descriptionShort = $descriptionShort;
    }

    /**
     * @param string $descriptionLong
     */
    public function setDescriptionLong($descriptionLong)
    {
        $this->descriptionLong = $descriptionLong;
    }

    /**
     * @param string $ean
     */
    public function setEan($ean)
    {
        $this->ean = $ean;
    }

    /**
     * @param string $supplierAltAid
     */
    public function setSupplierAltAid($supplierAltAid)
    {
        $this->supplierAltAid = $supplierAltAid;
    }

    /**
     * @param string $manufacturerAid
     */
    public function setManufacturerAid($manufacturerAid)
    {
        $this->manufacturerAid = $manufacturerAid;
    }

    /**
     * @param string $manufacturerName
     */
    public function setManufacturerName($manufacturerName)
    {
        $this->manufacturerName = $manufacturerName;
    }

    /**
     * @param string $manufacturerTypeDescription
     */
    public function setManufacturerTypeDescription($manufacturerTypeDescription)
    {
        $this->manufacturerTypeDescription = $manufacturerTypeDescription;
    }

    /**
     * @param string $erpGroupBuyer
     */
    public function setErpGroupBuyer($erpGroupBuyer)
    {
        $this->erpGroupBuyer = $erpGroupBuyer;
    }

    /**
     * @param string $erpGroupSupplier
     */
    public function setErpGroupSupplier($erpGroupSupplier)
    {
        $this->erpGroupSupplier = $erpGroupSupplier;
    }

    /**
     * @param float $deliveryTime
     */
    public function setDeliveryTime($deliveryTime)
    {
        $this->deliveryTime = $deliveryTime;
    }

    /**
     * @param string $remarks
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;
    }

    /**
     * @param int $articleOrder
     */
    public function setArticleOrder($articleOrder)
    {
        $this->articleOrder = $articleOrder;
    }

    /**
     * @param string $segment
     */
    public function setSegment($segment)
    {
        $this->segment = $segment;
    }

    /**
     * @return string
     */
    public function getDescriptionLong()
    {
        return $this->descriptionLong;
    }

    /**
     * @return string
     */
    public function getDescriptionShort()
    {
        return $this->descriptionShort;
    }

    /**
     * @return string
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * @return string
     */
    public function getManufacturerName()
    {
        return $this->manufacturerName;
    }

    /**
     * @return string
     */
    public function getSegment()
    {
        return $this->segment;
    }

    /**
     * @return string
     */
    public function getSupplierAltAid()
    {
        return $this->supplierAltAid;
    }

    /**
     * @return BuyerAidNode[]
     */
    public function getBuyerAids()
    {
        if ($this->buyerAids === null) {
            return [];
        }

        return $this->buyerAids;
    }

    /**
     * @return string
     */
    public function getManufacturerAid()
    {
        return $this->manufacturerAid;
    }

    /**
     * @return string
     */
    public function getManufacturerTypeDescription()
    {
        return $this->manufacturerTypeDescription;
    }

    /**
     * @return string
     */
    public function getErpGroupBuyer()
    {
        return $this->erpGroupBuyer;
    }

    /**
     * @return string
     */
    public function getErpGroupSupplier()
    {
        return $this->erpGroupSupplier;
    }

    /**
     * @return float
     */
    public function getDeliveryTime()
    {
        return $this->deliveryTime;
    }

    /**
     * @return SpecialTreatmentClassNode[]
     */
    public function getSpecialTreatmentClasses()
    {
        if ($this->specialTreatmentClasses === null) {
            return [];
        }

        return $this->specialTreatmentClasses;
    }

    /**
     * @return ArticleKeywordNode[]
     */
    public function getKeywords()
    {
        if ($this->keywords === null) {
            return [];
        }

        return $this->keywords;
    }

    /**
     * @return string
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * @return int
     */
    public function getArticleOrder()
    {
        return $this->articleOrder;
    }

    /**
     * @return ArticleStatusNode[]
     */
    public function getArticleStatus()
    {
        if ($this->articleStatus === null) {
            return [];
        }

        return $this->articleStatus;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
}