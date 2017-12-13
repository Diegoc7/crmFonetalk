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
//            $idNegocio = $this->db->lastInsertId();
//            $sql = "SELECT last_insert_id() FROM negocios";
//            $sql = $this->db->prepare($sql);
//            $sql->execute();
//          echo  $idNegocio = (int) $sql->fetch()['last_insert_id()'];
            $this->insertHistorico($array, 'create', $this->db->lastInsertId());
            $this->alteraNegocioUser($valor, $status, $id_user);
            return TRUE;
        }
    }

    private function insertHistorico($array, $situacao, $idNegocio) {
//        var_dump($array);
        extract($array);
        $nome = addslashes($nome);
        $valor = addslashes($valor);
        $dataPrevisao = addslashes($dataPrevisao);
        $dataPrevisao = $this->formataHoraParaBanco($dataPrevisao);
        $data = date('Y/m/d H:i:s');
        $sql = "INSERT INTO historico_negocios VALUES('', '$idNegocio', '$situacao', '$data','$nome','$fase', '$valor', '$dataPrevisao', '$status', '$contato', '$empresa' , '$id_user')";
        $sql = $this->db->prepare($sql);
        $sql->execute();
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

    private function editaNegocioUser($statusAntigo, $status, $valorAntigo, $valor, $id_user) {
        $valor = $this->valorConta($valor);
        $valorAntigo = $this->valorConta($valorAntigo);
        $retorno = $this->buscaNegocioUser($id_user);
//        var_dump($retorno);
        if ($status != $statusAntigo) {

            if ($statusAntigo == 'Aberto') {

                $qtd = $retorno['atual'] - 1;
                $valorBD = $retorno['valor_temporario'];
                $valorBD = $this->valorConta($valorBD);
                $valorFim = $valorBD - $valorAntigo;
                $valorFim = $this->valorPadraoBr($valorFim);
                $remSql = "valor_temporario = '$valorFim', atual = '$qtd'";
            } else if ($statusAntigo == 'Ganhou') {
                $qtd = $retorno['ganho'] - 1;
                $valorBD = $retorno['valor_ganho'];
                $valorBD = $this->valorConta($valorBD);
                $valorFim = $valorBD - $valor;
                $valorFim = $this->valorPadraoBr($valorFim);
                $remSql = "valor_ganho = '$valorFim', ganho = '$qtd'";
            } else if ($statusAntigo == 'Perdido') {
                $qtd = $retorno['perdido'] - 1;
                $valorBD = $retorno['valor_perdido'];
                $valorBD = $this->valorConta($valorBD);
                $valorFim = $valorBD - $valor;
                $valorFim = $this->valorPadraoBr($valorFim);
                $remSql = "valor_perdido = '$valorFim', perdido = '$qtd'";
            } else {
                $remSql = '';
            }
            if (empty($remSql)) {
                $aux = '';
            } else {
                $aux = ',';
            }
            if ($status == 'Aberto') {
                $qtd = $retorno['atual'] + 1;
                $valorBD = $retorno['valor_temporario'];
                $valorBD = $this->valorConta($valorBD);
                $valorFim = $valorBD + $valor;
                $valorFim = $this->valorPadraoBr($valorFim);
                $addSql .= "$aux valor_temporario = '$valorFim', atual = '$qtd'";
            } else if ($status == 'Ganhou') {
                $qtd = $retorno['ganho'] + 1;
                $valorBD = $retorno['valor_ganho'];
                $valorBD = $this->valorConta($valorBD);
                $valorFim = $valorBD + $valor;
                $valorFim = $this->valorPadraoBr($valorFim);
                $addSql = "$aux valor_ganho = '$valorFim', ganho = '$qtd'";
            } else if ($status == 'Perdido') {
                $qtd = $retorno['perdido'] + 1;
                $valorBD = $retorno['valor_perdido'];
                $valorBD = $this->valorConta($valorBD);
                $valorFim = $valorBD + $valor;
                $valorFim = $this->valorPadraoBr($valorFim);
                $addSql = "$aux valor_perdido = '$valorFim', perdido = '$qtd'";
            }
        } else {
            $addSql = '';
        }
        if (empty($remSql) && empty($addSql)) {
            return TRUE;
        } else {
            $sql = "UPDATE negocio_user SET  $remSql $addSql WHERE id_user = '$id_user'";
            $sql = $this->db->prepare($sql);
            $sql->execute();
            return true;
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

    public function buscaNegociosTabela() {
//     echo   $sql = "SELECT c.nome,c.telefone1,c.email,e.nome AS empresa FROM contatos AS c JOIN empresas AS e WHERE IF(c.id_empresa != 0) THEN c.id_empresa = e.id ELSE (c.id_empresa = 1)";
        $sql = "SELECT negocios.id, negocios.status, negocios.nome, negocios.valor, empresas.nome AS empresa, contatos.nome AS contato, usuario.nome AS usuario FROM negocios LEFT JOIN empresas ON negocios.id_empresa = empresas.id LEFT JOIN contatos ON negocios.id_contato = contatos.id LEFT JOIN usuario ON negocios.id_user = usuario.id";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function buscaNegociosUnico($id) {
        $sql = "SELECT negocios.*, empresas.nome AS empresa, contatos.nome AS contato, usuario.nome AS usuario FROM negocios LEFT JOIN empresas ON negocios.id_empresa = empresas.id LEFT JOIN contatos ON negocios.id_contato = contatos.id LEFT JOIN usuario ON negocios.id_user = usuario.id WHERE negocios.id = '$id'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function buscaNegociosUnicoHistorico($id) {
        $sql = "SELECT historico_negocios.*, empresas.nome AS empresa, contatos.nome AS contato, usuario.nome AS usuario FROM historico_negocios LEFT JOIN empresas ON historico_negocios.id_empresa = empresas.id LEFT JOIN contatos ON historico_negocios.id_contato = contatos.id LEFT JOIN usuario ON historico_negocios.id_user = usuario.id WHERE historico_negocios.id_negocios = '$id' ORDER BY data DESC";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function editaNegocio($array) {
        if (is_array($array) && isset($array['id_user_edit']) && $array['id_user_edit'] > 0 && $array['id_negocio'] > 0) {
            extract($array);
            $nomeEdit = addslashes($nomeEdit);
            $valorEdit = addslashes($valorEdit);
            $dataPrevisaoEdit = addslashes($dataPrevisaoEdit);
            $retorno = $this->buscaNegociosUnico($id_negocio);
//            var_dump($retorno);
            foreach ($retorno as $value) {
                $valorAntigo = $value['valor'];
                $statusAntigo = $value['status'];
            }
            $this->editaNegocioUser($statusAntigo, $statusEdit, $valorAntigo, $valorEdit, $id_user_edit);
            $editArray = array(
                'nome' => $nomeEdit,
                'fase' => $faseEdit,
                'valor' => $valorEdit,
                'dataPrevisao' => $dataPrevisaoEdit,
                'contato' => $contatoEdit,
                'status' => $statusEdit,
                'empresa' => $empresaEdit,
                'id_user' => $id_user_edit
            );
            $this->insertHistorico($editArray, 'edit', $id_negocio);
            $data = date('Y/m/d H:i:s');
//            print_r($retorno);
            $sql = "UPDATE negocios SET data = '$data', nome = '$nomeEdit', fase = '$faseEdit', valor = '$valorEdit', previsao = '$dataPrevisaoEdit', status = '$statusEdit', id_contato = '$contatoEdit', id_empresa = '$empresaEdit' WHERE id = '$id_negocio'";
            $sql = $this->db->prepare($sql);
            $sql->execute();
            return true;
        }
    }

    public function buscaNegociosContatosID($id) {
        $sql = "SELECT nome FROM negocios WHERE id_contato = '$id'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }
    public function buscaNegociosEmpresaID($id) {
        $sql = "SELECT nome FROM negocios WHERE id_empresa = '$id'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

}
