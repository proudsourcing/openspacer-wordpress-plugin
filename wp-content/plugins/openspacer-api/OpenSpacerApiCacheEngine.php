<?php

/**
 * Manage API cache
 * Class OpenSpacerApiCacheEngine
 */
class OpenSpacerApiCacheEngine
{
    /**
     * @var OpenSpacerApiOptions
     */
    private $_options;

    /**
     * @param OpenSpacerApiOptions $options
     */
    public function __construct(OpenSpacerApiOptions $options)
    {
        $this->_options = $options;
    }

    /**
     * Get cached api data
     *
     * @param string $api
     * @param string $eventId
     * @param string $key
     * @return bool|string
     */
    public function get($api, $eventId, $key)
    {
        $files = scandir($this->getCacheDir());
        $filename = $this->getFileName($api, $eventId, $key, '');

        $content = false;
        foreach($files as $file)
        {
            if(is_dir($this->getFullFilePath($file)))
                continue;

            $temp = explode('.', $file);
            if($temp[0] != $filename)
                continue;

            if($this->checkValidity($file) === true)
                $content = file_get_contents($this->getFullFilePath($file));
        }
        return $content;
    }

    /**
     * Create cache filename
     *
     * @param string $api
     * @param string $eventId
     * @param string $key
     * @param bool|string $file
     * @return string
     */
    public function getFileName($api, $eventId, $key, $file = false)
    {
        if($file ===  false)
            return $api.$eventId.$key.'.'.time();
        else
            return $api.$eventId.$key;
    }

    /**
     * Get the full cache file path
     *
     * @param string $filename
     * @return string
     */
    public function getFullFilePath($filename)
    {
        return $this->getCacheDir().'/'.$filename;
    }

    /**
     * Get the directory path where cache files are saved
     * @return string
     */
    public function getCacheDir()
    {
        return dirname(__FILE__).'/cache';
    }

    /**
     * Check cache file validity
     *
     * @param string $file
     * @return bool
     */
    private function checkValidity($file)
    {
        if((int) $this->_options->get('cache_lifetime') <= 0)
            return false;

        $temp = explode('.', $file);
        if(!isset($temp[1]))
            return false;

        $fileTime = (int) $temp[1];
        $now = time();
        if(($now - $fileTime) <= $this->_options->get('cache_lifetime'))
            return true;

        return false;
    }

    /**
     * Set a cache file
     *
     * @param string $api
     * @param string $eventId
     * @param string $key
     * @param mixed $data
     */
    public function set($api, $eventId, $key, $data)
    {
        $file = $this->getFullFilePath($this->getFileName($api, $eventId, $key));
        file_put_contents($file, $data);
    }

    /**
     * Delete a cache file
     *
     * @param string $file
     */
    public function deleteFile($file)
    {
        if(basename($file) != '.gitignore')
            unlink($file);
    }

    /**
     * Clear all cache
     */
    public function clearCache()
    {
        $files = scandir($this->getCacheDir());
        foreach($files as $file)
        {
            $path = $this->getFullFilePath($file);
            if(!is_dir($path))
                $this->deleteFile($path);
        }
    }
} 