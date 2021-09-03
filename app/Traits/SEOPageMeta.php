<?php

namespace App\Traits;


use Artesaos\SEOTools\Traits\SEOTools;
use SEOMeta;

trait SEOPageMeta
{

    use SEOTools;

    public function setPageTags($tags)
    {

        $this->seo()->setTitle($tags['title']);
        $this->seo()->setDescription($tags['description']);
        $this->seo()->setCanonical($tags['url']);
        $this->seo()->metatags()->setKeywords($tags['keywords']);
        $this->seo()->metatags()->setTitleSeparator($tags['separator']);


        $this->seo()->opengraph()->setTitle($tags['title']);
        $this->seo()->opengraph()->setDescription($tags['description']);
        $this->seo()->opengraph()->setUrl($tags['url']);
        $this->seo()->opengraph()->addImage($tags['image']);


        $this->seo()->twitter()->setTitle($tags['title']);
        $this->seo()->twitter()->setDescription($tags['description']);
        $this->seo()->twitter()->setImage($tags['image']);
        $this->seo()->twitter()->setUrl($tags['url']);

    }


}
