<?php
// Incluindo a conexão com o banco de dados
include('includes/db.php');

// Buscando os funcionários cadastrados
$sql = "SELECT * FROM funcionarios ORDER BY id ASC";  // A consulta ordena os funcionários pelo ID de forma crescente
$result = $conexao->query($sql);

// Montando a tabela de funcionários diretamente no PHP
$tabelaFuncionarios = '';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tabelaFuncionarios .= '
            <tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['nome'] . '</td>
                <td>' . $row['cpf'] . '</td>
            </tr>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Ponto</title>
    
    <!-- Estilo CSS básico para garantir que o conteúdo seja exibido corretamente -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #sidebar {
            width: 200px;
            background-color: #2C3E50;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            padding: 20px;
        }

        #sidebar ul {
            list-style: none;
            padding: 0;
        }

        #sidebar ul li {
            margin-bottom: 10px;
        }

        #sidebar ul li a {
            color: white;
            text-decoration: none;
        }

        #main-content {
            margin-left: 220px; /* Para empurrar o conteúdo para a direita, fora do sidebar */
            padding: 20px;
            background-color: #ecf0f1;
            height: 100vh; /* Certificar-se que ocupa toda a altura da tela */
        }

        h1 {
            font-size: 24px;
            color: #34495e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #34495e;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #34495e;
            color: white;
        }
    </style>
 
 <script>
        // Função para alterar o conteúdo da parte principal
        function carregarConteudo(conteudo) {
            let mainContent = document.getElementById('main-content');

            if (conteudo === 'home') {
                mainContent.innerHTML = `
                    <h1>Bem-vindo ao Sistema de Ponto</h1>
                    <h2>Registrar Entrada</h2>
                    <form id="form-entrada">
                        <label for="entrada">Entrada:</label>
                        <input type="text" id="entrada" name="entrada" required><br><br>
                        <button type="submit">Registrar Entrada</button>
                    </form>
                    <h2>Registrar Saída</h2>
                    <form id="form-saida">
                        <label for="saida">Saída:</label>
                        <input type="text" id="saida" name="saida" required><br><br>
                        <button type="submit">Registrar Saída</button>
                    </form>
                    <div id="mensagem"></div> <!-- Área para mostrar mensagens -->
                `;

                // Função para registrar entrada
                document.getElementById('form-entrada').onsubmit = function(event) {
                    event.preventDefault(); // Previne o envio tradicional do formulário
                    let formData = new FormData(this); // Coleta os dados do formulário

                    // Envia os dados via fetch (AJAX)
                    fetch('registra_entrada.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        // Mostra a mensagem de sucesso ou erro no div mensagem
                        document.getElementById('mensagem').innerHTML = data;
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        document.getElementById('mensagem').innerHTML = "Erro ao registrar entrada.";
                    });
                }

                // Função para registrar saída
                document.getElementById('form-saida').onsubmit = function(event) {
                    event.preventDefault(); // Previne o envio tradicional do formulário
                    let formData = new FormData(this); // Coleta os dados do formulário

                    // Envia os dados via fetch (AJAX)
                    fetch('registrar_saida.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        // Mostra a mensagem de sucesso ou erro no div mensagem
                        document.getElementById('mensagem').innerHTML = data;
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        document.getElementById('mensagem').innerHTML = "Erro ao registrar saída.";
                    });
                }
            } else if (conteudo === 'cadastrar') {
                // Formulário de Cadastro de Funcionário
                mainContent.innerHTML = `
                    <h1>Cadastrar Funcionário</h1>
                    <form id="form-cadastrar-funcionario">
                        <label for="nome">Nome do Funcionário:</label>
                        <input type="text" name="nome" id="nome" required><br><br>

                        <label for="cpf">CPF:</label>
                        <input type="text" name="cpf" id="cpf" required><br><br>

                        <input type="submit" value="Cadastrar Funcionário">
                    </form>
                    <div id="mensagem"></div> <!-- Área para mostrar mensagens -->
                `;

                // Função para enviar o formulário via AJAX
                document.getElementById('form-cadastrar-funcionario').onsubmit = function(event) {
                    event.preventDefault(); // Previne o envio tradicional do formulário
                    let formData = new FormData(this); // Coleta os dados do formulário

                    // Envia os dados via fetch (AJAX)
                    fetch('cadastrar_funcionario.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        // Mostra a mensagem de sucesso ou erro no div mensagem
                        document.getElementById('mensagem').innerHTML = data;

                        // Limpa os campos do formulário
                        document.getElementById('nome').value = '';
                        document.getElementById('cpf').value = '';
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        document.getElementById('mensagem').innerHTML = "Erro ao cadastrar funcionário.";
                    });
                }
            } else if (conteudo === 'relatorios') {
                mainContent.innerHTML = `
                    <h1>Relatórios</h1>
                    <p>Relatórios serão exibidos aqui.</p>
                `;
            } else if (conteudo === 'listar') {
                // Exibir Lista de Funcionários
                mainContent.innerHTML = `
                    <h1>Funcionários Cadastrados</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>CPF</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $tabelaFuncionarios; ?>
                        </tbody>
                    </table>
                `;
            }
        }

        // Inicializa o conteúdo quando a página é carregada
        window.onload = function() {
            carregarConteudo('home'); // Exibe o conteúdo da "Home" ao carregar a página
        }
    </script>
</head>
<body>

    <!-- Barra Lateral com Menu -->
    <div id="sidebar">
        <h1>NovaTech Solutions</h1>
        <ul>
            <li><a href="javascript:void(0);" onclick="carregarConteudo('home')">Home</a></li>
            <li><a href="javascript:void(0);" onclick="carregarConteudo('listar')">Lista de Funcionários</a></li>
            <li><a href="javascript:void(0);" onclick="carregarConteudo('cadastrar')">Cadastrar Funcionário</a></li>
            <li><a href="javascript:void(0);" onclick="carregarConteudo('relatorios')">Relatórios</a></li>
        </ul>
        <footer>Criação por NovaTech Solutions</footer>
    </div>

    <!-- Parte Principal do Conteúdo -->
    <div id="main-content">
        <!-- O conteúdo será carregado aqui via JavaScript -->
    </div>

</body>
</html>