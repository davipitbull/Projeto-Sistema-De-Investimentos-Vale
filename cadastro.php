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

<body>

    <div class="container" style="margin-top: 15rem">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="border-bottom: 3px outset white;">
                        <h4 class=" text-center">Cadastro </i></h4>
                    </div>
                    <div class="card-body ">
                        <form action="cadastrar.php" method="post">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome completo:</label>
                                <input type="text" class="form-control" id="nome" placeholder="Digite seu nome completo" name="nome">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label "> Email:</label>
                                <input type="email" class="form-control  " id="email" placeholder="Digite seu Email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label"> Senha:</label>
                                <input type="password" class="form-control " id="senha" placeholder="Digite sua senha" name="senha">
                            </div>
                            <div class="mb-3">
                                <label for="cpf" class="form-label "> Cpf:</label>
                                <input type="text" class="form-control" id="cpf" placeholder="Digite seu cpf (Somente números)" name="cpf">
                            </div>
                            <div class="mb-3">
                                <label for="ocupacao" class="form-label ">Ocupação:</label>
                                <input type="text" class="form-control " id="ocupacao" placeholder="Professor ou Aluno" name="ocupacao">

                            </div>
                            <div class="d-grid col-3 mx-auto">
                                <button type="submit" class=" btn btn-primary btn-block">Cadastrar</button>
                            </div>

                            <p class="mt-2 text-center"><a href="login.php" class=" text-center link-primary link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover">Já
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