<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Médico - Projeto 2</title>
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
        .box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            max-width: 500px;
            text-align: center;
        }
        h1 {
            color: var(--danger);
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 20px;
            font-size: 16px;
        }
        .btn {
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            margin: 5px;
            display: inline-block;
        }
        .btn-danger {
            background: var(--danger);
            color: white;
        }
        .btn-danger:hover { background: #b52a3a; }
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        .btn-secondary:hover { background: #5a6268; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Excluir Médico</h1>
        <p>Tem certeza que deseja excluir o médico <strong><?= htmlspecialchars($medico['nome']) ?></strong> (CRM: <?= htmlspecialchars($medico['crm']) ?>)?</p>

        <form method="post" action="/projeto02/public/index.php?controller=Medicos&action=delete">
            <input type="hidden" name="id" value="<?= htmlspecialchars($medico['id']) ?>">
            <button type="submit" class="btn btn-danger">Sim, excluir</button>
            <a href="/projeto02/public/index.php?controller=Medicos&action=index" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>