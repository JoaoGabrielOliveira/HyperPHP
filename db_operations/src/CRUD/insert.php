<?php

namespace Hyper\Database\CRUD;

use Hyper\Database\DbConnection;
use PDO;

class insert
{
    public static function execute(array $values)
    {
        $insert_results = 0;

        $collumns_name;
        $processed_data;
        $marged_data;
        try
        {
            if (self::is_mutiple_values($values))
            {
                $collumns_name = implode(',',array_keys($values[0]));
                $processed_data = self::processing_data($values);
                $marged_data = self::merge_data($processed_data);
            }

            else
            {
                $collumns_name = implode(',',array_keys($values));
                $processed_data = self::processing_multiple_data($values);
                //The syntax to insert a single data it's already and does not need marge data.
                $marged_data = $processed_data;
            }

            $SQL_string = self::convert_data_to_insert_sql('tb_cliente',$collumns_name,$processed_data);

            $statement = DbConnection::prepare_statement($SQL_string);

            
            foreach($marged_data as $key=>$value)
            {
                $statement->bindValue($key,$value);
                $insert_results++;
            }

            $statement->execute();

            info_success(print_yellow($insert_results) . "foram dados insetidos com", " SUCESSO!","⇉");
            print_blue($SQL_string, false);
            print("\n");
            
            $connection = null;

            return $insert_results;
        }
        catch(Exception $e)
        {
            print_red("Error: " . $e->getMessage(),false);
        }
    }

    private static function processing_data(array $data)
    {
        $processed_data = [];

        foreach($data as $index => $row)
        {
            $insert_data = [];                    
            foreach($row as $key=>$value)
            {
                $index_value = ':' . $index . $key;
                $insert_data[$index_value] = $value;
            }

            array_push($processed_data,$insert_data);
        }
        return $processed_data;
    }

    private static function is_mutiple_values(array $data)
    {
        $keys = array_keys($data);
        $is_int = is_int($keys[0]);

        return $is_int;
    }

    private static function convert_data_to_insert_sql($table_name, $collumns,$rows)
    {
        $sql_values = self::convert_values_to_sql($rows);

        return "INSERT INTO $table_name ($collumns) VALUES " . implode(',',$sql_values);
    }

    private static function convert_values_to_sql(array $data)
    {
        $result = [];

        foreach($data as $key)
        {
            $is_array = is_array($key);
            $keys = ($is_array) ? array_keys($key) : array_keys($data);

            $string_keys = implode("," , $keys);

            $string_keys = "(" . $string_keys .")";

            array_push($result,$string_keys);

            if (!$is_array) break;
        }

        return $result;
    }

    private static function processing_multiple_data(array $data)
    {
        $processed_data = [];

        foreach($data as $index => $value)
        {
            $index_value = ':' . $index;
            $processed_data[$index_value] = $value;
        }

        return $processed_data;
    }

    private static function merge_data(array $data)
    {
        $marged_data = [];

        foreach($data as $one_data)
        {
            $marged_data = array_merge($marged_data, $one_data);
        }

        return $marged_data;
    }


}


?>