<?php 
    require_once('classes/Config.class.php');
    Config::configuracoesIndex();
    

    $router = new Router();

    $router->on('GET', '/', function($dados){
        HomeController::home();
        
        return View::getView('home.php', $dados);
    });


    $res = $router->run($router->method(), $router->uri(), $dados);

?>