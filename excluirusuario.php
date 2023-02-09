<?php
    include("conectadb.php"); //Inclusão do Banco de dados pegando SQL do banco 


    //passa uma instrução para o BANCO, com comandos SQL excluindo o usuário selecionado
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST['id'];
        $sql = "DELETE FROM usuarios WHERE usu_id = '$id'";
        mysqli_query($link, $sql);
        header("Location: listausuario.php");
        exit();
    }
    if(!isset($_GET['id'])){
        header("Location: listausuario.php");
        exit();
    }

    $id = $_GET['id'];
    $sql = "SELECT usu_nome FROM usuarios WHERE usu_id = $id";
    $resultado = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($resultado)){
        $nome = $tbl[0];
    }
?>

<!DOCTYPE html> 
<html lang='pt-br'>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Excluir Usuários</title>
        <link rel="stylesheet" href="./estilos.css">
    </head>
    <body>
        <div class="container">
            <h2>Excluir usuários</h2>
            <p>Gostaria de Excluir o usuário <b><?=$nome?></b></p>
            <form action="excluirusuario.php" method="post">
                <input type="hidden" value="<?=$id?>" name="id">
                <input type="submit" value="Sim">
            </form>
            <a href="listausuario.php"><button id="btnao">Não</button></a>
        </div>
    </body>
</html>
    