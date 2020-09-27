<?php
    require_once '../vendor/autoload.php';

    use Hyper\System\ConfigurationManager;

    ConfigurationManager::setConfigurationFile('env.json');
    
    echo ConfigurationManager::getProjectName();

?>