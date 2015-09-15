<?php
/*
 * @package: OpenSpacer API
 * @author: Proud Sourcing GmbH
 * @link: https://github.com/proudsourcing/openspacer-wordpress-plugin
 * @version: 2.2.0
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
        'events' => array('participants', 'sessions', 'speakers', 'subevents', 'activities'),
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