<?php

class OpenSpacerApiUrlGenerator
{
    private $_options;

    public function __construct(OpenSpacerApiOptions $options)
    {
        $this->_options = $options;
    }

    public function generateUrl($api, $eventId, $key, $param = '')
    {
        if(!empty($param))
            $param = '/'.$param;

        return $this->_options->get('api_url').
            '/'.$api.'/'.$eventId.$param.'/'.$key.'?apiKey='.$this->_options->get('api_key');
    }
}