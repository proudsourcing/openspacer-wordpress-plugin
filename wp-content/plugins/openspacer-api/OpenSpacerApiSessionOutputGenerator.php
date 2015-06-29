<?php
/*
Plugin Name: OpenSpacer API
Plugin URI: http://openspacer.org
Description: Get data from OpenSpacer REST API
Author: Proud Sourcing GmbH
Author URI: http://www.proudsourcing.de
Version: 2.1.0
*/

include_once 'OpenSpacerApiOutputGenerator.php';
include_once 'OpenSpacerApiOutputGeneratorInterface.php';

/**
 * Class OpenSpacerApiSessionOutputGenerator
 */
class OpenSpacerApiSessionOutputGenerator extends OpenSpacerApiOutputGenerator implements OpenSpacerApiOutputGeneratorInterface
{

    /**
     * {@inheritDoc}
     */
    public function __construct($api, $key, $data)
    {
        parent::__construct($api, $key, $data);
    }

    /**
     * {@inheritDoc}
     */
    public function generate($json)
    {
        switch($this->key)
        {
            default:
                return $this->sessionData($json);
                break;
        }
    }

    /**
     * Generate output for
     * @param $json
     * @return mixed
     */
    protected function sessionData($json)
    {
        $key = $this->key;
        return $json->$key;
    }
} 