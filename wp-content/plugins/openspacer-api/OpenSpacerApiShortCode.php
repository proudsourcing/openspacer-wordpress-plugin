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
        $apiKey = "testApi1234";

        extract( shortcode_atts( array(
            'api' => 'events',
            'id' => null,
            'key' => 'title'
        ), $atts ) );

        $settings = new OpenSpacerApiSettings();
        $opt = new OpenSpacerApiOptions();
        $url = new OpenSpacerApiUrlGenerator($opt);
        $cache = new OpenSpacerApiCacheEngine($opt);

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

        // get event session list
        if($api == "events" && $key == "sessions" && $id != null)
        {
            $data = json_decode($json);
            $sessionList = "";
            foreach($data as $session)
            {
                $sessionList .= '<li><a target="_blank" href="'.$session->url.'">'.$session->title.'</a> (<a target="_blank" href="https://openspacer.org'.$session->ownerUrl.'">'.$session->ownerName.'</a>)</li>';
            }
            return $sessionList;
        }

        // get event participant list
        if($api == "events" && $key == "participants" && $id != null)
        {
            $data = json_decode($json);
            $participantList = "";
            foreach($data as $participant)
            {
                $participantList .= '<li style="list-style-type: none;"><a target="_blank" href="'.$participant->url.'"><img src="'.$participant->profilePicture.'" border="0" style="border-radius: 50%; float: left; margin-right: 15px;">'.$participant->name.'</a><br>'.$participant->city.'<br><br></li>';
            }
            return $participantList;
        }

        // get event data
        if($api == "events" && $key != "sessions" && $id != null)
        {
            $data = json_decode($json);
            return $data->$key;
        }

        // get session details
        if($api == "sessions" && $id != null)
        {
            $data = json_decode($json);
            return $data->$key;
        }

        return;
    }
} 