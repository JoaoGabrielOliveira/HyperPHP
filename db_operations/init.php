<?php
    require_once 'config.php';

    $configs = new Config();
    $configs->load_config();
    $env_config = $configs->loadEnvConfig();
    $configs->add_config_by_env('db',$env_config);
    
    $configs->save_config();