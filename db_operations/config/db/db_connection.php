<?php

class DbConnection
{
    public static function connect()
    {
        $db = $configs->Configs['db'];

        $database_server = 'mysql:dbname='. db['db-name'] . ';host=' . db['db-host']  . ';port=' . 3306 . ';charset=utf8';
        
        try 
        {
            $con = new \PDO($database_server,db['db-user'], db['db-pass']);
            return $con;
        }

        catch(PDOException $e)
        {
            echo 'Conexão falhou: ' . $e->getMessage();
        }
    }
}