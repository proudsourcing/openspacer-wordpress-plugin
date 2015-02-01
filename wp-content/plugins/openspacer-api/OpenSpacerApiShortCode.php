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
        // you need to set an api key in event administration
        $apiKey = "testApi1234";

        extract( shortcode_atts( array(
            'api' => 'events',
            'id' => null,
            'key' => 'title'
        ), $atts ) );

        $param = "";
        if($key == "sessions")
        {
            $param = "/sessions";
        }
        if($key == "participants")
        {
            $param = "/participants";
        }

        $url = "http://ospacer.localhost/app_dev.php/api/v1/secured/".$api."/".$id.$param."?apiKey=".$apiKey;
        if($dataMethod == "fopen")
        {
            $json = file_get_contents($url);
        }
        else
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            $json = curl_exec($ch);
            curl_close($ch);
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