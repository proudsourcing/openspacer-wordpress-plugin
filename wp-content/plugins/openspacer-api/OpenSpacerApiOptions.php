<?php
/*
 * @package: OpenSpacer API
 * @author: Proud Sourcing GmbH
 * @link: https://github.com/proudsourcing/openspacer-wordpress-plugin
 * @version: 2.2.0
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