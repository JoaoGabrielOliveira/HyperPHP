<?php
    require_once __DIR__ . '/../sys_config_php/config.php';
    require_once __DIR__ . '/config/db/db_connection.php';
    require_once __DIR__ . '/config/db/db_operation.php';

    use Hyper\Database\CRUD\delete;
    use Hyper\Database\CRUD\select;
    use Hyper\Database\CRUD\update;
    use Hyper\Database\CRUD\insert;

    use Hyper\Database\DbConnection;

    define('ROOTPATH', __DIR__);

    $configs = new Config(__DIR__ . '/config/config.json');
    
    $configs->load_config();
    $env_config = $configs->loadEnvConfig();
    $configs->add_config_by_env('db',$env_config);
    $configs->save_config();

    $conn = DbConnection::connect($configs->Configs);
    
    $value = array(
        'nome' => 'Heleno',
        'endereco_id' => 100,
        'criado_em' => "DATETIME('now')",
        'atualizado_em' => "DATETIME('now')"
    );

    $values = [ array(
        'nome' => 'Ronaldo',
        'endereco_id' => 400
    ),
    array(
        'nome' => 'Heleno',
        'endereco_id' => 300,
        'criado_em' => "DATETIME('now')",
        'atualizado_em' => "DATETIME('now')"
    )];
    
    print_r ( select::execute($conn,'tb_cliente','*') );
    //print_r ( insert::execute($conn,$value) );
    //print_r ( update::execute($conn, 'tb_cliente',"nome = 'Geraldo'",[ 'endereco_id'=> 1000]) );
    //print_r ( delete::execute($conn, 'tb_cliente',"nome = 'Geraldo'") );