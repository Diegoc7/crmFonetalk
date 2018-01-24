<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//header("Content-Type: text/html; charset=ISO-8859-1", true);

include_once 'config.php';
include_once 'core/model.php';
include_once 'models/Usuarios.php';
$usuarios = new Usuarios();
include_once 'models/Empresas.php';
$empresas = new Empresas();
include_once 'models/Negocios.php';
$negocios = new Negocios();
include_once 'models/Contatos.php';
$contatos = new Contatos();


$arquivo = 'inserir3.csv';
$ponteiro = fopen($arquivo, "r"); // abre o arquivo para escrita 
while (!feof($ponteiro)) {
    $linha = fgets($ponteiro, 4096);
//       utf8_encode($linha);
//     echo '<hr/>';
    $aux = explode(',', $linha);
//    var_dump($aux);
    $nome = str_replace('"', '', $aux[0]);
    $emailPrincipal = $aux[1];
    $telefonePrincipal = str_replace('"', '', $aux[2]);
    $tipoTelefone = '';
    if (!empty($telefonePrincipal)) {
        $tipoTelefone = 'Celular';
    }
    $dataInserindo = $aux[3];
    $email = str_replace('"', '', $aux[4]);
    $telefonesRestantes = str_replace('"', '', $aux[5]);
    $tipoTelefone2 = '';
    $tipoTelefone3 = '';
    if (!empty($telefonesRestantes)) {
        $tipoTelefone2 = 'Celular';
    }
    $telefonesRestantes2 = '';
    if (strstr($telefonesRestantes, '/')) {
        $telefonesRestantes = explode('/', $telefonesRestantes);
//        var_dump($telefonesRestantes);
        $telefonesRestantes2 = $telefonesRestantes[1];
        $telefonesRestantes = $telefonesRestantes[0];
        if (!empty($telefonesRestantes)) {
            $tipoTelefone2 = 'Celular';
        }
        if (!empty($telefonesRestantes2)) {
            $tipoTelefone3 = 'Celular';
        }
    }
//    var_dump($telefonesRestantes);
    $empresaRelacionada = str_replace('"', '', $aux[6]);
    $empresa = explode('(', $empresaRelacionada)[0];
//    var_dump($empresa);
    $empresaEmailRelacionada = $aux[7];
    $cargo = str_replace('"', '', $aux[8]);
    $cargo = explode('(', $cargo)[0];
    $origemCadastro = $aux[9];
    $responsavel = str_replace('"', '', $aux[10]);  //buscar o id no bd
    $emailsEnviados = $aux[11]; //Descartar*
    $emailsAbertos = $aux[12]; //Descartar*
    $emailsClicados = $aux[13]; //Descartar*
    $totaldeNotas = $aux[14]; //verificar*
     $atividadesRealizadas = $aux[15];
    $atividadesAgendadas = $aux[16];
    $ultimaAtividadesFeita = $aux[17]; //Descartar*
    $proximaAtividade = $aux[18]; //Descartar*
    //ADD
    $negociosGanhos = str_replace('"', '', $aux[19]);
    $negociosPerdidos = str_replace('"', '', $aux[20]);
    $negociosAndamentos = str_replace('"', '', $aux[21]);
     //ADD
    $ultimoNegocioGanho = $aux[22]; //Descartar*
    $ultimoNegocioPerdido = $aux[23]; //Descartar*
    $dataDesignacao = $aux[24]; //Descartar*
    $interacoes = $aux[25]; //Descartar*
    $diasSemInteracao = $aux[26]; //Descartar*
    $dataCriacao = str_replace('"', '', $aux[27]);
    $cpf = str_replace('"', '', $aux[28]);
    $endereco = str_replace('"', '', $aux[29]);
    $origem = str_replace('"', '', $aux[30]);
    $dataNascimento = str_replace('"', '', $aux[31]);


    $id_user = $usuarios->buscaUsuarioID(($responsavel));
    $id_empresa = '';
    if (!empty($empresa)) {
        $id_empresa = $empresas->verificaEmpresaNome($empresa, $id_user);
    }
    $negocios->addNegocioArquivo($negociosGanhos, $negociosPerdidos, $negociosAndamentos, $id_user);
//    var_dump($id_user);
   $id_contato =  $contatos->insereContatoArquivo($dataCriacao, $nome, $id_empresa, $cargo, $tipoTelefone, $telefonePrincipal, $tipoTelefone2, $telefonesRestantes, $tipoTelefone3, $telefonesRestantes2, $email, $origem, $cpf, $dataNascimento, $endereco, '', $id_user);
   if (!empty($empresa) && !empty($id_contato)) {
        $empresas->atualizaID_Contato($id_empresa, $id_contato);
   }
  echo 'ok';
  echo '<hr/>';
}



 