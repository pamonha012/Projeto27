<?php
    //coleta as variáveis do name no input HTML e abre conexão com o banco
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $quantidade = $_POST['quantidade'];
        $preco = $_POST['preco'];
        include("conectadb.php");
         #Verifica produto existente utilizando um select sql
         $sql = "SELECT COUNT(pro_id) FROM produtos WHERE  pro_nome = '$nome'";
         //Faz um consulta no banco de dados e verifica se o produto cadastrado existe ou não
         $resultado = mysqli_query($link,$sql);
         while($tbl = mysqli_fetch_array($resultado)){
            $cont = $tbl[0];
        }  
        // verificação visual se produto existe ou não
        if($cont==1){
            echo"<script>window.alert('PROUTO JÁ CADASTRADO!!!')</script>";
        }else{
            //Insert sql para inserir o produto após a coleta de dados
            $sql = "INSERT INTO produtos (pro_nome, pro_descricao, pro_quantidade, pro_preco, pro_ativo) VALUES ('$nome','$descricao','$quantidade', '$preco', 's')";
            mysqli_query($link,$sql); //Faz uma consulta no banco de dados 
            header("Location: listaproduto.php"); //quando o produto é cadastrado o header atualiza e leva o usuário para listaproduto.php
            exit();
        }
    }    
?>

<!DOCTYPE html> 
<html lang='pt-br'>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastra Produto</title>
        <link rel="stylesheet" href="./estilos.css">
    </head>
    <body>
        <div class="container">
            <a href="homesistema.html"> <button id="meuhome"><img src="./assets/home.png"></button></a>
            <br><br>
            <form action="cadastraproduto.php" method="POST">
                <h1>Cadastrar Produtos</h1>
                <input type="text" name="nome" id="nome" placeholder="Nome do produto" class="nomeUsu" required>
                <br><br>
                <input type="text" name="descricao" id="nome" placeholder="Descrição do produto" required>
                <br><br>
                <input type="number" name="quantidade" id="nome" placeholder="Quantidade" required>
                <br><br>
                <input type="number" name="preco" id="nome" placeholder="Valor do produto" required>
                <p></p>
                <input type="submit" name="cadastrar" id="cadastrar" value="Cadastrar">
                <br><br>
                <!-- Comando para recebimento de fotos -->
                <label>Imagem</label>
                <input type="file" name="foto1" id="img1" onchange="foto1()">
                <img src="img/semfoto.png" width="100px" id="foto1a">
            </form>
            <script>
                function foto1(){
                    document.getElementById("foto1a").src = "img/" (document.getElementById("img1").value).slice(12);
                }
            </script>
        </div>
    </body>
</HTml>
