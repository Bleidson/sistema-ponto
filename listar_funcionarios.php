<?php
include('includes/db.php');

// Buscando os funcionários cadastrados
$sql = "SELECT * FROM funcionarios ORDER BY id ASC";
$result = $conexao->query($sql);

$funcionarios = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $funcionarios[] = $row;
    }
}

echo json_encode($funcionarios);
?>
