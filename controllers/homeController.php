<?php

class homeController extends controller{
    public function index(){
        $this->validaSessao();
        $dados = array();
        $this->loadTemplate('home',$dados);
    }
}

