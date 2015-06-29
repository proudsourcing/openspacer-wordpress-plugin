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
 * Url generator for api call
 * Class OpenSpacerApiUrlGenerator
 */
class OpenSpacerApiUrlGenerator
{
    /**
     * @var OpenSpacerApiOptions
     * */
    private $_options;

    /**
     * Predefined method keys
     * @var array
     * */
    private $_actions = array(
        'events' => array('participants', 'sessions', 'speakers', 'subevents'),
        'sessions' => array()
    );

    /**
     * @param OpenSpacerApiOptions $options
     * */
    public function __construct(OpenSpacerApiOptions $options)
    {
        $this->_options = $options;
    }

    /**
     * Generate api URL from short tag attributes
     *
     * @param string $api
     * @param string $eventId
     * @param string $key
     * @param string $param
     *
     * @return string
     * */
    public function generateUrl($api, $eventId, $key, $param = '')
    {
        if(!empty($param))
            $param = '/'.$param;

        // check if key is an action
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