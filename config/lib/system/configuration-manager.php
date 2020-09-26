<?php

namespace Hyper\System;
use Hyper\System\ConfigurationFile;

class ConfigurationManager
{
    private static $Configuration;

    public static function setConfigurationFile(string $path)
    {
        self::$Configuration = new ConfigurationFile($path);
    }

    public static function getConfiguration()
    {
        return self::$Configuration;
    }
}

?>