<?php

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: /projeto02/public/index.php");
    exit;
}

// Conexão com o banco
$host = "localhost";
$user = "root";       // ajuste se necessário
$pass = "";           // senha do MySQL
$db   = "clinica";    // nome do banco

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Busca todos os pacientes
$sql = "SELECT id, nome, email, telefone FROM pacientes";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pacientes - Sistema Clínico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f5f5f5;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        .menu {
            margin-bottom: 20px;
        }
        .menu a {
            margin-right: 15px;
            text-decoration: none;
            color: #007BFF;
        }
    </style>
</head>
<body>
    <h1>Lista de Pacientes</h1>

    <div class="menu">
        <a href="/projeto02/public/dashboard.php">Voltar ao Dashboard</a>
        <a href="/projeto02/public/logout.php">Sair</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['nome']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['telefone']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4">Nenhum paciente cadastrado.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>