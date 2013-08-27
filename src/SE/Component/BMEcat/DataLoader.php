<?php
/**
 * This file is part of the BMEcat php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\BMEcat;

use \SE\Component\BMEcat\DocumentBuilder;
use \SE\Component\BMEcat\Node\AbstractNode;
use \SE\Component\BMEcat\Node\DocumentNode;
use \SE\Component\BMEcat\Node\HeaderNode;
use \SE\Component\BMEcat\Exception\UnknownKeyException;

/**
 *
 * @package SE\Component\BMEcat
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class DataLoader
{
    /**
     * @param array $data
     * @param \SE\Component\BMEcat\DocumentBuilder $builder
     * @throws Exception\UnknownKeyException
     */
    public static function load(array $data, DocumentBuilder $builder)
    {

        if(isset($data['loader']) === true) {
            foreach($data['loader'] as $nodeName => $class) {
                $builder->getLoader()->set($nodeName, $class);
            }
        }

        if(($document = $builder->getDocument()) === null) {
            $document = $builder->build();
        }

        foreach($data as $key => $value) {
            switch(strtolower($key)) {

                case 'nullable':
                    if(is_bool($value) === true) {
                        $builder->setSerializeNull($value);
                    }
                    break;

                case 'document':
                    self::loadDocument($value, $document);
                break;

                case 'loader':
                    continue;

                default:
                    throw new UnknownKeyException(sprintf('Unknown key %s to load', $key));
            }
        }
    }

    /**
     *
     * @param array $data
     * @param \SE\Component\BMEcat\Node\DocumentNode $document
     * @throws \SE\Component\BMEcat\Exception\UnknownKeyException
     */
    public static function loadDocument(array $data, DocumentNode $document)
    {
        foreach($data as $key => $value) {
            switch(strtolower($key)) {

                case 'header':
                    self::loadHeader($value, $document->getHeader());
                    break;

                case 'attributes':
                    self::loadArrayData($value, $document);
                    break;

                default:
                    throw new UnknownKeyException(sprintf('Unknown key document.%s to load', $key));
            }
        }
    }

    /**
     * @param array $data
     * @param \SE\Component\BMEcat\Node\HeaderNode $header
     * @throws \SE\Component\BMEcat\Exception\UnknownKeyException
     */
    public static function loadHeader(array $data, HeaderNode $header)
    {
        foreach($data as $key => $value) {
            switch(strtolower($key)) {

                case 'generator_info':
                    self::loadScalarData($key, $value, $header);
                    break;

                case 'catalog':
                    self::loadArrayData($value, $header->getCatalog());
                    break;

                case 'supplier':
                    self::loadArrayData($value, $header->getSupplier());
                    break;

                default:
                    throw new UnknownKeyException(sprintf('Unknown key header.%s to load', $key));
            }
        }
    }

    /**
     * @param array $data
     * @param \SE\Component\BMEcat\Node\AbstractNode $node
     */
    public static function loadArrayData(array $data, AbstractNode $node)
    {
        foreach($data as $key => $value) {
            self::loadScalarData($key, $value, $node);
        }
    }

    /**
     * @param string $key
     * @param mixed $value
     * @param \SE\Component\BMEcat\Node\AbstractNode $node
     */
    public static function loadScalarData($key, $value, AbstractNode $node)
    {
        $method = 'set'.self::formatAttribute($key);
        $node->{$method}($value);
    }

    /**
     * @param string $attribute
     * @return string
     */
    protected static function formatAttribute($attribute)
    {
        return \preg_replace_callback(
            '/(^|_|\.)+(.)/', function ($match) {
                return ('.' === $match[1] ? '_' : '').strtoupper($match[2]);
            }, $attribute
        );
    }
}