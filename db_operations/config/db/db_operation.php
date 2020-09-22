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
    include_once dirname(__FILE__) . '/CRUD/update.php';
?>