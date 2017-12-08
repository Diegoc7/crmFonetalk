<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Negocios
 *
 * @author Diego
 */
class Negocios extends model {

    //put your code here
    public function insereNegocio($array) {
        if (is_array($array) && isset($array)) {
            extract($array);
            $nome = addslashes($nome);
            $valor = addslashes($valor);
            $dataPrevisao = addslashes($dataPrevisao);
            $dataPrevisao = $this->formataHoraParaBanco($dataPrevisao);
            $data = date('Y/m/d H:i:s');
            $sql = "INSERT INTO negocios VALUES('','$data','$nome','$fase', '$valor', '$dataPrevisao', '$status', '$contato', '$empresa' , '$id_user')";
            $sql = $this->db->prepare($sql);
            $sql->execute();
            $this->alteraNegocioUser($valor, $status, $id_user);
        }
    }

    private function alteraNegocioUser($valor, $status, $id_user) {
        $retorno = $this->buscaNegocioUser($id_user);
//        var_dump($retorno);
        if (!empty($retorno)) {
            extract($retorno);
            $valor = $this->valorConta($valor);
            switch ($status) {
                case 'Aberto':
                    $valor_temporario = $this->valorConta($valor_temporario);
                    $valorFim = $valor + $valor_temporario;
                    $valorFim = $this->valorPadraoBr($valorFim);
                    $qtd = $this->verificaQTDUser($id_user, $status)['c'];
                    $addSql = "valor_temporario = '$valorFim', atual = '$qtd'";
                    break;
                case 'Ganhou':
                    $valor_ganho = $this->valorConta($valor_ganho);
                    $valorFim = $valor + $valor_ganho;
                    $valorFim = $this->valorPadraoBr($valorFim);
                    $qtd = $this->verificaQTDUser($id_user, $status)['c'];
                    $addSql = "valor_ganho = '$valorFim', ganho = '$qtd'";
                    break;
                case 'Perdido':
                    $valor_perdido = $this->valorConta($valor_perdido);
                    $valorFim = $valor + $valor_perdido;
                    $valorFim = $this->valorPadraoBr($valorFim);
                    $qtd = $this->verificaQTDUser($id_user, $status)['c'];
                    $addSql = "valor_perdido = '$valorFim', perdido = '$qtd'";
                    break;

                default:
                    break;
            }

            $sql = "UPDATE negocio_user SET $addSql WHERE id_user = '$id_user'";
            $sql = $this->db->prepare($sql);
            $sql->execute();
        }
    }

    private function verificaQTDUser($id, $status) {
        $sql = "SELECT COUNT(*) as c FROM negocios WHERE status = '$status' AND id_user = '$id' ";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetch();
    }

    public function buscaNegocioUser($id_user) {
        if (!empty($id_user) && $id_user > 0) {
            $sql = "SELECT * FROM negocio_user WHERE id_user = '$id_user'";
            $sql = $this->db->prepare($sql);
            $sql->execute();
            return $sql->fetch();
        }
    }

}
