<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author Diego
 */
class model {

    protected $db;

    public function __construct() {
        global $db;
        $this->db = $db;
    }

    protected function formataHoraParaBanco($data) {
//    $data = '21/01/2017';
        $aux = explode('/', $data);
//    var_dump($aux);
        $dataModificada = $aux[2] . "/" . $aux[1] . "/" . $aux[0];
        return $dataModificada;
    }

    protected function valorConta($valor) {
        $valor = str_replace('R$', '', $valor);
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
        $valor = trim($valor);
        return $valor;
    }

    protected function valorPadraoBr($valor){
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }
}
