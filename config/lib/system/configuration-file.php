<?php

namespace Hyper\System;
use Exception;
use InvalidArgumentException;

class ConfigurationFile
{
    private $path;
    private $content;

    public function getConfigPath()
    {
        return $this->path;
    }

    public function getConfigContent()
    {
        return $this->content;
    }

    public function __construct($path)
    {
        $this->setConfiguration($path);
    }

    public function setConfiguration($path)
    {
        $this->path = $path;
        $this->content = (object)json_decode(file_get_contents($this->path, true));
    }

    public function saveConfiguration($content)
    {
        try
        {
            file_put_contents($this->path, json_encode($content));

            echo "Configuration has been saved!";
        }

        catch(Exception $e)
        {
            echo 'Erro: ' . $e->getMessage();
        }
        
    }

    public function addConfiguration($key,$value):void
    {
        $this->content->$key = $value;
    }

    public function removeConfiguration($key):void
    {
        unset($this->content[$key]);
    }
}

?>