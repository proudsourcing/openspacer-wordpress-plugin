<?php

class OpenSpacerCacheEngine
{
    private $_options;
    private $_urlGenerator;

    public function __construct(OpenSpacerApiOptions $options, OpenSpacerApiUrlGenerator $urlGenerator)
    {
        $this->_options = $options;
        $this->_urlGenerator = $urlGenerator;
    }

    public function get($api, $eventId, $key)
    {
        $path = $this->getPath($api, $eventId, $key);
        $files = scandir($path);

        $content = false;
        foreach($files as $file)
        {
            $filePath = $this->getFilePath($path, $file);
            if(is_dir($filePath))
                continue;

            if($this->checkValidity($file) === true)
                $content = file_get_contents($filePath);
        }
        return $content;
    }

    public function getPath($api, $eventId, $key)
    {
        $path = dirname(__FILE__).'/'.$api.'/'.$eventId.'/'.$key;
        if(!file_exists($path))
            mkdir($path, 0755, true);
    }

    public function getFilePath($path, $filename = false)
    {
        if(!$filename)
            return $path.'/'.time().'.cache';
        else
            return $path.'/'.$filename;
    }

    private function checkValidity($file)
    {
        if((int) $this->_options['cache_lifetime'] <= 0)
            return false;

        $temp = explode('.', $file);
        if(!isset($temp[1]) || $temp != 'cache')
            return false;

        $fileTime = (int) $temp[0];
        $now = time();
        if(($now - $fileTime) <= $this->_options['cache_lifetime'])
            return true;

        return false;
    }

    public function setCache($api, $eventId, $key)
    {

    }

    public function deleteFile($file)
    {

    }
} 