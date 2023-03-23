<?php
    //coleta as variáveis do name ho input HTML e abre conexão com o banco
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        include("conectadb.php");
         #Verifica usuário existente
         $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE  usu_nome = '$nome' AND usu_senha = '$senha'";
         $resultado = mysqli_query($link,$sql);
         while($tbl = mysqli_fetch_array($resultado)){
            $cont = $tbl[0];
        }  
                //SOCORRO

        // verificação visual se usuário existe ou não
        if($cont==1){
            echo"<script>window.alert('USUÁRIO JÁ CADASTRADO!!!')</script>";
        }else{
            $sql = "INSERT INTO usuarios (usu_nome, usu_senha, usu_ativo) VALUES ('$nome','$senha', 'n')";
            mysqli_query($link,$sql);
            header("Location: listausuario.php");
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
        <link rel="stylesheet" href="./newestilo.css">
    </head>
    <body>
    <a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>
        <div class="container">
            <br><br>
            <!-- script para mostrar senha -->
            <script>
                function mostrarSenha(){
                    var tipo = document.getElementById("senha");
                    if(tipo.type ==  "password"){
                        tipo.type = "text";
                    }else{
                        tipo.type = "password";
                    }
                }
            </script>
            <!-- FIM DO SCRIPT -->
            <form action="cadastrausuario.php" method="POST" class="lista">
                <h1>Cadastrar Usuário</h1>
                <input type="text" name="nome" id="nome" placeholder="Nome" class="nomeUsu" required>
                <p></p>
                <input type="password" name="senha" id="senha" placeholder="Senha" class="senhaUsu" required>
                <img id="olinho" src="assets/eye.svg" onclick="mostrarSenha()">
                <p></p>
                <input type="submit" name="cadastrar" id="cadastrar" value="Cadastrar">
            </form>
        </div>
    </body>
</HTml>
