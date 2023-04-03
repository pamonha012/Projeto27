<?php
    //Trazer conexão com o banco
    include("../conectadb.php");
    //inicia a sessão já aberta 
    session_start();
    $idcliente = $_SESSION['idcliente'];
    $sql = "SELECT numero_carrinho, pro_nome, pro_descricao, pro_preco, item_quantidade, valor_carrinho, imagem1, carrinho_id FROM itens_carrinho INNER JOIN clientes ON fk_cli_id = cli_id INNER JOIN produtos ON fk_pro_id = pro_id WHERE cli_id = $idcliente AND carrinho_finalizado = 'n'";
    $finalizada = 'n';
    //lista de todos os produtos do carrinho
  
    $resultado = mysqli_query($link, $sql);
    
    //seletor de carrinho finalizado
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //receber escolha do html seletor (radio_button)
        $finalizada = $_POST['finalizada'];
        if($finalizada == 'n'){
            $sql = "SELECT numero_carrinho, pro_nome, pro_descricao, pro_preco, item_quantidade, valor_carrinho, imagem1, carrinho_id FROM itens_carrinho INNER JOIN clientes ON fk_cli_id = cli_id INNER JOIN produtos ON fk_pro_id = pro_id WHERE cli_id = $idcliente AND carrinho_finalizado = 'n'";
            $resultado = mysqli_query($link, $sql);
        }else{
            $sql = "SELECT numero_carrinho, pro_nome, pro_descricao, pro_preco, item_quantidade, valor_carrinho, imagem1, carrinho_id FROM itens_carrinho INNER JOIN clientes ON fk_cli_id = cli_id INNER JOIN produtos ON fk_pro_id = pro_id WHERE cli_id = $idcliente AND carrinho_finalizado = 's'";
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
    <link rel="stylesheet" href="../newestilo.css">
    <title>Carrinho</title>
</head>
<body>
    <a href="loja.php"><input type="button" id="loja" value="Voltar para Loja"></a>
    <form action="carrinho.php" method="post" class="lista">
        <input type="radio" name="finalizada" value="s" required onclick="submit()" <?=$finalizada == 's' ? "checked" : "" ?>> Compras finalizadas
        <br>
        <input type="radio" name="finalizada" value="n" required onclick="submit()" <?=$finalizada == 'n' ? "checked" : "" ?>> Coarrinhos abertos
    </form>
    <div class="container">
        <a href="finalizavenda.php?id=<?=$tbl[0]?>"><input type="button" value="Finalizar compra"></a>
        <table border="1">
            <tr>
                <th>Número do carrinho</th>
                <th>Produto</th>
                <th>Descrição</th>
                <th>Valor unitário</th>
                <th>Quantidade</th>
                <th>Imagem</th>
                <th>Excluir</th>
            </tr>
            <?php 
                while($tbl = mysqli_fetch_array($resultado)){
            ?>
            <tr>
            <tr>
                <td><?= $tbl[0]?></td>
                <td><?= $tbl[1]?></td>
                <td><?= $tbl[2]?></td>
                <td>R$ <?= number_format($tbl[3],2,',','.')?></td>
                <td><?= $tbl[4]?></td>
                <td><img src="data:image/jpeg;base64,<?= $tbl[6]?>" width="100" height="100"></td> 
                <td><a href="excluiproduto.php?id=<?= $tbl[7]?>"><input type="button" value="REMOVER ITEM"></a></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
</body>
</html>