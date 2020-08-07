<?php
    class Config
    {
        private $Configs;

        private $default_path;
        private $path_file;

        public static function Main()
        {
            echo "\n";

            $Configuração = new Config();

            $Configuração->CarregandoConfiguracoes();

            $opção = readline("Escreva qual ambiente você quer configurar: ");

            switch($opção)
            {
                case "dev":
                    $EnvConfig = self::loadConfigFrom(__DIR__ . '/env', 'dev.json');
                break;

                case "test":
                    $EnvConfig = self::loadConfigFrom(__DIR__ . '/env', 'test.json');
                break;

                case "prod":
                    $EnvConfig = self::loadConfigFrom(__DIR__ . '/env', 'prod.json');
                break;
            }

            print_r($EnvConfig);

            echo "\n";
        }

        //Private
        private function CarregandoConfiguracoes()
        {
            $path =  __DIR__ . '/';
            $file = 'config.json';

            $this->default_path =  $path;
            $this->path_file = $path . '/' . $file;

            $content_file = file_get_contents($this->path_file);
            $config = json_decode($content_file, true);

            $this->Configs = $config;
        }

        private static function loadConfigFrom($path = __DIR__.'/',$file='config.json')
        {
            $path_file = $path . '/' . $file;
            $content_file = file_get_contents($path_file);
            $config = json_decode($content_file, true);

            return $config;
        }

        private function CarregarInformações()
        {
            echo "Nome do Projeto: " . $this->Configs['project-name'] . "\n";
            echo "Versão: " . $this->Configs['version'] . "\n";
        }

        private function AdicionarConfiguração($key, $value)
        {
            $new_config = $this->Configs;
            $new_config[$key] = $value;
            try
            {
                file_put_contents($this->path_file, json_encode($new_config));
                echo "Adicionado a configuração: \n";
                echo '"' . $key . '":';
                echo '"' . $new_config[$key] . '"';
            }

            catch(Exception $e)
            {
                echo "\nAlgum erro acorreu no processo da nova configuração";
                echo "\nErro: $e";
            }
            
        }
    }
?>