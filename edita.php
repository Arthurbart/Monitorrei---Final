<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        p {
            font-size: 20px;
        }

        .profile-picture {
    width: 80%;  
    height: auto;  
    max-width: 380px;  
    max-height: 380px;
    border-radius: 50%;  
    object-fit: cover;  
    border: 4px solid rgb(0, 0, 0); 
}

    </style>
</head>

<body>
    <?php
    include('conexao.php');
    include('navbar.php');
    if ($_SESSION['cargo'] == 'admin') {
        $cargo = 'Administrador';
    } elseif ($_SESSION['cargo'] == 'docente') {
        $cargo = 'Professor';
    } elseif ($_SESSION['cargo'] == 'aluno') {
        $cargo = 'Aluno';
    }
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 text-center mb-5">
                <img src="<?= $_SESSION['foto'] ?>" alt="Foto de perfil" class="profile-picture img-fluid">
            </div>

            <div class="col-12 col-md-6">
                <h1 class="mb-5">Dados do Usuário</h1>
                <p><strong>Nome completo:</strong> <span id="nome_completo"><?= $_SESSION['nome_usuario'] ?></span></p>
                <p><strong>Matrícula:</strong> <span id="matricula"><?= $_SESSION['matricula'] ?></span></p>
                <p><strong>Cargo:</strong> <span id="cargo"><?= $cargo ?></span></p>
                <?php
                    $id_usuario = $_SESSION['usuario_id'];
                    $sql = "SELECT nome FROM monitorias WHERE usuario_id = $id_usuario AND status = 'ativo'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $monitoria = $result->fetch_assoc();
                        while ($monitoria) {
                            echo "<p><strong>Monitoria:</strong> <span id='monitoria'>" . $monitoria['nome'] . "</span></p>";
                            $monitoria = $result->fetch_assoc();
                        }
                    }
                    
                ?>
            </div>
            <button style="width: 40%;" type="button" class="btn btn-dark mb-5 me-4" data-bs-toggle="modal" data-bs-target="#alterarFotoModal">Alterar foto de Perfil</button>
            <button style="width: 40%;" type="button" class="btn btn-dark mb-5" data-bs-toggle="modal" data-bs-target="#alterarSenhaModal">Alterar Senha</button>
        </div>
    </div>

    <!-- Modal Alterar Foto -->
    <div class="modal fade" id="alterarFotoModal" tabindex="-1" aria-labelledby="alterarFotoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alterarFotoModalLabel">Alterar Foto de Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form enctype="multipart/form-data" action="processa_foto.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="fotoPerfil" class="form-label">Escolha uma nova foto de perfil</label>
                            <input type="file" class="form-control" id="fotoPerfil" accept="image/*" name="fotoPerfil" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <?php 
                        if ($_SESSION['foto'] != 'imgs/usuario/default.jpg') {
                            ?>
                            <a href="remove_foto.php"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Remover Foto de Perfil</button></a>
                            <?php
                        }
                        ?>

                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Alterar Senha -->
    <div class="modal fade" id="alterarSenhaModal" tabindex="-1" aria-labelledby="alterarSenhaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alterarSenhaModalLabel">Alterar Senha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="processa_senha.php" method="POST">
                        <div class="mb-3">
                            <label for="senhaAntiga" class="form-label">Senha Antiga</label>
                            <input type="password" class="form-control" id="senhaAntiga" name="senha_atual" required>
                        </div>
                        <div class="mb-3">
                            <label for="novaSenha" class="form-label">Nova Senha</label>
                            <input type="password" class="form-control" id="novaSenha" name="nova_senha" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmarSenha" class="form-label">Confirme a Nova Senha</label>
                            <input type="password" class="form-control" id="confirmarSenha" name="confirmar_senha" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>