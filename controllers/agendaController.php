<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of agendaController
 *
 * @author Diego
 */
class agendaController extends controller{
    //put your code here
     public function index() {
        $this->validaSessao();
        $dados = array();
        $this->loadTemplate('agenda', $dados);
    }
}
