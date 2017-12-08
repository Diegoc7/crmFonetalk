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
    $('.tell2Edit').css('display', 'none');
    $('.tell3Edit').css('display', 'none');
    $("body").fadeIn(1500);

   

    var url = location.href;
    url = url.split("http://192.168.1.61/crmFonetalk/"); //quebra o endeço de acordo com a / (barra)
//    url = url.split("http://192.168.0.126/crm/"); //quebra o endeço de acordo com a / (barra)
    url = url[1].replace('#', '');
    if (url == 'index.php' || url == 'index' || url == '') {
        $('#barIndex').addClass('active');
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
        }else if (url == 'negocios') {
            carregaContatosSelect();
            carregaEmpresasSelect();
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
        buscaNotas(id, id_user);
        buscaInfoContato(id);
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
        buscaInfoContato(id);
        $('#modalEmpresa').modal('show');
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

    function buscaInfoContato(id) {
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
        $('#nome_cliente').html(value.nome);
        $('#cargo_cliente').html(value.cargo_cliente);
        $('#mostraTelefonePrincipal').html(value.telefone1);
        $('#mostraTipoTelefonePrincipal').html(value.tipotel1);
        $('#mostraCNPJ').html(value.cnpj);
        $('#mostraEndereco').html(value.endereco);
//        $('#mostraOrigem').html(value.origem);
//        $('#mostraDataNascimento').html(value.data_nascimento);
        $('#dateCreate').html(value.data);
        $('#userCreate').html(value.user);
        $('#mostraEmpresa').html(value.empresa);
        $('#mostrarTipoTell2').html(value.tipotel2);
        $('#mostrarTell2').html(value.telefone2);
        $('#mostrarTipoTell3').html(value.tipotel3);
        $('#mostrarTell3').html(value.telefone3);
        $('#mostrarObs').html(value.observacao);
        $('#contEdit').html(value.contEdit);
    }
}