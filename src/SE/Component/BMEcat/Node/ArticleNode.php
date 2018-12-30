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
use \SE\Component\BMEcat\Node\ArticleDetailsNode;
use \SE\Component\BMEcat\Node\ArticleFeaturesNode;
use \SE\Component\BMEcat\Node\ArticlePriceNode;

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
     * @Serializer\SerializedName("SUPPLIER_AID")
     * @Serializer\Type("string")
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
     * @Serializer\SerializedName("ARTICLE_FEATURES")
     * @Serializer\Type("array<SE\Component\BMEcat\Node\ArticleFeatureNode>")
     * @Serializer\XmlList( entry="FEATURE")
     *
     * @var \SE\Component\BMEcat\Node\ArticleFeatureNode[]
     */
    protected $features = [];

    /**
     * @Serializer\Expose
     * @Serializer\SerializedName("MIME_INFO")
     * @Serializer\Type("array<SE\Component\BMEcat\Node\MimeNode>")
     * @Serializer\XmlList( entry="MIME")
     *
     * @var \SE\Component\BMEcat\Node\MimeNode[]
     */
    protected $mimeInfo = [];

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
     * @param \SE\Component\BMEcat\Node\ArticleFeatureNode $feature
     */
    public function addFeature(ArticleFeatureNode $feature)
    {
        if($this->features === null) {
            $this->features = [];
        }
        $this->features []= $feature;
    }
    /**
     *
     * @param \SE\Component\BMEcat\Node\ArticlePriceNode $price
     */
    public function addPrice(ArticlePriceNode $price)
    {
        if($this->prices === null) {
            $this->prices = [];
        }
        $this->prices []= $price;
    }


    /**
     *
     * @param \SE\Component\BMEcat\Node\MimeNode $mime
     */
    public function addMime(MimeNode $mime)
    {
        if($this->mimeInfo === null) {
            $this->mimeInfo = [];
        }
        $this->mimeInfo []= $mime;
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     */
    public function nullFeatures()
    {
        if(empty($this->features) === true) {
            $this->features = null;
        }
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     */
    public function nullPrices()
    {
        if(empty($this->prices) === true) {
            $this->prices = null;
        }
    }

    /**
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     */
    public function nullMimeInfo()
    {
        if(empty($this->mimeInfo) === true) {
            $this->mimeInfo = null;
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
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return \SE\Component\BMEcat\Node\ArticleFeatureNode[]
     */
    public function getFeatures()
    {
        if($this->features === null)  {
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
        if($this->prices === null)  {
            return [];
        }

        return $this->prices;
    }

    /**
     *
     * @return \SE\Component\BMEcat\Node\MimeNode[]
     */
    public function getMimeInfo()
    {
        if($this->mimeInfo === null) {
            return [];
        }

        return $this->mimeInfo;
    }
}