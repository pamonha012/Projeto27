<?php
    include("../conectadb.php");
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $id = $_GET["id"];
        $sql = "DELETE FROM itens_carrinho WHERE carrinho_id = $id";
        mysqli_query($link, $sql);
        echo"<script>window.alert('Produto excluido com sucesso!');</script>";
        echo "<script>window.location.href='carrinho.php';</script>";
    }
    $id = $_GET['id'];
    $sql = "SELECT pro_nome FROM itens_carrinho INNER JOIN produtos ON fk_pro_id = pro_id WHERE carrinho_id = $id";
    $resultado = mysqli_query($link, $sql);
?>