<?php
/*
Plugin Name: OpenSpacer API
Plugin URI: http://openspacer.org
Description: Get data from OpenSpacer REST API
Author: Proud Sourcing GmbH
Author URI: http://www.proudsourcing.de
Version: 2.1.0
*/

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