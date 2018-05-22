<?php

    class Breadcrumbs
    {
        private static $dados = [
            '/' => ['Home'],
        ];


        public static function getDados()
        {
            return $dados;
        }

        public static function getBreadcrumb($chave)
        {
            if(isset(self::$dados[$chave]))
                return self::$dados[$chave];

            return [];
        }
    }

?>