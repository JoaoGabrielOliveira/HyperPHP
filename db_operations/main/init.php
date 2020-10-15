<?php

use Hyper\Console;
use Hyper\Database\CRUD\select;
use Hyper\Database\DbConnection;

require_once dirname(__DIR__) . "/vendor/autoload.php";


DbConnection::set_instance([
    'db' => [
        "driver" => "sqlite",
        "path" => "/home/bionexo/Documents/projetos_paralelos/HyperPHP/db_operations/main/db/database.db"
    ]
]);

//Demonstrate how to create or prepare your SQL string
$stmt = DbConnection::prepare_statement("SELECT * FROM tB_cliente");
print_r($stmt);

//Using CRUD to make some operations

//Select / READ
print_r ( select::execute("tb_cliente") );

?>