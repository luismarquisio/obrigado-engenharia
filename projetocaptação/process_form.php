<?php
// Configurações do banco de dados
$servername = "localhost"; // Altere para o seu servidor
$username = "root";        // Altere para o seu usuário
$password = "";            // Altere para sua senha
$dbname = "engenharia_saude"; // Nome do banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Definir charset para UTF-8
$conn->set_charset("utf8");

// Obter dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$whatsapp = $_POST['whatsapp'];
$data_cadastro = date('Y-m-d H:i:s');

// Preparar e executar a query SQL
$stmt = $conn->prepare("INSERT INTO leads (nome, email, whatsapp, data_cadastro) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nome, $email, $whatsapp, $data_cadastro);

// Verificar se os dados foram salvos com sucesso
if ($stmt->execute()) {
    // Redirecionar para uma página de agradecimento
    header("Location: obrigado.html");
    exit();
} else {
    echo "Erro ao salvar os dados: " . $stmt->error;
}

// Fechar conexão
$stmt->close();
$conn->close();
?>