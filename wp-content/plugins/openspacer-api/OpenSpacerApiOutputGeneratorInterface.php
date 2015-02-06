<?php

interface OpenSpacerApiOutputGeneratorInterface
{
    public function __construct($api, $key, $data);
    public function generate($json);
} 