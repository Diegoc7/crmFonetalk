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
            $sql = "INSERT INTO negocios VALUES('','$data','$nome','$fase', '$valor', '$dataPrevisao', '$status', '$idBuscaContato', '$idBuscaEmpresa' , '$id_user')";
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

    public function addNegocioArquivo($ganho, $perdido, $atual, $id_user) {
        $retorno = $this->buscaNegocioUser($id_user);
        $ganhoAnt = $retorno['ganho'];
        $perdidoAnt = $retorno['perdido'];
        $atualAnt = $retorno['atual'];
//        var_dump($retorno);
        $sql = '';
        $vir = '';
        if ($ganho == 1) {
            $add = $ganhoAnt + 1;
            $sql .= "ganho = '$add'";
            $vir = ',';
        }
        if ($perdido == 1) {
            $add = $perdidoAnt + 1;
            $sql .= "$vir perdido = '$add'";
            $vir = ',';
        }
        if ($atual == 1) {
            $add = $atualAnt + 1;
            $sql .= "$vir atual = '$add'";
            $vir = ',';
        }
        if (!empty($vir) && !empty($id_user)) {
            $sql = "UPDATE negocio_user SET $sql WHERE id_user = '$id_user'";
            $sql = $this->db->prepare($sql);
            $sql->execute();
        }
//        echo $sql;
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
        $array = $sql->fetchAll();
//        var_dump($array);
        return $this->arrumaNegocioUnico($array);
//        return $sql->fetchAll();
    }

    private function arrumaNegocioUnico($array = '') {
        if (!empty($array)) {
            $cont = 0;
            $passaArray = '';
            foreach ($array as $value) {
                $passaArray[$cont]['id'] = $value['id'];
                $passaArray[$cont]['nome'] = $value['nome'];
                $passaArray[$cont]['fase'] = $value['fase'];
                $data = $value['data'];
                $passaArray[$cont]['data'] = date('d/m/Y h:i:s', strtotime($data));
                $previsao = $value['previsao'];
                $passaArray[$cont]['previsao'] = date('d/m/Y', strtotime($previsao));
                $passaArray[$cont]['valor'] = $value['valor'];
                $passaArray[$cont]['status'] = $value['status'];
                $passaArray[$cont]['id_contato'] = $value['id_contato'];
                $passaArray[$cont]['id_empresa'] = $value['id_empresa'];
                $passaArray[$cont]['id_user'] = $value['id_user'];
                $passaArray[$cont]['empresa'] = $value['empresa'];
                $passaArray[$cont]['contato'] = $value['contato'];
                $passaArray[$cont]['usuario'] = $value['usuario'];
                $cont = $cont + 1;
            }
            if (!empty($passaArray) && isset($passaArray)) {
                return $passaArray;
            } else {
                return FALSE;
            }
        }
    }

    public function buscaNegociosUnicoHistorico($id) {
        $sql = "SELECT historico_negocios.*, empresas.nome AS empresa, contatos.nome AS contato, usuario.nome AS usuario FROM historico_negocios LEFT JOIN empresas ON historico_negocios.id_empresa = empresas.id LEFT JOIN contatos ON historico_negocios.id_contato = contatos.id LEFT JOIN usuario ON historico_negocios.id_user = usuario.id WHERE historico_negocios.id_negocios = '$id' ORDER BY data DESC";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        $array = $sql->fetchAll();
        return $this->arrumaNegocioHistoricoUnico($array);
//        return $sql->fetchAll();
    }

    private function arrumaNegocioHistoricoUnico($array = '') {
        if (!empty($array)) {
            $cont = 0;
            $passaArray = '';
            foreach ($array as $value) {
                $passaArray[$cont]['id'] = $value['id'];
                $passaArray[$cont]['nome'] = $value['nome'];
                $passaArray[$cont]['id_negocios'] = $value['id_negocios'];
                $passaArray[$cont]['fase'] = $value['fase'];
                $passaArray[$cont]['situacao'] = $value['situacao'];
                $data = $value['data'];
                $passaArray[$cont]['data'] = date('d/m/Y h:i:s', strtotime($data));
                $previsao = $value['previsao'];
                $passaArray[$cont]['previsao'] = date('d/m/Y', strtotime($previsao));
                $passaArray[$cont]['valor'] = $value['valor'];
                $passaArray[$cont]['status'] = $value['status'];
                $passaArray[$cont]['id_contato'] = $value['id_contato'];
                $passaArray[$cont]['id_empresa'] = $value['id_empresa'];
                $passaArray[$cont]['id_user'] = $value['id_user'];
                $passaArray[$cont]['empresa'] = $value['empresa'];
                $passaArray[$cont]['contato'] = $value['contato'];
                $passaArray[$cont]['usuario'] = $value['usuario'];
                $cont = $cont + 1;
            }
            if (!empty($passaArray) && isset($passaArray)) {
                return $passaArray;
            } else {
                return FALSE;
            }
        }
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
            $dataPrevisaoEdit = $this->formataHoraParaBanco($dataPrevisaoEdit);
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
    public function buscaNegocios($busca) {
        $sql = "SELECT id,nome FROM  negocios WHERE nome LIKE '$busca%' LIMIT 50";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

}
