<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";
$return = conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];


    $exclusaoSucesso = deletarTabela('carro', 'idcarro', $id);

    // Redirecione de volta para a página principal após a exclusão
    header('Location: adm.php');
    exit();
}

?>