<?php
    //coleta as variáveis do name ho input HTML e abre conexão com o banco
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $quantidade = $_POST['quantidade'];
        $preco = $_POST['preco'];
        include("conectadb.php");
         #Verifica produto existente
         $sql = "SELECT COUNT(pro_id) FROM produtos WHERE  pro_nome = '$nome'";
         $resultado = mysqli_query($link,$sql);
         while($tbl = mysqli_fetch_array($resultado)){
            $cont = $tbl[0];
        }  
        // verificação visual se produto existe ou não
        if($cont==1){
            echo"<script>window.alert('PROUTO JÁ CADASTRADO!!!')</script>";
        }else{
            $sql = "INSERT INTO produtos (pro_nome, pro_descricao, pro_quantidade, pro_preco) VALUES ('$nome','$descricao','$quantidade', '$preco')";
            mysqli_query($link,$sql);
        }
    }    
?>

<!DOCTYPE html> 
<html lang='pt-br'>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastra Usuários</title>
        <link rel="stylesheet" href="./estilos.css">
    </head>
    <body>
        <div class="container">
            <a href="homesistema.html"> <button id="meuhome"><img src="./assets/home.png"></button></a>
            <form action="cadastraproduto.php" method="POST">
                <h1>Cadastrar Produtos</h1>
                <input type="text" name="nome" id="nome" placeholder="Nome do produto" required>
                <br><br>
                <input type="text" name="descricao" id="nome" placeholder="Descrição do produto" required>
                <br><br>
                <input type="number" name="quantidade" id="nome" placeholder="Quantidade" required>
                <br><br>
                <input type="number" name="preco" id="nome" placeholder="Valor do produto" required>
                <p></p>
                <input type="submit" name="cadastrar" id="cadastrar" value="Cadastrar">
            </form>
        </div>
    </body>
</HTml>
