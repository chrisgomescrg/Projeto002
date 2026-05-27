<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Consultas</title>
    <style>
        body { font-family: 'Segoe UI', Arial; background: #f5f7fa; margin:0; }
        header { background: #4a90e2; color: white; padding: 20px; text-align: center; font-size: 22px; font-weight: bold; }
        .container { max-width: 1100px; margin: 40px auto; background: white; padding: 20px; border-radius: 12px; box-shadow: 0 6px 12px rgba(0,0,0,0.1); }
        h2 { color: #4a90e2; margin-bottom: 20px; }
        .actions { display:flex; justify-content:space-between; margin-bottom:20px; gap:10px; flex-wrap:wrap; }
        .actions input { flex:1; padding:10px; border:1px solid #ccc; border-radius:8px; }
        .btn { padding:10px 16px; border-radius:8px; text-decoration:none; font-weight:600; }
        .btn-primary { background:#4a90e2; color:white; }
        .btn-primary:hover { background:#357abd; }
        .btn-danger { background:#dc3545; color:white; }
        .btn-danger:hover { background:#b52a3a; }
        .btn-secondary { background:#6c757d; color:white; }
        .btn-secondary:hover { background:#5a6268; }
        .scroll-area { max-height:500px; overflow-y:auto; border:1px solid #ddd; border-radius:8px; }
        table { width:100%; border-collapse:collapse; }
        th, td { padding:12px; text-align:left; }
        th { background:#4a90e2; color:white; position:sticky; top:0; }
        tr:nth-child(even) { background:#f9f9f9; }
        tr:hover { background:#eef4fb; }
        .footer-actions { margin-top:20px; text-align:center; }
    </style>
    <script>
        function filtrarConsultas() {
            const termo = document.getElementById('busca').value.toLowerCase();
            document.querySelectorAll('#tabelaConsultas tbody tr').forEach(linha => {
                const paciente = linha.querySelector('.paciente').textContent.toLowerCase();
                const medico = linha.querySelector('.medico').textContent.toLowerCase();
                linha.style.display = (paciente.includes(termo) || medico.includes(termo)) ? '' : 'none';
            });
        }
    </script>
</head>
<body>
<header>Projeto 2 - Christopher Gomes</header>
<div class="container">
    <h2>Consultas</h2>

    <div class="actions">
        <input type="text" id="busca" placeholder="Buscar por paciente ou médico..." onkeyup="filtrarConsultas()">
        <a class="btn btn-primary" href="/projeto02/public/index.php?controller=Consultas&action=create">+ Nova Consulta</a>
    </div>

    <div class="scroll-area">
        <table id="tabelaConsultas">
            <thead>
                <tr><th>Paciente</th><th>Médico</th><th>Data</th><th>Observações</th><th>Ações</th></tr>
            </thead>
            <tbody>
                <?php foreach ($consultas as $c): ?>
                <tr>
                    <td class="paciente"><?= htmlspecialchars($c['paciente_nome']) ?></td>
                    <td class="medico"><?= htmlspecialchars($c['medico_nome']) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($c['data_consulta'])) ?></td>
                    <td><?= htmlspecialchars($c['observacoes']) ?></td>
                    <td>
                        <a class="btn btn-primary" href="/projeto02/public/index.php?controller=Consultas&action=edit&id=<?= $c['id'] ?>">Editar</a>
                        <a class="btn btn-danger" href="/projeto02/public/index.php?controller=Consultas&action=delete&id=<?= $c['id'] ?>">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="footer-actions">
        <a class="btn btn-secondary" href="/projeto02/public/index.php?controller=Dashboard&action=index">← Voltar ao Dashboard</a>
    </div>
</div>
</body>
</html>