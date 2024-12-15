<?php
// Incluindo a conexão com o banco de dados
include('includes/db.php');

// Consultando todos os registros da tabela registro_ponto
$sql = "SELECT * FROM registro_ponto ORDER BY data_registro DESC";
$result = $conexao->query($sql);

if ($result->num_rows > 0) {
    echo '<h2>Registros de Ponto</h2>';
    echo '<table>';
    echo '<tr>
            <th>ID</th>
            <th>ID Funcionário</th>
            <th>Horário Entrada</th>
            <th>Horário Saída</th>
            <th>Valor Inicial Caixa</th>
            <th>Valor Final Caixa</th>
            <th>Horas Trabalhadas</th>
            <th>Data Registro</th>
          </tr>';
    // Exibindo cada registro na tabela
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['funcionario_id'] . '</td>';
        echo '<td>' . $row['horario_entrada'] . '</td>';
        echo '<td>' . $row['horario_saida'] . '</td>';
        echo '<td>' . $row['valor_inicial_caixa'] . '</td>';
        echo '<td>' . $row['valor_final_caixa'] . '</td>';
        echo '<td>' . $row['horas_trabalhadas'] . '</td>';
        echo '<td>' . $row['data_registro'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'Nenhum registro encontrado.';
}
?>
