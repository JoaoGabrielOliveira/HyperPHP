<?php

namespace Hyper\System;
use Hyper\System\ConfigurationFile;
use InvalidArgumentException;

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

    public static function getProjectName()
    {
        return(self::getConfiguration()->getConfigContent()->name);
    }

    public static function getCurrentEnvironment()
    {
        return(self::$Configuration->getConfigContent()->current_environment);
    }

    public static function allEnvironment()
    {
        return(self::$Configuration->getConfigContent()->env);
    }

    public static function loadEnvironment($path_environment_file)
    {
        if(!file_exists($path_environment_file))
        {
            throw new InvalidArgumentException;
        }

        $env = new ConfigurationFile($path_environment_file);

        self::$Configuration->addConfiguration("current_environment",$env->getConfigContent());
    }
}

?>