<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Monitoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script>

        function buscarNome() {
            const matricula = document.getElementById('matriculaMonitor').value;

            if (matricula) {
                fetch(`buscar_monitor.php?matricula=${matricula}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.sucesso) {
                            document.getElementById('nomeMonitor').value = data.nome;
                        } else {
                            alert('Matrícula não encontrada!');
                            document.getElementById('nomeMonitor').value = '';
                        }
                    })
                    .catch(error => {
                        console.error('Erro na busca:', error);
                    });
            } else {
                document.getElementById('nomeMonitor').value = '';
            }
        }
    </script>
</head>
<body>
    <?php
    include('conexao.php');
    include('navbar.php');
    ?>
    <div class="container mt-5">
        <ul class="nav nav-tabs" id="monitoriaTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="adicionar-tab" data-bs-toggle="tab" data-bs-target="#adicionar" type="button" role="tab" aria-controls="adicionar" aria-selected="true">Adicionar Monitoria</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="remover-tab" data-bs-toggle="tab" data-bs-target="#remover" type="button" role="tab" aria-controls="remover" aria-selected="false">Desativar Monitoria</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reativa-tab" data-bs-toggle="tab" data-bs-target="#reativa" type="button" role="tab" aria-controls="reativa" aria-selected="false">Reativar Monitoria</button>
            </li>
        </ul>

        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="adicionar" role="tabpanel" aria-labelledby="adicionar-tab">
                <h1 class="text-center mb-4">Adicionar Monitoria</h1>
                <form action="processa_monitoria.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nomeMonitoria" class="form-label">Nome da Monitoria</label>
                        <input type="text" class="form-control" id="nomeMonitoria" name="nome_monitoria" placeholder="Digite o nome da monitoria" required>
                    </div>
                    <div class="mb-3">
                        <label for="matriculaMonitor" class="form-label">Matrícula do Monitor</label>
                        <input type="text" class="form-control" id="matriculaMonitor" name="matricula_monitor" placeholder="Digite a matrícula do monitor" onblur="buscarNome()" required>
                    </div>
                    <div class="mb-3">
                        <label for="nomeMonitor" class="form-label">Nome do Monitor</label>
                        <input type="text" class="form-control" id="nomeMonitor" name="nome_monitor" placeholder="Nome do monitor" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="horario" class="form-label">Horário</label>
                        <input type="time" class="form-control" id="horario" name="horario" required>
                    </div>
                    <div class="mb-3">
                        <label for="dias" class="form-label">Dias de Funcionamento</label>
                        <input type="text" class="form-control" id="dias" name="dias" placeholder="Digite os dias da semana que a monitoria estará aberta" required>
                    </div>
                    <div class="mb-3">
                        <label for="local" class="form-label">Local</label>
                        <input type="text" class="form-control" id="local" name="local" placeholder="Digite o local da monitoria" required>
                    </div>
                    <div class="mb-3">
                        <label for="curso" class="form-label">Curso</label>
                        <select class="form-select" id="curso" name="curso" required>
                            <option value="Todos os Cursos" selected>Todos os cursos</option>
                            <option value="Administração">Administração</option>
                            <option value="Alimentos">Alimentos</option>
                            <option value="Agropecuária">Agropecuária</option>
                            <option value="Informática">Informática</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="img_card" class="form-label">Imagem do Card (Opcional)</label>
                        <input type="file" class="form-control" id="img_card" name="img_card">
                    </div>
                    <div class="mb-3">
                        <label for="img_banner" class="form-label">Imagem do Banner (Opcional)</label>
                        <input type="file" class="form-control" id="img_banner" name="img_banner">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-5">Adicionar Monitoria</button>
                </form>
            </div>

            <div class="tab-pane fade" id="remover" role="tabpanel" aria-labelledby="remover-tab">
                <h3>Desativar Monitoria</h3>
                <ul class="list-group">
                    <?php
                    $sql = "SELECT id, nome FROM monitorias WHERE status = 'ativo'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $nomeMonitoria = htmlspecialchars($row['nome']);
                            $idMonitoria = $row['id'];
                            echo "
                    <li class='list-group-item'>
                        <form action='processa_alteracao.php' method='post'>
                            <button type='submit' class='btn btn-danger' name='monitoria_id' value='$idMonitoria'>Desativar $nomeMonitoria</button>
                        </form>
                    </li>
                ";
                        }
                    } else {
                        echo "<li class='list-group-item text-muted'>Nenhuma monitoria ativa</li>";
                    }
                    ?>
                </ul>
            </div>

            <div class="tab-pane fade" id="reativa" role="tabpanel" aria-labelledby="reativa-tab">
                <h3>Reativar Monitoria</h3>
                <ul class="list-group">
                    <?php
                    $sql = "SELECT id, nome FROM monitorias WHERE status = 'desativado'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $nomeMonitoria = htmlspecialchars($row['nome']);
                            $idMonitoria = $row['id'];
                            echo "
                    <li class='list-group-item'>
                        <form action='processa_alteracao.php' method='post'>
                            <button type='submit' class='btn btn-success' name='monitoria_id' value='$idMonitoria'>Reativar $nomeMonitoria</button>
                        </form>
                    </li>
                ";
                        }
                    } else {
                        echo "<li class='list-group-item text-muted'>Nenhuma monitoria desativada</li>";
                    }
                    ?>
                </ul>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>