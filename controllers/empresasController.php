<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of empresasController
 *
 * @author Diego
 */
class empresasController extends controller{
    //put your code here
    public function index() {
        $this->validaSessao();
        $dados = array();
        $this->loadTemplate('empresas', $dados);
    }
    public function insere() {
//        print_r($_POST);
        $empresas = new Empresas();
        $retorno = $empresas->adicionaEmpresa($_POST);
        if ($retorno) {
            echo json_encode($retorno);
        } else {
            echo json_encode('erro');
        }
    }
    public function buscaTabela() {
        $empresas = new Empresas();
        $retorno = $empresas->buscaEmpresasTabela();
//        $retorno = '';
//        var_dump($retorno);
        echo json_encode($retorno);
    }
    public function empresaUnica($id) {
        if (isset($id) && !empty($id) && $id > 0 && is_numeric($id)) {
           $empresas = new Empresas();
            $retorno = $empresas->buscaEmpresaEspecifica($id);
            if ($retorno) {
//                var_dump($retorno);
                $passaArray = array();
                $cont = 0;
                foreach ($retorno as $value) {
                    $passaArray[$cont]['id'] = (int) $value['id'];
                    $data = $value['data'];
                    $mostrarData = date('d/m/Y H:i:s', strtotime($data));
                    $passaArray[$cont]['data'] = $mostrarData;

//                    $data_nascimento = $value['data_nascimento'];
//                    if ($data_nascimento != '0000-00-00 00:00:00') {
//                        $data_nascimento = date('d/m/Y', strtotime($data_nascimento));
//                        $passaArray[$cont]['data_nascimento'] = $data_nascimento;
//                    } else {
//                        $passaArray[$cont]['data_nascimento'] = '';
//                    }
                    $passaArray[$cont]['nome'] = $value['nome'];
                    $passaArray[$cont]['email'] = $value['email'];
                    $passaArray[$cont]['cargo'] = $value['cargo'];
                    $passaArray[$cont]['tipotel1'] = $value['tipotel1'];
                    $passaArray[$cont]['id_user'] = $value['id_user'];
                    $passaArray[$cont]['telefone1'] = $value['telefone1'];
                    $passaArray[$cont]['id_contato'] = $value['id_contato'];
                    $passaArray[$cont]['tipotel2'] = $value['tipotel2'];
                    $passaArray[$cont]['telefone2'] = $value['telefone2'];
                    $passaArray[$cont]['tipotel3'] = $value['tipotel3'];
                    $passaArray[$cont]['telefone3'] = $value['telefone3'];
//                    $passaArray[$cont]['origem'] = $value['origem'];
                    $passaArray[$cont]['cnpj'] = $value['cnpj'];
                    $passaArray[$cont]['endereco'] = $value['endereco'];
                    $passaArray[$cont]['observacao'] = $value['observacao'];
                    $passaArray[$cont]['contato'] = $value['contato'];
                    $passaArray[$cont]['usuario'] = $value['usuario'];
//                    $passaArray[$cont]['user'] = $value['user'];
                    $passaArray[$cont]['contEdit'] = $empresas->countEdit($id)['c'];

                    $cont = $cont + 1;
                }
                echo json_encode($passaArray);
            } else {
                echo json_encode('erro');
            }
        }
    }
    
    public function edita() {
//        var_dump($_POST);
        $empresas = new Empresas();
        $retorno = $empresas->editaEmpresa($_POST);
        if ($retorno) {
            echo json_encode('ok');
        } else {
            echo json_encode('erro');
        }
    }
    
    public function buscaContato($busca){
//        echo $busca;
        $contatos = new Contatos();
        $retorno = $contatos->buscaContato($busca);
//        var_dump($retorno);
        echo json_encode($retorno);
    }
}
