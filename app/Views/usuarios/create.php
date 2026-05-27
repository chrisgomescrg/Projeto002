<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário - Projeto 2</title>
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
            max-width: 450px;
            text-align: center;
        }
        .form-box h1 {
            margin-bottom: 20px;
            color: var(--primary);
            font-size: 26px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
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
        button:hover { background: #357abd; }
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
</head>
<body>
    <div class="form-box">
        <h1>Cadastrar Usuário</h1>

        <?php if (!empty($_SESSION['erro'])): ?>
            <div class="error"><?= htmlspecialchars($_SESSION['erro']) ?></div>
            <?php unset($_SESSION['erro']); ?>
        <?php endif; ?>

        <form method="post" action="/projeto02/public/index.php?controller=Usuarios&action=create">
            <input type="text" name="nome" placeholder="Digite o nome completo" required>
            <input type="email" name="email" placeholder="Digite o email" required>
            <input type="password" name="senha" placeholder="Digite a senha" required>
            <button type="submit">Cadastrar</button>
        </form>

        <a class="back-btn" href="/projeto02/public/index.php?controller=Usuarios&action=index">← Voltar</a>

        <footer>&copy; <?= date("Y") ?> Projeto 2 - Christopher Gomes</footer>
    </div>
</body>
</html>