<?php
include_once "./config/conexao.php";
include_once "./func/func.php";
include_once "./config/constantes.php";

// Conectar ao banco de dados
$conexao = conectar();

// Verificar se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se o ID do carro foi recebido
    if (isset($_POST['idcarro'])) {
        $idcarro = $_POST['idcarro'];

        // Verificar a quantidade de investimento
        if (isset($_POST['quantidade_' . $idcarro]) && !empty($_POST['quantidade_' . $idcarro])) {
            $quantidade = $_POST['quantidade_' . $idcarro];

            // Verificar o método de pagamento selecionado
            if (isset($_POST['metodo_pagamento_' . $idcarro])) {
                $metodo_pagamento = $_POST['metodo_pagamento_' . $idcarro];

                // Obter o total investido atual do carro e o valor do carro
                $carro = buscarRegistro('carro', 'idcarro', $idcarro);
                $total_investido_atual = $carro->valor_investido;
                $valor_carro = $carro->valor;

                // Verificar se o método de pagamento é cartão de crédito
                if ($metodo_pagamento === 'cartao_credito') {
                    // Verificar se o código do cartão foi fornecido
                    if (isset($_POST['codigo_cartao_' . $idcarro]) && !empty($_POST['codigo_cartao_' . $idcarro])) {
                        $codigo_cartao = $_POST['codigo_cartao_' . $idcarro];

                        // Verificar se o código do cartão existe na tabela cartao
                        $cartao = buscarRegistro('cartao_credito', 'codigo_cartao', $codigo_cartao);
                        if ($cartao) {
                            // Verificar se o saldo do cartão é suficiente para o investimento
                            $saldo_cartao = $cartao->saldo;
                            $total_investimento = $valor_carro * $quantidade;
                            if ($saldo_cartao >= $total_investimento) {
                                // Atualizar o saldo do cartão
                                $novo_saldo_cartao = $saldo_cartao - $total_investimento;
                                $atualizar_cartao = atualizarRegistro('cartao_credito', 'saldo', $novo_saldo_cartao, 'codigo_cartao', $codigo_cartao);
                                if ($atualizar_cartao) {
                                    // Atualizar o total investido e saldo do carro na tabela carro
                                    $novo_total_investido = $total_investido_atual + $total_investimento;
                                    $atualizar_carro = atualizarRegistro('carro', 'valor_investido', $novo_total_investido, 'idcarro', $idcarro);
                                    if ($atualizar_carro) {
                                        // Inserir o registro do investimento na tabela investimento
                                        $dados_investimento = array(
                                            'idcarro' => $idcarro,
                                            'quantidade' => $quantidade,
                                            'metodo_pagamento' => $metodo_pagamento
                                        );
                                        $inserir_investimento = inserirRegistro('investimento', $dados_investimento);
                                        if ($inserir_investimento) {
                                            echo "Investimento realizado com sucesso.";
                                            header("location: index.php");
                                        } else {
                                            echo "Erro ao registrar o investimento.";
                                        }
                                    } else {
                                        echo "Erro ao atualizar o saldo do carro.";
                                    }
                                } else {
                                    echo "Erro ao atualizar o saldo do cartão.";
                                }
                            } else {
                                // Enviar mensagem de erro para carros.php
                                header("location: index.php?error=saldo_insuficiente&idcarro=$idcarro");
                            }
                        } else {
                            header("location: index.php?error=codigo_cartao_invalido&idcarro=$idcarro");
                        }
                    } else {
                        header("location: index.php?error=quantidade_invalida&idcarro=$idcarro");
                    }
                } else if ($metodo_pagamento === 'dinheiro') {
                    // Calcular o total investido e saldo do carro
                    $total_investimento = $valor_carro * $quantidade;
                    $novo_total_investido = $total_investido_atual + $total_investimento;

                    // Atualizar o total investido e saldo do carro na tabela carro
                    $atualizar_carro = atualizarRegistro('carro', 'valor_investido', $novo_total_investido, 'idcarro', $idcarro);
                    if ($atualizar_carro) {
                        // Inserir o registro do investimento na tabela investimento
                        $dados_investimento = array(
                            'idcarro' => $idcarro,
                            'quantidade' => $quantidade,
                            'metodo_pagamento' => $metodo_pagamento
                        );
                        $inserir_investimento = inserirRegistro('investimento', $dados_investimento);
                        if ($inserir_investimento) {
                            echo "Investimento realizado com sucesso.";
                            header("location: index.php");
                        } else {
                            echo "Erro ao registrar o investimento.";
                        }
                    } else {
                        echo "Erro ao atualizar o saldo do carro.";
                    }
                } else {
                    echo "Método de pagamento inválido.";
                }
            } else {
                echo "Por favor, selecione o método de pagamento.";
            }
        } else {
            header("location: index.php?error=quantidade_invalida&idcarro=$idcarro");
        }
    } else {
        echo "ID do carro não fornecido.";
    }
} else {
    echo "Método de requisição inválido.";
}
