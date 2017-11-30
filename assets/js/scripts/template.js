/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var ver = $('.divTabela').html();
$(document).ready(function () {
    $('#addUser').tooltip();
    $('.tell2').css('display', 'none');
    $('.tell3').css('display', 'none');
    $("body").fadeIn(1500);

    var url = location.href;
    url = url.split("http://192.168.0.126/crm/"); //quebra o endeço de acordo com a / (barra)
    url = url[1].replace('#', '');
    if (url == 'index.php' || url == 'index' || url == '') {
        $('#barIndex').addClass('active');
    } else {
        $('#bar_' + url).addClass('active');
        
        if(url == 'usuarios'){
            carregaUsuarios();
        }else if(url == 'contatos'){
            carregaContatos();
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
});
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
    } else if (value.status == '2') {
        tipo = 'Vendedor';
    } else if (value.status == '3') {
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
}
function fechaForm() {
    $('.forms').slideUp('slow');
    $('#addUser').show('slow');
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

$('#form-insert-contact').bind('submit', function (e) {
    e.preventDefault();
    var txt = $(this).serialize();
    console.log(txt);
    $.ajax({
        type: 'POST',
        url: 'contatos/insere',
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
            $('#modalError').modal('show');
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
    } else  {
        tipo = value.empresa;
    } 
//    var btnRelatorio = '<a class="btndeleta btn btn-primary btn-sm" href="http://192.168.0.126/crm/contatos/contato/'+value.id+'"  ><i class="fa fa-eye"></i></a>';
    var btnRelatorio = '<button class="btndeleta btn btn-primary btn-sm" onclick="mostraContato('+value.id+');"  ><i class="fa fa-eye"></i></button>';
    $('.tabela').find('tbody').append(
            '<tr><td ' + cor + ' >' + value.nome + '</td><td ' + cor + '>' + value.telefone1 + '</td><td ' + cor + '>' + value.email + '</td><td ' + cor + '>' + tipo + '</td><td ' + cor + '>' + btnRelatorio + ' </td></tr>'
            );
}

function mostraContato(id){
    $('#modalContato').modal('show');
}