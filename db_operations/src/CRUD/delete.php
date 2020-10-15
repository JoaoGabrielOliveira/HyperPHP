<?php

namespace Hyper\Database\CRUD;

use Hyper\Database\DbConnection;
use Hyper\Console;
use PDO;

class delete
{
    public static function execute($table_name, $condition)
    {
        try
        {
            $condition = self::creating_condition($condition);

            $SQL_string = "DELETE FROM $table_name $condition";

            $statement = DbConnection::prepare_statement($SQL_string);

            $statement->execute();

            $connection = null;

            info_success( print_yellow($SQL_string) . "foram atualizados com", " SUCESSO!","  ⇉");
        }

        catch(Exception $e)
        {
            print_red("Error: " . $e->getMessage(),false);
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

?>