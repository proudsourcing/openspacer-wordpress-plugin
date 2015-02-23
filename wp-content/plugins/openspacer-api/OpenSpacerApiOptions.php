<?php

/**
 * Class OpenSpacerApiOptions
 */
class OpenSpacerApiOptions
{
    /**
     * @var array
     */
    protected $options;

    public function __construct()
    {
        $this->options = get_option('openspacer_api_settings_options');
    }

    /**
     * Get the saved option value
     *
     * @param string $key
     * @return string|mixed
     */
    public function get($key)
    {
        if(isset($this->options[$key]))
            return $this->options[$key];

        return '';
    }
} 