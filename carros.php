<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";

// Conectar ao banco de dados
$return = conectar();

// Verificar se o parâmetro de pesquisa está definido
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Construir a cláusula WHERE com base no parâmetro de pesquisa
$whereClause = "";
if (!empty($search)) {
    $whereClause = " WHERE nome LIKE '%$search%' OR descricao LIKE '%$search%'";
}

if (isset($_GET['error']) and isset($_GET['idcarro'])) {
    $error = $_GET['error'];
    $idcarro = $_GET['idcarro'];
    if ($error === 'saldo_insuficiente') {
        echo "<div id='error-message' class='alert alert-danger' role='alert'>Saldo insuficiente no cartão de crédito para investir neste carro. ID do carro: $idcarro</div>";
    } elseif ($error === 'codigo_cartao_invalido') {
        echo "<div id='error-message' class='alert alert-danger' role='alert'>Código do cartão de crédito inválido. ID do carro: $idcarro</div>";
    } elseif ($error === 'quantidade_invalida') {
        echo "<div id='error-message' class='alert alert-danger' role='alert'>Quantidade de investimento inválida. ID do carro: $idcarro</div>";
    } elseif ($error === 'metodo_pagamento_invalido') {
        echo "<div id='error-message' class='alert alert-danger' role='alert'>Método de pagamento inválido. ID do carro: $idcarro</div>";
    }
}

// Listar os carros com base na cláusula WHERE
$carros = listarTabela2("idcarro, nome, descricao, imagem, data_criacao, alteracao, ativo, valor_investido, valor", 'carro', 'idcarro', $whereClause);
?>

<!-- Estrutura HTML para exibir os detalhes do carro -->


<?php
if (is_array($carros) && count($carros) > 0) {
 foreach ($carros as $carro) { 
    ?>
    <div class="col-sm-4 col-md-4 col-lg-3 p-3">
        <div class="card borda_card_solid" style="width: 100%; height: 100%;">
            <?php
            $idcarro = $carro->idcarro;
            $nome = $carro->nome;
            $descricao = $carro->descricao;
            $imagem = $carro->imagem;
            $valor_investido = $carro->valor_investido;
            $valor = $carro->valor;
            ?>
            <img src="img/<?php echo $imagem; ?>" class="card-img-top" alt="<?php echo $imagem; ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo $nome; ?></h5>
                <p class="card-text"><?php echo $descricao; ?></p>
                <p class="card-text">Valor: <?php echo $valor; ?></p>

                <p class="card-text" style="color: green">Valor já investido: <?php echo $valor_investido; ?></p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalInvestimento<?php echo $idcarro; ?>">
                    Investir
                </button>
            </div>
        </div>
    </div>

    <!-- Modal de Investimento -->
    <div class="modal fade" id="modalInvestimento<?php echo $idcarro; ?>" tabindex="-1" aria-labelledby="modalInvestimentoLabel<?php echo $idcarro; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalInvestimentoLabel<?php echo $idcarro; ?>">Investir em <?php echo $nome; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formInvestimento_<?php echo $idcarro; ?>" action="processar_investimento_index.php" method="post">
                        <input type="hidden" name="idcarro" value="<?php echo $idcarro; ?>">
                        <div class="mb-3">
                            <label for="quantidade_<?php echo $idcarro; ?>">Quantidade de Investimento:</label>
                            <input type="number" class="form-control" id="quantidade_<?php echo $idcarro; ?>" name="quantidade_<?php echo $idcarro; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="metodo_pagamento_<?php echo $idcarro; ?>">Método de Pagamento:</label>
                            <select class="form-control" id="metodo_pagamento_<?php echo $idcarro; ?>" name="metodo_pagamento_<?php echo $idcarro; ?>" onchange="toggleCartaoCredito(<?php echo $idcarro; ?>)">
                                <option value="cartao_credito" selected>Cartão de Crédito</option>
                                <option value="dinheiro">Dinheiro</option>
                            </select>
                        </div>

                        <div id="cartao_credito_<?php echo $idcarro; ?>" class="cartao_credito">
                            <div class="mb-3">
                                <label for="codigo_cartao_<?php echo $idcarro; ?>">Código do Cartão de Crédito:</label>
                                <input type="text" class="form-control" id="codigo_cartao_<?php echo $idcarro; ?>" name="codigo_cartao_<?php echo $idcarro; ?>">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php }} else {
    echo '<h1 class="text-white">Sem Resultados</h1>';
} ?>

<script>
    setTimeout(function() {
        var errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            errorMessage.remove();
        }
    }, 4000); // Tempo em milissegundos (5 segundos)



    // Função para mostrar ou ocultar o campo do código do cartão de crédito
    function toggleCartaoCredito(idcarro) {
        var metodoPagamento = document.getElementById('metodo_pagamento_' + idcarro).value;
        var cartaoCredito = document.getElementById('cartao_credito_' + idcarro);
        if (metodoPagamento === 'cartao_credito') {
            cartaoCredito.style.display = 'block';
        } else {
            cartaoCredito.style.display = 'none';
        }
    }

    // Adiciona um listener para cada modal de investimento
    <?php foreach ($carros as $carro) { ?>
        var idcarro = <?php echo $carro->idcarro; ?>;
        document.getElementById('formInvestimento_<?php echo $idcarro; ?>').addEventListener('change', function() {
            toggleCartaoCredito(<?php echo $idcarro; ?>);
        });
    <?php } ?>
</script>