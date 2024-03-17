<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";

$return = conectar();

if (!isset($_SESSION['idcliente'])) {
    header('location: login.php');
}

$cliente = listarTabela("idcliente, nome, email, saldo", 'cliente', 'idcliente');

if (isset($cliente)) {
    foreach ($cliente as $item)
        $idcliente = $item->idcliente;
        $nome = $item->nome;
        $email = $item->email;
        $saldo = $item->saldo;
};

$currentPage = isset($_GET['page']) ? $_GET['page'] : 'main';
?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Investimentos</title>
</head>

<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
    }

    table {
        border-collapse: collapse;
        width: 80%;
        margin-top: 20px;
        margin-left: 20px;
    }

    th,
    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 1px;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>

<body>



    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="cliente.php">
                <img src="imgSite/logo.png" alt="" width="50px">
                Invista Aqui
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="cliente.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: green;" aria-disabled="true">Seu saldo: <?php echo $saldo; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sair.php">Sair</a>
                    </li>

                </ul>
                <form class="d-flex" action="cliente.php" method="get">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" name="search">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>


            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row text-center">
            <?php include "carrosCliente.php"; ?>
        </div>
    </div>





    <script src="js/func.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>