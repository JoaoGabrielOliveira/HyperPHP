<?php
    require_once __DIR__ . '/../sys_config_php/config.php';
    require_once __DIR__ . '/config/db/db_connection.php';
    require_once __DIR__ . '/config/db/db_operation.php';

    define('ROOTPATH', __DIR__);

    $configs = new Config(__DIR__ . '/config/config.json');
    
    $configs->load_config();
    $env_config = $configs->loadEnvConfig();
    $configs->add_config_by_env('db',$env_config);
    $configs->save_config();

    $conn = DbConnection::connect($configs->Configs);
    $result = DbOperation::query($conn,"SELECT * FROM tb_cliente");
    print_r($result);