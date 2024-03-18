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
                    <!-- Passando os valores corretos para a função abrirModal() -->
                    <form action="excluirCarro.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $idcarro ?>">

                        <button class="btn btn-primary btn-sm" type="button" onclick="abrirModal(<?php echo $idcarro ?>, '<?php echo $nome ?>', '<?php echo $descricao ?>', '<?php echo $ativo ?>')">Editar</button>
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </div>

            </div>
        </div>
<?php
    }
} else {
    echo '<h1>Sem Resultados</h1>';
}
?>

<!-- Modal de Edição -->
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarModalLabel">Editar Registro</h5>
            </div>
            <div class="modal-body">
                <form action="editCarros.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="editId">
                    <label for="editNome">Nome:</label>
                    <input type="text" id="editNome" name="editNome" class="form-control">

                    <label for="editDescricao">Descrição:</label>
                    <input type="text" id="editDescricao" name="editDescricao" class="form-control">

                    <label for="editImagem">Imagem:</label>
                    <input type="file" id="editImagem" name="editImagem" class="form-control">



                    <label for="editAtivo">Ativo:</label>
                    <input type="text" id="editAtivo" name="editAtivo" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="salvarEdicao()">Salvar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function abrirModal(id, nome, descricao, ativo) {
        // Preenche os campos da modal com os valores atuais do registro
        document.getElementById('editId').value = id;
        document.getElementById('editNome').value = nome;
        document.getElementById('editDescricao').value = descricao;

        document.getElementById('editAtivo').value = ativo;

        // Abre a modal
        $('#editarModal').modal('show');
    }

    function salvarEdicao() {
        // Aqui você pode obter os valores editados e realizar a lógica de atualização no banco de dados
        // Exemplo de obtenção de valores (ajuste conforme necessário)
        var novoNome = document.getElementById('editNome').value;
        var novoDescricao = document.getElementById('editDescricao').value;

        var novoAtivo = document.getElementById('editAtivo').value;

        // Lógica para salvar as alterações (AJAX, formulário, etc.)
        // ...

        // Fecha a modal após salvar
        $('#editarModal').modal('hide');
    }
</script>