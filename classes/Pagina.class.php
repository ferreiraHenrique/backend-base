<?php

    class Pagina
    {
        private static $titles = [
            '/' => 'Home',
        ];

        private static $descriptions = [
            '/' => [
                'meta'=> '',
                'facebook'=> '',
                'twitter'=> '',
            ],

            'padrao' => 'Padrão',
        ];


        public static function getTitle($uri)
        {
            if(isset(self::$titles[$uri]))
                return self::$titles[$uri];

            return 'Padrão';
        }

        public static function getMetaDescription($uri)
        {
            if(!empty(self::$descriptions[$uri]['meta']))
                return self::$descriptions[$uri]['meta'];

            return self::$descriptions['padrao'];
        }

        public static function getTwitterDescription($uri)
        {
            if(!empty(self::$descriptions[$uri]['twitter']))
                return self::$descriptions[$uri]['twitter'];

            return self::$descriptions['padrao'];
        }

        public static function getFacebookDescription($uri)
        {
            if(!empty(self::$descriptions[$uri]['facebook']))
                return self::$descriptions[$uri]['facebook'];

            return self::$descriptions['padrao'];
        }
    }

?>