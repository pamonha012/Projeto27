<?php
session_start();
    include("../conectadb.php"); //Inclusão do Banco de dados pegando SQL do banco 
    $sql = "SELECT * FROM produtos WHERE pro_ativo = 's';"; //passa uma instrução para o BANCO, com comandos SQL listando os produtos
    $resultado = mysqli_query($link, $sql); 
    $ativo = 's';
    
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./newestiloloja.css">
        <title>Loja do Projeto</title>
    </head>
    <body>
        <?php
            if(isset($_SESSION['idcliente'])){
        ?>
            <h1 style="background-color: whitesmoke;">BOM DIA <?=$_SESSION['nomecliente'];?></h1>
            <form id="formloja" action="logout.php" method="post">
                <a href="carrinho.php"><input type="button" value="Área cliente"<?= $_SESSION['idcliente']?>></a>
                <input type="submit" value="Sair">
            </form>
        <?php
            }else{
        ?>
            <form action="logout.php" id="formloja" method="post">
                <a href="logincliente.php"><input type="button" value="Login"></a>
            </form>
        <?php
        }
        ?>
        
        <form action="" method="post" >
            <div class="container"> 
                <br><br><br>
                <table border=1>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição do Produto</th>
                        <!-- <th>Quantidade</th> -->
                        <th>Valor</th>
                        <th>Imagem</th>
                        <th>Ver Produto</th>
                    </tr>
                    <?php 
                    //Preenchimento da tabela com os dados do banco
                        while($tbl = mysqli_fetch_array($resultado)){
                    ?>
                            <tr>
                                <td><?=$tbl[1]?></td>
                                <td><?=$tbl[2]?></td>
                                <!-- <td><input type="number" name="quantidade" id="nome" placeholder="Quantidade" required></td> -->
                                <!-- number_format altera '.' para ',' e usa apenas duas casas decimais -->
                                <td>R$<?= number_format($tbl[4],2,',','.',)?></td>
                                <td><img src="data:image/jpeg;base64,<?=$tbl[6]?>" width="100" height="100"></td>   
                                <td><a href="verproduto.php?id=<?= $tbl[0]?>"><input type="button" value="Ver Produto"></a></td>                 
                            </tr>
                    <?php
                        } 
                    ?>
                </table>
            </div>
        </form>
    </body>
</html>