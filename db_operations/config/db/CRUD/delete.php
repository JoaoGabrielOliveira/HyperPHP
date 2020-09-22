<?php

namespace Hyper\Database\CRUD;

use PDO;

class delete
{
    public static function execute(PDO $connection,$table_name = 'tb_cliente', $condition = ['nome' => 'Antonio'])
    {
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);

        try
        {
            $condition = self::creating_condition($condition);

            $SQL_string = "DELETE FROM $table_name $condition";

            $statement = $connection->prepare($SQL_string);

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