<?php
include('includes/db.php');

// Verificando se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $funcionario_id = $_POST['funcionario_id'];
    $valor_inicial_caixa = $_POST['valor_inicial_caixa'];
    $data_registro = $_POST['data_registro'];

    // Inserindo o registro de entrada no banco de dados
    $sql = "INSERT INTO registro_ponto (funcionario_id, tipo, valor_inicial_caixa, data_registro) VALUES ('$funcionario_id', 'entrada', '$valor_inicial_caixa', '$data_registro')";

    if ($conexao->query($sql) === TRUE) {
        echo "Entrada registrada com sucesso! Agora, registre a saída.";
    } else {
        echo "Erro ao registrar entrada: " . $conexao->error;
    }
}
?>
