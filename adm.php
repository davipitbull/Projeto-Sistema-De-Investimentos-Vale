<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";

$return = conectar();

if (!isset($_SESSION['idadm'])) {
    header('location: login.php');
}

$currentPage = isset($_GET['page']) ? $_GET['page'] : 'main';
?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="adm.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sair.php">Sair</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Sanfona
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Acao</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-success" type="submit">Cadastrar</button>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="post">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row text-center">
            <?php
            $carros = listarTabela("idcarro, nome, descricao, imagem, data_criacao", 'carro', 'idcarro');
            if ($carros) {

                foreach ($carros as $carrosItem) {

                    $idcarro = $carrosItem->idcarro;
                    $nome = $carrosItem->nome;
                    $descricao = $carrosItem->descricao;
                    $imagem = $carrosItem->imagem;
                    $data_criacao = $carrosItem->data_criacao;
                    ?>
                    <div class="col-sm-2 col-md-3 col-lg-4 p-5 text-center">
                        <div class="card" style="width: 100%; height: 100%;">
                            <img src="img/<?php echo $imagem; ?>" class="card-img-top" alt="<?php echo $imagem; ?>">
                            <div class="card-body text-center ">
                                <h5 class="card-title">
                                    <?php echo $nome; ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo $descricao; ?>
                                </p>

                                <a href="#" class="btn btn-primary btn-sm">Go somewhere</a>
                            </div>
                        </div>
                    </div>




                    <?php
                }
            }
            ?>
        </div>
    </div>
    <script src="js/func.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>