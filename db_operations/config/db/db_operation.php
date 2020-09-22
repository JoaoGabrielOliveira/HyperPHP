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

    include_once dirname(__FILE__) . '/CRUD/select.php';
    include_once dirname(__FILE__) . '/CRUD/insert.php';
    include_once dirname(__FILE__) . '/CRUD/update.php';
?>