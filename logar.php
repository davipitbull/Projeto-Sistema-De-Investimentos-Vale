<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";

$conn = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verifique se o usuário é administrador
    $query = "SELECT * FROM adm WHERE email = :email AND senha = :senha";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $password);
    $stmt->execute();
    $admin = $stmt->fetch();

    if ($admin) {
        // Usuário é administrador, redireciona para adm.php e define mensagem de sucesso
        session_start();
        $_SESSION['idadm'] = $admin['idadm'];
        header('location: adm.php');
        exit();
    }

    // Verifique se o usuário é cliente
    $query = "SELECT * FROM cliente WHERE email = :email AND senha = :senha";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $password);
    $stmt->execute();
    $cliente = $stmt->fetch();

    if ($cliente) {
        // Usuário é cliente, redireciona para cliente.php e define mensagem de sucesso
        session_start();
        $_SESSION['idcliente'] = $cliente['idcliente'];
        header('location: cliente.php');
        exit();
    }

    // Se não for encontrado nenhum usuário com o email e senha fornecidos, define mensagem de erro
    session_start();
    $_SESSION['error_message'] = "Usuário ou senha incorretos!";
    header('location: login.php');
} else {
    // Se não for uma solicitação POST, redirecione de volta para a página de login com mensagem de erro
    session_start();
    $_SESSION['error_message'] = "Método de requisição inválido!";
    header('location: login.php');
}
?>
