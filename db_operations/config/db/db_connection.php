<?php

namespace Hyper\Database;

class DbConnection
{
    public static function connect($Configs)
    {
        $db = $Configs['db'];

        if($db['db-driver'] == 'sqlite')
        {
            $database_server = $db['db-driver']
            .':' . ROOTPATH . '/' . $db['db-name'];

            try 
            {
                $con = new \PDO($database_server);
                return $con;
            }
            catch(PDOException $e)
            {
                echo 'Conexão falhou: ' . $e->getMessage();
            }
        }
        else
        {
            $database_server = $db['db-driver']
            .':dbname=' . $db['db-name']
            .';host=' . $db['db-host']
            .';port=' . $db['port'] . ';charset=utf8';

            try 
            {
                $con = new \PDO($database_server,$db['db-user'], $db['db-pass']);
                return $con;
            }
            catch(PDOException $e)
            {
                echo 'Conexão falhou: ' . $e->getMessage();
            }
        }


    }
}