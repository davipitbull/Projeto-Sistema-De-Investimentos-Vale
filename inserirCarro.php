<?php
session_start();
include_once "./config/conexao.php";
include_once "./config/constantes.php";
include_once "./func/func.php";

// Verifica se o usuário está autenticado
if (!isset($_SESSION['idadm'])) {
    header('location: login.php');
    exit(); // Encerra o script para evitar execução desnecessária
}

// Conecta ao banco de dados usando PDO
$conexao = conectar();

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST['Insnome'];
    $descricao = $_POST['Insdescricao'];

    // Verifica se uma imagem foi enviada
    if ($_FILES['Insimagem']['error'] == UPLOAD_ERR_OK) {
        // Diretório onde as imagens serão armazenadas
        $diretorio = 'img/';

        // Move a imagem para o diretório de destino
        $caminho_imagem = $diretorio . basename($_FILES['Insimagem']['name']);
        if (move_uploaded_file($_FILES['Insimagem']['tmp_name'], $caminho_imagem)) {
            // Pega apenas o nome do arquivo da imagem
            $nome_imagem = basename($_FILES['Insimagem']['name']);

            // Insere o registro no banco de dados com o nome da imagem
            $stmt = $conexao->prepare("INSERT INTO carro (nome, descricao, imagem) VALUES (:nome, :descricao, :imagem)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':imagem', $nome_imagem);

            if ($stmt->execute()) {
                // Redireciona para a página principal ou exibe uma mensagem de sucesso
                header('location: adm.php');
                exit(); // Encerra o script para evitar execução desnecessária
            } else {
                echo "Erro ao inserir registro no banco de dados.";
            }
        } else {
            echo "Erro ao mover o arquivo de imagem.";
        }
    } else {
        echo "Erro ao enviar a imagem.";
    }
}
?>
