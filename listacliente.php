<?php
    include("conectadb.php"); //Inclusão do Banco de dados pegando SQL do banco 
    $sql = "SELECT * FROM clientes WHERE cli_ativo = 's';"; //passa uma instrução para o BANCO, com comandos SQL listando os clientes
    $resultado = mysqli_query($link, $sql); 
    $ativo = 's';

    if($_SERVER['REQUEST_METHOD']  == 'POST'){
        $ativo = $_POST['ativo'];
        if($ativo == 's'){
             //passa uma instrução para o BANCO, com comandos SQL listando os usuários 
             // Confere se o POST da página foi "s"
             //Se "s" traga cliente ativos, senão tragas os produtos inatinvos
            $sql = "SELECT * FROM clientes WHERE cli_ativo = 's';";
            $resultado = mysqli_query($link, $sql); 
        }else{
            $sql = "SELECT * FROM clientes WHERE cli_ativo = 'n';";
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
        <title>Lista Clientes</title>
    </head>
    <body>
        <a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>
        <div class="container">
        <form action="listacliente.php" method = "post">
            <!-- Botões de validação, mostrando se o cliente está ou não ativo
                 onclick="submit()" é um JS que já faz u, submit na página usando o navegador como recurso
                 $ativo== valida se  se o btnRadio foi acionado(checked)-->
                <input type="radio" name="ativo" value="s" required onclick="submit()" <?=$ativo == "s"? "checked":""?>>Ativado<br>
                <input type="radio" name="ativo" value="n" required onclick="submit()" <?=$ativo == "n"? "checked":""?>>Desativado
            </form>
            <br><br><br>
            <table border=1>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Data de Nascimento</th>
                    <th>Telefone</th>
                    <th>Logradouro</th>
                    <th>Núemro</th>
                    <th>Cidade</th>
                    <th>Status do Cliente</th>
                    <th>Alterar Cliente</th>
                </tr>
                <?php 
                //Preenchimento da tabela com os dados do banco
                    while($tbl = mysqli_fetch_array($resultado)){
                ?>
                        <tr>
                            <td><?=$tbl[1]?></td>
                            <td><?=$tbl[7]?></td>
                            <td><?=$tbl[2]?></td>
                            <td><?=$tbl[3]?></td>
                            <td><?=$tbl[4]?></td>
                            <td><?=$tbl[5]?></td>
                            <td><?=$tbl[6]?></td>
                            <td><?=$check = ($tbl[8] == "s")?"Ativo":"Desativado"?></td>
                            <td><a href="alterarcliente.php?id=<?= $tbl[0]?>"><input type="button" value="Alterar"></a></td>
                            
                        </tr>
                <?php
                    } 
                ?>
            </table>
        </div>
    </body>
</html>