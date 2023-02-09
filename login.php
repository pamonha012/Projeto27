<?php 
//Uma captura de variáveis utilizzando o método POST
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $nome = $_POST['nome']; //declandando a variável 'name' que busca dados do input HTML com o mesmo nome 
        $password = $_POST['password']; //declandando a variável 'password' que busca dados do input HTML com o mesmo nome
        include("conectadb.php"); //Inclusão do Banco de dados pegando SQL do banco 

        #consulta sql para verificar usuario cadastrado
        //instrução de comunicação com o banco de dados
        $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE  usu_nome = '$nome' AND usu_senha = '$password' AND usu_ativo = 's'";
        //coleta o valor da consulta e cria um array para armazenar 
        $resultado = mysqli_query($link,$sql);
        while($tbl = mysqli_fetch_array($resultado)){
            $cont = $tbl[0]; //armazena o valor da coluna no caso a coluna zero
        }  
        //verifica de o resultado do cont é 0 ou 1 
        //confere se o usuário ou senha estão incorretos 
        if($cont==1){
            header("Location: homesistema.html"); //se o usuário e senha estão corretos, manda para homesistema.html
        }else{
            echo"<script>window.alert('USUÁRIOS OU SENHA INCORRETOS')</script>"; //se estiver incorretos mostra um comando JS que mostra um poup-up
        }
    }
?>
<!DOCTYPE html> 
<html lang='pt-br'>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="./stylecadastra.css">
    </head>
    <body>
        <div class="container">
            <!-- script para mostrar senha -->
            <script>
                function mostrarSenha(){
                    var tipo = document.getElementById("password");
                    if(tipo.type ==  "password"){
                        tipo.type = "text";
                    }else{
                        tipo.type = "password";
                    }
                }
            </script>
            <!-- FIM DO SCRIPT -->
            <form action="login.php" method="POST">
                <h1>Login de usuário</h1>
                <input type="text" name="nome" id="nome" placeholder="Nome">
                <p></p>
                <input type="password" id="password" name="password" placeholder="Senha">
                <img id="olinho" src="assets/eye.svg" onclick="mostrarSenha()">  <!-- chamando a função mostrarSenha() do Script -->
                <p></p>
                <input type="submit" name="login" value="LOGIN">
            </form>
        </div>
    </body>
</HTml>
