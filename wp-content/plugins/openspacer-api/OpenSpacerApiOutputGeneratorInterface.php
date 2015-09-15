<?php
/*
 * @package: OpenSpacer API
 * @author: Proud Sourcing GmbH
 * @link: https://github.com/proudsourcing/openspacer-wordpress-plugin
 * @version: 2.2.0
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