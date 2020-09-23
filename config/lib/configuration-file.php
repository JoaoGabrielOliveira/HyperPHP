<?php

namespace Hyper\System;
use Exception;

class ConfigurationFile
{
    private static $path;
    private static $content;

    public static function getConfigPath()
    {
        return self::$path;
    }

    public static function getConfigContent()
    {
        return self::$content;
    }

    public function __construct($path)
    {
        self::$path = $path;
        self::$content = file_get_contents(self::$path, true);
    }

    public function saveConfiguration($content)
    {
        try
        {
            file_put_contents(self::$path, json_encode($content));
            echo "Configuration has been saved!";
        }

        catch(Exception $e)
        {
            echo 'Erro: ' . $e->getMessage();
        }
        
    }
}

?>