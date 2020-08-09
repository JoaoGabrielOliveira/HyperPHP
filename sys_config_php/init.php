<?php
require_once 'config.php';

    $Configuração = new Config();

    $Configuração->load_config();

    $EnvConfig = $Configuração->loadEnvConfig();
    $Configuração->add_config_by_env('db',$EnvConfig);
    
    $Configuração->save_config();

    echo "\n";

?>