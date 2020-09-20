<?php
    require_once dirname(__FILE__) . '/db_connection.php';
    require_once dirname(__DIR__) . '/../../colored_console/console.php';

    class DbOperation
    {
        public static function query(PDO $connection,$SQL, $OPTIONS='')
        {
            try
            {
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $connection->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
                $statement = $connection->prepare($SQL);
                $statement->execute();

                $result = $statement->fetchAll();

                $connection = null;
            }

            catch(PDOException $e)
            {
                return "Error: " . $e->getMessage();
                die();
            }
        }

        public static function insert(PDO $connection,array $values)
        {
            $insert_results = 0;

            $collumns_name;
            $processed_data;
            $marged_data;
            try
            {
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

                $statement = $connection->prepare($SQL_string);

                
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
            catch(PDOException $e)
            {
                print_red("Error: " . $e->getMessage(),false);
            }
        }

        public static function update(PDO $connection,$table_name = 'tb_cliente', $condition = ['nome' => 'Antonio'], $params = [ 'endereco_id'=> 1000])
        {
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);

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

        public static function delete(PDO $connection,$table_name = 'tb_cliente', $condition = ['nome' => 'Antonio'])
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

        /* HELPERS */

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

    include_once dirname(__FILE__) . '/CRUD/select.php';
    include_once dirname(__FILE__) . '/CRUD/insert.php';
?>