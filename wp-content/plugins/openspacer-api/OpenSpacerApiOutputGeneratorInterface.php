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
 * Interface for output generator
 * Interface OpenSpacerApiOutputGeneratorInterface
 */
interface OpenSpacerApiOutputGeneratorInterface
{
    /**
     * @param string $api
     * @param string $key
     * @param string $data
     */
    public function __construct($api, $key, $data);

    /**
     * Generate shortcode output
     *
     * @param object $json
     * @return string
     */
    public function generate($json);
} 