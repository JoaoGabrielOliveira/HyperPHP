<?php
    require_once dirname(__DIR__) . '/vendor/autoload.php';

    use Hyper\System\ConfigurationManager;

    ConfigurationManager::setConfigurationFile(dirname(__FILE__) . '/env.json');

    ConfigurationManager::loadEnvironment(dirname(__FILE__) . '/dev.json');

    $content = ConfigurationManager::getCurrentEnvironment();
    
    print_r($content);

    
?>