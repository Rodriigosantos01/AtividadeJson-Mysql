<html>
    <head>
    <title>BuscarCEP</title>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script type="text/javascript" >
        $(document).ready(function() {
            function limpa_formulário_cep() {
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }
            
            $("#cep").blur(function() {
                var cep = $(this).val().replace(/\D/g, '');
                if (cep != "") {
                    var validacep = /^[0-9]{8}$/;
                    if(validacep.test(cep)) {
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        $("#ibge").val("...");
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                            if (!("erro" in dados)) {
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                $("#numero").focus();
                            }else{
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    }else {
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                }else{
                    limpa_formulário_cep();
                }
            });

            $("#salvarCep").on("click", function(event){
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "salvar.php",
                    data: $("#formCep").serialize(),
                    success: function(data){
                        $("#resp").html(data);
                        $("#resultado").load("mostrar.php");    
                    }
                });
            });

            $("#resultado").load("mostrar.php");
        });
    </script>
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12" id="resp">

            </div>
            <div class="col-md-4 offset-md-4">
                <form id="formCep">
                    CEP:
                    <input class="form-control" name="cep" type="text" id="cep" value="" size="10" maxlength="9" required/>
                    RUA:
                    <input class="form-control" name="rua" type="text" id="rua" size="60" required/>
                    NUMERO:
                    <input class="form-control" name="numero" type="number" id="numero" required/>
                    Bairro:
                    <input class="form-control" name="bairro" type="text" id="bairro" size="40" required/>
                    Cidade:
                    <input class="form-control" name="cidade" type="text" id="cidade" size="40" required/>
                    Estado:
                    <input class="form-control" name="uf" type="text" id="uf" size="2" required/>
                    </br><input class="btn btn-primary btn-lg btn-block" id="salvarCep" type="submit" value="Salvar" />
                </form>
            </div>
            <div class="col-md-5 offset-md-3" id="resultado">
            </div>
        </div>
    </div>      
    </body>
</html>