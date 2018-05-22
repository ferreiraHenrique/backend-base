<?php

    class View
    {
        
        public static function CssComPreLoad($arq){
            if (strpos($_SERVER['HTTP_USER_AGENT'], 'Edge') !== false){
                return '<link rel="stylesheet" href="'.$arq.'">';
            }else{
                if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false /*|| strpos($_SERVER['HTTP_USER_AGENT'], 'CriOS') !== false*/) {
                    return '<link rel="preload" href="'.$arq.'" as="style" onload="this.rel=\'stylesheet\'"><noscript><link rel="stylesheet" href="'.$arq.'"></noscript>';
                }else{
                    return '<link rel="stylesheet" href="'.$arq.'">';
                }
            } 
        }


        public static function getView($arq, &$dados)
        {
            $uri = $dados['uri'];

            $dados['title'] = Pagina::getTitle($uri);

            $dados['meta_description'] = Pagina::getMetaDescription($uri);
            $dados['twitter_description'] = Pagina::getTwitterDescription($uri);
            $dados['facebook_description'] = Pagina::getFacebookDescription($uri);

            $dados['url_atual'] = URL.$uri;

            extract($dados); unset($dados);

            if(is_file(ROOT.'/views/'.$arq))
            {
                require_once(ROOT.'/views/'.$arq);

                return true;   
            }

            return false;
        }
    }

?>