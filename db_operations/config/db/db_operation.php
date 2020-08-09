<?php
    require_once dirname(__FILE__) . '/db_connection.php';

    public class DbOperation
    {
        private static $connection = DbConnection::connect();;

        function __construct()
        {
            $this->connection = DbConnection::connect();
        }
    }
?>