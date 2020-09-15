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

        public static function select(PDO $connection,$SQL, $OPTIONS='')
        {
            try
            {
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $connection->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
                $statement = $connection->prepare($SQL);
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
                    //The syntax to insert a single data it's already and does not need be marged.
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
                
                $condition = self::creating_condition();

                $SQL_string = "UPDATE $table_name SET $setters WHERE $condition";

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

        /* HELPERS */
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

        private static function is_mutiple_values(array $data)
        {
            $keys = array_keys($data);
            $is_int = is_int($keys[0]);

            return $is_int;
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
            }

            else if(is_string($condition))
            {
                $result = $condition;
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