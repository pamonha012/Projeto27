<?php
    include("conectadb.php"); //Inclusão do Banco de dados pegando SQL do banco 

    //passa uma instrução para o BANCO, com comandos SQL alterando o usuário selecionado
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $quantidade = $_POST['quantidade'];
        $preco = $_POST['preco'];
        $sql = "UPDATE produtos SET pro_nome = '$nome', pro_descricao = '$descricao', pro_quantidade = '$quantidade', pro_preco = '$preco' WHERE pro_id = $id";
        mysqli_query($link, $sql);
        header("Location: listaproduto.php");
        echo"<script>window.alert('PRODUTO ALTERADO COM SUCESSO');</script>";
        exit();
    }

    // coletando ID via Link exemplo alterarproduto.php?id=2
    $id = $_GET['id'];
    $sql = "SELECT * FROM produtos WHERE pro_id = '$id'";
    $resultado = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($resultado)){
        $nome = $tbl[1];
        $descricao = $tbl[2];
        $quantidade = $tbl[3];
        $preco = $tbl[4];
    }
?>

<!DOCTYPE html> 
<html lang='pt-br'>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alterar Produtos</title>
        <link rel="stylesheet" href="./estilos.css">
    </head>
    <body>
        <div class="container">
            <form action="alterarproduto.php" method="post">
                <input type="hidden" value="<?=$id?>" name="id" required> <!-- coleta o ID ao carregar a página de forma oculta -->
                <label>Nome</label>
                <input type="text" name="nome" id="nome" value="<?=$nome?>" required> <!-- coleta o nome do produto e preenche a txtbox  -->
                <br><br>
                <label>Descrição</label>
                <input type="text" name="descricao" id="descricao" value="<?=$descricao?>" required> <!-- coleta a descrição do produto e preenche a txtbox  -->
                <br><br>
                <label>Quantidade</label>
                <input type="number" name="quantidade" id="quantidade" value="<?=$quantidade?>" required>
                <br><br>
                <label>Valor</label>
                <input type="number" name="preco" id="valor" value="<?=$preco?>" required>
                <br><br>
                <input type="submit" value="Salvar">
            </form>
        </div>
    </body>
</HTml>