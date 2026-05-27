<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Projeto 2</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .logout-btn {
            background: var(--danger);
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: background 0.2s ease;
        }
        .logout-btn:hover { background: #b52a3a; }
        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 20px;
            color: var(--primary);
            font-size: 22px;
            font-weight: 600;
            text-align: center;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .card {
            background: var(--secondary);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }
        .card h3 {
            margin: 0;
            font-size: 18px;
            color: var(--primary);
        }
        .btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 18px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: background 0.2s ease;
        }
        .btn:hover { background: #357abd; }
        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <header>
        <span>Projeto 2 - Christopher Gomes</span>
        <a class="logout-btn" href="/projeto02/public/index.php?controller=Auth&action=logout">Sair</a>
    </header>
    <div class="container">
        <h2>Bem-vindo ao Projeto 2</h2>
        <div class="grid">
            <div class="card">
                <h3>Usuários</h3>
                <a class="btn" href="/projeto02/public/index.php?controller=Usuarios&action=index">Gerenciar</a>
            </div>
            <div class="card">
                <h3>Pacientes</h3>
                <a class="btn" href="/projeto02/public/index.php?controller=Pacientes&action=index">Gerenciar</a>
            </div>
            <div class="card">
                <h3>Médicos</h3>
                <a class="btn" href="/projeto02/public/index.php?controller=Medicos&action=index">Gerenciar</a>
            </div>
            <div class="card">
                <h3>Consultas</h3>
                <a class="btn" href="/projeto02/public/index.php?controller=Consultas&action=index">Gerenciar</a>
            </div>
        </div>
        <footer>&copy; <?= date("Y") ?> Projeto 2 - Christopher Gomes</footer>
    </div>
</body>
</html>