<!--#!/usr/bin/php-->
<?php
include_once 'config.php';
include_once 'core/model.php';
include_once 'models/Atividades.php';
$atividades = new Atividades();
$retorno = $atividades->buscaAtividadesTabela();
//var_dump($retorno);
$retornoAgenda = $atividades->buscaAgenda();
//var_dump($retornoAgenda);

foreach ($retorno as $value) {
    $id = $value['id'];
    $del = 0;
    foreach ($retornoAgenda as $v) {

        $id_atividade = $v['id_atividade'];
//        echo '<br/>';
        if ($id == $id_atividade) {
            $del = 1;
            $dataAgendamento = $atividades->formataHoraParaBanco($value['data_agendamento']);
            $dataAgendamento = str_replace('/', '-', $dataAgendamento);
            $data = '';
//            echo $dataAgendamento . " " . $value['hora'] . '<br/>';
//            echo $v['start'];
            if ($dataAgendamento . " " . $value['hora'] != $v['start']) {
                $data = $v['start'];
            }
            if (!empty($data)) {
                $atividades->comparaAtividadeAgenda($data, $id_atividade);
            }
            break;
        }
    }
    if ($del == 0) {
//        echo 'aqui!';
        $atividades->deletaAtividadeCron($id);
    }
}
