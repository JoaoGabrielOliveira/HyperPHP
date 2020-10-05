<?php

namespace Hyper\Database;

class DbConnection
{    
    public static function connect($params)
    {
        if(isset($params->db))
        {
            $params = $params->db;
        }

        $database_server = '';

        switch($params->driver)
        {
            case 'sqlite':
                $database_server = 'sqlite:' . $params->path;
            break;

            case 'psql': $database_server = 'psql'
            .':dbname=' . $params->name
            .';host=' . $params->host
            .';port=' . $params->port . ';
            user:' . $params->user .';
            password:' . $params->password . 'charset=utf8';
            break;

            default:
                $database_server = $params->driver . ':dbname=' . $params->name . ';
                host=' . $params->host . ';
                port=' . $params->port . ';
                user:' . $params->user .';
                password:' . $params->password . 'charset=utf8';
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
}

?>