<?php
// Arquivo de conexão com o banco de dados

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "sistema_ponto";

// Cria a conexão
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verifica se houve erro na conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
?>
