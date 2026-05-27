<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Nova Consulta</title>
    <style>
        body { font-family: 'Segoe UI', Arial; background: #f5f7fa; margin:0; display:flex; justify-content:center; align-items:center; height:100vh; }
        .box { background:white; padding:40px; border-radius:12px; box-shadow:0 6px 12px rgba(0,0,0,0.1); max-width:600px; width:100%; }
        h1 { color:#4a90e2; margin-bottom:20px; text-align:center; }
        label { display:block; margin-top:15px; font-weight:bold; }
        select, input, textarea { width:100%; padding:10px; margin-top:5px; border:1px solid #ccc; border-radius:8px; }
        .actions { margin-top:20px; text-align:center; }
        .btn { padding:10px 16px; border-radius:8px; text-decoration:none; font-weight:600; margin:5px; display:inline-block; }
        .btn-primary { background:#4a90e2; color:white; }
        .btn-primary:hover { background:#357abd; }
        .btn-secondary { background:#6c757d; color:white; }
        .btn-secondary:hover { background:#5a6268; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Cadastrar Nova Consulta</h1>

        <form method="post" action="/projeto02/public/index.php?controller=Consultas&action=create">
            <label for="paciente_id">Paciente:</label>
            <select name="paciente_id" id="paciente_id" required>
                <?php foreach ($pacientes as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nome']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="medico_id">Médico:</label>
            <select name="medico_id" id="medico_id" required>
                <?php foreach ($medicos as $m): ?>
                    <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['nome']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="data_consulta">Data e Hora:</label>
            <input type="datetime-local" name="data_consulta" id="data_consulta" required>

            <label for="observacoes">Observações:</label>
            <textarea name="observacoes" id="observacoes"></textarea>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="/projeto02/public/index.php?controller=Consultas&action=index" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>