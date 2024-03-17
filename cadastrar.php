<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $ocupacao = $_POST['ocupacao'];

    try {
        $conexao = conectar();

        $query = "INSERT INTO cliente (nome, email,senha,cpf,ocupacao) VALUES (:nome,:email,:senha,:cpf,:ocupacao)";
        $stmt = $conexao->prepare($query);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":ocupacao", $ocupacao);
        $stmt->execute();

        header("Location: login.php");
        exit();
    } catch (PDOException $e) {

        echo "Erro ao inserir registro: " . $e->getMessage();
    }
} else {

    header("Location: cadastro.php");
    exit();
}
?>
