<?php
    include("conectadb.php"); //Inclusão do Banco de dados pegando SQL do banco 

    //passa uma instrução para o BANCO, com comandos SQL alterando o usuário selecionado
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $dtnasc = $_POST['dataNasc'];
        $telefone = $_POST['telefone'];
        $logradouro = $_POST['logradouro'];
        $numero = $_POST['numero'];
        $cidade = $_POST['cidade'];
        $cpf = $_POST['cpf'];
        $ativo = $_POST['ativo'];
        $senha = $_POST['senha'];
        $sql = "UPDATE clientes SET cli_nome = '$nome', cli_datanasc = '$dtnasc', cli_telefone = '$telefone',
        cli_logradouro = '$logradouro', cli_numero = '$numero', cli_cidade = '$cidade', cli_cpf = '$cpf', cli_ativo = '$ativo', cli_senha = '$senha' WHERE cli_id = $id";

        mysqli_query($link, $sql);
        header("Location: listacliente.php");
        echo"<script>window.alert('CLIENTE ALTERADO COM SUCESSO');</script>";
        exit();
    }
        // coletando ID via Link exemplo alterarcliente.php?id=2
        $id = $_GET['id'];
        $sql = "SELECT * FROM clientes WHERE cli_id = $id";
        $resultado = mysqli_query($link, $sql);
        while($tbl = mysqli_fetch_array($resultado)){
            $nome = $tbl[1];
            $dtnasc = $tbl[2];
            $telefone = $tbl[3];
            $logradouro = $tbl[4];
            $numero = $tbl[5];
            $cidade = $tbl[6];
            $cpf = $tbl[7];
            $ativo = $tbl[8];
            $senha = $tbl[9];
        }
    

?>

<!DOCTYPE html> 
<html lang='pt-br'>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alterar Usuários</title>
        <link rel="stylesheet" href="./newestilo.css">
    </head>
    <body>
        <a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>
        <div class="container">
            <form action="alterarcliente.php" method="post">
                <!-- coleta os dados do cliente e preenche seus respectivos txtbox  -->
                <input type="hidden" value="<?=$id?>" name="id" required> 
                <label>Nome</label>
                <input type="text" name="nome" id="nome" value="<?=$nome?>" required> 
                <label>Data de Nascimento</label>
                <input type="date" name="dataNasc" id="nome" value="<?=$dtnasc?>" required> 
                <label>CPF</label>
                <input type="text" name="cpf" id="nome" value="<?=$cpf?>" required  disabled="">
                <label>Telefone</label>
                <input type="text" name="telefone" id="nome" value="<?=$telefone?>" required>
                <label>Logradouro</label>
                <input type="text" name="logradouro" id="nome" value="<?=$logradouro?>" required>
                <label>Número</label>
                <input type="text" name="numero" id="nome" value="<?=$numero?>" required>
                <label>Cidade</label>
                <input type="text" name="cidade" id="nome" value="<?=$cidade?>" required>
                <label>Senha</label>
                <input type="password" name="senha" id="nome" value="<?=$senha?>" required>
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