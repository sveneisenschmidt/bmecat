<?php
/**
 * This file is part of the BMEcat php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\BMEcat\Tests;

/**
 *
 * @package SE\Component\BMEcat\Tests
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class DocumentTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $data = [
            'document' => [
                'header' =>[
                    'generator_info' => 'DocumentTest Document',
                    'catalog' => [
                        'id'        => 'MY_CATALOG',
                        'version'   => '0.99',
                        'language'  => 'EN',
                        'datetime'  => [
                            'date' => '1979-01-01',
                            'time' => '10:59:54',
                            'timezone' => '-01:00',
                        ]
                    ],
                    'supplier' => [
                        'id'    => 'BMECAT_TEST',
                        'name'  => 'TestSupplier',
                    ]
                ]
            ]
        ];

        $builder = new \SE\Component\BMEcat\DocumentBuilder();
        $builder->build();
        $builder->load($data);

        $catalog = new \SE\Component\BMEcat\Node\NewCatalogNode;
        $builder->getDocument()->setNewCatalog($catalog);

        foreach([1,2,3] as $index) {
            $article = new \SE\Component\BMEcat\Node\ArticleNode;
            $article->setId($index);

            foreach([['EUR', 10.50], ['GBP', 7.30]] as $value) {
                list($currency, $amount) = $value;

                $price = new \SE\Component\BMEcat\Node\ArticlePriceNode;

                $price->setPrice($amount);
                $price->setCurrency($currency);
                $price->setSupplierPrice(round($amount/2,2));

                $article->addPrice($price);
            }

            foreach([['A', 'X'],['B', 'Y']] as $value) {
                list($key, $text) = $value;

                $feature = new \SE\Component\BMEcat\Node\ArticleFeatureNode;

                $feature->setName($key);
                $feature->setValue($text);

                $article->addFeature($feature);
            }

            $catalog->addArticle($article);
        }

        $this->builder = $builder;
    }

    /**
     *
     * @test
     */
    public function Compare_Document_With_Null_Values()
    {
        $this->builder->setSerializeNull(true);

        $expected = file_get_contents(__DIR__.'/Fixtures/document_with_null_values.xml');
        $actual = $this->builder->toString();

        $this->assertEquals($expected, $actual);
    }

    /**
     *
     * @test
     */
    public function Compare_Document_Without_Null_Values()
    {
        $this->builder->setSerializeNull(false);

        $expected = file_get_contents(__DIR__.'/Fixtures/document_without_null_values.xml');
        $actual = $this->builder->toString();

        $this->assertEquals($expected, $actual);
    }
}