<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of negociosController
 *
 * @author Diego
 */
class negociosController extends controller {

    //put your code here
    public function index() {
        $this->validaSessao();
        $dados = array();
        $this->loadTemplate('negocios', $dados);
    }

    public function insere() {
//        var_dump($_POST);
        if (isset($_POST) && !empty($_POST['id_user']) && $_POST['id_user'] > 0) {
            $negocios = new Negocios();
            $retorno = $negocios->insereNegocio($_POST);
            if ($retorno) {
                echo json_encode($retorno);
            } else {
                echo json_encode('erro');
            }
        }
    }

    public function buscaTabela() {
        $negocios = new Negocios();
        $retorno = $negocios->buscaNegociosTabela();
//        var_dump($retorno);
        echo json_encode($retorno);
    }
    public function buscaInfoNegocioUser($id_user){
        $negocios = new Negocios();
        $retorno = $negocios->buscaNegocioUser($id_user);
        
//        var_dump($retorno);
        $ganho = $perdido = $atual = 0;
        extract($retorno);
        $total = $ganho + $perdido + $atual;
        $array = array(
                'ganho' => $ganho,
                'perdido' => $perdido,
                'atual' => $atual,
                'valor_ganho' => $valor_ganho,
                'valor_perdido' => $valor_perdido,
                'valor_temporario' => $valor_temporario,
                'porcGanho' =>   $this->calculaPorc($total, $ganho),
                'porcPerdido' => $this->calculaPorc($total, $perdido),
                'porcAtual' => $this->calculaPorc($total, $atual),
                );
//        var_dump($array);
        echo json_encode($array);
    }

    private function calculaPorc($total, $valor){
        $porc = $valor * 100 / $total;
        return round($porc, 2);
    }

    public function buscaNegocioHistorico($id) {
        $negocios = new Negocios();
        $retorno = $negocios->buscaNegociosUnicoHistorico($id);
//        var_dump($retorno);
        echo json_encode($retorno);
    }
    public function buscaNegocio($id){
        $negocios = new Negocios();
        $retorno = $negocios->buscaNegociosUnico($id);
//        var_dump($retorno);
        echo json_encode($retorno);
    }
    
    public function negocioUnico($id){
        $negocios = new Negocios();
        $retorno = $negocios->buscaNegociosUnico($id);
//        var_dump($retorno);
        echo json_encode($retorno);
    }
    public function edita(){
//        var_dump($_POST);
        $negocios = new Negocios();
        $retorno = $negocios->editaNegocio($_POST);
        if ($retorno) {
            echo json_encode('ok');
        } else {
            echo json_encode('erro');
        }
    }
    public function buscaNomeContatoID($id){
        $negocios = new Negocios();
            $retornoNegocio = $negocios->buscaNegociosContatosID($id);
//            var_dump($retornoNegocio);
          echo  json_encode($retornoNegocio);
    }
    public function buscaNomeEmpresaID($id){
        $negocios = new Negocios();
            $retornoNegocio = $negocios->buscaNegociosContatosID($id);
//            var_dump($retornoNegocio);
          echo  json_encode($retornoNegocio);
    }
}
