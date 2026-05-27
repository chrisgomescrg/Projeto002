<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Consulta</title>
    <style>
        :root {
            --primary: #4a90e2;
            --secondary: #f5f7fa;
            --danger: #dc3545;
            --text: #333;
        }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--secondary);
            margin: 0;
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
            max-width: 600px;
            width: 100%;
        }
        h1 {
            color: var(--primary);
            text-align: center;
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }
        input, select, textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        textarea { resize: vertical; }
        .btn {
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            margin: 5px;
            display: inline-block;
        }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: #357abd; }
        .btn-secondary { background: #6c757d; color: white; }
        .btn-secondary:hover { background: #5a6268; }
        .msg { padding:10px; border-radius:8px; margin-bottom:15px; }
        .erro { background: var(--danger); color:white; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Editar Consulta</h1>

        <?php if (!empty($_SESSION['erro'])): ?>
            <div class="msg erro"><?= $_SESSION['erro']; unset($_SESSION['erro']); ?></div>
        <?php endif; ?>

        <form method="post" action="/projeto02/public/index.php?controller=Consultas&action=edit">
            <input type="hidden" name="id" value="<?= htmlspecialchars($consulta['id']) ?>">

            <!-- Seleção de Paciente -->
            <label for="paciente_id">Paciente</label>
            <select id="paciente_id" name="paciente_id" required>
                <?php foreach ($pacientes as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= $p['id'] == $consulta['paciente_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($p['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Seleção de Médico -->
            <label for="medico_id">Médico</label>
            <select id="medico_id" name="medico_id" required>
                <?php foreach ($medicos as $m): ?>
                    <option value="<?= $m['id'] ?>" <?= $m['id'] == $consulta['medico_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($m['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Data e Hora -->
            <label for="data_consulta">Data e Hora da Consulta</label>
            <input type="datetime-local" id="data_consulta" name="data_consulta"
                   value="<?= htmlspecialchars(date('Y-m-d\TH:i', strtotime($consulta['data_consulta']))) ?>" required>

            <!-- Observações -->
            <label for="observacoes">Observações</label>
            <textarea id="observacoes" name="observacoes" rows="4"><?= htmlspecialchars($consulta['observacoes']) ?></textarea>

            <!-- Botões -->
            <div style="text-align:center;">
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="/projeto02/public/index.php?controller=Consultas&action=index" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>