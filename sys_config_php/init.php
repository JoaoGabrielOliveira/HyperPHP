<?php
use Hyper\System;

    $Configuração = new Config();

    $Configuração->load_config();

    $EnvConfig = $Configuração->loadEnvConfig();
    $Configuração->add_config_by_env('db',$EnvConfig);
    
    $Configuração->save_config();

    echo "\n";

?>