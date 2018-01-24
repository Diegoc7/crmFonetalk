/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('#login-form').bind('submit', function (e) {
    e.preventDefault();
    var txt = $(this).serialize();
//    console.log(txt);
    $.ajax({
        type: 'POST',
        url: 'login/verificar',
        data: txt,
        dataType: 'json',
        beforeSend: function () {
//            $('#tituloEsqueceu').html('Verificando!...');
            $('#login-form').find('input').attr('disabled', 'disabled');
            $('#login-form').find('button').attr('disabled', 'disabled');
//            $('#myModal').modal('hide');
        },
        success: function (json) {
            console.log(json);
            if (json == 'ok') {
                $("body").fadeOut(1500, redirectPage);
            } else if (json == 'vazio') {
                console.log('vazio');

            }else{
                console.log('erro');
            }
//            $('#tituloEsqueceu').html('Esqueceu a senha?');
            $('#login-form').find('input').removeAttr('disabled');
            $('#login-form').find('button').removeAttr('disabled');
        },

        error: function () {//executa se der erro em algum lugar
//            alert("Ocorreu um erro");
        }
    });
});
function redirectPage() {
    window.location = "index.php";
}