<?php
    include("conectadb.php"); //Inclusão do Banco de dados pegando SQL do banco 
    $sql = "SELECT * FROM usuarios WHERE usu_ativo = 's';";
    $resultado = mysqli_query($link, $sql); 
    $ativo = 's';

    if($_SERVER['REQUEST_METHOD']  == 'POST'){
        $ativo = $_POST['ativo'];
        if($ativo == 's'){
             //passa uma instrução para o BANCO, com comandos SQL listando os usuários 
            $sql = "SELECT * FROM usuarios WHERE usu_ativo = 's';";
            $resultado = mysqli_query($link, $sql); 
        }else{
            $sql = "SELECT * FROM usuarios WHERE usu_ativo = 'n';";
            $resultado = mysqli_query($link, $sql); 
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./estilos.css">
        <title>Lista Usuários</title>
    </head>
    <body>
        <a href="homesistema.html"> <button id="meuhome"><img src="./assets/home.png"></button></a>
        <div class="container">
            <form action="listausuario.php" method = "post">
                <input type="radio" name="ativo" value="s" required onclick="submit()" <?=$ativo == "s"? "checked":""?>>Ativado<br>
                <input type="radio" name="ativo" value="n" required onclick="submit()" <?=$ativo == "n"? "checked":""?>>Desativado
            
            </form>
            <br><br><br>
            <table border=1>
                <tr>
                    <th>Nome</th>
                    <th>Status Usuário</th>
                    <th>Alterar Dados</th>
                </tr>
                <?php 
                    while($tbl = mysqli_fetch_array($resultado)){
                ?>
                        <tr>
                            <td><?=$tbl[1]?></td> <!-- traz somente a coluna NOME para apresentar na tabela -->
                            <td><?=$check = ($tbl[3] == "s")?"Ativo":"Desativado"?></td>
                            <!-- ao clicar no botão ele ja trará o ID do usuário para a página do alterar -->
                            <td><a href="alterarusuario.php?id=<?= $tbl[0]?>"><input type="button" value="Alterar"></a></td>
                            <!-- ao clicar no botão ele já trará o ID do usuário para a página do ecluir -->
                            <!-- <td><a href="excluirusuario.php?id=<//?= $tbl[0]?>"><input type="button" value="Excluir"></a></td> -->
                        </tr>
                <?php
                    } 
                ?>
            </table>
        </div>
    </body>
</html>