<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuários - Projeto 2</title>
    <style>
        :root {
            --primary: #4a90e2;
            --secondary: #f5f7fa;
            --success: #28a745;
            --danger: #dc3545;
            --text: #333;
        }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            background: var(--secondary);
            color: var(--text);
        }
        header {
            background: var(--primary);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 20px;
            color: var(--primary);
            font-size: 22px;
            font-weight: 600;
        }
        .messages { margin-bottom: 20px; }
        .messages p {
            padding: 12px;
            border-radius: 8px;
            font-weight: 500;
        }
        .messages .error { background: #f8d7da; color: var(--danger); }
        .messages .success { background: #d4edda; color: var(--success); }
        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }
        .actions input {
            flex: 1;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }
        .btn {
            padding: 10px 18px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: background 0.2s ease;
        }
        .btn:hover { background: #357abd; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th, table td {
            padding: 14px;
            text-align: left;
        }
        table th {
            background: var(--primary);
            color: white;
            font-weight: 600;
        }
        table tr:nth-child(even) { background: #f9f9f9; }
        table tr:hover { background: #eef4fb; }
        .footer-actions {
            margin-top: 20px;
            text-align: center;
        }
        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
    </style>
    <script>
        function filtrarUsuarios() {
            const termo = document.getElementById('busca').value.toLowerCase();
            const linhas = document.querySelectorAll('#tabelaUsuarios tbody tr');

            linhas.forEach(linha => {
                const nome = linha.querySelector('td:nth-child(1)').textContent.toLowerCase();
                const email = linha.querySelector('td:nth-child(2)').textContent.toLowerCase();

                if (nome.includes(termo) || email.includes(termo)) {
                    linha.style.display = '';
                } else {
                    linha.style.display = 'none';
                }
            });
        }
    </script>
</head>
<body>
    <header>Projeto 2 - Christopher Gomes</header>
    <div class="container">
        <h2>Gerenciamento de Usuários</h2>

        <div class="messages">
            <?php if (!empty($_SESSION['erro'])): ?>
                <p class="error"><?= htmlspecialchars($_SESSION['erro']) ?></p>
                <?php unset($_SESSION['erro']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['sucesso'])): ?>
                <p class="success"><?= htmlspecialchars($_SESSION['sucesso']) ?></p>
                <?php unset($_SESSION['sucesso']); ?>
            <?php endif; ?>
        </div>

        <div class="actions">
            <input type="text" id="busca" placeholder="Buscar por nome ou email..." onkeyup="filtrarUsuarios()">
            <a class="btn" href="/projeto02/public/index.php?controller=Usuarios&action=create">+ Novo Usuário</a>
        </div>

        <table id="tabelaUsuarios">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u['nome']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td>
                        <a class="btn" href="/projeto02/public/index.php?controller=Usuarios&action=edit&id=<?= $u['id'] ?>">Editar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="footer-actions">
            <a class="btn" href="/projeto02/public/index.php?controller=Dashboard&action=index">← Voltar ao Dashboard</a>
        </div>

        <footer>&copy; <?= date("Y") ?> Projeto 2 - Christopher Gomes</footer>
    </div>
</body>
</html>