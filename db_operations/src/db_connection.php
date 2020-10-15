<?php

namespace Hyper\Database;

use Exception;
use PDO;

class DbConnection
{   
    public $connection_params;
    private static $_instance;

    public function __construct($params)
    {
        if(isset($params['db']))
        {
            $params = $params['db'];
        }

        $this->connection_params = $params;
    }
    
    public function connect()
    {
        $database_server = '';
        $params = $this->connection_params;
        
        switch($params['driver'])
        {
            case 'sqlite':
                $database_server = 'sqlite:' . $params['path'];
            break;

            case 'psql':
            $database_server = 'psql' . ':
                dbname=' . $params['name'] . ';
                host=' . $params['host'] . ';
                port=' . $params['port'] . ';
                user:' . $params['user'] .';
                password:' . $params['password'] . 'charset=utf8';
            break;

            default:
                $new_params = [$params['driver'] . ':'];
                unset($params['driver']);

                //Get all params and set all with your key name and value
                foreach($params as $param => $value)
                {
                    $new_params[] = "$param=$value;";
                }

                $database_server = implode('',$new_params);
            break;
        }
        
        try 
        {
            return new \PDO($database_server);
        }
        catch(PDOException $e)
        {
            echo 'Conexão falhou: ' . $e->getMessage();
        }
    }

    public static function get_instance()
    {
        return self::$_instance;
    }

    public static function set_instance($params)
    {
        if(self::is_intance_null())
        {
            if(is_null($params))
            {
                throw new Exception("Database is not instanced. Create the instance using this method with params of the database.");
            }

            self::$_instance = new DbConnection($params);
        }

        else
        {
            echo "This it's already instanced";
        }
    }

    public static function prepare_statement(string $query)
    {
        $connection = self::$_instance->connect();

        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);

        return $connection->prepare($query);
    }

    private static function is_intance_null():bool
    {
        if(is_null(self::$_instance))
            return true;
        return false; 
    }
}

?>