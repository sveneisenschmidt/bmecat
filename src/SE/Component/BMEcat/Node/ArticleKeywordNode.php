<?php

namespace SE\Component\BMEcat\Node;

use \JMS\Serializer\Annotation as Serializer;

/**
 *
 * @package SE\Component\BMEcat
 * @author Jochen Pfaeffle <jochen.pfaeffle.dev@gmail.com>
 *
 * @Serializer\XmlRoot("KEYWORD")
 */
class ArticleKeywordNode extends AbstractNode
{
    /**
     * @Serializer\Type("string")
     * @Serializer\XmlValue
     *
     * @var string
     */
    static protected $value = '';

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