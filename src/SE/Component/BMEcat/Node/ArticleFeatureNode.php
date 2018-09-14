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

use http\Exception\BadQueryStringException;
use \JMS\Serializer\Annotation as Serializer;

use \SE\Component\BMEcat\Node\AbstractNode;

/**
 *
 * @package SE\Component\BMEcat
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * @Serializer\XmlRoot("FEATURE")
 */
class ArticleFeatureNode extends AbstractNode
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("FNAME")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    protected $name;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("VARIANTS")
     * @Serializer\SkipWhenEmpty
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\Exclude(if="empty($this->value)")
     *
     * @var string
     */
    protected $variants;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("FVALUE")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    protected $value;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("FUNIT")
     *
     * @var string
     */
    protected $unit;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("FORDER")
     *
     * @var string
     */
    protected $order;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("FDESCR")
     *
     * @var string
     */
    protected $description;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     * @Serializer\SerializedName("FVALUE_DETAILS")
     *
     * @var string
     */
    protected $valueDetails;

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $variants
     */
    public function setVariants($variants)
    {
        $this->variants = $variants;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @param string $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    /**
     * @param string $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param string $valueDetails
     */
    public function setValueDetails($valueDetails)
    {
        $this->valueDetails = $valueDetails;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVariants()
    {
        return $this->variants;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getValueDetails()
    {
        return $this->valueDetails;
    }
}