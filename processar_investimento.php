<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";
$return = conectar();

// Obtenha o valor do investimento e o valor do carro enviados via POST
$investmentAmount = isset($_POST['Qinvestimento']) ? intval($_POST['Qinvestimento']) : 0;;
$idCarro = $_POST['idcarro'] ?? 0;

// Obter o valor do carro enviado via POST
$valorCarro = $_POST['car_value'] ?? 0;


// Suponha que você tenha uma variável de sessão para armazenar o ID do cliente
$clienteId = $_SESSION['idcliente'];

// Obter o saldo atual do cliente
$sqlSaldo = "SELECT saldo FROM cliente WHERE idcliente = :clienteId";
$stmtSaldo = $return->prepare($sqlSaldo);
$stmtSaldo->bindParam(':clienteId', $clienteId);
$stmtSaldo->execute();
$saldoAtual = $stmtSaldo->fetch(PDO::FETCH_ASSOC)['saldo'];

$totalInvestido = $investmentAmount * $valorCarro;

// Verificar se o saldo do cliente é suficiente para o investimento
if ($saldoAtual >= $totalInvestido) {
    // Atualizar o saldo do cliente subtraindo o valor do investimento
    $novoSaldo = $saldoAtual - $totalInvestido;
    $sqlAtualizarSaldo = "UPDATE cliente SET saldo = :novoSaldo WHERE idcliente = :clienteId";
    $stmtAtualizarSaldo = $return->prepare($sqlAtualizarSaldo);
    $stmtAtualizarSaldo->bindParam(':novoSaldo', $novoSaldo);
    $stmtAtualizarSaldo->bindParam(':clienteId', $clienteId);
    $stmtAtualizarSaldo->execute();

    // Calcule o valor total do investimento


    // Adicionamos um echo para exibir o valor total do investimento
    echo "Total Investido: $totalInvestido";
    echo "id do carro: $idCarro";

    // Atualizar o valor investido no carro
    // Atualizar o valor investido no carro
    $sqlAtualizarValorInvestido = "UPDATE carro SET valor_investido = valor_investido + :totalInvestido WHERE idcarro = :idCarro";
    $stmtAtualizarValorInvestido = $return->prepare($sqlAtualizarValorInvestido);
    $stmtAtualizarValorInvestido->bindValue(':totalInvestido', $totalInvestido, PDO::PARAM_INT);
    $stmtAtualizarValorInvestido->bindParam(':idCarro', $idCarro, PDO::PARAM_INT);
    


    // Adicionar um echo para exibir a consulta antes de ser executada
    echo "Consulta de Atualização: $sqlAtualizarValorInvestido";


    $stmtAtualizarValorInvestido->execute();


    // Verificar se ambas as atualizações foram bem-sucedidas
    $rowCountSaldo = $stmtAtualizarSaldo->rowCount();
    $rowCountValorInvestido = $stmtAtualizarValorInvestido->rowCount();

    if ($rowCountSaldo > 0 && $rowCountValorInvestido > 0) {
        echo json_encode(array('success' => true));
        // Redirecionar para a página do cliente após o investimento bem-sucedido
        header('location: cliente.php');
    } else {
        echo json_encode(array('success' => false, 'message' => 'Falha ao processar o investimento. Atualizações no banco de dados não foram aplicadas.', 'rowCountSaldo' => $rowCountSaldo, 'rowCountValorInvestido' => $rowCountValorInvestido));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Saldo insuficiente para realizar o investimento.'));
}
