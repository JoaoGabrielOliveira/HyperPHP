<?php

class update
{
    public static function execute(PDO $connection,$table_name, $condition, $params)
    {
        try
        {
            $setters = self::creating_setters($params);
            
            $condition = self::creating_condition($condition);

            $SQL_string = "UPDATE $table_name SET $setters $condition";

            $statement = $connection->prepare($SQL_string);

            $statement->execute();

            $connection = null;

            info_success(print_blue($setters) . "foram atualizados com", " SUCESSO!","  ⇉");
        }

        catch(Exception $e)
        {
            print_red("Error: " . $e->getMessage(),false);
        }
    }

    public static function execute_other(PDO $connection,$table_name, $params = [1, ['nome' => '', 'endereco_id' => '300']])
    {
        
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

    private static function creating_setters($data)
    {
        $result = [];

        foreach($data as $key => $value)
        {
            $set;
            if (is_numeric($value))
                $set =$key .'='. "$value";
            else
                $set =$key .'='. "'$value'";

            array_push($result,$set);
        }

        return( implode(',',$result) );
    }


}


?>