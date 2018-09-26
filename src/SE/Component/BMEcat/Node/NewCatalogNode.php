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
use \SE\Component\BMEcat\Node\ArticleNode;

/**
 *
 * @Serializer\XmlRoot("T_NEW_CATALOG")
 */
class NewCatalogNode extends AbstractNode
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("array<SE\Component\BMEcat\Node\ArticleNode>")
     * @Serializer\XmlList(inline = true, entry = "ARTICLE")
     *
     * @var \SE\Component\BMEcat\Node\ArticleNode[]
     */
    protected $articles = [];

    /**
     *
     * @param \SE\Component\BMEcat\Node\ArticleNode $article
     */
    public function addArticle(ArticleNode $article)
    {
        if($this->articles === null) {
            $this->articles = [];
        }
        $this->articles []= $article;
    }

    /**
     *
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     */
    public function nullArticles()
    {
        if(empty($this->articles ) === true) {
            $this->articles = null;
        }
    }

    /**
     *
     * @return \SE\Component\BMEcat\Node\ArticleNode[]
     */
    public function getArticles()
    {
        if($this->articles === null)  {
            return [];
        }

        return $this->articles;
    }


}