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
use \SE\Component\BMEcat\Node\DateTimeNode;

/**
 *
 * @package SE\Component\BMEcat
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * @Serializer\XmlRoot("CATALOG")
 */
class CatalogNode extends AbstractNode
{

    /**
      * @Serializer\Expose
      * @Serializer\Type("string")
      * @Serializer\SerializedName("CATALOG_ID")
     * @Serializer\XmlElement(cdata=false)
      *
      * @var string
      */
    protected $id;

    /**
      * @Serializer\Expose
      * @Serializer\Type("string")
      * @Serializer\SerializedName("CATALOG_VERSION")
     * @Serializer\XmlElement(cdata=false)
      *
      * @var string
      */
    protected $version;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("LANGUAGE")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    protected $language;

    /**
     * @Serializer\Expose
     * @Serializer\Type("SE\Component\BMEcat\Node\DateTimeNode")
     * @Serializer\SerializedName("DATETIME")
     * @Serializer\XmlElement(cdata=false)
     *
     * @var string
     */
    protected $dateTime;

    /**
     * @param string $language
     * @return void
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @param string $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $version
     * @return void
     */
    public function setVersion($version)
    {
        $this->version = $version;
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
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     *
     * @param \SE\Component\BMEcat\Node\DateTimeNode $dateTime
     */
    public function setDateTime(DateTimeNode $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    /**
     *
     * @return \SE\Component\BMEcat\Node\DateTimeNode
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

}