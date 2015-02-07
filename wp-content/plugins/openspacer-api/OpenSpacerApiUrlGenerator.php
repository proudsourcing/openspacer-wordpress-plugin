<?php

class OpenSpacerApiUrlGenerator
{
    private $_options;

    private $_actions = array(
        'events' => array('participants', 'sessions'),
        'sessions' => array()
    );

    public function __construct(OpenSpacerApiOptions $options)
    {
        $this->_options = $options;
    }

    public function generateUrl($api, $eventId, $key, $param = '')
    {
        if(!empty($param))
            $param = '/'.$param;

        if(isset($this->_actions[$api]))
        {
            if(in_array($key, $this->_actions[$api]))
                $key = '/'.$key;
            else
                $key = '';
        }

        return $this->_options->get('api_url').
            '/'.$api.'/'.$eventId.$param.$key.'?apiKey='.$this->_options->get('api_key');
    }
}