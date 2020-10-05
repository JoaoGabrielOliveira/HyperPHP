<?php

namespace Hyper\System;

use Exception;
use InvalidArgumentException;
use Hyper\Console;

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
        $this->content = $this->validateFile($path);
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

            Console::info_success(" Configuration has been saved ", "");
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

    private function validateFile(string $path)
    {
        $this->validatePath($path);

        $content = file_get_contents($path);
        $extension = pathinfo($path)['extension'];

        switch($extension)
        {
            case 'json':
                return json_decode($content);
            break;

            case 'yml':
                return yaml_parse($content);
            break;

            case 'ini':
                return parse_ini_string($content);
            break;

            default:
                throw new Exception('file type is not support.');
            break;
        }

        
    }
}

?>