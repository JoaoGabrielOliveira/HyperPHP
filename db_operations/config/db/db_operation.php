<?php
    require_once dirname(__FILE__) . '/db_connection.php';

    class DbOperation
    {
        public static function query($connection,$SQL, $OPTIONS='')
        {
            try
            {
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $connection->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
                $statement = $connection->prepare('SELECT * FROM tb_cliente');
                $statement->execute();

                $result = $statement->fetchAll();

                $connection = null;

                return $result;
            }

            catch(PDOException $e)
            {
                return "Error: " . $e->getMessage();
                die();
            }
        }

        public static function select($connection,$SQL, $OPTIONS='')
        {
            try
            {
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $connection->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
                $statement = $connection->prepare('SELECT * FROM tb_cliente');
                $statement->execute();

                $result = $statement->fetchAll();

                $connection = null;

                return $result;
            }

            catch(PDOException $e)
            {
                return "Error: " . $e->getMessage();
                die();
            }
        }

        public static function insert(PDO $connection,array $values = [])
        {

            $values = array(
                array(
                    'nome' => 'Antonio',
                    'endereco_id' => 100,
                    'criado_em' => "datetime('now')",
                    'atualizado_em' => "datetime('now')"
                ),
                array(
                    'nome' => 'Fernandinho',
                    'endereco_id' => 99,
                    'criado_em' => "datetime('now')",
                    'atualizado_em' => "datetime('now')"
                ),
                array(
                    'nome' => 'Rodriguinho',
                    'endereco_id' => 97,
                    'criado_em' => "datetime('now')",
                    'atualizado_em' => "datetime('now')"
                )
            );

            try
            {
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $insert_results = 0;

                $collumns_name = implode(',',array_keys($values[0]));

                $processed_data = self::data_validate($values);

                //print_r($processed_data);

                print_r( self::convert_values_to_sql($processed_data) );
                
                $SQL_string = self::convert_data_to_sql($collumns_name,$processed_data);
                
                //$statement = $connection->prepare($SQL_string);
                

                foreach($processed_data as $data)
                {
                    foreach($data as $key => $value)
                    {
                        //\$statement->bindValue($key, $value);
                        //print($key . " -> " . $value . " || ");
                    }
                }

                //$statement->execute();

                return $insert_results;
            }

            

            catch(PDOException $e)
            {
                return "Error: " . $e->getMessage();
            }
        }

        private static function convert_data_to_sql($collumns,$rows)
        {
            $sql_values = self::convert_values_to_sql($rows);

            return "INSERT INTO tb_cliente ($collumns) VALUES " . implode(',',$sql_values);
        }

        private static function data_validate(array $data)
        {
            $processed_data = [];

            foreach($data as $index => $row)
            {
                $insert_data = [];
                foreach($row as $r=>$d)
                {
                    $index_value = ':' . $index .'-'. $r;
                    $insert_data[$index_value] = $d;    
                }

                array_push($processed_data,$insert_data);
            }

            return $processed_data;
        }

        private static function convert_values_to_sql(array $data)
        {
            $result = [];

            foreach($data as $key)
            {
                
                $keys = array_keys($key);

                $string_keys = implode("," , $keys);

                $string_keys = "(" . $string_keys .")";

                array_push($result,$string_keys);
            }

            return $result;
        }
    }
?>