<?php

class OpenSpacerApiOutputGenerator
{
    protected $api;
    protected $key;
    protected $data;

    public function __construct($api, $key, $data)
    {
        $this->api = $api;
        $this->key = $key;
        $data = explode(',', $data);
        foreach($data as $k => $v)
            $this->data[] = trim($v);
    }

    public function createAnchor($url, $text, $class = '')
    {
        return '<a target="_blank" href="'.$url.'" class="ps-anchor '.$class.'">'.trim($text).'</a>';
    }

    public function createList($text, $class = '')
    {
        return '<li class="ps-list-element '.$class.'">'.trim($text).'</li>';
    }

    public function createImage($imgUrl, $class = '')
    {
        return '<img class="ps-picture '.$class.'" src="'.$imgUrl.'" />';
    }
} 