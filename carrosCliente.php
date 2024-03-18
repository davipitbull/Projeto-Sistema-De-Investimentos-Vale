<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";
$return = conectar();

$search = isset($_GET['search']) ? $_GET['search'] : '';
$whereClause = "";

if (!empty($search)) {
    // Se houver um termo de pesquisa, adicione uma cláusula WHERE na consulta SQL
    $whereClause = "WHERE nome LIKE '%$search%' OR descricao LIKE '%$search%'";
}

$carros = listarTabela2("idcarro, nome, descricao, imagem, data_criacao, alteracao, ativo, valor_investido", 'carro', 'idcarro', $whereClause);


// Verifica se $carros é um array antes de usar o loop foreach
if (is_array($carros) && count($carros) > 0) {
    foreach ($carros as $carrosItem) {
        $idcarro = $carrosItem->idcarro;
        $nome = $carrosItem->nome;
        $descricao = $carrosItem->descricao;
        $imagem = $carrosItem->imagem;
        $data_criacao = $carrosItem->data_criacao;
        $alteracao = $carrosItem->alteracao;
        $ativo = $carrosItem->ativo;
        $valor_investido = $carrosItem->valor_investido;
?>
        <div class="col-sm-2 col-md-3 col-lg-4 p-5 text-center">
            <div class="card" style="width: 100%; height: 100%;">
                <img src="img/<?php echo $imagem; ?>" class="card-img-top" alt="<?php echo $imagem; ?>">
                <div class="card-body text-center ">
                    <h5 class="card-title">
                        <?php echo $nome; ?>
                    </h5>
                    <p class="card-text">
                        <?php echo $descricao; ?>
                    </p>
                    <p class="card-text">
                        Valor já investido: <?php echo $valor_investido; ?>
                    </p>

                    <!-- Adicione o atributo data-* com os dados do carro -->
                    <button class="btn btn-sm btn-success btn-invest" data-car-id="<?php echo $idcarro; ?>" data-car-name="<?php echo $nome; ?>" data-car-description="<?php echo $descricao; ?>" data-car-image="<?php echo $imagem; ?>">
                        Investir
                    </button>

                </div>
            </div>
        </div>
<?php
    }
} else {
    echo '<h1>Sem Resultados</h1>';
}
?>

<!-- Modal de Investimento -->
<div class="modal fade" id="investModal" tabindex="-1" role="dialog" aria-labelledby="investModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="investModalLabel">Investir em Carro</h5>

            </div>
            <div class="modal-body">
                <!-- Exibir imagem do carro -->
                <img src="" id="carImage" class="img-fluid mb-2" alt="Car Image">
                <!-- Formulário para inserir o valor do investimento -->
                <form id="investForm" action="processar_investimento.php" method="post">
                    <div class="form-group">
                        <label for="investmentAmount">Valor do Investimento:</label>
                        <input type="number" class="form-control" id="investimento" placeholder="Insira o valor a investir" name="investimento" required>
                        <p style="color: green;" class="">Saldo disponível: <?php echo $saldo; ?></p>
                        <input type="hidden" name="idcarro" value="" class="carro-id-hidden">



                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" id="investButton">Investir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
    // Função para processar o investimento
    $('#investButton').click(function(event) {
        // Evitar o envio do formulário se o campo de investimento estiver vazio


        // Lógica para processar o investimento
        var investmentAmount = parseFloat($('#investimento').val());
        var saldoDisponivel = parseFloat('<?php echo $saldo; ?>'); // Obtém o saldo disponível do PHP
        if (isNaN(investmentAmount) || investmentAmount <= 0) {
            alert('Por favor, insira um valor de investimento válido.');
            event.preventDefault(); // Evitar o envio do formulário
            return;
        }

        // Verificar se o saldo é suficiente
        if (investmentAmount > saldoDisponivel) {
            alert('Saldo insuficiente para realizar o investimento.');
            event.preventDefault(); // Evitar o envio do formulário
            return;
        }

        // Se todas as validações passarem, o formulário será enviado normalmente
    });
});

    

    



    $(document).ready(function() {
        // Função para abrir a modal de investimento e preencher informações
        $('.btn-invest').click(function() {
            // Preencher informações do carro
            var carId = $(this).data('car-id');
            var carName = $(this).data('car-name');
            var carDescription = $(this).data('car-description');
            var carImage = $(this).data('car-image');

            // Defina o ID do carro no campo de entrada invisível
            $('.carro-id-hidden').val(carId);

            // Exibir informações na modal
            $('#carImage').attr('src', 'img/' + carImage);

            // Abrir a modal de investimento
            $('#investModal').modal('show');
        });

        // Função para processar o investimento
        $('#investButton').click(function() {
            var investmentAmount = $('#investimento').val();
            // Lógica para processar o investimento
            // ...
        });
    });


</script>