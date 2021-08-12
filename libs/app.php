<?php
class App {
    function __construct() {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        if(empty($url[0])) {
            error_log('libs -> app -> __construct');
            $file_controller = 'controllers/login.php';
            require_once $file_controller;
            $controller = new Login();
            $controller->loadModel('login');
            $controller->render();
            return false;
        }

        $file_controller = 'controllers/'.$url[0].'.php';

        if(file_exists($file_controller)){
            require_once $file_controller;

            $controller = new $url[0];
            $controller->loadModel($url[0]);

            if(isset($url[1])) {
                if(method_exists($controller, $url[1])) {
                    if(isset($url[2])) {
                        $num_param = sizeof($url) - 2;
                        $params = [];

                        for($i = 0; $i < $num_param; $i++) {
                            array_push($params, $url[$i + 2]);
                        }
   
                        $controller->{$url[1]}($params);
                    }
                    else {
                        $controller->{$url[1]}();    
                    }
                }
                else {
                    //$controller = new Errors();
                }
            }
            else {
                $controller->render();
            }
        }
        else {
            //$controller = new Errors();
        }
    }
}