<?php
    require_once dirname(__FILE__) . '/db_connection.php';

    public class DbOperation
    {
        private static $connection = DbConnection::connect();

        public static function query($SQL, $OPTIONS = '')
        {
            try
            {
                $connection = self::$connection;
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $connection->prepare($SQL);
                $statement->execute();
                return $statement->fetch_all();
            }

            catch(PDOException $e)
            {
                return "Error: " . $e->getMessage();
            }
        }
    }
?>