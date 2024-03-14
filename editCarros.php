<?php
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";

// Conecta ao banco de dados usando PDO
$conexao = conectar();

// Verifica se a conexão foi estabelecida corretamente
if (!$conexao) {
    echo "Erro ao conectar ao banco de dados.";
    exit();
}

// Verifica se o ID foi enviado via POST
if (isset($_POST['id'])) {
    try {
        // Obtém os dados do formulário
        $id = $_POST['id'];
        $editNome = $_POST['editNome'];
        $editDescricao = $_POST['editDescricao'];
        $editImagem = $_POST['editImagem'];
        $editCadastro = $_POST['editCadastro'];
        $editAlteracao = $_POST['editAlteracao'];
        $editAtivo = $_POST['editAtivo'];

        // Prepara a consulta SQL para atualização
        $query = "UPDATE carro SET nome = :nome, descricao = :descricao, imagem = :imagem, data_criacao = :cadastro, alteracao = :alteracao, ativo = :ativo WHERE idcarro = :id";
        $stmt = $conexao->prepare($query);

        // Executa a consulta com os parâmetros vinculados
        $stmt->bindParam(':nome', $editNome);
        $stmt->bindParam(':descricao', $editDescricao);
        $stmt->bindParam(':imagem', $editImagem);
        $stmt->bindParam(':cadastro', $editCadastro);
        $stmt->bindParam(':alteracao', $editAlteracao);
        $stmt->bindParam(':ativo', $editAtivo);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        // Redireciona para a página anterior ou exibe uma mensagem de sucesso
        header("Location: adm.php");
        exit();
    } catch (PDOException $e) {
        // Em caso de erro, redireciona com uma mensagem de erro
        header("Location: adm.php?erro=1");
        exit();
    }
} else {
    // Se o ID não foi enviado, redireciona para a página anterior
    header("Location: adm.php");
    exit();
}
?>