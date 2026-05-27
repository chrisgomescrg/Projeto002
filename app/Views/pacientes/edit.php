<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Paciente - Projeto 2</title>
    <style>
        :root {
            --primary: #4a90e2;
            --secondary: #f5f7fa;
            --danger: #dc3545;
            --text: #333;
        }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            background: var(--secondary);
            color: var(--text);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        .form-box h1 {
            margin-bottom: 20px;
            color: var(--primary);
            font-size: 26px;
            font-weight: bold;
        }
        label {
            display: block;
            text-align: left;
            margin: 8px 0 4px;
            font-weight: 600;
            color: var(--text);
        }
        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
        }
        button:disabled {
            background: #999;
            cursor: not-allowed;
        }
        button:hover:enabled { background: #357abd; }
        .error {
            background: #f8d7da;
            color: var(--danger);
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-weight: 500;
        }
        footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
        .back-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 18px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: background 0.2s ease;
        }
        .back-btn:hover { background: #5a6268; }
    </style>
    <script>
        function validarFormulario() {
            const nome = document.querySelector('[name="nome"]').value.trim();
            const cpf = document.querySelector('[name="cpf"]').value.trim();
            const telefone = document.querySelector('[name="telefone"]').value.trim();
            const email = document.querySelector('[name="email"]').value.trim();
            const data = document.querySelector('[name="data_nascimento"]').value.trim();

            const botao = document.getElementById('btnSalvar');

            const cpfValido = cpf.length === 14; // formato 000.000.000-00
            const telefoneValido = telefone.length >= 8;
            const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

            if (nome && cpfValido && telefoneValido && emailValido && data) {
                botao.disabled = false;
            } else {
                botao.disabled = true;
            }
        }
    </script>
</head>
<body>
    <div class="form-box">
        <h1>Editar Paciente</h1>

        <?php if (!empty($_SESSION['erro'])): ?>
            <div class="error"><?= htmlspecialchars($_SESSION['erro']) ?></div>
            <?php unset($_SESSION['erro']); ?>
        <?php endif; ?>

        <form method="post" action="/projeto02/public/index.php?controller=Pacientes&action=edit" oninput="validarFormulario()">
            <input type="hidden" name="id" value="<?= htmlspecialchars($paciente['id']) ?>">

            <label for="nome">Nome completo</label>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($paciente['nome']) ?>" required>

            <label for="cpf">CPF</label>
            <input type="text" name="cpf" id="cpf" value="<?= htmlspecialchars($paciente['cpf']) ?>" required>

            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone" value="<?= htmlspecialchars($paciente['telefone']) ?>" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($paciente['email']) ?>" required>

            <label for="data_nascimento">Data de nascimento</label>
            <input type="date" name="data_nascimento" id="data_nascimento" value="<?= htmlspecialchars($paciente['data_nascimento']) ?>" required>

            <button type="submit" id="btnSalvar" disabled>Salvar Alterações</button>
        </form>

        <a class="back-btn" href="/projeto02/public/index.php?controller=Pacientes&action=index">← Voltar</a>

        <footer>&copy; <?= date("Y") ?> Projeto 2 - Christopher Gomes</footer>
    </div>
</body>
</html>