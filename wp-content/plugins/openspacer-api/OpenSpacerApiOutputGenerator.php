<?php

/**
 * Base class of output generators
 * Class OpenSpacerApiOutputGenerator
 */
class OpenSpacerApiOutputGenerator
{
    /**
     * @var string
     * */
    protected $api;

    /**
     * @var string
     * */
    protected $key;

    /**
     * @var array
     * */
    protected $data;

    /**
     * Constructor
     *
     * @param string $api
     * @param string $key
     * @param string $data
     */
    public function __construct($api, $key, $data)
    {
        $this->api = $api;
        $this->key = $key;
        $data = explode(',', $data);
        foreach($data as $k => $v)
            $this->data[] = trim($v);
    }

    /**
     * Create an anchor
     *
     * @param string $url
     * @param string $text
     * @param string $class
     *
     * @return string
     * */
    public function createAnchor($url, $text, $class = '')
    {
        $text = trim($text);
        if(empty($text))
            return '';

        return '<a target="_blank" href="'.$url.'" class="'.$class.'"><span class="ps-anchor">'.$text.'</span></a>';
    }

    /**
     * Create a list element <li></li>
     *
     * @param string $text
     * @param string $class
     *
     * @return string
     * */
    public function createList($text, $class = '')
    {
        $text = trim($text);
        if(empty($text))
            return '';

        return '<li class="'.$class.'"><span class="ps-list-element">'.$text.'</span></li>';
    }

    /**
     * Create an img <img />
     *
     * @param string $imgUrl
     * @param string $class
     *
     * @return string
     * */
    public function createImage($imgUrl, $class = '')
    {
        if(empty($imgUrl))
            return '';

        return '<span class="ps-picture"><img class="'.$class.'" src="'.$imgUrl.'" /></span>';
    }
} 