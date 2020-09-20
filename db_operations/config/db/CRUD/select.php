<?php

class select
{
    public static function execute($connection,$table_name, $collumns = '*', $condition = '')
    {
        try
        {
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);

            $condition = self::creating_condition($condition);

            $statement = $connection->prepare("SELECT $collumns FROM $table_name $condition");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_CLASS);

            $connection = null;

            return $result;
        }

        catch(PDOException $e)
        {
            return "Error: " . $e->getMessage();
            die();
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