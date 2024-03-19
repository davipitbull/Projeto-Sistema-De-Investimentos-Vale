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
        <div class="col-sm-2 col-md-3 col-lg-4 p-5 text-center ">
            <div class="card borda_card_solid " style="width: 100%; height: 100%;">
                <img src="img/<?php echo $imagem; ?>" class="card-img-top rounded-0" alt="<?php echo $imagem; ?>">
                <div class="card-body text-center" style="border-top: 10px solid #121516">
                    <h5 class="card-title" style="font-size: 20px">
                       <b>
                           <?php echo $nome; ?>
                       </b>
                    </h5>
                    <p class="card-text" style="font-size: 18px">
                        <?php echo $descricao; ?>
                    </p>
                    <p class="card-text" style="font-size: 18px;color: green">
                        Valor já investido: <?php echo $valor_investido; ?>
                    </p>
                    <!-- Passando os valores corretos para a função abrirModal() -->
                </div>

            </div>
        </div>
<?php
    }
} else {
    echo '<h1>Sem Resultados</h1>';
}
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>