<?php

class contatosController extends controller {

    public function index() {
        $dados = array();
        $this->loadTemplate('contatos', $dados);
    }

    public function insere() {
        $contatos = new Contatos();
        $retorno = $contatos->adicionaUsuario($_POST);
        if ($retorno) {
            echo json_encode($retorno);
        } else {
            echo json_encode('erro');
        }
    }

    public function buscaTabela() {
        $contatos = new Contatos();
        $retorno = $contatos->buscaContatosTabela();
//        var_dump($retorno);
        echo json_encode($retorno);
    }

    public function contato($id) {
//        echo "OK$id";
//        echo realpath;
        if (isset($id) && !empty($id) && $id > 0 && is_numeric($id)) {
            $dados = array(
                'id_contato' => $id
            );
            $this->loadTemplate('contato', $dados);
        }
    }

}
