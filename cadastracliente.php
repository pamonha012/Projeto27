<?php
    //coleta as variáveis do name no input HTML e abre conexão com o banco
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nome = $_POST['nome'];
        $dtnasc = $_POST['dataNasc'];
        $telefone = $_POST['telefone'];
        $logradouro = $_POST['logradouro'];
        $numero = $_POST['numero'];
        $cidade = $_POST['cidade'];
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];

        include("conectadb.php");
         #Verifica cliente existente
         $sql = "SELECT COUNT(cli_id) FROM clientes WHERE  cli_cpf = '$cpf'";
         $resultado = mysqli_query($link,$sql);
         while($tbl = mysqli_fetch_array($resultado)){
            $cont = $tbl[0];
        }  
                //SOCORRO

        // verificação visual se cliente existe ou não
        if($cont==1){
            echo"<script>window.alert('CLIENTE JÁ CADASTRADO!!!')</script>";
        }else{
            $sql = "INSERT INTO clientes (cli_nome, cli_datanasc, cli_telefone, cli_logradouro, cli_numero, cli_cidade, cli_cpf, cli_ativo, cli_senha) VALUES ('$nome','$dtnasc','$telefone','$logradouro','$numero','$cidade', '$cpf', 's', '$senha')";
            mysqli_query($link,$sql);
            header("Location: listacliente.php");
        }
    }    
?>
	


<!DOCTYPE html> 
<html lang='pt-br'>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastra Clientes</title>
        <link rel="stylesheet" href="./newestilo.css">
    </head>
    <body>
        <div class="container">
            <a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>
            <br><br>
            <form action="cadastracliente.php" method="POST" class="cadastro">
                <h1>Cadastrar Cliente</h1>
                <input type="text" name="nome" id="nome" placeholder="Nome" required>
                <p></p>
                <input type="date" name="dataNasc" id="nome" placeholder="Data de nascimento" required>
                <p></p>
                <input type="text" name="cpf" id="nome" placeholder="CPF" required>
                <p></p>
                <input type="text" name="telefone" id="nome" placeholder="Telefone" required>
                <p></p>
                <input type="text" name="logradouro" id="nome" placeholder="Logradouro" required>
                <p></p>
                <input type="text" name="numero" id="nome" placeholder="Número" required>
                <p></p>
                <input type="text" name="cidade" id="nome" placeholder="Cidade" required>
                <p></p>
                <input type="password" name="senha" id="nome" placeholder="Senha" required>
                <p></p>
                <input type="submit" name="cadastrar" id="cadastrar" value="Cadastrar">
            </form>
        </div>
    </body>
</HTml>
