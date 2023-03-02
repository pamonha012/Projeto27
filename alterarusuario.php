<?php
    include("conectadb.php"); //Inclusão do Banco de dados pegando SQL do banco 

    //passa uma instrução para o BANCO, com comandos SQL alterando o usuário selecionado
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        $ativo = $_POST['ativo'];
        $sql = "UPDATE usuarios SET usu_nome = '$nome', usu_senha = '$senha', usu_ativo = '$ativo' WHERE usu_id = $id";
        mysqli_query($link, $sql);
        header("Location: listausuario.php");
        echo"<script>window.alert('USUÁRIO ALTERADO COM SUCESSO');</script>";
        exit();
    }

    // coletando ID via Link exemplo alterarusuario.php?id=2
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE usu_id = $id";
    $resultado = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($resultado)){
        $nome = $tbl[1];
        $senha = $tbl[2];
        $ativo = $tbl[3];
    }
?>

<!DOCTYPE html> 
<html lang='pt-br'>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alterar Usuários</title>
        <link rel="stylesheet" href="./estilos.css">
    </head>
    <body>
        <a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>
        <div class="container">
            <form action="alterarusuario.php" method="post">
                <input type="hidden" value="<?=$id?>" name="id" required> <!-- coleta o ID ao carregar a página de forma oculta -->
                <label>Nome</label>
                <input type="text" name="nome" id="nome" value="<?=$nome?>" required> <!-- coleta o nome do do usuário e preenche a txtbox  -->
                <label>Senha</label>
                <input type="password" name="senha" id="senha" value="<?=$senha?>" required> <!-- coleta a senha do do usuário e preenche a txtbox  -->
                <p></p>
                <label>Status: <?=$check = ($ativo == 's')?"Ativo":"Inativo";?></label>
                <br>
                <input type="radio" name="ativo" value="s" <?=$ativo == "s"? "checked":""?>>Ativar<br>
                <input type="radio" name="ativo" value="n"<?=$ativo == "n"? "checked":""?>>Desativar
                <input type="submit" value="Salvar">
            </form>
        </div>
    </body>
</HTml>