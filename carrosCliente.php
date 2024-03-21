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

$carros = listarTabela2("idcarro, nome, descricao, imagem, data_criacao, alteracao, ativo, valor_investido, valor", 'carro', 'idcarro', $whereClause);


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
        $valor = $carrosItem->valor;

?>
        <div class="col-sm-2 col-md-3 col-lg-4 p-5 text-center">
            <div class="card borda_card_solid" style="width: 100%; height: 100%;">
                <img src="img/<?php echo $imagem; ?>" class="card-img-top rounded-0" alt="<?php echo $imagem; ?>">
                <div class="card-body text-center" style="border-top: 10px solid #121516">
                    <h5 class="card-title" style="font-size: 20px">
                        <?php echo $nome; ?>
                    </h5>
                    <p class="card-text">
                        <?php echo $descricao; ?>
                    </p>
                    <p class="card-text">
                        Preço:
                        <?php echo $valor; ?>
                    </p>
                    <p class="card-text" style="font-size: 18px;color: green">
                        Valor já investido: <?php echo $valor_investido; ?>
                    </p>

                    <!-- Adicione o atributo data-* com os dados do carro -->
                    <button class="btn btn-sm btn-success btn-invest" data-car-id="<?php echo $idcarro; ?>" data-car-name="<?php echo $nome; ?>" data-car-description="<?php echo $descricao; ?>" data-car-image="<?php echo $imagem; ?>" data-car-value="<?php echo $valor; ?>">
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
            <div class="modal-header " style="background-color: #5E6A72">
                <h5 class="modal-title text-white" id="investModalLabel">Investir em Carro</h5>

            </div>
            <div class="modal-body" style="background-color: #363D45">
                <!-- Exibir imagem do carro -->
                <img src="" id="carImage" class="img-fluid mb-2 borda_card_solid " alt="Car Image">
                <!-- Formulário para inserir o valor do investimento -->
                <form id="investForm" action="processar_investimento.php" method="post">
                    <div class="form-group">
                        <label class="text-white" for="investmentAmount">Quantas vezes deseja comprar?</label>
                        <input type="number" style="background-color: #4A5057" class="form-control me-2 place_branco focus_branco text-white" id="Qinvestimento" placeholder="Insira a quantidade de vezes que deseja investir" name="Qinvestimento" required>
                        <p style="color: green;" class=""><span class="text-white">Saldo disponível:</span> <span style="color: greenyellow" class="linha_palavra">
                                <?php echo $saldo; ?>
                            </span></p>
                        <input type="hidden" name="idcarro" value="" class="carro-id-hidden">
                        <input type="hidden" name="car_value" value="" class="carro-id-valor">
                        <!-- Corrigido para enviar o valor do carro corretamente -->



                    </div>
            </div>
            <div class="modal-footer" style="background-color: #5E6A72">
                <button type="submit" class="btn btn-outline btn_buscar_2" style="border: 1px solid white;background-color: #5E6A72" id="investButton">Investir</button>
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


            var investmentAmount = parseFloat($('#Qinvestimento').val());
            var saldoDisponivel = parseFloat('<?php echo $saldo; ?>'); // Obtém o saldo disponível do PHP
            var Valor = parseFloat($('#car_value').val());
            if (isNaN(investmentAmount) || investmentAmount <= 0) {
                alert('Por favor, insira um valor de investimento válido.');
                event.preventDefault(); // Evitar o envio do formulário
                return;
            }

            if (investmentAmount * Valor > saldoDisponivel) {
                alert('Saldo insuficiente para realizar o investimento.');
                event.preventDefault(); // Evitar o envio do formulário
                return false; // Impedir o evento padrão do botão
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
            var carValue = $(this).data('car-value');

            // Defina o ID do carro no campo de entrada invisível
            $('.carro-id-hidden').val(carId);
            $('.carro-id-valor').val(carValue);

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