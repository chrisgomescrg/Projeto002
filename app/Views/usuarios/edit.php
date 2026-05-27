<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <style>
        body { font-family:'Segoe UI', Arial; margin:0; background:#f4f6f9; }
        header { background:#0069d9; color:white; padding:20px; text-align:center; }
        .container { max-width:500px; margin:40px auto; background:white; padding:30px; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1); }
        h2 { color:#0069d9; margin-bottom:20px; text-align:center; }
        input { width:100%; padding:12px; margin:10px 0; border:1px solid #ccc; border-radius:6px; }
        button { width:100%; padding:12px; background:#ffc107; color:white; border:none; border-radius:6px; font-size:16px; font-weight:bold; cursor:pointer; }
        button:hover { background:#e0a800; }
        a.btn { display:inline-block; margin-top:15px; padding:8px 15px; background:#0069d9; color:white; text-decoration:none; border-radius:5px; }
        a.btn:hover { background:#0056b3; }
    </style>
    <script>
        function toggleSenha() {
            const campos = document.getElementById('camposSenha');
            campos.style.display = document.getElementById('alterarSenha').checked ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <header><h1>Clínica Médica - Usuários</h1></header>
    <div class="container">
        <h2>Editar Usuário</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
            <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
            <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

            <h3>Alterar Senha</h3>
            <label>
                <input type="checkbox" id="alterarSenha" name="alterar_senha" value="1" onclick="toggleSenha()">
                Desejo alterar a senha
            </label>

            <div id="camposSenha" style="display:none; margin-top:15px;">
                <input type="password" name="senha_atual" placeholder="Digite a senha atual">
                <input type="password" name="nova_senha" placeholder="Digite a nova senha">
            </div>

            <button type="submit">Atualizar</button>
        </form>
        <a class="btn" href="/projeto02/public/index.php?controller=Usuarios&action=index">Voltar</a>
    </div>
</body>
</html>