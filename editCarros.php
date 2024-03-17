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
        $editAtivo = $_POST['editAtivo'];

        // Verifica se uma nova imagem foi enviada
        $nome_imagem = null;
        if (isset($_FILES['editImagem']) && $_FILES['editImagem']['error'] == UPLOAD_ERR_OK) {
            // Diretório onde as imagens são armazenadas
            $diretorio = 'img/';

            // Move a imagem para o diretório de destino
            $caminho_imagem = $diretorio . basename($_FILES['editImagem']['name']);
            if (move_uploaded_file($_FILES['editImagem']['tmp_name'], $caminho_imagem)) {
                // Pega apenas o nome do arquivo da imagem
                $nome_imagem = basename($_FILES['editImagem']['name']);
            } else {
                echo "Erro ao mover o arquivo de imagem.";
                exit();
            }
        }

        // Prepara a consulta SQL para atualização
        if ($nome_imagem) {
            $query = "UPDATE carro SET nome = :nome, descricao = :descricao, imagem = :imagem, ativo = :ativo WHERE idcarro = :id";
        } else {
            $query = "UPDATE carro SET nome = :nome, descricao = :descricao, ativo = :ativo WHERE idcarro = :id";
        }
        $stmt = $conexao->prepare($query);

        // Executa a consulta com os parâmetros vinculados
        $stmt->bindParam(':nome', $editNome);
        $stmt->bindParam(':descricao', $editDescricao);
        $stmt->bindParam(':ativo', $editAtivo);
        $stmt->bindParam(':id', $id);
        if ($nome_imagem) {
            $stmt->bindParam(':imagem', $nome_imagem);
        }

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
