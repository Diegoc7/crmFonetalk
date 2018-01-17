/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var ver = $('.divTabela').html();
var session_id_user = $('#session_id_user').val();
$(document).ready(function () {
    
   

//    $('#modalAgenda').modal('show');

    $('#addUser').tooltip();
    $('.btnVer').tooltip();
    $('.tell2').css('display', 'none');
    $('.tell3').css('display', 'none');
    $('.tell2Edit').css('display', 'none');
    $('.tell3Edit').css('display', 'none');
    $("body").fadeIn(1500);



    var url = location.href;
    url = url.split("http://192.168.1.61/crmFonetalk/"); //quebra o endeço de acordo com a / (barra)
//    url = url.split("http://192.168.0.126/crm/"); //quebra o endeço de acordo com a / (barra)
    url = url[1].replace('#', '');
    if (url == 'index.php' || url == 'index' || url == '') {
        $('#barIndex').addClass('active');
        graficoHome();
        buscaInfoNegociosUser(session_id_user);
    } else {
        $('#bar_' + url).addClass('active');

        if (url == 'usuarios') {
            carregaUsuarios();
        } else if (url == 'contatos') {
            carregaContatos();
            carregaEmpresasSelect();
        } else if (url == 'empresas') {
            carregaEmpresas();
            carregaContatosSelect();
        } else if (url == 'negocios') {
            carregaContatosSelect();
            carregaEmpresasSelect();
            carregaNegocios();
        } else if (url == 'agenda') {
            caledario();
        } else if (url == 'atividades') {
            carregaAtividades();
            carregaContatosSelect();
            carregaEmpresasSelect();
            carregaNegociosSelect();
        }
    }
    $('.dataFormato').datepicker({
        clearBtn: true,
        language: "pt-BR",
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true
//            datesDisabled: ['08/06/2017', '08/21/2017']
    });
    $('.dataFormato').mask("99/99/9999");
    $('.cpfFormato').mask("999.999.999-99");
    $('.cnpjFormato').mask("99.999.999/9999-99");
    $("#valor").maskMoney();
    $("#valorEdit").maskMoney();
    console.log(url);



    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
            spOptions = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };

    $('.telFormato').mask(SPMaskBehavior, spOptions);

    $("#arquivo").change(function () {
        var fileInput = $(this);
        var maxSize = $(this).data('max-size');
//        console.log(fileInput.get(0).files[0].size);
        //aqui a sua função normal
        if (fileInput.get(0).files.length) {
            var fileSize = fileInput.get(0).files[0].size; // in bytes
            if (fileSize > maxSize) {
                alert('Tamanho do arquivo acima de 4MB');
                return false;
            } else {
                //alert('file size is correct- ' + fileSize + ' bytes');
            }
        } else {
            alert('choose file, please');
            return false;
        }
    });

    buscaNotificacoes();
});

var auto_refresh = setInterval(function () {
    buscaNotificacoes();
}
, 950);

function buscaNotificacoes() {
    $.ajax({
        type: 'POST',
        url: 'atividades/buscaNotificacoes/' + session_id_user,
        cache: false,
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (json) {
//            console.log(json);
            $('#notificacoes').html('');
            if (json != 'vazio') {
//                $('.tabela').find('tbody').html('');
                json.forEach(montaNotificacoes);
            }

        },
        error: function (e) {//executa se der erro em algum lugar
            alert("Ocorreu um erro" + e);
        }
    });
}

function montaNotificacoes(value, index, ar) {
    console.log(index);
    var cont = -1;
    if (value.cont > cont) {
        cont = value.cont;
        $('#numberNotificacao').html(cont + 1);
        $('#numberNotificacao').removeClass('bg-secondary');
        $('#numberNotificacao').addClass('bg-red');
    }

    if (value.alerta == 1) {
        var btn = '<center><button class="btn btn-md btn-outline-success" onclick="feito(' + value.id + ', ' + 3 + ')">Tarefa Realizada!</button></center><hr/>';
        $('#tituloModalAlerta').html('Aviso ' + value.tipo + '!');
        $('#escreveAlertaModal').html('O evento: ' + value.assunto + ' está agendado para <u>agora!</u><br/>' + btn);
        $('#modalAgenda').modal('show');
    }
    var fa;
    var color;
    if (value.tipo == 'E-mail') {
        fa = 'envelope';
        color = 'red';
    } else if (value.tipo == 'Feedback') {
        fa = 'reply';
        color = 'green';
    } else if (value.tipo == 'Ligação') {
        fa = 'phone';
        color = 'blue';

    } else if (value.tipo == 'Reunião') {
        fa = 'group';
        color = 'warning';

    } else if (value.tipo == 'Visita') {
        fa = 'car';
        color = 'success';
    }
    var escreve1 = '<li><a rel="nofollow" href="#" class="dropdown-item">';
    var escreve2 = '<div class="notification">';
    var escreve3 = '<div class="notification-content"><i class="fa fa-' + fa + ' bg-' + color + '"></i>' + value.assunto + '</div>';
    var escreve4 = '<div class="notification-time"><small>' + value.tempo + '</small></div></div></a></li>';
    $('#notificacoes').append(escreve1 + '' + escreve2 + '' + escreve3 + '' + escreve4);
//   console.log(value.cont);
}

function caledario() {
    var calendar = $('#calendar').fullCalendar({
        locale: 'pt-br',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultView: 'agendaWeek',
        editable: true,
        selectable: true,
        allDaySlot: false,

//            events: "http://192.168.1.61/crmFonetalk/atividades/agenda/1",
//            events: "http://192.168.1.61/crmFonetalk/atividades/agenda?view=1",
        events: "db.php?view=1",
//            events: "index.php?view=1",


        eventClick: function (event, jsEvent, view) {
            endtime = $.fullCalendar.moment(event.end).format('h:mm');
            starttime = $.fullCalendar.moment(event.start).format('dddd, MMMM Do YYYY, h:mm');
            var mywhen = starttime + ' - ' + endtime;
            $('#modalTitle').html(event.title);
            $('#modalWhen').text(mywhen);
            $('#eventID').val(event.id);
            $('#calendarModal').modal();
        },

        //header and other values
        select: function (start, end, jsEvent) {
            endtime = $.fullCalendar.moment(end).format('h:mm');
            starttime = $.fullCalendar.moment(start).format('dddd, MMMM Do YYYY, h:mm');
            var mywhen = starttime + ' - ' + endtime;
            start = moment(start).format();
            end = moment(end).format();
            $('#createEventModal #startTime').val(start);
            $('#createEventModal #endTime').val(end);
            $('#createEventModal #when').text(mywhen);
            $('#createEventModal').modal('toggle');
        },
        eventDrop: function (event, delta) {
            $.ajax({
//                   url: 'http://192.168.1.61/crmFonetalk/atividades/agenda',
                url: 'db.php',
//                   url: 'index.php',
                data: 'action=update&title=' + event.title + '&start=' + moment(event.start).format() + '&end=' + moment(event.end).format() + '&id=' + event.id,
                type: "POST",
                success: function (json) {
                    //alert(json);
                }
            });
        },
        eventResize: function (event) {
            $.ajax({
//                   url: 'http://192.168.1.61/crmFonetalk/atividades/agenda',
                url: 'db.php',
//                   url: 'index.php',
                data: 'action=update&title=' + event.title + '&start=' + moment(event.start).format() + '&end=' + moment(event.end).format() + '&id=' + event.id,
                type: "POST",
                success: function (json) {
                    //alert(json);
                }
            });
        }
    });

    $('#submitButton').on('click', function (e) {
        // We don't want this to act as a link so cancel the link action
        e.preventDefault();
        doSubmit();
    });

    $('#deleteButton').on('click', function (e) {
        // We don't want this to act as a link so cancel the link action
        e.preventDefault();
        doDelete();
    });

    function doDelete() {
        $("#calendarModal").modal('hide');
        var eventID = $('#eventID').val();
        $.ajax({
//               url: 'http://192.168.1.61/crmFonetalk/atividades/agenda',
            url: 'db.php',
//               url: 'index.php',
            data: 'action=delete&id=' + eventID,
            type: "POST",
            success: function (json) {
                if (json == 1)
                    $("#calendar").fullCalendar('removeEvents', eventID);
                else
                    return false;


            }
        });
    }
    function doSubmit() {
        $("#createEventModal").modal('hide');
        var title = $('#title').val();
        var startTime = $('#startTime').val();
        var endTime = $('#endTime').val();

        $.ajax({
//               url: 'http://192.168.1.61/crmFonetalk/atividades/agenda',
            url: 'db.php',
//               url: 'index.php',
            data: 'action=add&title=' + title + '&start=' + startTime + '&end=' + endTime,
            type: "POST",
            success: function (json) {
                $("#calendar").fullCalendar('renderEvent',
                        {
                            id: json.id,
                            title: title,
                            start: startTime,
                            end: endTime,
                        },
                        true);
            }
        });

    }
}

function buscaInfoNegociosUser(id) {
    $.ajax({
        type: 'POST',
        url: 'http://192.168.1.61/crmFonetalk/negocios/buscaInfoNegocioUser/' + id,
        cache: false,
        dataType: 'json',
        success: function (json) {
            console.log(json);
            $('#negociacoesPerdidas').html(json['perdido']);
            $('#barNegociacoesPerdidas').prop('style', 'width: ' + json['porcPerdido'] + '%; height: 4px;');
            $('#negociacoesGanhas').html(json['ganho']);
            $('#barNegociacoesGanhas').prop('style', 'width: ' + json['porcGanho'] + '%; height: 4px;');
            $('#negociacoesAtuais').html(json['atual']);
            $('#barNegociacoesAtuais').prop('style', 'width: ' + json['porcAtual'] + '%; height: 4px;');
            $('#porcPerda').html(json['porcPerdido'] + ' %');
            $('#porcGanho').html(json['porcGanho'] + ' %');
            $('#porcAberta').html(json['porcAtual'] + ' %');
        },
        error: function (e) {//executa se der erro em algum lugar
            alert("erro ao buscar" + e);
        }
    });
}
$("#tipoCell").on('change', function (e) {
    var val = $(this).val();
    if (val != '') {
        $('#telefone').removeAttr('disabled');
        return false;
    } else {
        $('#telefone').attr('disabled', 'disabled');
    }
});
$("#tipoCell2").on('change', function (e) {
    var val = $(this).val();
    if (val != '') {
        $('#telefone2').removeAttr('disabled');
        return false;
    } else {
        $('#telefone2').attr('disabled', 'disabled');
    }
});
$("#tipoCell3").on('change', function (e) {
    var val = $(this).val();
    if (val != '') {
        $('#telefone3').removeAttr('disabled');
        return false;
    } else {
        $('#telefone3').attr('disabled', 'disabled');
    }
});
$("#tipoCellEdit").on('change', function (e) {
    var val = $(this).val();
    if (val != '') {
        $('#telefoneEdit').removeAttr('disabled');
        return false;
    } else {
        $('#telefoneEdit').attr('disabled', 'disabled');
    }
});
$("#tipoCell2Edit").on('change', function (e) {
    var val = $(this).val();
    if (val != '') {
        $('#telefone2Edit').removeAttr('disabled');
        return false;
    } else {
        $('#telefone2Edit').attr('disabled', 'disabled');
    }
});
$("#tipoCell3Edit").on('change', function (e) {
    var val = $(this).val();
    if (val != '') {
        $('#telefone3Edit').removeAttr('disabled');
        return false;
    } else {
        $('#telefone3Edit').attr('disabled', 'disabled');
    }
});
$('#form-insert-user').bind('submit', function (e) {
    e.preventDefault();
    var txt = $(this).serialize();
    console.log(txt);
    $.ajax({
        type: 'POST',
        url: 'usuarios/insere',
        data: txt,
        dataType: 'json',
        beforeSend: function (x) {
            $('#modalCarregar').modal('show');
//            alteraModal();
        },
        success: function (json) {
            console.log(json);
            setTimeout(function () {
                $('#modalCarregar').modal('hide');
            }, 500);
            if (json === 'erro') {
                setTimeout(function () {
                    $('#modalError').modal('show');
                }, 1000);
//                $('#modalError').modal('show');
            } else {
                $('#nome').val('');
                $('#login').val('');
                $('#email').val('');
                $('#senha').val('');
                $('#repitaSenha').val('');
                setTimeout(function () {
                    $('#modalOK').modal('show');
                }, 1000);
//                $('#modalOK').modal('show');
                carregaUsuarios();
            }

        },

        error: function () {//executa se der erro em algum lugar
            $('#modalError').modal('show');
        }
    });
});
function alteraModal() {
    $('#modalCarregar').modal('toggle');
}
function carregaUsuarios() {
    $.ajax({
        type: 'POST',
        url: 'usuarios/buscaTabela',
        cache: false,
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (json) {
//            console.log(json);
            $('.divTabela').html(ver);
            if (json != 'vazio') {
                $('.tabela').find('tbody').html('');
                json.forEach(montaTabela);

            }
            $('.tabela').DataTable({
                "aaSorting": [[0, "asc"]],
                "oLanguage": {
                    "sLengthMenu": "Mostrando _MENU_ registros",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
                    "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros)",
                    "sSearch": "Pesquisar: ",
                    "oPaginate": {
                        "sFirst": "Início",
                        "sPrevious": "Anterior",
                        "sNext": "Próximo",
                        "sLast": "Último"
                    }
                }
            });

        },
        error: function (e) {//executa se der erro em algum lugar
            alert("Ocorreu um erro" + e);
        }
    });
}
function montaTabela(value, index, ar) {
    var cor = '';
    var tipo = '';
    if (value.tipo == '1') {
        tipo = 'Administração';
    } else if (value.tipo == '2') {
        tipo = 'Vendedor';
    } else if (value.tipo == '3') {
        tipo = 'Operador';
    } else if (value.status == 'Andamento') {
        tipo = ' ';
    }
    var btnRelatorio = '<button class="btndeleta btn btn-primary btn-sm" onclick="iniciaTabelaRelatorio(\'' + value.idlist + '\' ,\'Ura Ativa\' )"  ><i class="fa fa-eye"></i></button>';
    $('.tabela').find('tbody').append(
            '<tr><td ' + cor + ' >' + value.nome + '</td><td ' + cor + '>' + value.login + '</td><td ' + cor + '>' + value.email + '</td><td ' + cor + '>' + tipo + '</td><td ' + cor + '>' + btnRelatorio + ' </td></tr>'
            );
}

function abreForm() {
    $('.forms').slideDown('slow');
    $('html, body').animate({
        scrollTop: $('.forms').offset().top
    }, 1000);
    $('#addUser').hide('slow');
    $('.edit').slideUp('slow');
}
function fechaForm() {
    $('.forms').slideUp('slow');
    $('#addUser').show('slow');
}
function fechaFormEdit() {
    $('.edit').slideUp('slow');
//    $('#addUser').show('slow');
}

function addTel(valor) {
    if (valor == 0) {
        $('.tell2').slideDown('slow');
        $('#addTell').removeAttr('onclick');
        $('#addTell').attr('onclick', 'addTel(1);');

        $('#remTell').removeClass('disabled');
        $('#remTell').removeAttr('onclick');
        $('#remTell').attr('onclick', 'removeTel(1);');
    }
    if (valor == 1) {
        $('.tell3').slideDown('slow');
        $('#addTell').removeAttr('onclick');
        $('#addTell').attr('onclick', 'addTel(2);');
        $('#addTell').addClass('disabled');

        $('#remTell').removeAttr('onclick');
        $('#remTell').attr('onclick', 'removeTel(2);');
    }
    console.log(valor);
}
function removeTel(valor) {
    if (valor == 1) {
        $('.tell2').slideUp('slow');
        $('#addTell').removeAttr('onclick');
        $('#addTell').attr('onclick', 'addTel(0);');

        $('#remTell').addClass('disabled');
        $('#remTell').removeAttr('onclick');
        $('#remTell').attr('onclick', 'removeTel(0);');
    }
    if (valor == 2) {
        $('.tell3').slideUp('slow');
        $('#addTell').removeAttr('onclick');
        $('#addTell').attr('onclick', 'addTel(1);');
        $('#addTell').removeClass('disabled');

        $('#remTell').removeAttr('onclick');
        $('#remTell').attr('onclick', 'removeTel(1);');
    }
}
function addTelEdit(valor) {
    if (valor == 0) {
        $('.tell2Edit').slideDown('slow');
        $('#addTellEdit').removeAttr('onclick');
        $('#addTellEdit').attr('onclick', 'addTelEdit(1);');

        $('#remTellEdit').removeClass('disabled');
        $('#remTellEdit').removeAttr('onclick');
        $('#remTellEdit').attr('onclick', 'removeTelEdit(1);');
    }
    if (valor == 1) {
        $('.tell3Edit').slideDown('slow');
        $('#addTellEdit').removeAttr('onclick');
        $('#addTellEdit').attr('onclick', 'addTelEdit(2);');
        $('#addTellEdit').addClass('disabled');

        $('#remTellEdit').removeAttr('onclick');
        $('#remTellEdit').attr('onclick', 'removeTelEdit(2);');
    }
    console.log(valor);
}
function removeTelEdit(valor) {
    if (valor == 1) {
        $('.tell2Edit').slideUp('slow');
        $('#addTellEdit').removeAttr('onclick');
        $('#addTellEdit').attr('onclick', 'addTelEdit(0);');

        $('#remTellEdit').addClass('disabled');
        $('#remTellEdit').removeAttr('onclick');
        $('#remTellEdit').attr('onclick', 'removeTelEdit(0);');
    }
    if (valor == 2) {
        $('.tell3Edit').slideUp('slow');
        $('#addTellEdit').removeAttr('onclick');
        $('#addTellEdit').attr('onclick', 'addTelEdit(1);');
        $('#addTellEdit').removeClass('disabled');

        $('#remTellEdit').removeAttr('onclick');
        $('#remTellEdit').attr('onclick', 'removeTelEdit(1);');
    }
}

$('#form-insert-contact').bind('submit', function (e) {
    e.preventDefault();
    var txt = $(this).serialize();
    console.log(txt);
    $.ajax({
        type: 'POST',
        url: 'contatos/insere',
        data: txt,
//        dataType: 'json',
        beforeSend: function (x) {
            $('#modalCarregar').modal('show');
//            alteraModal();
        },
        success: function (json) {
            console.log(json);
            setTimeout(function () {
                $('#modalCarregar').modal('hide');
            }, 500);
            if (json === 'erro') {
                setTimeout(function () {
                    $('#modalError').modal('show');
                }, 1000);
            } else {
                $('#form-insert-contact')[0].reset();
                $(".selectpicker").val('default');
                $(".selectpicker").selectpicker("refresh");
                setTimeout(function () {
                    $('#modalOK').modal('show');
                }, 1000);
//                $('#modalOK').modal('show');
//                carregaUsuarios();
                carregaContatos();
            }

        },

        error: function () {//executa se der erro em algum lugar
            $('#modalCarregar').modal('hide');
            setTimeout(function () {
                $('#modalError').modal('show');
            }, 1000);
        }
    });
});

function carregaContatos() {
    $.ajax({
        type: 'POST',
        url: 'contatos/buscaTabela',
        cache: false,
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (json) {
//            console.log(json);
            $('.divTabela').html(ver);
            if (json != 'vazio') {
                $('.tabela').find('tbody').html('');
                json.forEach(montaTabelaContatos);
            }
            $('.tabela').DataTable({
                "aaSorting": [[0, "asc"]],
                "oLanguage": {
                    "sLengthMenu": "Mostrando _MENU_ registros",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
                    "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros)",
                    "sSearch": "Pesquisar: ",
                    "oPaginate": {
                        "sFirst": "Início",
                        "sPrevious": "Anterior",
                        "sNext": "Próximo",
                        "sLast": "Último"
                    }
                }
            });
        },
        error: function (e) {//executa se der erro em algum lugar
            alert("Ocorreu um erro" + e);
        }
    });
}

function montaTabelaContatos(value, index, ar) {
    var cor = '';
    var tipo = '';
    if (value.empresa == null) {
        tipo = ' ';
    } else {
        tipo = value.empresa;
    }
//    var btnRelatorio = '<a class="btndeleta btn btn-primary btn-sm" href="http://192.168.0.126/crm/contatos/contato/'+value.id+'"  ><i class="fa fa-eye"></i></a>';
    var btnRelatorio = '<button class="btndeleta btn btn-primary btn-sm" onclick="mostraContato(' + value.id + ');"  ><i class="fa fa-eye"></i></button>';
    var btnEdit = '<button class="btnedit btn btn-secondary btn-sm" onclick="edit(' + value.id + ');"  ><i class="fa fa-edit"></i></button>';
//    var btnEdit = '<button class="btnedit btn btn-secondary btn-sm" onclick="edit(' + value.id + ', "\ '+value.nome+' "\, "", "", "", "", "", "", "", "", "", "", "", "", "");"  ><i class="fa fa-edit"></i></button>';
    $('.tabela').find('tbody').append(
            '<tr><td ' + cor + ' >' + value.nome + '</td><td ' + cor + '>' + value.telefone1 + '</td><td ' + cor + '>' + value.email + '</td><td ' + cor + '>' + tipo + '</td><td ' + cor + '>' + btnRelatorio + ' ' + btnEdit + ' </td></tr>'
            );
}

var modalContato = $('#modalContato').html();
function mostraContato(id) {
    $('#modalContato').html(modalContato);
    $('#assunto').addClass('input-material');
    $('#tipoAtividade').addClass('selectpicker');
    $('#tipoAtividade').selectpicker('refresh');
    $('#tipoNegocios').addClass('selectpicker');
    $('#tipoNegocios').selectpicker('refresh');
    if (id != '' && id > 0) {
        var id_user = $("[name=id_user]").val();
        console.log(id_user);
        $('#id_contato_arquivo').val(id);
        buscaNotas(id, id_user);
        buscaInfoContato(id);
        buscaNegociosIdContato(id);
        buscaArquivosContato(id);
        $('#modalContato').modal('show');
    }


    $('[name=id_client]').val('');
    $('[name=id_client]').val(id);

    $('#btnEnviarNota').on('click', function () {
        var nota = $('#nova_nota').val();
        var id_user = $("[name=id_user]").val();
        var id_client = $("[name=id_client]").val();
        console.log(id_client);
        if (nota != '' && id_user != '' && id_client != '') {
            var passar = 'id_user=' + id_user + '&nota=' + nota + '&id_client=' + id_client;
            $.ajax({
                type: 'POST',
                url: 'http://192.168.1.61/crmFonetalk/notas/insere',
//                url: 'http://192.168.0.126/crm/notas/insere',
                data: passar,
                cache: false,
                dataType: 'json',
                success: function (json) {
                    console.log(json);
                    if (json != 'erro') {
//                        $('#modalOK').modal('show');
                        $('#nova_nota').val('');
                        buscaNotas(id_client, id_user);
                    }
                },
                error: function (e) {//executa se der erro em algum lugar
                    alert("Ocorreu um erro" + e);
                }
            });
        }

    });

    function buscaNotas(id, id_user) {
        if (id_user != '') {
            $.ajax({
                type: 'POST',
                url: 'http://192.168.1.61/crmFonetalk/notas/busca/' + id_user + '/' + id,
//                url: 'http://192.168.0.126/crm/notas/busca/' + id_user + '/' + id,
//                data: passar,
                cache: false,
                dataType: 'json',
                success: function (json) {
                    $('#contNotas').html('0');
                    $('#writeNotes').html('');
                    console.log(json);
                    if (json != 'erro') {
                        json.forEach(montaNotas);
                    }
                },
                error: function (e) {//executa se der erro em algum lugar
                    alert("erro ao buscar" + e);
                }
            });
        }
    }

    function montaNotas(value, index, ar) {
        $('#contNotas').html(value.cont);
        var cabecalho = '<div class="card border border-info" ><h3 class="card-header">Nota</h3>';
        var corpo = '<div class="card-body"><h4 class="card-title">Inserida ás ' + value.data + '</h4>';
        var corpo2 = '<p class="card-text">' + value.nota + '</p> </div>';
        var rodape = '<div class="card-footer">por: ' + value.nome + '</div></div><hr/>';

        $('#writeNotes').append(cabecalho + '' + '' + corpo + '' + corpo2 + '' + rodape);
//        $('#writeNotes').html(cabecalho+''+''+corpo+''+corpo2+''+rodape);

    }

    function buscaNegociosIdContato(id) {
        $.ajax({
            type: 'POST',
            url: 'http://192.168.1.61/crmFonetalk/negocios/buscaNomeContatoID/' + id,
            cache: false,
            dataType: 'json',
            success: function (json) {
                console.log(json);
                if (json != '') {
                    $('#writeBusiness').html('');
                    json.forEach(montaEscreveNegocio);
                }
            },
            error: function (e) {//executa se der erro em algum lugar
                alert("erro ao buscar" + e);
            }
        });
    }
    function montaEscreveNegocio(value, index, ar) {
        $('#writeBusiness').append(value.nome + '<br/>');
    }

    function buscaInfoContato(id) {
        if (id != '') {
            $.ajax({
                type: 'POST',
                url: 'http://192.168.1.61/crmFonetalk/contatos/contatoUnico/' + id,
//                url: 'http://192.168.0.126/crm/contatos/contatoUnico/' + id,
//                data: passar,
                cache: false,
                dataType: 'json',
                success: function (json) {
//                    $('#contNotas').html('0');
//                     $('#writeNotes').html('');
                    console.log(json);
                    if (json != 'erro') {
                        json.forEach(montaDadosCliente);
                    }
                },
                error: function (e) {//executa se der erro em algum lugar
                    alert("erro ao buscar" + e);
                }
            });
        }
    }

    function montaDadosCliente(value, index, ar) {
        $('#nome_cliente').html(value.nome);
        $('#cargo_cliente').html(value.cargo);
        $('#mostraTelefonePrincipal').html(value.telefone1);
        $('#mostraTipoTelefonePrincipal').html(value.tipo_tel1);
        $('#mostraCPF').html(value.cpf);
        $('#mostraEndereco').html(value.endereco);
        $('#mostraOrigem').html(value.origem);
        $('#mostraDataNascimento').html(value.data_nascimento);
        $('#dateCreate').html(value.data);
        $('#userCreate').html(value.user);
        $('#mostraEmpresa').html(value.empresa);
        $('#mostrarTipoTell2').html(value.tipo_tel2);
        $('#mostrarTell2').html(value.telefone2);
        $('#mostrarTipoTell3').html(value.tipo_tel3);
        $('#mostrarTell3').html(value.telefone3);
        $('#mostrarObs').html(value.observacao);
        $('#contEdit').html(value.contEdit);
    }

    $(function () {
//        $('.form-insert-file-exe').bind('submit', function (e) {
        $('.form-insert-file-contact').bind('submit', function (e) {
            e.preventDefault();

            var data;
            var contentType = "application/x-www-form-urlencoded";
            var processData = true;
            if ($(this).attr('enctype') == 'multipart/form-data') {
                data = new FormData($('.form-insert-file-contact').get(0));//seleciona classe form-horizontal adicionada na tag form do html

                contentType = false;
                processData = false;
            } else {
                data = $(this).serialize();
            }
//        console.log(data);
            $.ajax({
                data: data,
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                contentType: contentType,
                processData: processData,
                beforeSend: function (xhr) {
                    $('#modalCarregar').modal('show');
                },
                success: function (json) {
                    setTimeout(function () {
                        $('#modalCarregar').modal('hide');
                    }, 500);
                    montaAlerta(json);
                    $('.form-insert-file-contact')[0].reset();

                    buscaArquivosContato(id);
                },
                error: function (exr, sender) {
                    alert('error');
                }
            });

        });

    });

    function montaAlerta(resposta) {
        console.log(resposta);
        $('.alert-file').removeClass('alert-danger').removeClass('alert-warning').removeClass('alert-success');
        if (resposta == "1") {
            $('.alert-file').addClass('alert-danger');
            $('.alert-file').html(' <strong>Erro!</strong> Sem Arquivo!.');
        } else if (resposta == '2') {
            $('.alert-file').addClass('alert-warning');
            $('.alert-file').html(' <strong>Alerta!</strong> Extensão não permitida ou arquivo acima de 4 MB!.');
        } else if (resposta == '3') {
            $('.alert-file').addClass('alert-danger');
            $('.alert-file').html(' <strong>Falha!</strong> Erro ao mover o arquivo!.');
        } else {
            $('.alert-file').addClass('alert-success');
            $('.alert-file').html(' <strong>Successo!</strong> Arquivo inserido no sistema!.');
        }
        $('.alert-file').slideDown('slow');
    }

    function buscaArquivosContato(id) {
        if (id != '') {
            $.ajax({
                type: 'POST',
                url: 'http://192.168.1.61/crmFonetalk/arquivos/busca/' + id + '/contatos',
//                url: 'http://192.168.0.126/crm/contatos/contatoUnico/' + id,
//                data: passar,
                cache: false,
                dataType: 'json',
                success: function (json) {
//                    $('#contNotas').html('0');
//                     $('#writeNotes').html('');
                    console.log(json);
                    if (json != 'erro') {
                        $('#mostraArquivos').html('');
                        json.forEach(montaDadosArquivos);
                    }
                },
                error: function (e) {//executa se der erro em algum lugar
                    alert("erro ao buscar" + e);
                }
            });
        }
    }

    function montaDadosArquivos(value, index, ar) {
        $('#mostraArquivos').append('<a href="http://192.168.1.61/crmFonetalk/' + value.caminho + '">' + value.nome + '</a>');

    }
}

function edit(id) {
//    console.log(nome);
    if (id != '') {
        $.ajax({
            type: 'POST',
            url: 'http://192.168.1.61/crmFonetalk/contatos/contatoUnico/' + id,
//            url: 'http://192.168.0.126/crm/contatos/contatoUnico/' + id,
//                data: passar,
            cache: false,
            dataType: 'json',
            beforeSend: function (xhr) {
                $('.forms').slideUp('slow');
            },
            success: function (json) {
                console.log(json);
                if (json != 'erro') {
                    json.forEach(montaEdit);
                    $('.edit').slideDown('slow');
                    $('html, body').animate({
                        scrollTop: $('.edit').offset().top
                    }, 1000);
                }
            },
            error: function (e) {//executa se der erro em algum lugar
                alert("erro ao buscar" + e);
            }
        });
    }
    function montaEdit(value, index, ar) {
        $('#id_contato').val(value.id);
        $('#nomeEdit').val(value.nome);
        $('#empresaEdit').selectpicker('val', value.id_empresa);
        $('#cargoEdit').val(value.cargo);
        $('#tipoCellEdit').selectpicker('val', value.tipo_tel1);
//    $('#tipoCellEdit').val(tipocell);//selectip
        $('#telefoneEdit').val(value.telefone1);
        if (value.telefone1 != '') {
            $('#telefoneEdit').removeAttr('disabled');
        }
        $('#tipoCell2Edit').selectpicker('val', value.tipo_tel2);
        $('#telefone2Edit').val(value.telefone2);
        if (value.telefone2 != '') {
            $('#telefone2Edit').removeAttr('disabled');
        }
        $('#tipoCell3Edit').selectpicker('val', value.tipo_tel3);
        $('#telefone3Edit').val(value.telefone3);
        if (value.telefone3 != '') {
            $('#telefone3Edit').removeAttr('disabled');
        }
        $('#emailEdit').val(value.email);
        $('#origemEdit').selectpicker('val', value.origem);
        $('#cpfEdit').val(value.cpf);
        $('#dataEdit').val(value.data_nascimento);
        $('#enderecoEdit').val(value.endereco);
        $('#observacaoEdit').val(value.observacao);
    }



}
$('#form-edit-contact').bind('submit', function (e) {
    e.preventDefault();
    var txt = $(this).serialize();
    console.log(txt);
    $.ajax({
        type: 'POST',
        url: 'contatos/edita',
        data: txt,
//        dataType: 'json',
        beforeSend: function (x) {
            $('#modalCarregar').modal('show');
//            alteraModal();
        },
        success: function (json) {
            console.log(json);
            setTimeout(function () {
                $('#modalCarregar').modal('hide');
            }, 500);
            if (json === 'erro') {
                setTimeout(function () {
                    $('#modalError').modal('show');
                }, 1000);
            } else {
                $('#form-edit-contact')[0].reset();
                $(".selectpicker").val('default');
                $(".selectpicker").selectpicker("refresh");
                $(".edit").slideUp('slow');
                setTimeout(function () {
                    $('#modalOK').modal('show');
                }, 1000);
//                $('#modalOK').modal('show');
//                carregaUsuarios();
                carregaContatos();
            }

        },

        error: function () {//executa se der erro em algum lugar
            $('#modalCarregar').modal('hide');
            setTimeout(function () {
                $('#modalError').modal('show');
            }, 1000);
        }
    });
});

$('#form-insert-company').bind('submit', function (e) {
    e.preventDefault();
    var txt = $(this).serialize();
    console.log(txt);
    $.ajax({
        type: 'POST',
        url: 'empresas/insere',
        data: txt,
//        dataType: 'json',
        beforeSend: function (x) {
            $('#modalCarregar').modal('show');
//            alteraModal();
        },
        success: function (json) {
            console.log(json);
            setTimeout(function () {
                $('#modalCarregar').modal('hide');
            }, 500);
            if (json === 'erro') {
                setTimeout(function () {
                    $('#modalError').modal('show');
                }, 1000);
            } else {
                $('#form-insert-company')[0].reset();
                $(".selectpicker").val('default');
                $(".selectpicker").selectpicker("refresh");
                setTimeout(function () {
                    $('#modalOK').modal('show');
                }, 1000);
                carregaEmpresas();
            }

        },

        error: function () {//executa se der erro em algum lugar
            $('#modalCarregar').modal('hide');
            setTimeout(function () {
                $('#modalError').modal('show');
            }, 1000);
        }
    });
});

function carregaEmpresas() {
    $.ajax({
        type: 'POST',
        url: 'empresas/buscaTabela',
        cache: false,
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (json) {
//            console.log(json);
            $('.divTabela').html(ver);
            if (json != 'vazio') {
                $('.tabela').find('tbody').html('');
                json.forEach(montaTabelaEmpresas);
            }
            $('.tabela').DataTable({
                "aaSorting": [[0, "asc"]],
                "oLanguage": {
                    "sLengthMenu": "Mostrando _MENU_ registros",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
                    "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros)",
                    "sSearch": "Pesquisar: ",
                    "oPaginate": {
                        "sFirst": "Início",
                        "sPrevious": "Anterior",
                        "sNext": "Próximo",
                        "sLast": "Último"
                    }
                }
            });
        },
        error: function (e) {//executa se der erro em algum lugar
            alert("Ocorreu um erro" + e);
        }
    });
}

function montaTabelaEmpresas(value, index, ar) {
    var cor = '';
    var tipo = '';
    if (value.contato == null) {
        tipo = ' ';
    } else {
        tipo = value.contato;
    }
//    var btnRelatorio = '<a class="btndeleta btn btn-primary btn-sm" href="http://192.168.0.126/crm/contatos/contato/'+value.id+'"  ><i class="fa fa-eye"></i></a>';
    var btnRelatorio = '<button class="btndeleta btn btn-primary btn-sm" onclick="mostraEmpresa(' + value.id + ');"  ><i class="fa fa-eye"></i></button>';
    var btnEdit = '<button class="btnedit btn btn-secondary btn-sm" onclick="editEmpresa(' + value.id + ');"  ><i class="fa fa-edit"></i></button>';
//    var btnEdit = '<button class="btnedit btn btn-secondary btn-sm" onclick="edit(' + value.id + ', "\ '+value.nome+' "\, "", "", "", "", "", "", "", "", "", "", "", "", "");"  ><i class="fa fa-edit"></i></button>';
    $('.tabela').find('tbody').append(
            '<tr><td ' + cor + ' >' + value.nome + '</td><td ' + cor + '>' + value.telefone1 + '</td><td ' + cor + '>' + value.email + '</td><td ' + cor + '>' + tipo + '</td><td ' + cor + '>' + btnRelatorio + ' ' + btnEdit + ' </td></tr>'
            );
}

function carregaEmpresasSelect() {
    var passar = 'empresas=' + 1;
    $.ajax({
        type: 'POST',
        url: 'empresas/buscaTabela',
        data: passar,
        cache: false,
        dataType: 'json',
        success: function (json) {
//            console.log(json);
            if (json != 'vazio') {
                json.forEach(montaSelectEmpresas);
            }
        },
        error: function (e) {//executa se der erro em algum lugar
//            alert("Ocorreu um erro" + e);
        }
    });
}
function montaSelectEmpresas(value, index, ar) {
//    console.log("teste");
//    console.log(value.ramal);
    var options = [];
    var src = [
        {id: value.id, txt: value.nome}
    ];
    src.forEach(function (item) {
        var option = '<option value=' + item.id + '>' + item.txt + "</option>";
        options.push(option);
    });
//    $('#opcRamal').html(options); neste caso apaga tudo e reinicia a classe selectpicker
    $('#empresa').append(options);
    $('#empresa').selectpicker('refresh');
    $('#empresaEdit').append(options);
    $('#empresaEdit').selectpicker('refresh');

}
function carregaNegociosSelect() {
    var passar = 'empresas=' + 1;
    $.ajax({
        type: 'POST',
        url: 'negocios/buscaTabela',
        data: passar,
        cache: false,
        dataType: 'json',
        success: function (json) {
//            console.log(json);
            if (json != 'vazio') {
                json.forEach(montaSelectNegocios);
            }
        },
        error: function (e) {//executa se der erro em algum lugar
//            alert("Ocorreu um erro" + e);
        }
    });
}
function montaSelectNegocios(value, index, ar) {
//    console.log("teste");
//    console.log(value.ramal);
    var options = [];
    var src = [
        {id: value.id, txt: value.nome}
    ];
    src.forEach(function (item) {
        var option = '<option value=' + item.id + '>' + item.txt + "</option>";
        options.push(option);
    });
//    $('#opcRamal').html(options); neste caso apaga tudo e reinicia a classe selectpicker
    $('#negocio').append(options);
    $('#negocio').selectpicker('refresh');
    $('#negocioEdit').append(options);
    $('#negocioEdit').selectpicker('refresh');

}
function carregaContatosSelect() {
    var passar = 'empresas=' + 1;
    $.ajax({
        type: 'POST',
        url: 'contatos/buscaTabela',
        data: passar,
        cache: false,
        dataType: 'json',
        success: function (json) {
//            console.log(json);
            if (json != 'vazio') {
                json.forEach(montaSelectContatos);
            }
        },
        error: function (e) {//executa se der erro em algum lugar
//            alert("Ocorreu um erro" + e);
        }
    });
}
function montaSelectContatos(value, index, ar) {
//    console.log("teste");
//    console.log(value.ramal);
    var options = [];
    var src = [
        {id: value.id, txt: value.nome}
    ];
    src.forEach(function (item) {
        var option = '<option value=' + item.id + '>' + item.txt + "</option>";
        options.push(option);
    });
//    $('#opcRamal').html(options); neste caso apaga tudo e reinicia a classe selectpicker
    $('#contato').append(options);
    $('#contato').selectpicker('refresh');
    $('#contatoEdit').append(options);
    $('#contatoEdit').selectpicker('refresh');

}

function editEmpresa(id) {
//    console.log(nome);
    if (id != '') {
        $.ajax({
            type: 'POST',
            url: 'http://192.168.1.61/crmFonetalk/empresas/empresaUnica/' + id,
//            url: 'http://192.168.0.126/crm/empresas/empresaUnica/' + id,
//                data: passar,
            cache: false,
            dataType: 'json',
            beforeSend: function (xhr) {
                $('.forms').slideUp('slow');
                $('#addUser').show('slow');
            },
            success: function (json) {
                console.log(json);
                if (json != 'erro') {
                    json.forEach(montaEditEmpresa);
                    $('.edit').slideDown('slow');
                    $('html, body').animate({
                        scrollTop: $('.edit').offset().top
                    }, 1000);
                }
            },
            error: function (e) {//executa se der erro em algum lugar
                alert("erro ao buscar" + e);
            }
        });
    }
    function montaEditEmpresa(value, index, ar) {
//        console.log(value.id);
        $('#id_empresa').val(value.id);
        $('#nomeEdit').val(value.nome);
        $('#contatoEdit').selectpicker('val', value.id_contato);
        $('#cargoEdit').val(value.cargo);
        $('#tipoCellEdit').selectpicker('val', value.tipotel1);
//    $('#tipoCellEdit').val(tipocell);//selectip
        $('#telefoneEdit').val(value.telefone1);
        if (value.telefone1 != '') {
            $('#telefoneEdit').removeAttr('disabled');
        }
        $('#tipoCell2Edit').selectpicker('val', value.tipotel2);
        $('#telefone2Edit').val(value.telefone2);
        if (value.telefone2 != '') {
            $('#telefone2Edit').removeAttr('disabled');
        }
        $('#tipoCell3Edit').selectpicker('val', value.tipotel3);
        $('#telefone3Edit').val(value.telefone3);
        if (value.telefone3 != '') {
            $('#telefone3Edit').removeAttr('disabled');
        }
        $('#emailEdit').val(value.email);
//        $('#origemEdit').selectpicker('val', value.origem);
        $('#cnpjEdit').val(value.cnpj);
//        $('#dataEdit').val(value.data_nascimento);
        $('#siteEdit').val(value.site);
        $('#enderecoEdit').val(value.endereco);
        $('#observacaoEdit').val(value.observacao);
    }
}

$('#form-edit-company').bind('submit', function (e) {
    e.preventDefault();
    var txt = $(this).serialize();
    console.log(txt);
    $.ajax({
        type: 'POST',
        url: 'empresas/edita',
        data: txt,
//        dataType: 'json',
        beforeSend: function (x) {
            $('#modalCarregar').modal('show');
//            alteraModal();
        },
        success: function (json) {
            console.log(json);
            setTimeout(function () {
                $('#modalCarregar').modal('hide');
            }, 500);
            if (json === 'erro') {
                setTimeout(function () {
                    $('#modalError').modal('show');
                }, 1000);
            } else {
                $('#form-edit-company')[0].reset();
                $(".selectpicker").val('default');
                $(".selectpicker").selectpicker("refresh");
                $(".edit").slideUp('slow');
                setTimeout(function () {
                    $('#modalOK').modal('show');
                }, 1000);
//                $('#modalOK').modal('show');
                carregaEmpresas();
            }

        },

        error: function () {//executa se der erro em algum lugar
            $('#modalCarregar').modal('hide');
            setTimeout(function () {
                $('#modalError').modal('show');
            }, 1000);
        }
    });
});

var modalEmpresa = $('#modalEmpresa').html();
function mostraEmpresa(id) {
    $('#modalEmpresa').html(modalEmpresa);
    $('#assunto').addClass('input-material');
    $('#tipoAtividade').addClass('selectpicker');
    $('#tipoAtividade').selectpicker('refresh');
    $('#tipoNegocios').addClass('selectpicker');
    $('#tipoNegocios').selectpicker('refresh');
    if (id != '' && id > 0) {
        var id_user = $("[name=id_user]").val();
        console.log(id_user);
        buscaNotas(id, id_user);
        buscaInfoEmpresa(id);
        buscaNegociosIdEmpresa(id);
        buscaArquivosEmpresas(id);
        $('#modalEmpresa').modal('show');
        $('#id_empresa_arquivo').val(id);
    }


    $('[name=id_empresa]').val('');
    $('[name=id_empresa]').val(id);

    $('#btnEnviarNota').on('click', function () {
        var nota = $('#nova_nota').val();
        var id_user = $("[name=id_user]").val();
        var id_client = $("[name=id_empresa]").val();
        console.log(id_client);
        if (nota != '' && id_user != '' && id_client != '') {
            var passar = 'id_user=' + id_user + '&nota=' + nota + '&id_client=' + id_client;
            $.ajax({
                type: 'POST',
                url: 'http://192.168.1.61/crmFonetalk/notas/insereEmpresa',
//                url: 'http://192.168.0.126/crm/notas/insereEmpresa',
                data: passar,
                cache: false,
                dataType: 'json',
                success: function (json) {
                    console.log(json);
                    if (json != 'erro') {
//                        $('#modalOK').modal('show');
                        $('#nova_nota').val('');
                        buscaNotas(id_client, id_user);
                    }
                },
                error: function (e) {//executa se der erro em algum lugar
                    alert("Ocorreu um erro" + e);
                }
            });
        }

    });

    function buscaNotas(id, id_user) {
        if (id_user != '') {
            $.ajax({
                type: 'POST',
                url: 'http://192.168.1.61/crmFonetalk/notas/buscaEmpresa/' + id_user + '/' + id,
//                url: 'http://192.168.0.126/crm/notas/buscaEmpresa/' + id_user + '/' + id,
//                data: passar,
                cache: false,
                dataType: 'json',
                success: function (json) {
                    $('#contNotas').html('0');
                    $('#writeNotes').html('');
                    console.log(json);
                    if (json != 'erro') {
                        json.forEach(montaNotas);
                    }
                },
                error: function (e) {//executa se der erro em algum lugar
                    alert("erro ao buscar" + e);
                }
            });
        }
    }

    function montaNotas(value, index, ar) {
        $('#contNotas').html(value.cont);
        var cabecalho = '<div class="card border border-info" ><h3 class="card-header">Nota</h3>';
        var corpo = '<div class="card-body"><h4 class="card-title">Inserida ás ' + value.data + '</h4>';
        var corpo2 = '<p class="card-text">' + value.nota + '</p> </div>';
        var rodape = '<div class="card-footer">por: ' + value.nome + '</div></div><hr/>';

        $('#writeNotes').append(cabecalho + '' + '' + corpo + '' + corpo2 + '' + rodape);
//        $('#writeNotes').html(cabecalho+''+''+corpo+''+corpo2+''+rodape);

    }

    function buscaNegociosIdEmpresa(id) {
        $.ajax({
            type: 'POST',
            url: 'http://192.168.1.61/crmFonetalk/negocios/buscaNomeEmpresaID/' + id,
            cache: false,
            dataType: 'json',
            success: function (json) {
                console.log(json);
                if (json != '') {
                    $('#writeBusiness').html('');
                    json.forEach(montaEscreveNegocio);
                }

            },
            error: function (e) {//executa se der erro em algum lugar
                alert("erro ao buscar" + e);
            }
        });
    }
    function montaEscreveNegocio(value, index, ar) {
        $('#writeBusiness').append(value.nome + '<br/>');
    }


    function buscaInfoEmpresa(id) {
        if (id != '') {
            $.ajax({
                type: 'POST',
                url: 'http://192.168.1.61/crmFonetalk/empresas/empresaUnica/' + id,
//                url: 'http://192.168.0.126/crm/empresas/empresaUnica/' + id,
//                data: passar,
                cache: false,
                dataType: 'json',
                success: function (json) {
//                    $('#contNotas').html('0');
//                     $('#writeNotes').html('');
                    console.log(json);
                    if (json != 'erro') {
                        json.forEach(montaDadosCliente);
                    }
                },
                error: function (e) {//executa se der erro em algum lugar
                    alert("erro ao buscar" + e);
                }
            });
        }
    }

    function montaDadosCliente(value, index, ar) {
        console.log(value.usuario);
        $('#nome_cliente').html(value.nome);
        $('#cargo_cliente').html(value.cargo_cliente);
        $('#mostraTelefonePrincipal').html(value.telefone1);
        $('#mostraTipoTelefonePrincipal').html(value.tipotel1);
        $('#mostraCNPJ').html(value.cnpj);
        $('#mostraEndereco').html(value.endereco);
        $('#mostraContatoEmpresa').html(value.contato);
//        $('#mostraContatoEmpresa').html(value.usuario);
//        $('#mostraOrigem').html(value.origem);
//        $('#mostraDataNascimento').html(value.data_nascimento);
        $('#dateCreate').html(value.data);
        $('#userCreate').html(value.usuario);
        $('#mostraEmpresa').html(value.empresa);
        $('#mostrarTipoTell2').html(value.tipotel2);
        $('#mostrarTell2').html(value.telefone2);
        $('#mostrarTipoTell3').html(value.tipotel3);
        $('#mostrarTell3').html(value.telefone3);
        $('#mostrarObs').html(value.observacao);
        $('#contEdit').html(value.contEdit);
    }

    $(function () {
        $('.form-insert-file-company').bind('submit', function (e) {
//        $('.form-insert-file-company').bind('submit', function (e) {
            e.preventDefault();

            var data;
            var contentType = "application/x-www-form-urlencoded";
            var processData = true;
            if ($(this).attr('enctype') == 'multipart/form-data') {
                data = new FormData($('.form-insert-file-company').get(0));//seleciona classe form-horizontal adicionada na tag form do html

                contentType = false;
                processData = false;
            } else {
                data = $(this).serialize();
            }
//        console.log(data);
            $.ajax({
                data: data,
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                contentType: contentType,
                processData: processData,
                beforeSend: function (xhr) {
                    $('#modalCarregar').modal('show');
                },
                success: function (json) {
                    console.log(json);
                    setTimeout(function () {
                        $('#modalCarregar').modal('hide');
                    }, 500);
//                    setTimeout(function () {
//                        $('#modalError').modal('show');
//                    }, 1000);
                    montaAlerta(json);
                    $('.form-insert-file-company')[0].reset();
                    buscaArquivosEmpresas(id);
                },
                error: function (exr, sender) {
                    alert('error');
                }
            });

        });

    });

    function montaAlerta(resposta) {
        console.log(resposta);
        $('.alert-file').removeClass('alert-danger').removeClass('alert-warning').removeClass('alert-success');
        if (resposta == "1") {
            $('.alert-file').addClass('alert-danger');
            $('.alert-file').html(' <strong>Erro!</strong> Sem Arquivo!.');
        } else if (resposta == '2') {
            $('.alert-file').addClass('alert-warning');
            $('.alert-file').html(' <strong>Alerta!</strong> Extensão não permitida ou arquivo acima de 4 MB!.');
        } else if (resposta == '3') {
            $('.alert-file').addClass('alert-danger');
            $('.alert-file').html(' <strong>Falha!</strong> Erro ao mover o arquivo!.');
        } else {
            $('.alert-file').addClass('alert-success');
            $('.alert-file').html(' <strong>Successo!</strong> Arquivo inserido no sistema!.');
        }
        $('.alert-file').slideDown('slow');
    }


    function buscaArquivosEmpresas(id) {
        if (id != '') {
            $.ajax({
                type: 'POST',
                url: 'http://192.168.1.61/crmFonetalk/arquivos/busca/' + id + '/empresas',
//                url: 'http://192.168.0.126/crm/contatos/contatoUnico/' + id,
//                data: passar,
                cache: false,
                dataType: 'json',
                success: function (json) {
//                    $('#contNotas').html('0');
//                     $('#writeNotes').html('');
                    console.log(json);
                    if (json != 'erro') {
                        $('#mostraArquivos').html('');
                        json.forEach(montaDadosArquivos);
                    }
                },
                error: function (e) {//executa se der erro em algum lugar
                    alert("erro ao buscar" + e);
                }
            });
        }
    }

    function montaDadosArquivos(value, index, ar) {
        $('#mostraArquivos').append('<a href="http://192.168.1.61/crmFonetalk/' + value.caminho + '">' + value.nome + '</a>');

    }

}



$('#form-insert-business').bind('submit', function (e) {
    e.preventDefault();
    var txt = $(this).serialize();
    console.log(txt);
    $.ajax({
        type: 'POST',
        url: 'negocios/insere',
        data: txt,
//        dataType: 'json',
        beforeSend: function (x) {
            $('#modalCarregar').modal('show');
//            alteraModal();
        },
        success: function (json) {
            console.log(json);
            setTimeout(function () {
                $('#modalCarregar').modal('hide');
            }, 500);
            if (json === 'erro') {
                setTimeout(function () {
                    $('#modalError').modal('show');
                }, 1000);
            } else {
                $('#form-insert-business')[0].reset();
                $(".selectpicker").val('default');
                $(".selectpicker").selectpicker("refresh");
                setTimeout(function () {
                    $('#modalOK').modal('show');
                }, 1000);
                carregaNegocios();
            }

        },

        error: function () {//executa se der erro em algum lugar
            $('#modalCarregar').modal('hide');
            setTimeout(function () {
                $('#modalError').modal('show');
            }, 1000);
        }
    });
});


function carregaNegocios() {
    $.ajax({
        type: 'POST',
        url: 'negocios/buscaTabela',
        cache: false,
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (json) {
//            console.log(json);
            $('.divTabela').html(ver);
            if (json != 'vazio') {
                $('.tabela').find('tbody').html('');
                json.forEach(montaTabelaNegocios);
            }
            $('.tabela').DataTable({
                "aaSorting": [[0, "asc"]],
                "oLanguage": {
                    "sLengthMenu": "Mostrando _MENU_ registros",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
                    "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros)",
                    "sSearch": "Pesquisar: ",
                    "oPaginate": {
                        "sFirst": "Início",
                        "sPrevious": "Anterior",
                        "sNext": "Próximo",
                        "sLast": "Último"
                    }
                }
            });
        },
        error: function (e) {//executa se der erro em algum lugar
            alert("Ocorreu um erro" + e);
        }
    });
}

function montaTabelaNegocios(value, index, ar) {
    var cor = '';
    var contato = '';
    var empresa = '';
    var usuario = '';
    if (value.status == 'Aberto') {
        cor = 'class="table-primary"';
    } else if (value.status == 'Ganhou') {
        cor = 'class="table-success"';
    } else if (value.status == 'Perdido') {
        cor = 'class="table-danger"';
    }
    if (value.contato == null) {
        contato = ' ';
    } else {
        contato = value.contato;
    }
    if (value.empresa == null) {
        empresa = ' ';
    } else {
        empresa = value.empresa;
    }
    if (value.usuario == null) {
        usuario = ' ';
    } else {
        usuario = value.usuario;
    }
//    var btnRelatorio = '<a class="btndeleta btn btn-primary btn-sm" href="http://192.168.0.126/crm/contatos/contato/'+value.id+'"  ><i class="fa fa-eye"></i></a>';
    var btnRelatorio = '<button class="btndeleta btn btn-primary btn-sm" onclick="mostraNegocios(' + value.id + ');"  ><i class="fa fa-eye"></i></button>';
    var btnEdit = '<button class="btnedit btn btn-secondary btn-sm" onclick="editNegocios(' + value.id + ');"  ><i class="fa fa-edit"></i></button>';
//    var btnEdit = '<button class="btnedit btn btn-secondary btn-sm" onclick="edit(' + value.id + ', "\ '+value.nome+' "\, "", "", "", "", "", "", "", "", "", "", "", "", "");"  ><i class="fa fa-edit"></i></button>';
    $('.tabela').find('tbody').append(
            '<tr><td ' + cor + ' >' + value.nome + '</td><td ' + cor + '>' + value.valor + '</td><td ' + cor + '>' + empresa + '</td><td ' + cor + '>' + contato + '</td><td ' + cor + '>' + usuario + '</td><td ' + cor + '>' + btnRelatorio + ' ' + btnEdit + ' </td></tr>'
            );
}

var modalNegocios = $('#modalNegocios').html();
function mostraNegocios(id) {
    $('#modalNegocios').html(modalNegocios);
    $('#assunto').addClass('input-material');
    $('#tipoAtividade').addClass('selectpicker');
    $('#tipoAtividade').selectpicker('refresh');
    $('#tipoNegocios').addClass('selectpicker');
    $('#tipoNegocios').selectpicker('refresh');
    if (id != '' && id > 0) {
        var id_user = $("[name=id_user]").val();
        console.log(id_user);
        BuscaHistNegocios(id, id_user);
        buscaNegocio(id);
        buscaArquivosNegocios(id);
        $('#id_negocio_arquivo').val(id);
        $('#modalNegocios').modal('show');
    }


    $('[name=id_empresa]').val('');
    $('[name=id_empresa]').val(id);

    $('#btnEnviarNota').on('click', function () {
        var nota = $('#nova_nota').val();
        var id_user = $("[name=id_user]").val();
        var id_client = $("[name=id_empresa]").val();
        console.log(id_client);
        if (nota != '' && id_user != '' && id_client != '') {
            var passar = 'id_user=' + id_user + '&nota=' + nota + '&id_client=' + id_client;
            $.ajax({
                type: 'POST',
                url: 'http://192.168.1.61/crmFonetalk/notas/insereEmpresa',
//                url: 'http://192.168.0.126/crm/notas/insereEmpresa',
                data: passar,
                cache: false,
                dataType: 'json',
                success: function (json) {
                    console.log(json);
                    if (json != 'erro') {
//                        $('#modalOK').modal('show');
                        $('#nova_nota').val('');
                        buscaNotas(id_client, id_user);
                    }
                },
                error: function (e) {//executa se der erro em algum lugar
                    alert("Ocorreu um erro" + e);
                }
            });
        }

    });

    function BuscaHistNegocios(id) {
        if (id_user != '') {
            $.ajax({
                type: 'POST',
                url: 'http://192.168.1.61/crmFonetalk/negocios/buscaNegocioHistorico/' + id,
//                url: 'http://192.168.0.126/crm/notas/buscaEmpresa/' + id_user + '/' + id,
//                data: passar,
                cache: false,
                dataType: 'json',
                success: function (json) {
                    $('#contNotas').html('0');
                    $('#writeNotes').html('');
                    console.log(json);
                    if (json != 'erro') {
                        json.forEach(montaHistorico);
                    }
                },
                error: function (e) {//executa se der erro em algum lugar
                    alert("erro ao buscar" + e);
                }
            });
        }
    }

    function montaHistorico(value, index, ar) {
        console.log(value.situacao);
        if (value.situacao == 'create') {
            $('#dateCreate').html(value.data);
            $('#userCreate').html(value.usuario);
            $('#valorCreate').html(value.valor);
            $('#faseCreate').html(value.fase);
            $('#statusCreate').html(value.status);
        } else {
            console.log('chegou aqui');
            var classe = '';
            if (value.status == 'Aberto') {
                classe = 'info';
            } else if (value.status == 'Ganhou') {
                classe = 'success';
            } else if (value.status == 'Perdido') {
                classe = 'danger';
            }
            var texto = 'Previsão :' + value.previsao + '<br/>\n\
            Fase: ' + value.fase + '<br/> Valor: ' + value.valor;
            var cabecalho = '<div class="card border border-' + classe + ' alert alert-' + classe + '" ><h3 class="card-header alert alert-' + classe + '">Négocio ' + value.nome + '</h3>';
            var corpo = '<div class="card-body"><h4 class="card-title">Editado ás ' + value.data + '</h4>';
            var corpo2 = '<p class="card-text">' + texto + '</p> </div>';
            var rodape = '<div class="card-footer">por: ' + value.usuario + '</div></div><hr/>';

            $('#writeNotes').append(cabecalho + '' + '' + corpo + '' + corpo2 + '' + rodape);
        }
//        $('#writeNotes').html(cabecalho+''+''+corpo+''+corpo2+''+rodape);

    }

    function buscaNegocio(id) {
        if (id != '') {
            $.ajax({
                type: 'POST',
                url: 'http://192.168.1.61/crmFonetalk/negocios/buscaNegocio/' + id,
//                url: 'http://192.168.0.126/crm/empresas/empresaUnica/' + id,
//                data: passar,
                cache: false,
                dataType: 'json',
                success: function (json) {
//                    $('#contNotas').html('0');
//                     $('#writeNotes').html('');
                    console.log(json);
                    if (json != 'erro') {
                        json.forEach(montaDadosNegocios);
                    }
                },
                error: function (e) {//executa se der erro em algum lugar
                    alert("erro ao buscar" + e);
                }
            });
        }
    }

    function montaDadosNegocios(value, index, ar) {
        $('#nome_negocio').html(value.nome);
        $('#mostraValor').html(value.valor);
        $('#mostraFase').html(value.fase);
        $('#mostraPrevisao').html(value.previsao);
        $('#mostraStatus').html(value.status);
        $('#mostraEmpresa').html(value.empresa);
        $('#mostraContato').html(value.contato);
//        $('#mostraOrigem').html(value.origem);
//        $('#mostraDataNascimento').html(value.data_nascimento);
//        $('#dateCreate').html(value.data);
//        $('#userCreate').html(value.user);
//        $('#mostraEmpresa').html(value.empresa);
//        $('#mostrarTipoTell2').html(value.tipotel2);
//        $('#mostrarTell2').html(value.telefone2);
//        $('#mostrarTipoTell3').html(value.tipotel3);
//        $('#mostrarTell3').html(value.telefone3);
//        $('#mostrarObs').html(value.observacao);
//        $('#contEdit').html(value.contEdit);
    }

    $(function () {
        $('.form-insert-file-business').bind('submit', function (e) {
//        $('.form-insert-file-company').bind('submit', function (e) {
            e.preventDefault();

            var data;
            var contentType = "application/x-www-form-urlencoded";
            var processData = true;
            if ($(this).attr('enctype') == 'multipart/form-data') {
                data = new FormData($('.form-insert-file-business').get(0));//seleciona classe form-horizontal adicionada na tag form do html

                contentType = false;
                processData = false;
            } else {
                data = $(this).serialize();
            }
//        console.log(data);
            $.ajax({
                data: data,
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                contentType: contentType,
                processData: processData,
                beforeSend: function (xhr) {
                    $('#modalCarregar').modal('show');
                },
                success: function (json) {
                    console.log(json);
                    setTimeout(function () {
                        $('#modalCarregar').modal('hide');
                    }, 500);
//                    setTimeout(function () {
//                        $('#modalError').modal('show');
//                    }, 1000);
                    montaAlerta(json);
                    $('.form-insert-file-business')[0].reset();
                    buscaArquivosNegocios(id);
                },
                error: function (exr, sender) {
                    alert('error');
                }
            });

        });

    });

    function montaAlerta(resposta) {
        console.log(resposta);
        $('.alert-file').removeClass('alert-danger').removeClass('alert-warning').removeClass('alert-success');
        if (resposta == "1") {
            $('.alert-file').addClass('alert-danger');
            $('.alert-file').html(' <strong>Erro!</strong> Sem Arquivo!.');
        } else if (resposta == '2') {
            $('.alert-file').addClass('alert-warning');
            $('.alert-file').html(' <strong>Alerta!</strong> Extensão não permitida ou arquivo acima de 4 MB!.');
        } else if (resposta == '3') {
            $('.alert-file').addClass('alert-danger');
            $('.alert-file').html(' <strong>Falha!</strong> Erro ao mover o arquivo!.');
        } else {
            $('.alert-file').addClass('alert-success');
            $('.alert-file').html(' <strong>Successo!</strong> Arquivo inserido no sistema!.');
        }
        $('.alert-file').slideDown('slow');
    }

}
function buscaArquivosNegocios(id) {
    if (id != '') {
        $.ajax({
            type: 'POST',
            url: 'http://192.168.1.61/crmFonetalk/arquivos/busca/' + id + '/negocios',
//                url: 'http://192.168.0.126/crm/contatos/contatoUnico/' + id,
//                data: passar,
            cache: false,
            dataType: 'json',
            success: function (json) {
//                    $('#contNotas').html('0');
//                     $('#writeNotes').html('');
                console.log(json);
                if (json != 'erro') {
                    $('#mostraArquivos').html('');
                    json.forEach(montaDadosArquivos);
                }
            },
            error: function (e) {//executa se der erro em algum lugar
                alert("erro ao buscar" + e);
            }
        });
    }
}
function montaDadosArquivos(value, index, ar) {
    $('#mostraArquivos').append('<a href="http://192.168.1.61/crmFonetalk/' + value.caminho + '" download>' + value.nome + '</a>');

}
function editNegocios(id) {
//    console.log(nome);
    if (id != '') {
        $.ajax({
            type: 'POST',
            url: 'http://192.168.1.61/crmFonetalk/negocios/negocioUnico/' + id,
//            url: 'http://192.168.0.126/crm/empresasempresaUnica/' + id,
//                data: passar,
            cache: false,
            dataType: 'json',
            beforeSend: function (xhr) {
                $('.forms').slideUp('slow');
                $('#addUser').show('slow');
            },
            success: function (json) {
                console.log(json);
                if (json != 'erro') {
                    json.forEach(montaEditNegocio);
                    $('.edit').slideDown('slow');
                    $('html, body').animate({
                        scrollTop: $('.edit').offset().top
                    }, 1000);
                }
            },
            error: function (e) {//executa se der erro em algum lugar
                alert("erro ao buscar" + e);
            }
        });
    }
    function montaEditNegocio(value, index, ar) {
//        console.log(value.id);
        $('#id_negocio').val(value.id);
        $('#nomeEdit').val(value.nome);
        $('#contatoEdit').selectpicker('val', value.id_contato);
        $('#empresaEdit').selectpicker('val', value.id_empresa);
        $('#faseEdit').selectpicker('val', value.fase);
        $('#statusEdit').selectpicker('val', value.status);
        $('#valorEdit').val(value.valor);
        $('#dataPrevisaoEdit').val(value.previsao);

    }
}

$('#form-edit-business').bind('submit', function (e) {
    e.preventDefault();
    var txt = $(this).serialize();
    console.log(txt);
    $.ajax({
        type: 'POST',
        url: 'negocios/edita',
        data: txt,
//        dataType: 'json',
        beforeSend: function (x) {
            $('#modalCarregar').modal('show');
//            alteraModal();
        },
        success: function (json) {
            console.log(json);
            setTimeout(function () {
                $('#modalCarregar').modal('hide');
            }, 500);
            if (json === 'erro') {
                setTimeout(function () {
                    $('#modalError').modal('show');
                }, 1000);
            } else {
                $('#form-edit-business')[0].reset();
                $(".selectpicker").val('default');
                $(".selectpicker").selectpicker("refresh");
                $(".edit").slideUp('slow');
                setTimeout(function () {
                    $('#modalOK').modal('show');
                }, 1000);
//                $('#modalOK').modal('show');
//                carregaUsuarios();
                carregaNegocios();
            }

        },

        error: function () {//executa se der erro em algum lugar
            $('#modalCarregar').modal('hide');
            setTimeout(function () {
                $('#modalError').modal('show');
            }, 1000);
        }
    });
});

function carregaAtividades() {
    $.ajax({
        type: 'POST',
        url: 'atividades/buscaTabela',
        cache: false,
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (json) {
//            console.log(json);
            $('.divTabela').html(ver);
            if (json != 'vazio') {
                $('.tabela').find('tbody').html('');
                json.forEach(montaTabelaAtividades);
            }
            $('.tabela').DataTable({
                "aaSorting": [[0, "asc"]],
                "oLanguage": {
                    "sLengthMenu": "Mostrando _MENU_ registros",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
                    "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros)",
                    "sSearch": "Pesquisar: ",
                    "oPaginate": {
                        "sFirst": "Início",
                        "sPrevious": "Anterior",
                        "sNext": "Próximo",
                        "sLast": "Último"
                    }
                }
            });
        },
        error: function (e) {//executa se der erro em algum lugar
            alert("Ocorreu um erro" + e);
        }
    });
}

function montaTabelaAtividades(value, index, ar) {
    var cor = '';
    var disabled = '';
    if (value.acao == 3) {
        disabled = 'disabled';
    }

//    var btnRelatorio = '<a class="btndeleta btn btn-primary btn-sm" href="http://192.168.0.126/crm/contatos/contato/'+value.id+'"  ><i class="fa fa-eye"></i></a>';
    var btnRelatorio = '<button class="btnVer btn btn-primary btn-sm" data-toggle="tooltip"  data-placement="left" title="Abrir Formulário" onclick="mostraAtividade(' + value.id + ');"  ><i class="fa fa-eye"></i></button>';
    var btnEdit = '<button class="btnedit btn btn-secondary btn-sm" ' + disabled + ' onclick="editAtividades(' + value.id + ');"  ><i class="fa fa-edit"></i></button>';
    var btnFeito;
    if (value.acao == 1) {
        btnFeito = '<button class="btnedit btn btn-danger btn-sm" onclick="feito(' + value.id + ', ' + 3 + ');"  ><i class="fa fa-square-o"></i></button>';
    } else if (value.acao == 2) {
        btnFeito = '<button class="btnedit btn btn-warning btn-sm" onclick="feito(' + value.id + ', ' + 3 + ');"  ><i class="fa fa-check"></i></button>';
    } else {
        btnFeito = '<button class="btnedit btn btn-success btn-sm" onclick="feito(' + value.id + ', ' + 3 + ');"  ><i class="fa fa-check-square-o"></i></button>';
    }

//    var btnEdit = '<button class="btnedit btn btn-secondary btn-sm" onclick="edit(' + value.id + ', "\ '+value.nome+' "\, "", "", "", "", "", "", "", "", "", "", "", "", "");"  ><i class="fa fa-edit"></i></button>';
    $('.tabela').find('tbody').append(
            '<tr><td ' + cor + ' >' + value.tipo + '</td><td ' + cor + '>' + value.assunto + '</td><td ' + cor + '>' + value.data_agendamento + '</td><td ' + cor + '>' + value.hora + '</td><td ' + cor + '>' + btnRelatorio + ' ' + btnEdit + ' ' + btnFeito + ' </td></tr>'
            );
}

function feito(id, valor) {
    console.log(valor);
    var passar = 'id=' + id + '&valor=' + valor;
    $.ajax({
        type: 'POST',
        url: 'atividades/feito',
        data: passar,
        cache: false,
        dataType: 'json',
        success: function (json) {
            console.log(json);
            carregaAtividades();
            $('#modalAgenda').modal('hide');

        }
    });
}
var modalAtividades = $('#modalAtividades').html();
function mostraAtividade(id) {
//    alert(id);
//   
    $('#modalAtividades').html(modalAtividades);
//    $('#assunto').addClass('input-material');
//    $('#tipoAtividade').addClass('selectpicker');
//    $('#tipoAtividade').selectpicker('refresh');
//    $('#tipoNegocios').addClass('selectpicker');
//    $('#tipoNegocios').selectpicker('refresh');
    if (id != '' && id > 0) {
//        $('#modalAtividades').find('button').prop('onclick', 'deletaAtividade(' + id + ')');
        $('.btnDelAtividade').attr('onclick', 'deletaAtividade(' + id + ')');
//        $('.btnDelAtividade').removeClass('btn-outline-danger');
        var id_user = $("[name=id_user]").val();
        console.log(id_user);
//        buscaNotas(id, id_user);
        buscaInfoAtividade(id);
//        buscaNegociosIdEmpresa(id);
//        buscaArquivosEmpresas(id);
        $('#modalAtividades').modal('show');
        $('#id_empresa_arquivo').val(id);
    }


    $('[name=id_empresa]').val('');
    $('[name=id_empresa]').val(id);

    $('#btnEnviarNota').on('click', function () {
        var nota = $('#nova_nota').val();
        var id_user = $("[name=id_user]").val();
        var id_client = $("[name=id_empresa]").val();
        console.log(id_client);
        if (nota != '' && id_user != '' && id_client != '') {
            var passar = 'id_user=' + id_user + '&nota=' + nota + '&id_client=' + id_client;
            $.ajax({
                type: 'POST',
                url: 'http://192.168.1.61/crmFonetalk/notas/insereEmpresa',
//                url: 'http://192.168.0.126/crm/notas/insereEmpresa',
                data: passar,
                cache: false,
                dataType: 'json',
                success: function (json) {
                    console.log(json);
                    if (json != 'erro') {
//                        $('#modalOK').modal('show');
                        $('#nova_nota').val('');
                        buscaNotas(id_client, id_user);
                    }
                },
                error: function (e) {//executa se der erro em algum lugar
                    alert("Ocorreu um erro" + e);
                }
            });
        }

    });

    function buscaNotas(id, id_user) {
        if (id_user != '') {
            $.ajax({
                type: 'POST',
                url: 'http://192.168.1.61/crmFonetalk/notas/buscaEmpresa/' + id_user + '/' + id,
//                url: 'http://192.168.0.126/crm/notas/buscaEmpresa/' + id_user + '/' + id,
//                data: passar,
                cache: false,
                dataType: 'json',
                success: function (json) {
                    $('#contNotas').html('0');
                    $('#writeNotes').html('');
                    console.log(json);
                    if (json != 'erro') {
                        json.forEach(montaNotas);
                    }
                },
                error: function (e) {//executa se der erro em algum lugar
                    alert("erro ao buscar" + e);
                }
            });
        }
    }

    function montaNotas(value, index, ar) {
        $('#contNotas').html(value.cont);
        var cabecalho = '<div class="card border border-info" ><h3 class="card-header">Nota</h3>';
        var corpo = '<div class="card-body"><h4 class="card-title">Inserida ás ' + value.data + '</h4>';
        var corpo2 = '<p class="card-text">' + value.nota + '</p> </div>';
        var rodape = '<div class="card-footer">por: ' + value.nome + '</div></div><hr/>';

        $('#writeNotes').append(cabecalho + '' + '' + corpo + '' + corpo2 + '' + rodape);
//        $('#writeNotes').html(cabecalho+''+''+corpo+''+corpo2+''+rodape);

    }

    function buscaInfoAtividade(id) {
        $.ajax({
            type: 'POST',
            url: 'http://192.168.1.61/crmFonetalk/atividades/atividadeUnico/' + id,
            cache: false,
            dataType: 'json',
            success: function (json) {
                console.log(json);
                if (json != '') {
                    $('#writeBusiness').html('');
                    json.forEach(montaEscreveAtividade);
                }

            },
            error: function (e) {//executa se der erro em algum lugar
                alert("erro ao buscar" + e);
            }
        });
    }
    function montaEscreveAtividade(value, index, ar) {
//        $('#writeBusiness').append(value.nome + '<br/>');

        if (value.acao == 1) {
            $('.cardAtividade').addClass('border-danger bg-danger');

        } else {
//            $('#btnAcaoAtividade').removeClass('btn-outline-danger').addClass('btn-outline-success').text('Realizada');
            $('.cardAtividade').addClass('border-success bg-success');
        }
        console.log(value.data_agendamento);
        $('#mostraTipo').html(value.tipo);
        $('#mostraAssunto').html(value.assunto);
        $('#mostraNegocio').html(value.negocio);
        $('#mostraEmpresa').html(value.empresa);
        $('#mostraContato').html(value.contato);
        $('#mostraObservacao').html(value.observacao);
        $('#dateCreate').html(value.data);
        $('#dataAtividadeAgendamento').html(value.data_agendamento);
        $('#horaAtividadeAgendamento').html(value.hora);
        $('#userCreate').html(value.usuario);

    }




    $(function () {
        $('.form-insert-file-company').bind('submit', function (e) {
//        $('.form-insert-file-company').bind('submit', function (e) {
            e.preventDefault();

            var data;
            var contentType = "application/x-www-form-urlencoded";
            var processData = true;
            if ($(this).attr('enctype') == 'multipart/form-data') {
                data = new FormData($('.form-insert-file-company').get(0));//seleciona classe form-horizontal adicionada na tag form do html

                contentType = false;
                processData = false;
            } else {
                data = $(this).serialize();
            }
//        console.log(data);
            $.ajax({
                data: data,
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                contentType: contentType,
                processData: processData,
                beforeSend: function (xhr) {
                    $('#modalCarregar').modal('show');
                },
                success: function (json) {
                    console.log(json);
                    setTimeout(function () {
                        $('#modalCarregar').modal('hide');
                    }, 500);
//                    setTimeout(function () {
//                        $('#modalError').modal('show');
//                    }, 1000);
                    montaAlerta(json);
                    $('.form-insert-file-company')[0].reset();
                    buscaArquivosEmpresas(id);
                },
                error: function (exr, sender) {
                    alert('error');
                }
            });

        });

    });

    function montaAlerta(resposta) {
        console.log(resposta);
        $('.alert-file').removeClass('alert-danger').removeClass('alert-warning').removeClass('alert-success');
        if (resposta == "1") {
            $('.alert-file').addClass('alert-danger');
            $('.alert-file').html(' <strong>Erro!</strong> Sem Arquivo!.');
        } else if (resposta == '2') {
            $('.alert-file').addClass('alert-warning');
            $('.alert-file').html(' <strong>Alerta!</strong> Extensão não permitida ou arquivo acima de 4 MB!.');
        } else if (resposta == '3') {
            $('.alert-file').addClass('alert-danger');
            $('.alert-file').html(' <strong>Falha!</strong> Erro ao mover o arquivo!.');
        } else {
            $('.alert-file').addClass('alert-success');
            $('.alert-file').html(' <strong>Successo!</strong> Arquivo inserido no sistema!.');
        }
        $('.alert-file').slideDown('slow');
    }


    function buscaArquivosEmpresas(id) {
        if (id != '') {
            $.ajax({
                type: 'POST',
                url: 'http://192.168.1.61/crmFonetalk/arquivos/busca/' + id + '/empresas',
//                url: 'http://192.168.0.126/crm/contatos/contatoUnico/' + id,
//                data: passar,
                cache: false,
                dataType: 'json',
                success: function (json) {
//                    $('#contNotas').html('0');
//                     $('#writeNotes').html('');
                    console.log(json);
                    if (json != 'erro') {
                        $('#mostraArquivos').html('');
                        json.forEach(montaDadosArquivos);
                    }
                },
                error: function (e) {//executa se der erro em algum lugar
                    alert("erro ao buscar" + e);
                }
            });
        }
    }

    function montaDadosArquivos(value, index, ar) {
        $('#mostraArquivos').append('<a href="http://192.168.1.61/crmFonetalk/' + value.caminho + '">' + value.nome + '</a>');

    }

}

$('#form-insert-activity').bind('submit', function (e) {
    e.preventDefault();
    var txt = $(this).serialize();
    console.log(txt);
    $.ajax({
        type: 'POST',
        url: 'atividades/insere',
        data: txt,
//        dataType: 'json',
        beforeSend: function (x) {
            $('#modalCarregar').modal('show');
//            alteraModal();
        },
        success: function (json) {
            console.log(json);
            setTimeout(function () {
                $('#modalCarregar').modal('hide');
            }, 500);
            if (json === 'erro') {
                setTimeout(function () {
                    $('#modalError').modal('show');
                }, 1000);
            } else {
                $('#form-insert-activity')[0].reset();
                $(".selectpicker").val('default');
                $(".selectpicker").selectpicker("refresh");
                $(".form").slideUp('slow');
                setTimeout(function () {
                    $('#modalOK').modal('show');
                }, 1000);
//                $('#modalOK').modal('show');
//                carregaUsuarios();
                carregaAtividades();
            }

        },

        error: function () {//executa se der erro em algum lugar
            $('#modalCarregar').modal('hide');
            setTimeout(function () {
                $('#modalError').modal('show');
            }, 1000);
        }
    });
});

function editAtividades(id) {
//    console.log(nome);
    if (id != '') {
        $.ajax({
            type: 'POST',
            url: 'http://192.168.1.61/crmFonetalk/atividades/atividadeUnico/' + id,
//            url: 'http://192.168.0.126/crm/empresasempresaUnica/' + id,
//                data: passar,
            cache: false,
            dataType: 'json',
            beforeSend: function (xhr) {
                $('.forms').slideUp('slow');
                $('#addUser').show('slow');
            },
            success: function (json) {
                console.log(json);
                if (json != 'erro') {
                    json.forEach(montaEditAtividade);
                    $('.edit').slideDown('slow');
                    $('html, body').animate({
                        scrollTop: $('.edit').offset().top
                    }, 1000);
                }
            },
            error: function (e) {//executa se der erro em algum lugar
                alert("erro ao buscar" + e);
            }
        });
    }
    function montaEditAtividade(value, index, ar) {
//        console.log(value.id);
        $('#id_atividade').val(value.id);
        $('#assuntoEdit').val(value.assunto);
        $('#dataAgendamentoEdit').val(value.data_agendamento);
        $('#horaEdit').val(value.hora);
        $('#contatoEdit').selectpicker('val', value.id_contato);
        $('#negocioEdit').selectpicker('val', value.id_negocio);
        $('#empresaEdit').selectpicker('val', value.id_empresa);
        $('#tipoEdit').selectpicker('val', value.tipo);
        $('#observacaoEdit').val(value.observacao);

    }
}

$('#form-edit-activity').bind('submit', function (e) {
    e.preventDefault();
    var txt = $(this).serialize();
    console.log(txt);
    $.ajax({
        type: 'POST',
        url: 'atividades/edita',
        data: txt,
//        dataType: 'json',
        beforeSend: function (x) {
            $('#modalCarregar').modal('show');
//            alteraModal();
        },
        success: function (json) {
            console.log(json);
            setTimeout(function () {
                $('#modalCarregar').modal('hide');
            }, 500);
            if (json === 'erro') {
                setTimeout(function () {
                    $('#modalError').modal('show');
                }, 1000);
            } else {
                $('#form-edit-activity')[0].reset();
                $(".selectpicker").val('default');
                $(".selectpicker").selectpicker("refresh");
                $(".edit").slideUp('slow');
                setTimeout(function () {
                    $('#modalOK').modal('show');
                }, 1000);
//                $('#modalOK').modal('show');
//                carregaUsuarios();
                carregaAtividades();
            }

        },

        error: function () {//executa se der erro em algum lugar
            $('#modalCarregar').modal('hide');
            setTimeout(function () {
                $('#modalError').modal('show');
            }, 1000);
        }
    });
});

function deletaAtividade(id) {
    $.ajax({
        type: 'POST',
        url: 'http://192.168.1.61/crmFonetalk/atividades/deleta/' + id,
        cache: false,
        dataType: 'json',
        success: function (json) {
            console.log(json);
            $('#modalAtividades').modal('hide');
            carregaAtividades();
        },
        error: function (e) {//executa se der erro em algum lugar
            alert("erro ao deletar" + e);
        }
    });
}

function graficoHome() {
     'use strict';

    
    var legendState = true;
    if ($(window).outerWidth() < 576) {
        legendState = false;
    }

    var LINECHART = $('#lineCahrt');
    var myLineChart = new Chart(LINECHART, {
        type: 'line',
        options: {
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    }
                }]
            },
            legend: {
                display: legendState
            }
        },
        data: {
            labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
            datasets: [
                {
                    label: "Perdido",
                    fill: true,
                    lineTension: 0,
                    backgroundColor: "transparent",
                    borderColor: '#f15765',
                    pointBorderColor: '#da4c59',
                    pointHoverBackgroundColor: '#da4c59',
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    borderWidth: 1,
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 0,
                    data: [50, 20, 60, 31, 52, 22, 40, 25, 30, 68, 56, 40],
                    spanGaps: false
                },
                {
                    label: "Ganho",
                    fill: true,
                    lineTension: 0,
                    backgroundColor: "transparent",
                    borderColor: "#54e69d",
                    pointHoverBackgroundColor: "#44c384",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    borderWidth: 1,
                    pointBorderColor: "#44c384",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: [20, 7, 35, 17, 26, 8, 18, 10, 14, 46, 30, 30],
                    spanGaps: false
                },
                {
                    label: "Abertos",
                    fill: true,
                    lineTension: 0,
                    backgroundColor: "transparent",
                    borderColor: "#85b4f2",
                    pointHoverBackgroundColor: "#008ccc",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    borderWidth: 1,
                    pointBorderColor: "#008ccc",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: [2, 74, 32, 10, 10, 2, 3, 55, 12, 5, 8, 30],
                    spanGaps: false
                }
            ]
        }
    });
    
    
     var PIECHART = $('#pizza');
    var myPieChart = new Chart(PIECHART, {
        type: 'doughnut',
        options: {
            cutoutPercentage: 50,
            legend: {
                display: false
            }
        },
        data: {
            labels: [
                "Perdido",
                "Aberto",
                "Ganho"
            ],
            datasets: [
                {
                    data: [300 , 50, 100],
                    borderWidth: [0, 0, 0],
                    backgroundColor: [
                        '#c41a07',
                        "#2b90d9",
                        "#1fb50e"
                    ],
                    hoverBackgroundColor: [
                        '#931305',
                        "#1d6ca5",
                        "#17870a"
                    ]
                }]
        }
    });


}