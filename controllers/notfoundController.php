<?php

class notfoundController extends controller{
    public function index(){
        $this->loadTemplate('404', array());
//        $this->loadView('404', array());
    }

}

