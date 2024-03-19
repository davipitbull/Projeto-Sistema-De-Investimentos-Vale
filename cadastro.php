<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";

$return = conectar();

?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Página de Cadastro</title>
</head>

<body style="background-color: #36454F">
    <div class="container" style="margin-top: 8%">
        <div class="row justify-content-center" >
            <div class="col-md-6">
                <div class="card rounded-0">
                    <div class="card-header" style="border-bottom: 3px outset white;background-color: #5E6A72">
                        <h4 class=" text-center text-white">Cadastro </i></h4>
                    </div>
                    <div class="card-body " style="background-color: #363D45" >
                        <form action="cadastrar.php" method="post">
                            <div class="mb-3">
                                <label for="nome" class="form-label text-white">Nome Completo:</label>
                                <input type="text" class="form-control me-2 place_branco focus_branco text-white" style="background-color: #4A5057" id="nome" placeholder="Digite seu nome completo" name="nome">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label text-white "> Email:</label>
                                <input type="email" class="form-control me-2 place_branco focus_branco text-white" style="background-color: #4A5057" id="email" placeholder="Digite seu Email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label text-white"> Senha:</label>
                                <input type="password" class="form-control me-2 place_branco focus_branco text-white" style="background-color: #4A5057" id="senha" placeholder="Digite sua senha" name="senha">
                            </div>
                            <div class="mb-3">
                                <label for="cpf" class="form-label text-white"> Cpf:</label>
                                <input type="text" class="form-control me-2 place_branco focus_branco text-white" style="background-color: #4A5057" id="cpf" placeholder="Digite seu cpf (Somente números)" name="cpf">
                            </div>
                            <div class="mb-3">
                                <label for="ocupacao" class="form-label text-white">Ocupação:</label>
                                <input type="text" class="form-control me-2 place_branco focus_branco text-white" style="background-color: #4A5057" id="ocupacao" placeholder="Professor ou Aluno" name="ocupacao">

                            </div>
                            <div class="d-grid col-3 mx-auto">
                                <button class="btn btn-outline btn_buscar_2" style="border: 1px solid white;background-color: #5E6A72" type="submit">Cadastrar</button>
                            </div>

                            <p class="mt-2 text-center"><a href="login.php" class=" text-center link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Já
                                    possui conta? Clique aqui!!👍</a></p>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>