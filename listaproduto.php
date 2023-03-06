<?php
    include("conectadb.php"); //Inclusão do Banco de dados pegando SQL do banco 
    $sql = "SELECT * FROM produtos WHERE pro_ativo = 's';"; //passa uma instrução para o BANCO, com comandos SQL listando os produtos
    $resultado = mysqli_query($link, $sql); 
    $ativo = 's';

    if($_SERVER['REQUEST_METHOD']  == 'POST'){
        $ativo = $_POST['ativo'];
        if($ativo == 's'){
             //passa uma instrução para o BANCO, com comandos SQL listando os usuários 
             // Confere se o POST da página foi "s"
             //Se "s" traga produtos ativos, senão tragas os produtos inatinvos
            $sql = "SELECT * FROM produtos WHERE pro_ativo = 's';";
            $resultado = mysqli_query($link, $sql); 
        }else{
            $sql = "SELECT * FROM produtos WHERE pro_ativo = 'n';";
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
        <link rel="stylesheet" href="./newestilo.css">
        <title>Lista Produtos</title>
    </head>
    <body>
        <a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>
        <div class="container">
        <form action="listaproduto.php" method = "post" class="lista">
            <!-- Botões de validação, mostrando se o produto está ou não ativo
                 onclick="submit()" é um JS que já faz u, submit na página usando o navegador como recurso
                 $ativo== valida se  se o btnRadio foi acionado(checked)-->
                <input type="radio" name="ativo" value="s" required onclick="submit()" <?=$ativo == "s"? "checked":""?>>Ativado<br>
                <input type="radio" name="ativo" value="n" required onclick="submit()" <?=$ativo == "n"? "checked":""?>>Desativado
            </form>
            <br><br><br>
            <table border=1>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Descrição do Produto</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                    <th>Status do produto</th>
                    <th>Imagem</th>
                    <th>Alterar produto</th>
                </tr>
                <?php 
                //Preenchimento da tabela com os dados do banco
                    while($tbl = mysqli_fetch_array($resultado)){
                ?>
                        <tr>
                            <td><?=$tbl[0]?></td>
                            <td><?=$tbl[1]?></td>
                            <td><?=$tbl[2]?></td>
                            <td><?=$tbl[3]?></td>
                            <!-- number_format altera '.' para ',' e usa apenas duas casas decimais -->
                            <td>R$<?= number_format($tbl[4],2,',','.',)?></td>
                            <td><?=$check = ($tbl[5] == "s")?"Ativo":"Desativado"?></td>
                            <td><img src="img/<?=$tbl[6]?>.png" alt=""></td>
                            <td><a href="alterarproduto.php?id=<?= $tbl[0]?>"><input type="button" value="Alterar"></a></td>
                            
                        </tr>
                <?php
                    } 
                ?>
            </table>
        </div>
    </body>
</html>