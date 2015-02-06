<?php

include_once 'OpenSpacerApiOutputGenerator.php';
include_once 'OpenSpacerApiOutputGeneratorInterface.php';

class OpenSpacerApiSessionOutputGenerator extends OpenSpacerApiOutputGenerator implements OpenSpacerApiOutputGeneratorInterface
{

    public function __construct($api, $key, $data)
    {
        parent::__construct($api, $key, $data);
    }

    public function generate($json)
    {
        switch($this->key)
        {
            default:
                return $this->sessionData($json);
                break;
        }
    }

    protected function sessionData($json)
    {
        return $json->key;
    }
} 