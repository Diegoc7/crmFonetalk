<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Empresas
 *
 * @author Diego
 */
class Empresas extends model {

    //put your code here
    public function adicionaEmpresa($array) {
//        var_dump($array);
        if (isset($array['nome']) && !empty($array['nome']) && isset($array['id_user']) && !empty($array['id_user'])) {
            extract($array);
            $nome = addslashes($nome);
//            $empresa = addslashes($empresa);
            if (empty($contato) || !isset($contato)) {
                $contato = '';
            } else {
                $contato = addslashes($contato);
            }
            if (empty($idBuscaContato) || !isset($idBuscaContato)) {
                $idBuscaContato = '';
            } else {
                $idBuscaContato = addslashes($idBuscaContato);
            }
            $cargo = addslashes($cargo);
//            $tipoCell = addslashes($tipoCell);
            if (empty($tipoCell) || !isset($tipoCell)) {
                $tipoCell = '';
            } else {
                $tipoCell = addslashes($tipoCell);
            }
            if (empty($telefone) || !isset($telefone)) {
                $telefone = '';
            } else {
                $telefone = addslashes($telefone);
            }
//            $tipoCell2 = addslashes($tipoCell2);
            if (empty($tipoCell2) || !isset($tipoCell2)) {
                $tipoCell2 = '';
            } else {
                $tipoCell2 = addslashes($tipoCell2);
            }
            if (empty($telefone2) || !isset($telefone2)) {
                $telefone2 = '';
            } else {
                $telefone2 = addslashes($telefone2);
            }
//            $tipoCell3 = addslashes($tipoCell3);
            if (empty($tipoCell3) || !isset($tipoCell3)) {
                $tipoCell3 = '';
            } else {
                $tipoCell3 = addslashes($tipoCell3);
            }
            if (empty($telefone3) || !isset($telefone3)) {
                $telefone3 = '';
            } else {
                $telefone3 = addslashes($telefone3);
            }
            $email = addslashes($email);
//            $origem = addslashes($origem);
//            if (empty($origem) || !isset($origem)) {
//                $origem = '';
//            } else {
//                $origem = addslashes($origem);
//            }
            $cnpj = addslashes($cnpj);
            $site = addslashes($site);
//            $data = $this->formataHoraParaBanco($data);
            $endereco = addslashes($endereco);
            $observacao = addslashes($observacao);
            $id_user = addslashes($id_user);
            $dataInsercao = date("Y-m-d H:i:s");
            $sql = "INSERT INTO empresas VALUES('','$dataInsercao','$nome','$idBuscaContato','$cargo','$tipoCell','$telefone','$tipoCell2','$telefone2','$tipoCell3','$telefone3','$email','$site','$observacao','$cnpj','$endereco','$id_user')";
//            $sql = "INSERT INTO empresas VALUES('','$dataInsercao','$nome','$contato','$cargo','$tipoCell','$telefone','$tipoCell2','$telefone2','$tipoCell3','$telefone3','$email','$site','$observacao','$cnpj','$endereco','$id_user')";
            $sql = $this->db->prepare($sql);
            $sql->execute();
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    public function buscaEmpresasTabela() {
//     echo   $sql = "SELECT c.nome,c.telefone1,c.email,e.nome AS empresa FROM contatos AS c JOIN empresas AS e WHERE IF(c.id_empresa != 0) THEN c.id_empresa = e.id ELSE (c.id_empresa = 1)";
        $sql = "SELECT empresas.id, empresas.nome, empresas.telefone1, empresas.email, contatos.nome AS contato FROM empresas LEFT JOIN contatos ON empresas.id_contato = contatos.id";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function buscaEmpresaEspecifica($id) {
        $sql = "SELECT empresas.*, contatos.nome AS contato, usuario.nome AS usuario FROM empresas LEFT JOIN contatos ON empresas.id_contato = contatos.id JOIN usuario WHERE empresas.id = '$id' AND usuario.id = empresas.id_user";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function countEdit($id) {
        $sql = "SELECT COUNT(*) as c FROM  historico_empresas WHERE id_empresa = '$id'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetch();
    }

    public function editaEmpresa($array) {
        if (is_array($array) && $array['id_empresa'] > 0 && !empty($array['id_empresa'])) {
            extract($array);
            $nomeEdit = addslashes($nomeEdit);
//            $empresa = addslashes($empresa);
            if (empty($contatoEdit) || !isset($contatoEdit)) {
                $contatoEdit = '';
            } else {
                $contatoEdit = addslashes($contatoEdit);
            }
            if (empty($idBuscaContatoEdit) || !isset($idBuscaContatoEdit)) {
                $idBuscaContatoEdit = '';
            } else {
                $idBuscaContatoEdit = addslashes($idBuscaContatoEdit);
            }
            $cargoEdit = addslashes($cargoEdit);
//            $tipoCell = addslashes($tipoCell);
            if (empty($tipoCellEdit) || !isset($tipoCellEdit)) {
                $tipoCellEdit = '';
            } else {
                $tipoCellEdit = addslashes($tipoCellEdit);
            }
            if (empty($telefoneEdit) || !isset($telefoneEdit)) {
                $telefoneEdit = '';
            } else {
                $telefoneEdit = addslashes($telefoneEdit);
            }
//            $tipoCell2 = addslashes($tipoCell2);
            if (empty($tipoCell2Edit) || !isset($tipoCell2Edit)) {
                $tipoCell2Edit = '';
            } else {
                $tipoCell2Edit = addslashes($tipoCell2Edit);
            }
            if (empty($telefone2Edit) || !isset($telefone2Edit)) {
                $telefone2Edit = '';
            } else {
                $telefone2Edit = addslashes($telefone2Edit);
            }
//            $tipoCell3 = addslashes($tipoCell3);
            if (empty($tipoCell3Edit) || !isset($tipoCell3Edit)) {
                $tipoCell3Edit = '';
            } else {
                $tipoCell3Edit = addslashes($tipoCell3Edit);
            }
            if (empty($telefone3Edit) || !isset($telefone3Edit)) {
                $telefone3Edit = '';
            } else {
                $telefone3Edit = addslashes($telefone3Edit);
            }
            $emailEdit = addslashes($emailEdit);
//            $origem = addslashes($origem);
//            if (empty($origemEdit) || !isset($origemEdit)) {
//                $origemEdit = '';
//            } else {
//                $origemEdit = addslashes($origemEdit);
//            }
            $cnpjEdit = addslashes($cnpjEdit);
            $siteEdit = addslashes($siteEdit);

            $enderecoEdit = addslashes($enderecoEdit);
            $observacaoEdit = addslashes($observacaoEdit);
            $id_user_edit = addslashes($id_user_edit);
            $sql = "UPDATE empresas SET nome = '$nomeEdit', id_contato = '$idBuscaContatoEdit', cargo = '$cargoEdit', tipotel1 = '$tipoCellEdit', telefone1 = '$telefoneEdit', tipotel2 = '$tipoCell2Edit', telefone2 = '$telefone2Edit', tipotel3 = '$tipoCell3Edit', telefone3 = '$telefone3Edit', email = '$emailEdit', site = '$siteEdit', cnpj = '$cnpjEdit', endereco = '$enderecoEdit', observacao = '$observacaoEdit' WHERE id = '$id_empresa'";
            $sql = $this->db->prepare($sql);
            $sql->execute();

            $id_empresa = addslashes($id_empresa);
            $data = date("Y-m-d H:i:s");
            $sql = "INSERT INTO historico_empresas VALUES('','$id_user_edit','$id_empresa','','$data')";
            $sql = $this->db->prepare($sql);
            $sql->execute();

            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function buscaEmpresa($busca) {
        $sql = "SELECT id,nome,cargo FROM  empresas WHERE nome LIKE '$busca%'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

    private function insereEmpresaVazio($nome, $id_user) {
        $dataInsercao = date("Y-m-d H:i:s");
        $sql = "INSERT INTO empresas VALUES('','$dataInsercao','$nome','','','','','','','','','','','','','','$id_user')";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $this->db->lastInsertId();
    }

    public function atualizaID_Contato($id_empresa, $id_contato) {
        $sql = "UPDATE empresas SET id_contato = '$id_contato' WHERE id = '$id_empresa'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
    }
    
    public function verificaEmpresaNome($nome, $id_user) {
//        $nome = utf8_encode($nome);
        $sql = "SELECT id FROM  empresas WHERE nome = '$nome'";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        if (empty($sql->fetch())) {
            return $this->insereEmpresaVazio($nome, $id_user);
        } else {
            return $sql->fetch()['id'];
        }
    }

}
