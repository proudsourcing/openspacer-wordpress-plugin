<?php

class OpenSpacerCacheEngine
{
    private $_options;

    public function __construct()
    {
        $this->_options = get_option('openspacer_api_settings_options');
    }

    public function get($api,$key)
    {

    }
} 