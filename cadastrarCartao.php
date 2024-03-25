<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";

// Conectar ao banco de dados
$conexao = conectar();

// Verificar se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se todos os campos necessários foram enviados
    if (isset($_POST['codigo_cartao']) && isset($_POST['saldo'])) {
        $codigo_cartao = $_POST['codigo_cartao'];
        $saldo = $_POST['saldo'];

        try {

            // Verificar se o cartão já existe no banco de dados
            $stmt = $conexao->prepare("SELECT * FROM cartao_credito WHERE codigo_cartao = :codigo_cartao");
            $stmt->bindParam(':codigo_cartao', $codigo_cartao);
            $stmt->execute();
            $cartao_existente = $stmt->fetch();

            if ($cartao_existente) {
                echo "Este cartão já está cadastrado.";
            } else {
                // Preparar e executar a consulta SQL para inserir o novo cartão no banco de dados
                $stmt = $conexao->prepare("INSERT INTO cartao_credito (codigo_cartao, saldo) VALUES (:codigo_cartao, :saldo)");
                $stmt->bindParam(':codigo_cartao', $codigo_cartao);
                $stmt->bindParam(':saldo', $saldo);
                $stmt->execute();

                echo "Cartão cadastrado com sucesso.";
                header('location: adm.php');
            }
        } catch (PDOException $e) {
            echo "Erro ao cadastrar o cartão: " . $e->getMessage();
        }
    } else {
        echo "Por favor, preencha todos os campos obrigatórios.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
