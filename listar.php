<?php
// Incluindo a conexão com o banco de dados
include('includes/db.php');

// Buscando os funcionários cadastrados
$sql = "SELECT * FROM funcionarios ORDER BY id ASC";  // A consulta ordena os funcionários pelo ID de forma crescente
$result = $conexao->query($sql);

// Fechando a conexão com o banco
$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Funcionários</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Lista de Funcionários</h1>

    <!-- Tabela para exibir os funcionários cadastrados -->
    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['cpf']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum funcionário cadastrado.</p>
    <?php endif; ?>

</body>
</html>
