<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Atividades
 *
 * @author Diego
 */
class Atividades extends model {

    //put your code here
    public function insereAtividade($array) {
        if (isset($array['tipo']) && !empty($array['tipo']) && isset($array['assunto']) && !empty($array['assunto']) && isset($array['id_user']) && !empty($array['id_user'])) {
//            echo 'ok';
            extract($array);
            $assunto = addslashes($assunto);
//            $empresa = addslashes($empresa);
            if (empty($negocio) || !isset($negocio)) {
                $negocio = '';
            } else {
                $negocio = addslashes($negocio);
            }
            if (empty($empresa) || !isset($empresa)) {
                $empresa = '';
            } else {
                $empresa = addslashes($empresa);
            }
            if (empty($tipo) || !isset($tipo)) {
                $tipo = '';
            } else {
                $tipo = addslashes($tipo);
            }
            if (empty($contato) || !isset($contato)) {
                $contato = '';
            } else {
                $contato = addslashes($contato);
            }
            $dataAgendamento = addslashes($dataAgendamento);
            $dataAgendamento = $this->formataHoraParaBanco($dataAgendamento);
            $hora = addslashes($hora);
            $contato = addslashes($contato);
            $empresa = addslashes($empresa);
            $observacao = addslashes($observacao);
            $id_user = addslashes($id_user);
            $dataInsercao = date("Y-m-d H:i:s");
            $sql = "INSERT INTO atividades VALUES('','$dataInsercao','$assunto','$dataAgendamento','$hora','$tipo','$observacao', '$id_user','$contato','$empresa','$negocio','1')";
            $sql = $this->db->prepare($sql);
            $sql->execute();
            $lastInsertID = $this->db->lastInsertId();
            $this->insertAgenda($dataAgendamento, $hora, $assunto, $tipo, $id_user, $lastInsertID);
            return $lastInsertID;
        } else {
            return false;
        }
    }

    private function insertAgenda($dataAgendamento, $hora, $assunto, $tipo, $id_user, $id_atividade) {
        $data = $dataAgendamento . ' ' . $hora;
        $title = $assunto . ' (' . $tipo . ')';
        $sql = "INSERT INTO events VALUES('','$data','$data','$title','$id_user','$id_atividade')";
        $sql = $this->db->prepare($sql);
        $sql->execute();
    }

    public function buscaAtividadesTabela() {
//     echo   $sql = "SELECT c.nome,c.telefone1,c.email,e.nome AS empresa FROM contatos AS c JOIN empresas AS e WHERE IF(c.id_empresa != 0) THEN c.id_empresa = e.id ELSE (c.id_empresa = 1)";
        $sql = "SELECT id, assunto, tipo, data_agendamento, hora, acao FROM atividades";
        $sql = $this->db->prepare($sql);
        $sql->execute();
//        return $sql->fetchAll();
        $array = $sql->fetchAll();
        return $this->arrumaAtividadesTabela($array);
    }

    public function arrumaAtividadesTabela($array = '') {
        if (!empty($array)) {
            $cont = 0;
            $passaArray = '';
            foreach ($array as $value) {
                $passaArray[$cont]['id'] = $value['id'];
                $passaArray[$cont]['assunto'] = $value['assunto'];
                $passaArray[$cont]['tipo'] = $value['tipo'];
                $data_agendamento = $value['data_agendamento'];
                $passaArray[$cont]['data_agendamento'] = date('d/m/Y', strtotime($data_agendamento));
                $passaArray[$cont]['hora'] = $value['hora'];
                $passaArray[$cont]['acao'] = $value['acao'];
                $cont = $cont + 1;
            }
            if (!empty($passaArray) && isset($passaArray)) {
                return $passaArray;
            } else {
                return FALSE;
            }
        }
    }

    public function buscaAtividadesDia($id_user) {
//     echo   $sql = "SELECT c.nome,c.telefone1,c.email,e.nome AS empresa FROM contatos AS c JOIN empresas AS e WHERE IF(c.id_empresa != 0) THEN c.id_empresa = e.id ELSE (c.id_empresa = 1)";
        $data = date("Y-m-d");
        $sql = "SELECT id, assunto, tipo, data_agendamento, hora, acao FROM atividades WHERE data_agendamento = '$data' AND id_user = '$id_user'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function alteraAcao($id, $acao) {
        $sql = "UPDATE atividades SET acao = '$acao'  WHERE id = '$id'";
//        shell_exec("echo '" . $sql . " << SQL Editando Atividades " . "' >> /var/log/log_developer/adm.log");
        $sql = $this->db->prepare($sql);
        $sql->execute();
    }

    public function buscaAtividadesUnico($id) {
        $sql = "SELECT atividades.*, empresas.nome AS empresa, contatos.nome AS contato, usuario.nome AS usuario, negocios.nome AS negocio FROM atividades LEFT JOIN empresas ON atividades.id_empresa = empresas.id LEFT JOIN contatos ON atividades.id_contato = contatos.id LEFT JOIN usuario ON atividades.id_user = usuario.id LEFT JOIN negocios ON atividades.id_negocio = negocios.id WHERE atividades.id = '$id'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        $array = $sql->fetchAll();
        if (!empty($array)) {
//            var_dump($this->arrumaAtividadeUnica($array));
            return $this->arrumaAtividadeUnica($array);
        } else {
            return FALSE;
        }
    }

    public function buscaAgenda() {
        $sql = "SELECT * FROM events WHERE id_atividade != 0";
//        $sql = "SELECT * FROM events WHERE id_atividade != 0";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

    private function arrumaAtividadeUnica($array) {
//        var_dump($array);
        $cont = 0;
        $passaArray = '';
        foreach ($array as $value) {
            $passaArray[$cont]['id'] = $value['id'];
            $data = $value['data'];
            $passaArray[$cont]['data'] = date('d/m/Y h:i:s', strtotime($data));
            $data_agendamento = $value['data_agendamento'];
            $passaArray[$cont]['data_agendamento'] = date('d/m/Y', strtotime($data_agendamento));
            $passaArray[$cont]['assunto'] = $value['assunto'];
            $passaArray[$cont]['hora'] = $value['hora'];
            $passaArray[$cont]['tipo'] = $value['tipo'];
            $passaArray[$cont]['observacao'] = $value['observacao'];
            $passaArray[$cont]['id_user'] = $value['id_user'];
            $passaArray[$cont]['id_contato'] = $value['id_contato'];
            $passaArray[$cont]['id_empresa'] = $value['id_empresa'];
            $passaArray[$cont]['id_negocio'] = $value['id_negocio'];
            $passaArray[$cont]['acao'] = $value['acao'];
            $passaArray[$cont]['empresa'] = $value['empresa'];
            $passaArray[$cont]['contato'] = $value['contato'];
            $passaArray[$cont]['usuario'] = $value['usuario'];
            $passaArray[$cont]['negocio'] = $value['negocio'];
            $cont = $cont + 1;
        }
        if (!empty($passaArray) && isset($passaArray)) {
            return $passaArray;
        } else {
            return FALSE;
        }
    }

    public function editaAtividade($array) {
//        var_dump($array);
        if (is_array($array) && isset($array['id_user_edit']) && $array['id_user_edit'] > 0 && $array['id_atividade'] > 0) {
            extract($array);
            $assuntoEdit = addslashes($assuntoEdit);
            $dataAgendamentoEdit = addslashes($dataAgendamentoEdit);
            $dataAgendamentoEdit = $this->formataHoraParaBanco($dataAgendamentoEdit);
            $horaEdit = addslashes($horaEdit);
            $observacaoEdit = addslashes($observacaoEdit);

            $data = date('Y/m/d H:i:s');
//            print_r($retorno);
            $sql = "UPDATE atividades SET data = '$data', assunto = '$assuntoEdit', data_agendamento = '$dataAgendamentoEdit', hora = '$horaEdit', tipo = '$tipoEdit', observacao = '$observacaoEdit', id_user = '$id_user_edit', id_contato = '$contatoEdit', id_empresa = '$empresaEdit', id_negocio = '$negocioEdit' WHERE id = '$id_atividade'";
            $sql = $this->db->prepare($sql);
            $sql->execute();
            $this->alteraAgenda($dataAgendamentoEdit, $horaEdit, $assuntoEdit, $tipoEdit, $id_user_edit, $id_atividade);
            return true;
        }
    }

    private function alteraAgenda($dataAgendamento, $hora, $assunto, $tipo, $id_user, $id_atividade) {
        $data = $dataAgendamento . ' ' . $hora;
        $title = $assunto . ' (' . $tipo . ')';
     echo   $sql = "UPDATE events SET  start = '$data', end = '$data', title = '$title' WHERE id_atividade = '$id_atividade'";
//        $sql = "INSERT INTO events VALUES('','$data','$data','$title','$id_user','$id_atividade')";
        $sql = $this->db->prepare($sql);
        $sql->execute();
    }
    public function comparaAtividadeAgenda($dataAgenda, $id_atividade) {
        $data = date('Y/m/d H:i:s');
//        echo $dataAgenda;
        $aux = explode(' ', $dataAgenda);
//        var_dump($aux);
        $sql = "UPDATE atividades SET data = '$data', data_agendamento = '$aux[0]', hora = '$aux[1]' WHERE id = '$id_atividade'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
    }
    
    public function deletaAtividadeCron($id){
        $sql = "DELETE FROM atividades WHERE id = '$id'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
    }
    public function deletaAgendaCron($id){
        $sql = "DELETE FROM events WHERE id_atividade = '$id'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
    }

}
