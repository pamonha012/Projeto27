<?php
include("../conectadb.php");

#Busca a Variavel de Sessão do usuario
session_start();
$idcliente = $_SESSION['idcliente'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idproduto = $_POST['idproduto'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $totalparcial = ($preco * $quantidade);

    #VARIAVEL CRIADA PARA IDENTIFICAÇÃO DO CARRINHO
    $numerocarrinho = MD5($_SESSION['idcliente'] . date('d-m-Y H:i:s'));

    if($idcliente <= 0){
        echo"<script>window.alert('Você precisa estar logado!');</script>";
        echo "<script>window.location.href='logincliente.php';</script>";
    } else {

        #VERIFICA SE O CARRINHO EXISTE
        $sql = "SELECT COUNT(numero_carrinho) FROM itens_carrinho INNER JOIN clientes ON fk_cli_id = cli_id WHERE cli_id = '$idcliente' AND carrinho_finalizado = 'n'";
        $resultado = mysqli_query($link, $sql);
        while ($tbl = mysqli_fetch_array($resultado)) {
            $cont = $tbl[0];
            if ($cont == 0) {
                $sql = "INSERT INTO itens_carrinho (fk_pro_id, item_quantidade, fk_cli_id, valor_carrinho, numero_carrinho, carrinho_finalizado) VALUES('$idproduto','$quantidade', '$idcliente','$totalparcial', '$numerocarrinho', 'n')";
                mysqli_query($link, $sql);
                
                echo "<script>window.alert('PRODUTO ADICIONADO AO CARRINHO $numerocarrinho');</script>";
                echo "<script>window.location.href='loja.php';</script>";
            } else {
                #VERIFICA QUAL É O NUMERO DO CARRINHO DA MELIANTE
                $sql = "SELECT DISTINCT(numero_carrinho) FROM itens_carrinho WHERE fk_cli_id = '$idcliente' AND carrinho_finalizado = 'n'";
                $resultado2 = mysqli_query($link, $sql);
                while ($tbl2 = mysqli_fetch_array($resultado2)) {
                    $numerocarrinhocliente = $tbl2[0];
                    $sql2 = "INSERT INTO  itens_carrinho (fk_pro_id, item_quantidade, fk_cli_id, valor_carrinho,numero_carrinho, carrinho_finalizado) VALUES('$idproduto', '$quantidade', '$idcliente', '$totalparcial', '$numerocarrinhocliente','n')";
                    mysqli_query($link, $sql2);

                    echo "<script>window.alert('PRODUTO ADICIONADO AO CARRINHO $numerocarrinhocliente');</script>";
                    echo "<script>window.location.href='loja.php';</script>";
                }
            }
        }
    }
}


$idproduto = $_GET['id'];
$sql = "SELECT * FROM produtos WHERE pro_id = '$idproduto'";
echo ($sql);
$resultado = mysqli_query($link, $sql);
while ($tbl = mysqli_fetch_array($resultado)) {
    $nomeproduto = $tbl[1];
    $descricao = $tbl[2];
    $preco = $tbl[4];
    $imagematual = $tbl[6];
}

?>
<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="../newestilo.css">
    <title>Ver Produto</title>
</head>
<body>
    <div>
        <form action="verproduto.php" method="post" class="lista">
            <input type="hidden" name="idproduto" value="<?= $idproduto ?>" required>
            <label>Nome: </label>
            <input type="text" name="nome" , value="<?= $nomeproduto ?>" required disabled>
            <br>
            <label>Descrção: </label>
            <input type="text" name="descricao" , value="<?= $descricao ?>" required disabled>
            <br>
            <label>quantidade: </label>
            <input type="number" name="quantidade" required>
            <br>
            <label>Preço: </label>
            <input type="decimal" name="preco" , value="<?= $preco ?>" required>
            <br>
            <img src="data:image/jpeg;base64,<?=$imagematual?>" width="150" height="150">
            <input type="submit" value="Adionar carrinho">
        </form>
    </div>
</body>
</html>