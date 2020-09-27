<?php
    require_once '../vendor/autoload.php';

    use Hyper\System\ConfigurationManager;

    ConfigurationManager::setConfigurationFile('env.json');

    ConfigurationManager::loadEnvironment('dev.json');

    $content = ConfigurationManager::getCurrentEnvironment();
    
    print_r($content);

?>