<?php

class OpenSpacerApiOptions
{
    protected $options;

    public function __construct()
    {
        $this->options = get_option('openspacer_api_settings_options');
    }

    public function get($key)
    {
        if(isset($this->options[$key]))
            return $this->options[$key];

        return '';
    }
} 