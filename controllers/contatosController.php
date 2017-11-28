<?php

class contatosController extends controller{
    public function index(){
        $dados = array();
        $this->loadTemplate('contatos',$dados);
    }
    public function insere(){
       $contatos = new Contatos();
       $contatos->adicionaUsuario($_POST);
//       if($retorno){
//           echo json_encode($retorno);
//       } else {
//           echo json_encode('erro');
//       }
    }
}
