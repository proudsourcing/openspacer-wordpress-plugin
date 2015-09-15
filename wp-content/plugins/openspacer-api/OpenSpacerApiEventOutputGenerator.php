<?php
/*
 * @package: OpenSpacer API
 * @author: Proud Sourcing GmbH
 * @link: https://github.com/proudsourcing/openspacer-wordpress-plugin
 * @version: 2.2.0
 */

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
            case 'subevents':
                return $this->subeventsOutput($json);
                break;
            case 'speakers':
                return $this->speakersOutput($json);
                break;
            case 'activities':
                return $this->activitiesOutput($json);
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


            if(in_array('name', $this->data))
                $name = $participants->name;

            if(in_array('picture', $this->data))
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

            if(in_array('title', $this->data))
                $name = $session->title;

            if(in_array('ownerName', $this->data))
                $owner = $session->ownerName;

            if(in_array('ownerUrl', $this->data))
                $owner = $this->createAnchor($session->ownerUrl, $owner);

            if(in_array('url', $this->data))
                $anchor = $this->createAnchor($session->url, $name);
            else
                $anchor = $name;

            $html .= $this->createList($anchor.' '.$owner);
        }
        $html .= '</ul>';
        return $html;
    }
    
    /**
     * Generate output for [openspacer api=events id=EVENTID key=subevents data=DISPLAY_ATTRIBUTES]
     *
     * @param object $json
     *
     * @return string
     * */
    protected function subeventsOutput($json)
    {
        if(!is_array($json))
            return '';

        $html = '<ul class="ps-list ps-subevents">';
        foreach($json as $subevent)
        {
            $anchor = $title = $desc = $scount = $pcount = '';

            if(in_array('title', $this->data))
                $title = $subevent->title;

            if(in_array('description', $this->data))
                $desc = '<br>'.$subevent->description;
                
            if(in_array('sessionCount', $this->data))
                $scount = $subevent->sessionCount;
                
            if(in_array('participantCount', $this->data))
                $pcount = $subevent->participantCount;

            if(in_array('url', $this->data))
                $anchor = $this->createAnchor($subevent->url, $title);
            else
                $anchor = $title;
                
            if($pcount > 0 || $scount > 0) {
            	$count1 = "(";
            	$count2 = ")";
            }
            	
            $html .= $this->createList($anchor.' '.$count1.(($pcount > 0) ? $pcount." Teilnehmer" : "").(($scount > 0) ? ", ".$scount." Sessions" : "").$count2.$desc);
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

    /**
     * Generate output for [openspacer api=events id=EVENTID key=speakers data=DISPLAY_ATTRIBUTES]
     * @param $json
     * @return string
     */
    protected function speakersOutput($json)
    {
        if(!is_array($json))
            return '';

        $html = '<ul class="ps-list ps-speakers">';
        foreach($json as $participants)
        {
            $img = $anchor = $name = $city = '';

            if(in_array('name', $this->data))
                $name = $participants->name;

            if(in_array('picture', $this->data))
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
     * Generate output for [openspacer api=events id=EVENTID key=activities data=DISPLAY_ATTRIBUTES]
     * @param $json
     * @return string
     */
    protected function activitiesOutput($json)
    {
        if(!is_array($json))
            return '';

        $html = '<ul class="ps-list ps-activity">';
        foreach($json as $activities)
        {
            $img = $anchor = $name = $city = '';

            if(in_array('userName', $this->data))
                $name = $activities->userName;

            if(in_array('userPicture', $this->data))
                $img = $this->createImage($activities->userPicture);

            if(in_array('time', $this->data))
                $time = $activities->time;

            if(in_array('activity', $this->data))
                $activity = $activities->activity;
                
            if(in_array('userUrl', $this->data))
                $anchor = $this->createAnchor($activities->userUrl, $img.' '.$name);
            else
                $anchor = $img.' '.$name;

            $html .= $this->createList($anchor.' '.$activity);
        }
        $html .= '</ul>';
        return $html;
    }
    
}