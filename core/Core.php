<?php

class Core {

    public function run() {

        $url = '/';
        if (isset($_GET['url'])) {
            $url .= $_GET['url'];
        }
        $params = array();
        if (!empty($url) && $url != '/') {
            $url = explode('/', $url);
            array_shift($url);
            $currentController = $url[0] . 'Controller';
            array_shift($url);

            if (isset($url[0]) && !empty($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            } else {
                $currentAction = 'index';
            }

            if (count($url) > 0) {
                $params = $url;
            }
        } else {
            $currentController = 'homeController';
            $currentAction = 'index';
        }

//    echo $currentController;
//    echo $currentAction;
//    exit;
        if (!file_exists('controllers/' . $currentController . '.php') || !method_exists($currentController, $currentAction)) {
            $currentController = 'notfoundController';
            $currentAction = 'index';
        }

//        if (!isset($_SESSION['UsuarioNivel'])) {
//            $currentController = 'loginController';
//            $currentAction = 'index';
//        }

        $c = new $currentController();

        call_user_func_array(array($c, $currentAction), $params);


//    echo "CONTROLLER: ".$currentController."<br/>";
//    echo "ACTION: ".$currentAction."<br/>";
//    echo "ACTION: ". var_dump($params)."<br/>";
    }

}
