<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";

$return = conectar();

if (!isset ($_SESSION['idadm'])) {
    header('location: login.php');
}

$currentPage = isset ($_GET['page']) ? $_GET['page'] : 'main';
?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>ADM</title>
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

<body style="background-color: #36454F">

    <nav style="background-color: #5E6A72" class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="adm.php?search=">Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active click_branco text-white" aria-current="page" href="adm.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  click_branco text-white" href="sair.php">Sair</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-outline btn_buscar_2" data-bs-toggle="modal"
                            data-bs-target="#cadastrarModal" style="border: 1px solid white;background-color: #5E6A72"
                            type="button">Cadastrar
                        </button>
                    </li>
                </ul>
                <form class="d-flex" action="adm.php" method="get">
                    <input class="form-control me-2 place_branco focus_branco text-white"
                        style="background-color: #121516" type="search" placeholder="Buscar" aria-label="Search"
                        name="search">
                    <button class="btn btn-outline btn_buscar" style="border: 1px solid white"
                        type="submit">Buscar</button>
                </form>


            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row text-center">
            <?php include "carrosAdm.php"; ?>
        </div>
    </div>


    <!-- Modal de Cadastro -->
    <div class="modal fade" id="cadastrarModal" tabindex="-1" role="dialog" aria-labelledby="cadastrarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header " style="background-color: #5E6A72">
                    <h5 class="modal-title text-white " id="cadastrarModalLabel">Cadastrar Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background-color: #363D45">
                    <form action="inserirCarro.php" method="post" enctype="multipart/form-data">
                        <!-- Campos do formulário para inserir um novo registro -->
                        <label class="text-white" for="nome">Nome:</label>
                        <input type="text" id="Insnome" name="Insnome" placeholder="Digite o Nome"
                            class="form-control me-2 place_branco focus_branco text-white"
                            style="background-color: #4A5057" required>

                        <label class="text-white" for="nome">Descrição:</label>
                        <input type="text" id="Insdescricao" name="Insdescricao" placeholder="Digite a Descrição"
                            class="form-control me-2 place_branco focus_branco text-white"
                            style="background-color: #4A5057" required>

                        <label class="text-white" for="Insvalor">Valor:</label>
                        <input type="number" id="Insvalor" name="Insvalor" placeholder="Digite o valor"
                            class="form-control me-2 place_branco focus_branco text-white"
                            style="background-color: #4A5057" required>

                        <label class="text-white" for="imagem">Imagem:</label>
                        <input type="file" id="Insimagem" name="Insimagem" class="form-control me-2 focus_branco "
                            required>

                        <!-- Adicione outros campos conforme necessário -->

                        <!-- Botões para submeter o formulário ou fechar a modal -->
                </div>
                <div class="modal-footer" style="background-color: #5E6A72">
                    <button class="btn btn-outline btn_buscar_2"
                        style="border: 1px solid white;background-color: #5E6A72" type="submit">Cadastrar
                    </button>
                    <button class="btn btn-outline btn_buscar_2"
                        style="border: 1px solid white;background-color: #5E6A72" data-bs-dismiss="modal"
                        type="button">Fechar
                    </button>

                </div>
                </form>


            </div>
        </div>
    </div>

    <script src="js/func.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>