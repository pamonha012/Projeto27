<?php
    include("conectadb.php"); //Inclusão do Banco de dados pegando SQL do banco 
    $sql = "SELECT * FROM produtos;"; //passa uma instrução para o BANCO, com comandos SQL listando os produtos
    $resultado = mysqli_query($link, $sql); 
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./estilos.css">
        <title>Lista Produtos</title>
    </head>
    <body>
        <a href="homesistema.html"> <button id="meuhome"><img src="./assets/home.png"></button></a>
        <div class="container">
            <table border=1>
                <tr>
                    <th>Nome</th>
                    <th>Descrição do Produto</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                    <th>Alterar produto</th>
                </tr>
                <?php 
                    while($tbl = mysqli_fetch_array($resultado)){
                ?>
                        <tr>
                            <td><?=$tbl[1]?></td>
                            <td><?=$tbl[2]?></td>
                            <td><?=$tbl[3]?></td>
                            <td>R$<?=$tbl[4]?></td>
                            <td><a href="alterarproduto.php?id=<?= $tbl[0]?>"><input type="button" value="Alterar"></a></td>
                        </tr>
                <?php
                    } 
                ?>
            </table>
        </div>
    </body>
</html>