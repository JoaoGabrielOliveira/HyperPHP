<?php
    namespace Hyper;

    require_once dirname(__FILE__).'/../vendor/autoload.php';

    use Hyper\System\ConfigurationManager;
    use Hyper;
    use Hyper\Database\DbConnection;
    use InvalidArgumentException;

    $a = $argv[1];

    switch($a)
    {
        case 'app':
            echo "Rodando a aplicação";

            $connection = DbConnection::connect();
        break;

        case 'env':
            if(!isset($argv[2]))
            {
                echo 'This command need a name of environment.';
                return;
            }

            $env_name = $argv[2];

            if(in_array($env_name, ConfigurationManager::allEnvironment()))
            {
                echo "Loading the environment...\n";
                sleep(2);
                $path = Hyper::config() . '/env/' . "$env_name.json";
                ConfigurationManager::loadEnvironment($path);
                echo "Loading the environment with success!";
            }

            else
            {
                echo 'This environment not exist in the list of environments';
                return;
            }
        break;

        default:
            echo "Nada";
        break;
    }

?>