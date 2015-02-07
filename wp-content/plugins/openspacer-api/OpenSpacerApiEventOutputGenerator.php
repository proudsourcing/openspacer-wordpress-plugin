<?php

include_once 'OpenSpacerApiOutputGenerator.php';
include_once 'OpenSpacerApiOutputGeneratorInterface.php';

/**
 * Class OpenSpacerApiEventOutputGenerator
 */
class OpenSpacerApiEventOutputGenerator extends OpenSpacerApiOutputGenerator implements OpenSpacerApiOutputGeneratorInterface
{

    /**
     * {@inheritDoc}
     * */
    public function __construct($api, $key, $data)
    {
        parent::__construct($api, $key, $data);
    }

    /**
     * {@inheritDoc}
     * */
    public function generate($json)
    {
        switch($this->key)
        {
            case 'participants':
                return $this->participantsOutput($json);
                break;
            case 'sessions':
                return $this->sessionsOutput($json);
                break;
            default:
                return $this->eventData($json);
                break;
        }
    }

    /**
     * Generate output for [openspacer api=events id=EVENTID key=participants data=DISPLAY_ATTRIBUTES]
     *
     * @param object $json
     *
     * @return string
     * */
    protected function participantsOutput($json)
    {
        if(!is_array($json))
            return '';

        $html = '<ul class="ps-list ps-participants">';
        foreach($json as $participants)
        {
            $img = $anchor = $name = $city = '';
            $name = $participants->name;

            if(in_array('profilePicture', $this->data))
                $img = $this->createImage($participants->profilePicture);

            if(in_array('city', $this->data))
                $city = $participants->city;

            if(in_array('url', $this->data))
                $anchor = $this->createAnchor($participants->url, $img.' '.$name);
            else
                $anchor = $img.' '.$name;

            $html .= $this->createList($anchor.' '.$city);
        }
        $html .= '</ul>';
        return $html;
    }

    /**
     * Generate output for [openspacer api=events id=EVENTID key=sessions data=DISPLAY_ATTRIBUTES]
     *
     * @param object $json
     *
     * @return string
     * */
    protected function sessionsOutput($json)
    {
        if(!is_array($json))
            return '';

        $html = '<ul class="ps-sessions">';
        foreach($json as $session)
        {
            $anchor = $name = $owner = '';
            $name = $session->title;

            if(in_array('ownerUrl', $this->data))
                $owner = $this->createAnchor($session->ownerUrl, '('.$session->ownerName.')');

            if(in_array('url', $this->data))
                $anchor = $this->createAnchor($session->url, $name);
            else
                $anchor = $name;

            $html = $this->createList($anchor.' '.$owner);
        }
        $html .= '</ul>';
        return $html;
    }

    /**
     * Generate output for [openspacer api=events id=EVENTID key=DATAKEY]
     *
     * @param object $json
     *
     * @return string
     * */
    protected function eventData($json)
    {
        $key = $this->key;
        return $json->$key;
    }
}