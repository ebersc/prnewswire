
//Capturando a base da URL (equivalente ao base_url() do codeIgniter)
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

$('#btnSalvar').on('click', function () {

    let dados = [];

    //Verifica quais as newsletters foram selecionadas pelo usuário
    $.each($("input[name='news']:checked"), function () {
        dados.push($(this).val());
    });

    //Envia quais foram as newsletters selecionadas para a função que grava no banco de dados
    $.ajax({
        type: "POST",
        url: "index.php/Welcome/Salvar",
        data: {
            noticias: dados,
        },
        success: function () {
            alert('Newsletter cadastrada com sucesso!');
            location.href = 'index.php/Welcome/listarNoticia';
        },
        error: function (err) {
            console.log(err);
        }
    });
});


$('#btnEnviar').on('click', function () {

    let dados = $('<div>').append( $("#noticias").clone() ).html();
//Envia o html com as newsletters selecionados por email
   $.ajax({
       type: 'POST',
       url: baseUrl + '/index.php/EnviaEmail/EnviarEmail',
       data:{
           conteudo: dados,
       },
       success: function () {
         alert('Email enviado com sucesso!')
       },
       error: function (err) {
            console.log(err);
       }
   }) 
});