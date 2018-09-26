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
use SE\Component\BMEcat\Node\ArticleFeaturesNode;

/**
 *
 * @package SE\Component\BMEcat
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * @Serializer\XmlRoot("ARTICLE")
 */
class ArticleNode extends AbstractNode
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("SUPPLIER_AID")
     *
     * @var string
     */
    protected $id;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("ARTICLE_DETAILS")
     * @Serializer\Type("SE\Component\BMEcat\Node\ArticleDetailsNode")
     *
     * @var \SE\Component\BMEcat\Node\ArticleDetailsNode
     */
    protected $detail;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("ARTICLE_PRICE_DETAILS")
     * @Serializer\Type("array<SE\Component\BMEcat\Node\ArticlePriceNode>")
     * @Serializer\XmlList( entry="ARTICLE_PRICE")
     *
     * @var \SE\Component\BMEcat\Node\ArticlePriceNode[]
     */
    protected $prices = [];

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<SE\Component\BMEcat\Node\ArticleFeaturesNode>")
     * @Serializer\XmlList( inline=true, entry="ARTICLE_FEATURES")
     *
     * @var \SE\Component\BMEcat\Node\ArticleFeaturesNode[]
     */
    protected $features = [];

    /**
     * @Serializer\Expose
     * @Serializer\SerializedName("ARTICLE_ORDER_DETAILS")
     * @Serializer\Type("SE\Component\BMEcat\Node\ArticleOrderDetailsNode")
     *
     * @var \SE\Component\BMEcat\Node\ArticleOrderDetailsNode
     */
    protected $orderDetails;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("MIME_INFO")
     * @Serializer\Type("array<SE\Component\BMEcat\Node\ArticleMimeNode>")
     * @Serializer\XmlList( entry="MIME")
     *
     * @var \SE\Component\BMEcat\Node\ArticleMimeNode[]
     */
    protected $mimes;

    /**
     * Only for PIXI Import
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("ITEMTAGS")
     * @Serializer\Type("array<SE\Component\BMEcat\Node\ArticleItemTagNode>")
     * @Serializer\XmlList( entry="ITEMTAG")
     *
     * @var \SE\Component\BMEcat\Node\ArticleItemTagNode[]
     */
    protected $itemTags;

    /**
     *
     * @param \SE\Component\BMEcat\Node\ArticleDetailsNode $detail
     */
    public function setDetails(ArticleDetailsNode $detail)
    {
        $this->detail = $detail;
    }

    /**
     *
     * @return \SE\Component\BMEcat\Node\ArticleDetailsNode
     */
    public function getDetails()
    {
        return $this->detail;
    }

    /**
     *
     * @param \SE\Component\BMEcat\Node\ArticleFeaturesNode $features
     */
    public function addFeatures(ArticleFeaturesNode $features)
    {
        if ($this->features === null) {
            $this->features = [];
        }
        $this->features [] = $features;
    }

    /**
     *
     * @param \SE\Component\BMEcat\Node\ArticlePriceNode $price
     */
    public function addPrice(ArticlePriceNode $price)
    {
        if ($this->prices === null) {
            $this->prices = [];
        }
        $this->prices[] = $price;
    }

    public function addMime(ArticleMimeNode $mime)
    {
        if ($this->mimes === null) {
            $this->mimes = [];
        }
        $this->mimes[] = $mime;
    }

    public function addItemTag(ArticleItemTagNode $itemTag) {
        if ($this->itemTags === null) {
            $this->itemTags = [];
        }
        $this->itemTags[] = $itemTag;
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     */
    public function nullFeatures()
    {
        if (empty($this->features) === true) {
            $this->features = null;
        }
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     */
    public function nullItemTags()
    {
        if (empty($this->itemTags) === true) {
            $this->itemTags = null;
        }
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     */
    public function nullPrices()
    {
        if (empty($this->prices) === true) {
            $this->prices = null;
        }
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     */
    public function nullMime()
    {
        if (empty($this->mimes) === true) {
            $this->mimes = null;
        }
    }

    /**
     *
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param \SE\Component\BMEcat\Node\ArticleDetailsNode $detail
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
    }

    /**
     * @param \SE\Component\BMEcat\Node\ArticleOrderDetailsNode $orderDetails
     */
    public function setOrderDetails(ArticleOrderDetailsNode $orderDetails)
    {
        $this->orderDetails = $orderDetails;
    }

    /**
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \SE\Component\BMEcat\Node\ArticleDetailsNode
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     *
     * @return \SE\Component\BMEcat\Node\ArticleFeaturesNode[]
     */
    public function getFeatures()
    {
        if ($this->features === null) {
            return [];
        }

        return $this->features;
    }

    /**
     *
     * @return \SE\Component\BMEcat\Node\ArticlePriceNode[]
     */
    public function getPrices()
    {
        if ($this->prices === null) {
            return [];
        }

        return $this->prices;
    }

    /**
     * @return \SE\Component\BMEcat\Node\ArticleOrderDetailsNode
     */
    public function getOrderDetails()
    {
        return $this->orderDetails;
    }

    /**
     * @return \SE\Component\BMEcat\Node\ArticleMimeNode[]
     */
    public function getMimes()
    {
        if ($this->mimes === null) {
            return [];
        }

        return $this->mimes;
    }

    /**
     * @return \SE\Component\BMEcat\Node\ArticleItemTagNode[]
     */
    public function getItemTags()
    {
        if ($this->itemTags === null) {
            return [];
        }
        return $this->itemTags;
    }
}