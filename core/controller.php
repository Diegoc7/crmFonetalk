<?php

class controller {

    public function loadView($viewName, $viewData = array()) {
        extract($viewData);
        require 'views/' . $viewName . '.php';
    }

    public function loadTemplate($viewName, $viewData = array()) {
        require 'views/template.php';
    }

    public function loadViewInTemplate($viewName, $viewData = array()) {

        extract($viewData);
        require 'views/' . $viewName . '.php';
    }

    public function loadViewLogin() {
        require 'views/login.php';
    }

    protected function validaSessao() {
        session_start();
        if (!isset($_SESSION['ID'])) {
            header("Location: http://192.168.1.61/crmFonetalk/login");
        }
    }

}
