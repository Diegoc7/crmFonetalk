<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of relatorioController
 *
 * @author Diego
 */
class relatorioController extends controller{
    //put your code here
     public function index() {
        $this->validaSessao();
        $dados = array();
        $this->loadTemplate('relatorio', $dados);
    }
    public function buscaTabela(){
        $usuarios = new Usuarios();
        $retorno = $usuarios->buscaRelatorioUser();
//        var_dump($retorno);
        echo json_encode($retorno);
    }
}
