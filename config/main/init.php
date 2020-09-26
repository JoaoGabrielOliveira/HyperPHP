<?php
    require_once 'vendor/autoload.php';

    use Hyper\System\ConfigurationManager;

    switch ($argv[1])
    {
        case 'run':
            ConfigurationManager::setConfigurationFile('env.json');
        break;
    }

?>