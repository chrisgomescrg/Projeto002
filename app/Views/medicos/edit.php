<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Médico - Projeto 2</title>
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
            width: 100%;
        }
        h1 {
            color: var(--primary);
            margin-bottom: 20px;
            text-align: center;
        }
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }
        form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        .btn {
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            margin: 5px;
            display: inline-block;
            text-align: center;
        }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: #357abd; }
        .btn-secondary { background: #6c757d; color: white; }
        .btn-secondary:hover { background: #5a6268; }
        .msg { padding:10px; border-radius:8px; margin-bottom:15px; }
        .erro { background:#dc3545; color:white; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Editar Médico</h1>

        <?php if (!empty($_SESSION['erro'])): ?>
            <div class="msg erro"><?= $_SESSION['erro']; unset($_SESSION['erro']); ?></div>
        <?php endif; ?>

        <form method="post" action="/projeto02/public/index.php?controller=Medicos&action=edit">
            <input type="hidden" name="id" value="<?= htmlspecialchars($medico['id']) ?>">

            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($medico['nome']) ?>" required>

            <label for="especialidade">Especialidade</label>
            <input type="text" id="especialidade" name="especialidade" value="<?= htmlspecialchars($medico['especialidade']) ?>" required>

            <label for="crm">CRM</label>
            <input type="text" id="crm" name="crm" value="<?= htmlspecialchars($medico['crm']) ?>" required>

            <div style="text-align:center;">
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="/projeto02/public/index.php?controller=Medicos&action=index" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>