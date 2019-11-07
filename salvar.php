<?php 

include("banco.php");

$cep =          $_POST['cep'];
$rua =          $_POST['rua'];
$numero =       $_POST['numero'];
$bairro =       $_POST['bairro'];
$cidade =       $_POST['cidade'];
$estado =       $_POST['uf'];

$sql = "INSERT INTO  consultaCEP (cep, rua, numero, bairro, cidade, estado)
        VALUES ('$cep', '$rua', '$numero', '$bairro', '$cidade', '$estado');";
    
    $res = mysqli_query($con, $sql);
    if($res){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Salvao com sucesso!</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
            </div>";
    }else{
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Erro ao salvar!</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
            </div>";
    }
    mysqli_close($con);
?>