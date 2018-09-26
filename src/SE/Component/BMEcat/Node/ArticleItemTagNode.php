<?php

namespace SE\Component\BMEcat\Node;

use \JMS\Serializer\Annotation as Serializer;

/**
 *
 * @package SE\Component\BMEcat
 * @author Jochen Pfaeffle <jochen.pfaeffle.dev@gmail.com>
 *
 * @Serializer\XmlRoot("ITEMTAG")
 */
class ArticleItemTagNode extends AbstractNode
{
    /**
     * @Serializer\XmlValue
     * @Serializer\Type("string")
     *
     * @var string
     */
    static public $value = '';

    /**
     * @return string
     */
    public static function getValue()
    {
        return self::$value;
    }

    /**
     * @param string $value
     */
    public static function setValue($value)
    {
        self::$value = $value;
    }
}