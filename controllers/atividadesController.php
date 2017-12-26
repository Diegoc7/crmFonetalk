<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of atividadesController
 *
 * @author Diego
 */
class atividadesController extends controller {

    //put your code here
    public function index() {
        $this->validaSessao();
        $dados = array();
        $this->loadTemplate('atividades', $dados);
    }

    public function insere() {
//        var_dump($_POST);
        $atividades = new Atividades();
        $retorno = $atividades->insereAtividade($_POST);
        if ($retorno) {
            echo json_encode($retorno);
        } else {
            echo json_encode('erro');
        }
    }

    public function buscaTabela() {
        $atividades = new Atividades();
        $retorno = $atividades->buscaAtividadesTabela();
//        var_dump($retorno);
        echo json_encode($retorno);
    }

    public function buscaNotificacoes($id_user) {
        $atividades = new Atividades();
        $retorno = $atividades->buscaAtividadesDia($id_user);
//        var_dump($retorno);
        if (!empty($retorno)) {
            $hora = date("Y-m-d H:i:s");
            $hora = new DateTime($hora);
//         var_dump($hora);
            $cont = 0;
            foreach ($retorno as $value) {
                $data_agendamento = $value['data_agendamento'];
                $acao = $value['acao'];
                $horaBD = $data_agendamento . ' ' . $value['hora'];
                $horaBD = new DateTime($horaBD);
//                var_dump($horaBD);
                $intervalo = $hora->diff($horaBD);
//                 var_dump($horaBD);
//                echo $horaBD;
//                 var_dump($horaBD > $horaBD);
                if ($horaBD >= $hora && $acao == 1) {
                    $passaArray[$cont]['id'] = $value['id'];
                    $passaArray[$cont]['assunto'] = $value['assunto'];
                    $passaArray[$cont]['tipo'] = $value['tipo'];
//
                    $min = $intervalo->format("%I");
                    $hou = $intervalo->format("%h");
                    if ($hou > 0) {
                        $PassaHora = "$hou Hora(s) e";
                    } else {
                        $PassaHora = "";
                    }
//
                    $passaArray[$cont]['tempo'] = "Restam $PassaHora $min minuto(s)";
                    $passaArray[$cont]['cont'] = $cont;
                    if ($hou == 0 && ($min == 1 || $min == 0)) {
                        $passaArray[$cont]['alerta'] = '1';
                    } else {
                        $passaArray[$cont]['alerta'] = '0';
                    }
                    $cont = $cont + 1;
                }
            }
            if (isset($passaArray) && !empty($passaArray)) {
                echo json_encode($passaArray);
            } else {
                echo json_encode('vazio');
            }
        } else {
            echo json_encode('vazio');
        }
    }

    public function feito() {
        if (isset($_POST['id']) && $_POST['id'] > 0) {
            $atividades = new Atividades();
            $atividades->alteraAcao($_POST['id'], $_POST['valor']);
            echo json_encode('ok');
        }
    }

    public function atividadeUnico($id) {
        $atividades = new Atividades();
        $retorno = $atividades->buscaAtividadesUnico($id);
//        var_dump($retorno);
        echo json_encode($retorno);
    }

    public function edita() {
//        var_dump($_POST);
        $atividades = new Atividades();
        $retorno = $atividades->editaAtividade($_POST);
        if ($retorno) {
            echo json_encode('ok');
        } else {
            echo json_encode('erro');
        }
    }

    public function agenda($view = '') {
//        echo 'aqi';
        $_GET['view'] = $view;
        $connection = mysqli_connect('127.0.0.1', 'root', 'y2jrpdwk', 'bd_crm') or die(mysqli_error($connection));
//var_dump($_POST);
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = session_id();
        }
        $uid = $_SESSION['user'];  // set your user id settings
        $datetime_string = date('c', time());
//$_GET['view'] = 1;
        if (isset($_POST['action']) or isset($_GET['view'])) {
            if (isset($_GET['view'])) {
                header('Content-Type: application/json');
                $start = mysqli_real_escape_string($connection, $_GET["start"]);
                $end = mysqli_real_escape_string($connection, $_GET["end"]);

                $result = mysqli_query($connection, "SELECT `id`, `start` ,`end` ,`title` FROM  `events` where (date(start) >= '$start' AND date(start) <= '$end') and uid='" . $uid . "'");
                while ($row = mysqli_fetch_assoc($result)) {
                    $events[] = $row;
                }
                echo json_encode($events);
                exit;
            } elseif ($_POST['action'] == "add") {
                mysqli_query($connection, "INSERT INTO `events` (
                    `title` ,
                    `start` ,
                    `end` ,
                    `uid` 
                    )
                    VALUES (
                    '" . mysqli_real_escape_string($connection, $_POST["title"]) . "',
                    '" . mysqli_real_escape_string($connection, date('Y-m-d H:i:s', strtotime($_POST["start"]))) . "',
                    '" . mysqli_real_escape_string($connection, date('Y-m-d H:i:s', strtotime($_POST["end"]))) . "',
                    '" . mysqli_real_escape_string($connection, $uid) . "'
                    )");
                header('Content-Type: application/json');
                echo '{"id":"' . mysqli_insert_id($connection) . '"}';
                exit;
            } elseif ($_POST['action'] == "update") {
                mysqli_query($connection, "UPDATE `events` set 
            `start` = '" . mysqli_real_escape_string($connection, date('Y-m-d H:i:s', strtotime($_POST["start"]))) . "', 
            `end` = '" . mysqli_real_escape_string($connection, date('Y-m-d H:i:s', strtotime($_POST["end"]))) . "' 
            where uid = '" . mysqli_real_escape_string($connection, $uid) . "' and id = '" . mysqli_real_escape_string($connection, $_POST["id"]) . "'");
                exit;
            } elseif ($_POST['action'] == "delete") {
                mysqli_query($connection, "DELETE from `events` where uid = '" . mysqli_real_escape_string($connection, $uid) . "' and id = '" . mysqli_real_escape_string($connection, $_POST["id"]) . "'");
                if (mysqli_affected_rows($connection) > 0) {
                    echo "1";
                }
                exit;
            }
        }
    }
    
    public function deleta($id){
        $atividades = new Atividades();
        $atividades->deletaAtividadeCron($id);
        $atividades->deletaAgendaCron($id);
        echo json_encode('ok');
    }

}
