<?php 

include("banco.php");

$sql = "SELECT * FROM consultaCEP";
$res = mysqli_query($con, $sql);
 
// conta o número de registros
$total = mysqli_num_rows($res);
if($total == 0){
    echo "<center>Nenhum registro</center>";
}else{


echo "Total de Resultados: " . $total . "<br>";
?>
    <table class="table table-bordered table-striped">
        <tr>
            <td>ID</td>
            <td>CEP</td>
            <td>RUA</td>
            <td>NUMERO</td>
            <td>BAIRRO</td>
            <td>CIDADE</td>
            <td>ESTADO</td>
        </tr>
<?php 
    while ($row = mysqli_fetch_array($res)){
?>
    <tr>
        <td><?php echo $row['id'];?></td>
        <td><?php echo $row['cep'];?></td>
        <td><?php echo $row['rua'];?></td>
        <td><?php echo $row['numero'];?></td>
        <td><?php echo $row['bairro'];?></td>
        <td><?php echo $row['cidade'];?></td>
        <td><?php echo $row['estado'];?></td>
    </tr>
<?php
    }
}
    mysqli_close($con);?>
</table>