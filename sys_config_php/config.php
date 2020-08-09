<?php
    include_once __DIR__ . '/../colored_console/console.php';

    class Config
    {
        private $Configs;

        private $default_path;

        private $file;
        private $path;

        public function __construct($path = __DIR__ . "/config.json")
        {
            $file_path = explode("/",$path);

            $this->file = end($file_path);
            $this->default_path =  $path;

            $index = sizeof(array_keys($file_path)) -1;
            
            unset($file_path[$index]);

            $this->path = join("/",$file_path);
        }

        //Private
        public function load_config()
        {
            $content_file = file_get_contents($this->default_path);
            $config = json_decode($content_file, true);
                info_success('Configurações foram carregadas com');
            echo "\n";
            $this->Configs = $config;
        }

        public function save_config()
        {
            $path_file = $this->default_path;
            $new_config = $this->Configs;
            try
            {
                file_put_contents($this->default_path, json_encode($new_config));
                info_success("Configurações salvas com");
            }

            catch(Exception $e)
            {
                info_fail("Algum erro acorreu no processo da nova configuração");
                print_red("\nErro:" . $e->getMessage());
            }
        }

        public static function load_config_from($path,$file)
        {
            $path_file = $path . '/' . $file;
            $content_file = file_get_contents($path_file);
            $config = json_decode($content_file, true);

            info_success('Configurações foram carregadas com');
            return $config;
        }

        public function show_info()
        {
            echo "Nome do Projeto: " . $this->Configs['project-name'] . "\n";
            echo "Versão: " . $this->Configs['version'] . "\n";
        }

        /*
        private function AdicionarConfiguração($key, $value)
        {
            $new_config = $this->Configs;
            $new_config[$key] = $value;
            try
            {
                file_put_contents($this->path_file, json_encode($new_config));

                info_success("Adicionado a configuração:");                
                    echo '"' . $key . '":';
                    echo '"' . $new_config[$key] . '"';
            }

            catch(Exception $e)
            {
                echo "\n  \e[91m  \e[97mAlgum erro acorreu no processo da nova configuração";
                echo "\nErro: $e";
            }

            $this->CarregandoConfiguracoes();
            
        }
        */

        public function add_config_by_env($key, $EnvConfig)
        {
            if($EnvConfig == null)
            {
                info_fail("A configuração escolhida é", "NULA");
                return;
            }

            $this->Configs[$key] = $EnvConfig[$key];

            info_success("Chave: " . print_yellow($key), "CARREGADA", "➟");
        }

        public function loadEnvConfig()
        {
            $opção = readline("Escreva qual ambiente você quer configurar: ");
            
            foreach($this->Configs['env'] as $env)
            {
                if($env == $opção)
                {
                    $EnvConfig = self::load_config_from($this->path . '/env', 'dev.json');

                    info_success("Ambiente de ". print_blue($EnvConfig['env-name']) ."carregado com");

                    return $EnvConfig;
                }
            }

            info_fail("O ambiente digirado não existe! ");
            return null;
        }
    }
?>