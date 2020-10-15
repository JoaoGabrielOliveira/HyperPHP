<?php

namespace Hyper\Database\CRUD;

use Exception;
use Hyper\Database\DbConnection;
use PDO;

class select
{
    public static function execute($table_name, $collumns = '*', $condition = '')
    {
        try
        {
            $condition = self::creating_condition($condition);

            $SQL_string = "SELECT $collumns FROM $table_name $condition";

            $statement = DbConnection::prepare_statement($SQL_string);

            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_CLASS);

            return $result;
        }

        catch(Exception $e)
        {
            return "Error: " . $e->getMessage();
        }
    }

    private static function creating_condition($condition)
    {
        $result = [];

        if(is_array($condition) )
        {
            foreach($condition as $key => $value)
            {
                array_push($result,$key .'='."'$value'");
            }

            $result = implode(' AND ',$result);

            $result = 'WHERE ' . $result;
        }

        else if(is_string($condition) && $condition != '')
        {
            $result = 'WHERE ' . $condition;
        }

        else if($condition == '')
        {
            $result = '';
        }

        else
        {
            throw new InvalidArgumentException('Condition is not a string or a array.');
        }

        return($result);
    }
}