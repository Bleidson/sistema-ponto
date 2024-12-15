function showForm(formType) {
    const formContainer = document.querySelector('.form-container');
    formContainer.innerHTML = ''; // Limpa o conteúdo atual do formulário

    if (formType === 'entrada') {
        // Exibe o formulário de entrada
        formContainer.innerHTML = `
            <h2>Registrar Entrada</h2>
            <form id="entradaForm">
                <label for="funcionario">Nome do Funcionário:</label>
                <select name="funcionario" id="funcionario">
                    <!-- As opções de funcionários serão carregadas aqui -->
                    <option value="1">Funcionário 1</option>
                    <option value="2">Funcionário 2</option>
                    <!-- Adicionar dinamicamente mais opções -->
                </select><br><br>

                <label for="horario_entrada">Horário de Entrada:</label>
                <input type="time" name="horario_entrada" id="horario_entrada" required><br><br>

                <button type="submit">Registrar Entrada</button>
            </form>
            <button onclick="openCaixa()">Abrir Caixa</button>
        `;
    } else if (formType === 'cadastrarFuncionario') {
        // Exibe o formulário de cadastrar funcionário
        formContainer.innerHTML = `
            <h2>Cadastrar Funcionário</h2>
            <form id="cadastroFuncionario">
                <label for="nome">Nome do Funcionário:</label>
                <input type="text" name="nome" id="nome" required><br><br>

                <label for="cpf">CPF:</label>
                <input type="text" name="cpf" id="cpf" required><br><br>

                <button type="submit">Cadastrar Funcionário</button>
            </form>
        `;
    } else if (formType === 'relatorios') {
        // Exibe a área de relatórios (acessível apenas para administradores)
        formContainer.innerHTML = `
            <h2>Relatórios</h2>
            <p>Acesso restrito para administradores. Por favor, insira a senha.</p>
            <form id="relatorioForm">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" required><br><br>
                <button type="submit">Acessar Relatórios</button>
            </form>
        `;
    } else if (formType === 'listaFuncionarios') {
        // Exibe a lista de funcionários
        fetch('listar.php')
            .then(response => response.text())
            .then(data => {
                formContainer.innerHTML = data;
            })
            .catch(error => {
                formContainer.innerHTML = '<p>Erro ao carregar a lista de funcionários.</p>';
            });
    }
}

// Função para abrir o caixa
function openCaixa() {
    alert("Caixa aberto com sucesso!");
    // Enviar dados para o banco de dados (exemplo, usando AJAX)
    // Atualizar a tela com o formulário de saída
    showForm('saida');
}
