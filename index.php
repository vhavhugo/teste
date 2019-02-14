<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Consulta CEP / Ajax</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        div#mensagem{
            display: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="col-md-12">

     <div class="col-md-3 col-md-offset-9">
                    <p class="pull-right">
                        <button class="btn btn-custom btn-tipo-cadastro inverte-cor" type="button" data-tipo="pessoa-fisica">Pessoa Física
                        </button>

                        <button class="btn btn-custom btn-tipo-cadastro inverte-cor" type="button" data-tipo="pessoa-juridica">Pessoa Jurídica
                        </button>
                    </p>
                </div>


<div id="pessoa-fisica">
        <div class="row" style="margin-top: 20%;">
            <div class="col-md-2">
                <labe for="cep">Cep:</labe>
                <small>(ex: 01001-000)</small>
                <input type="text" class="form-control" name="cep" id="cep" placeholder="Inserir cep"/>
            </div>
            <div class="col-md-6">
                <label for="endereco">Endereço:</label>
                <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Inserir endereço"/>
            </div>
            <div class="col-md-4">
                <label for="complemento">Complemento:</label>
                <input type="text" class="form-control" name="complemento" id="complemento"
                       placeholder="Inserir endereço"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="cidade">Cidade:</label>
                <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Inserir cidade"/>
            </div>
            <div class="col-md-4">
                <label for="bairro">Bairro:</label>
                <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Inserir bairro"/>
            </div>
            <div class="col-md-4">
                <label for="estado">Estado:</label>
                <input type="text" class="form-control" name="estado" id="estado" placeholder="Inserir estado"/>
            </div>
        </div>
            <br>
            <div class="alert alert-danger" id="mensagem"></div>
        </div>
        <div id="pessoa-juridica" class="hide">
            Teste 2
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
        <!-- <script src="query.validate.v2.js" type="text/javascript"></script> -->
        <script src="cliente.js"></script>
<script type="text/javascript">
    $("#cep").blur(function (e) {
    var cep = $("#cep").val();
    var url = "http://viacep.com.br/ws/" + cep + "/json/";
    var validaCep = /^[0-9]{5}-?[0-9]{3}$/;
    if(validaCep.test(cep)) {
        $("#mensagem").hide();
        consultaCep(url);
    }else{
        $("#mensagem").show();
        $("#mensagem").html("Cep Inválido");
    }
    });

    function consultaCep(endereco) {
    $.ajax({
        type: "GET",
        url: endereco,
        async: false

    }).done(function (data) {
        $("#endereco").val(data.logradouro);
        $("#complemento").val(data.complemento);
        $("#cidade").val(data.localidade);
        $("#bairro").val(data.bairro);
        $("#estado").val(data.uf);
    }).fail(function () {
        console.log("error");
    })
    }
</script>

</body>
</html>