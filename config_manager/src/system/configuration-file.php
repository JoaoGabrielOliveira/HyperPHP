<?php

namespace Hyper\System;
use Exception;
use InvalidArgumentException;

class ConfigurationFile
{
    private $path;
    private $content;

    public function __construct(string $path)
    {
        $this->setConfiguration($path);
    }

    public function setConfiguration(string $path)
    {
        $this->path = $path;

        $this->validatePath($path);

        $this->content = (object)json_decode(file_get_contents($this->path));
    }

    public function getConfigPath()
    {
        return $this->path;
    }

    public function getConfigContent()
    {
        return $this->content;
    }

    public function saveConfiguration()
    {
        $content = $this->getConfigContent();
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

    private function validatePath(string $path)
    {
        if(!file_exists($path))
            throw new InvalidArgumentException("The argument used is invalid or path is not correct.");
    }
}

?>