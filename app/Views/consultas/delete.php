<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Excluir Consulta</title>
    <style>
        body { font-family: 'Segoe UI', Arial; background: #f5f7fa; margin:0; display:flex; justify-content:center; align-items:center; height:100vh; }
        .box { background:white; padding:40px; border-radius:12px; box-shadow:0 6px 12px rgba(0,0,0,0.1); max-width:600px; width:100%; text-align:center; }
        h1 { color:#dc3545; margin-bottom:20px; }
        p { margin-bottom:20px; }
        .btn { padding:10px 16px; border-radius:8px; text-decoration:none; font-weight:600; margin:5px; display:inline-block; }
        .btn-danger { background:#dc3545; color:white; }
        .btn-danger:hover { background:#b52a3a; }
        .btn-secondary { background:#6c757d; color:white; }
        .btn-secondary:hover { background:#5a6268; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Excluir Consulta</h1>
        <p>Tem certeza que deseja excluir a consulta 
           do paciente <strong><?= htmlspecialchars($consulta['paciente_nome']) ?></strong> 
           com o médico <strong><?= htmlspecialchars($consulta['medico_nome']) ?></strong> 
           em <?= htmlspecialchars(date('d/m/Y H:i', strtotime($consulta['data_consulta']))) ?>?</p>

        <form method="post" action="/projeto02/public/index.php?controller=Consultas&action=delete">
            <input type="hidden" name="id" value="<?= htmlspecialchars($consulta['id']) ?>">
            <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
            <a href="/projeto02/public/index.php?controller=Consultas&action=index" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>