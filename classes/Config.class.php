<?php

    class Config
    {
        const DB_URL = '';
		const DB_USER = '';
		const DB_PASS = '';
        const DB_NAME = ''; 
        

        public static function configuracoesIndex()
        {
            if($_SERVER['SERVER_NAME'] == 'localhost')
            {
                error_reporting(E_ERROR | E_PARSE);

                define('URL', 'http://localhost');
                define('ROOT', str_replace('\classes'. '\\', __DIR__));

                define('URL_IMG', URL.'/images');
				define('URL_CSS', URL.'/css');
				define('URL_JS', URL.'/js');
            }
            else
            {

            }


            date_default_timezone_set('America/Sao_Paulo');
            require_once(ROOT.'/autoload.php');
        }
    }

?>