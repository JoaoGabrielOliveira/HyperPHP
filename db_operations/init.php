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

    $i = DbOperation::insert($conn);

    /*DbOperation::query($conn,"
    INSERT INTO tb_cliente (nome, endereco_id, criado_em, atualizado_em) VALUES ('Cleber', 101, datetime('now'), datetime('now'));
    ");
    */
    $result = DbOperation::select($conn,"tb_cliente");
    
    print_r($result);