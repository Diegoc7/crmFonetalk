<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuariosController
 *
 * @author Diego
 */
class usuariosController extends controller{
    //put your code here
    public function index(){
        $dados = array();
        $this->loadTemplate('usuarios',$dados);
    }
    public function insere(){
        $usuarios = new Usuarios();
        $retorno = $usuarios->adicionaUsuario($_POST);
       if($retorno){
           echo json_encode($retorno);
       } else {
           echo json_encode('erro');
       }
    }
    public function buscaTabela(){
        $usuarios = new Usuarios();
        $retorno = $usuarios->buscaUsuariosTabela();
        echo json_encode($retorno);
    }
}
