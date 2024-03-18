<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";
$return = conectar();



// Obtenha o valor do investimento enviado via POST
$investmentAmount = $_POST['investimento'];

// Suponha que você tenha uma variável de sessão para armazenar o ID do cliente
$clienteId = $_SESSION['idcliente'];

// Obter o saldo atual do cliente
$sqlSaldo = "SELECT saldo FROM cliente WHERE idcliente = :clienteId";
$stmtSaldo = $return->prepare($sqlSaldo);
$stmtSaldo->bindParam(':clienteId', $clienteId);
$stmtSaldo->execute();
$saldoAtual = $stmtSaldo->fetch(PDO::FETCH_ASSOC)['saldo'];

// Verificar se o saldo do cliente é suficiente para o investimento
if ($saldoAtual >= $investmentAmount) {
    // Atualizar o saldo do cliente subtraindo o valor do investimento
    $novoSaldo = $saldoAtual - $investmentAmount;
    $sqlAtualizarSaldo = "UPDATE cliente SET saldo = :novoSaldo WHERE idcliente = :clienteId";
    $stmtAtualizarSaldo = $return->prepare($sqlAtualizarSaldo);
    $stmtAtualizarSaldo->bindParam(':novoSaldo', $novoSaldo);
    $stmtAtualizarSaldo->bindParam(':clienteId', $clienteId);
    $stmtAtualizarSaldo->execute();

    // Atualizar o valor investido no carro
    $idCarro = $_POST['idcarro']; // Supondo que você esteja enviando o ID do carro via POST
    $sqlAtualizarValorInvestido = "UPDATE carro SET valor_investido = valor_investido + :investmentAmount WHERE idcarro = :idCarro";
    $stmtAtualizarValorInvestido = $return->prepare($sqlAtualizarValorInvestido);
    $stmtAtualizarValorInvestido->bindParam(':investmentAmount', $investmentAmount);
    $stmtAtualizarValorInvestido->bindParam(':idCarro', $idCarro);
    $stmtAtualizarValorInvestido->execute();

    // Verifique se ambas as atualizações foram bem-sucedidas
    if ($stmtAtualizarSaldo->rowCount() > 0 && $stmtAtualizarValorInvestido->rowCount() > 0) {
        echo json_encode(array('success' => true));
        header('location: cliente.php');
    } else {
        echo json_encode(array('success' => false, 'message' => 'Falha ao processar o investimento.'));
    }
}
