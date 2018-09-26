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

/**
 *
 * @package SE\Component\BMEcat
 * @author Jochen Pfaeffle <jochen.pfaeffle.dev@gmail.com>
 *
 * @Serializer\XmlRoot("ARTICLE_FEATURES")
 */
class ArticleFeaturesNode extends AbstractNode
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("REFERENCE_FEATURE_SYSTEM_NAME")
     *
     * @var string
     */
    protected $referenceFeatureSystemName;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("REFERENCE_FEATURE_GROUP_NAME")
     * @Serializer\SkipWhenEmpty
     * @Serializer\Exclude(if="empty($this->referenceFeatureGroupId)")
     *
     * @var string
     */
    protected $referenceFeatureGroupName;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("REFERENCE_FEATURE_GROUP_ID")
     * @Serializer\SkipWhenEmpty
     * @Serializer\Exclude(if="empty($this->referenceFeatureGroupName)")
     *
     * @var string
     */
    protected $referenceFeatureGroupId;

    /**
     * @Serializer\Expose
     * @Serializer\SerializedName("FEATURE")
     * @Serializer\Type("array<SE\Component\BMEcat\Node\ArticleFeatureNode>")
     * @Serializer\XmlList( entry="FEATURE")
     *
     * @var \SE\Component\BMEcat\Node\ArticleFeatureNode[]
     */
    protected $features;

    /**
     * Only for PIXI Import
     *
     * @Serializer\Expose
     * @Serializer\Type("int")
     * @Serializer\SerializedName("SerialNumberRequired")
     * @Serializer\SkipWhenEmpty
     *
     * @var int
     */
    protected $serialNumberRequired;

    /**
     * Only for PIXI Import
     *
     * @Serializer\Expose
     * @Serializer\Type("int")
     * @Serializer\SerializedName("CustomsTariffNumber")
     * @Serializer\SkipWhenEmpty
     *
     * @var int
     */
    protected $customsTariffNumber;

    /**
     * Only for PIXI Import
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("CustomsCountryOfOrigin")
     * @Serializer\SkipWhenEmpty
     *
     * @var string
     */
    protected $customsCountryOfOrigin;

    /**
     * Only for PIXI Import
     *
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("CustomsTariffText")
     * @Serializer\SkipWhenEmpty
     *
     * @var string
     */
    protected $customsTariffText;

    /**
     * @param ArticleFeatureNode $feature
     */
    public function addFeature(ArticleFeatureNode $feature)
    {
        if ($this->features === null) {
            $this->features = [];
        }
        $this->features[] = $feature;
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
     * @param string $referenceFeatureSystemName
     */
    public function setReferenceFeatureSystemName($referenceFeatureSystemName)
    {
        $this->referenceFeatureSystemName = $referenceFeatureSystemName;
    }

    /**
     * @param string $referenceFeatureGroupName
     */
    public function setReferenceFeatureGroupName($referenceFeatureGroupName)
    {
        $this->referenceFeatureGroupName = $referenceFeatureGroupName;
    }

    /**
     * @param string $referenceFeatureGroupId
     */
    public function setReferenceFeatureGroupId($referenceFeatureGroupId)
    {
        $this->referenceFeatureGroupId = $referenceFeatureGroupId;
    }

    /**
     * @param int $serialNumberRequired
     */
    public function setSerialNumberRequired($serialNumberRequired)
    {
        $this->serialNumberRequired = $serialNumberRequired;
    }

    /**
     * @param int $customsTariffNumber
     */
    public function setCustomsTariffNumber($customsTariffNumber)
    {
        $this->customsTariffNumber = $customsTariffNumber;
    }

    /**
     * @param string $customsCountryOfOrigin
     */
    public function setCustomsCountryOfOrigin($customsCountryOfOrigin)
    {
        $this->customsCountryOfOrigin = $customsCountryOfOrigin;
    }

    /**
     * @param string $customsTariffText
     */
    public function setCustomsTariffText($customsTariffText)
    {
        $this->customsTariffText = $customsTariffText;
    }

    /**
     * @return string
     */
    public function getReferenceFeatureSystemName()
    {
        return $this->referenceFeatureSystemName;
    }

    /**
     * @return string
     */
    public function getReferenceFeatureGroupName()
    {
        return $this->referenceFeatureGroupName;
    }

    /**
     * @return string
     */
    public function getReferenceFeatureGroupId()
    {
        return $this->referenceFeatureGroupId;
    }

    /**
     * @return ArticleFeatureNode[]
     */
    public function getFeatures()
    {
        if ($this->features === null) {
            return [];
        }

        return $this->features;
    }

    /**
     * @return int
     */
    public function getSerialNumberRequired()
    {
        return $this->serialNumberRequired;
    }

    /**
     * @return int
     */
    public function getCustomsTariffNumber()
    {
        return $this->customsTariffNumber;
    }

    /**
     * @return string
     */
    public function getCustomsCountryOfOrigin()
    {
        return $this->customsCountryOfOrigin;
    }

    /**
     * @return string
     */
    public function getCustomsTariffText()
    {
        return $this->customsTariffText;
    }
}