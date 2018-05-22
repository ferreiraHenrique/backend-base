<?php

    class Router
    {
        private $routes = array(
            '/'
        );


        public function on($method, $path, $callback)
        {
            $method = strtolower($method);

            if(!isset($this->routes[$method]))
                $this->routes[$method] = array();

        
            if(is_array($path))
            {
                foreach($path as $p)
                {
                    $router = $this->createPattern($p);
                    $this->routes[$method][$router] = $callback;
                }
            }
            else
            {
                $router = $this->createPattern($path);
                $this->routes[$method][$router] = $callback;
            }

            return $this;
        }


        public function run($method, $uri, $dados)
        {
            $method = strtolower($method);

            if(!isset($this->routes[$method]))
                return null;

            foreach($this->routes[$method] as $route=> $callback)
            {
                if(preg_match($route, $uri, $parameters))
                {
                    array_shift($parameters);

                    return call_user_func_array($callback, ['dados'=>$dados]);
                }
            }


            return null;
        }


        public function method()
        {
            return isset($_SERVER['REQUEST_METHOD'])? strtolower($_SERVER['REQUEST_METHOD']) : 'cli';
        }


        public function uri()
        {
            $self = isset($_SERVER['PHP_SELF'])? str_replace('index.php/', '', $_SERVER['PHP_SELF']) : '';
            $uri = isset($_SERVER['REQUEST_URI'])? explode('?', $_SERVER['REQUEST_URI'])[0] : '';

            if($self !== $uri)
            {
                $peaces = explode('/', $self);
                array_pop($peaces);
                $start = implode('/', $peaces);
                $search = '/'.preg_quote($start, '/').'/';
                $uri = preg_replace($search, '', $uri, 1);
            }

            return str_replace('.php', '', $uri);
        }


        private function createPattern($path)
        {
            $uri = substr($path, 0, 1) !== '/'? '/'.$path : $path;
            $pattern = str_replace('/', '\/', $uri);
            $router = '/^'.$pattern.'$/';

            return $router;
        }
    }

?>