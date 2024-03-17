<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";

// Verifica se o ID do carro foi enviado via POST
if (isset($_POST['id'])) {
    // Conecta ao banco de dados usando PDO
    $conexao = conectar();

    try {
        // Obtém o ID do carro a ser excluído
        $idcarro = $_POST['id'];

        // Prepara a consulta SQL para excluir o carro com o ID especificado
        $query = "DELETE FROM carro WHERE idcarro = ?";
        $stmt = $conexao->prepare($query);
        $stmt->execute([$idcarro]);

        // Redireciona para a página anterior ou exibe uma mensagem de sucesso
        header("Location: adm.php?erro=bosta");
        exit();
    } catch (PDOException $e) {
        // Em caso de erro, redireciona com uma mensagem de erro
        header("Location: adm.php?erro=1");
        exit();
    }
} else {
    // Se o ID do carro não foi enviado, redireciona para a página anterior
    header("Location: adm.php?erro=buceta");
    exit();
}
?>
