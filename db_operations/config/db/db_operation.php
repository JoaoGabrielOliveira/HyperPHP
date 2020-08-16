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

        public static function insert($connection,$SQL, $OPTIONS='')
        {
            try
            {
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $SQL = 'INSERT INTO ';
                $statement = $connection->prepare($SQL);

                /*
                $stmt->execute(array(
                    ':nome' => 'Ricardo Arrigoni'
                  ));
                */
                
                $statement->execute();
            }

            catch(PDOException $e)
            {
                return "Error: " . $e->getMessage();
            }
        }
    }
?>