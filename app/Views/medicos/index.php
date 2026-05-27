<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Médicos - Projeto 2</title>
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
        }
        .msg {
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .sucesso { background: var(--success); color: white; }
        .erro { background: var(--danger); color: white; }
        .actions {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }
        .actions input {
            flex: 1;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        .btn {
            padding: 10px 18px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }
        .btn:hover { background: #357abd; }
        .btn-danger { background: var(--danger); }
        .btn-danger:hover { background: #b52a3a; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 14px;
            text-align: left;
        }
        table th {
            background: var(--primary);
            color: white;
        }
        table tr:nth-child(even) { background: #f9f9f9; }
        table tr:hover { background: #eef4fb; }
        .footer-actions {
            margin-top: 20px;
            text-align: center;
        }
    </style>
    <script>
        function filtrarMedicos() {
            const termo = document.getElementById('busca').value.toLowerCase();
            const linhas = document.querySelectorAll('#tabelaMedicos tbody tr');
            linhas.forEach(linha => {
                const textoLinha = linha.textContent.toLowerCase();
                linha.style.display = textoLinha.includes(termo) ? '' : 'none';
            });
        }
    </script>
</head>
<body>
    <header>Projeto 2 - Christopher Gomes</header>
    <div class="container">
        <h2>Gerenciamento de Médicos</h2>

        <?php if (!empty($_SESSION['sucesso'])): ?>
            <div class="msg sucesso"><?= $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?></div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['erro'])): ?>
            <div class="msg erro"><?= $_SESSION['erro']; unset($_SESSION['erro']); ?></div>
        <?php endif; ?>

        <div class="actions">
            <input type="text" id="busca" placeholder="Buscar médico..." onkeyup="filtrarMedicos()">
            <a class="btn" href="/projeto02/public/index.php?controller=Medicos&action=create">+ Novo Médico</a>
        </div>

        <table id="tabelaMedicos">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Especialidade</th>
                    <th>CRM</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($medicos as $m): ?>
                <tr>
                    <td><?= htmlspecialchars($m['nome']) ?></td>
                    <td><?= htmlspecialchars($m['especialidade']) ?></td>
                    <td><?= htmlspecialchars($m['crm']) ?></td>
                    <td>
                        <a class="btn" href="/projeto02/public/index.php?controller=Medicos&action=edit&id=<?= $m['id'] ?>">Editar</a>
                        <a class="btn btn-danger" href="/projeto02/public/index.php?controller=Medicos&action=delete&id=<?= $m['id'] ?>">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="footer-actions">
            <a class="btn" href="/projeto02/public/index.php?controller=Dashboard&action=index">← Voltar ao Dashboard</a>
        </div>
    </div>
</body>
</html>