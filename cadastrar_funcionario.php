<?php
// Incluindo a conexão com o banco de dados
include('includes/db.php');

// Verificando se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coletando dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];

    // Validando os dados (simples)
    if (empty($nome) || empty($cpf)) {
        echo "Por favor, preencha todos os campos.";
    } else {
        // Inserindo os dados no banco
        $sql = "INSERT INTO funcionarios (nome, cpf) VALUES ('$nome', '$cpf')";

        if ($conexao->query($sql) === TRUE) {
            echo "Funcionário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar funcionário: " . $conexao->error;
        }
    }
}
?>
