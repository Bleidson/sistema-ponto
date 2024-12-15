<?php
include('includes/db.php');

// Verificando se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $registro_ponto_id = $_POST['registro_ponto_id'];  // O ID do registro de entrada
    $valor_final_caixa = $_POST['valor_final_caixa'];
    $horario_saida = $_POST['horario_saida'];

    // Atualizando o registro de saída no banco de dados
    $sql = "UPDATE registro_ponto SET tipo = 'saida', valor_final_caixa = '$valor_final_caixa', horario_saida = '$horario_saida' WHERE id = '$registro_ponto_id'";

    if ($conexao->query($sql) === TRUE) {
        echo "Saída registrada com sucesso!";
    } else {
        echo "Erro ao registrar saída: " . $conexao->error;
    }
}
?>
