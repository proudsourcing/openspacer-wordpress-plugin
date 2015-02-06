<?php

class OpenSpacerApiShortCode
{
    private $_options;

    function __construct()
    {
        register_activation_hook( __FILE__, array( &$this, 'activate' ) );
        register_deactivation_hook( __FILE__, array( &$this, 'deactivate' ) );
        $this->_options = get_option('openspacer_api_settings_options');
    }

    function activate()
    {
        // on activate
    }

    function deactivate()
    {
        // on deactivate
    }

    function openSpacerData( $atts )
    {
        extract( shortcode_atts( array(
            'api' => 'events',
            'id' => null,
            'key' => '',
            'data' => 'title'
        ), $atts ) );

        $opt = new OpenSpacerApiOptions();
        $url = new OpenSpacerApiUrlGenerator($opt);
        $cache = new OpenSpacerApiCacheEngine($opt);

        $eventId = $opt->get('api_event');
        if(!empty($eventId) && null == $id)
            $id = $eventId;

        $json = $cache->get($api, $id, $key);

        if(!$json)
        {
            if($dataMethod == "fopen")
            {
                $json = file_get_contents($url->generateUrl($api, $id, $key));
            }
            else
            {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_URL, $url->generateUrl($api, $id, $key));
                $json = curl_exec($ch);
                curl_close($ch);
            }

            $cache->set($api, $id, $key, $json);
        }

        $json = json_decode($json);
        if($api == 'events')
        {
            $generator = new OpenSpacerApiEventOutputGenerator($api, $key, $data);
            return $generator->generate($json);
        }
        elseif($api == 'sessions')
        {
            $generator = new OpenSpacerApiSessionOutputGenerator($api, $key, $data);
            return $generator->generate($json);
        }
        else{}

    }
} 