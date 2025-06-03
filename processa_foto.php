<?php
include('conexao.php');

if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] === UPLOAD_ERR_OK) {
    $usuario_id = $_SESSION['usuario_id'];
    $arquivo = $_FILES['fotoPerfil'];

    $diretorio = 'imgs/usuario/';
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true);
    }

    $nome_arquivo = $_SESSION['matricula'] . "_FTperfil";
    $caminho_arquivo = $diretorio . $nome_arquivo;

    $tipo_arquivo = mime_content_type($arquivo['tmp_name']);
    if (strpos($tipo_arquivo, 'image/') === false) {
        echo "
        <script>
            alert('O arquivo selecionado não é uma imagem válida.');
            window.history.back();
        </script>";
        exit();
    }

    if (move_uploaded_file($arquivo['tmp_name'], $caminho_arquivo)) {
        $sql_update = "UPDATE usuario SET foto = '$caminho_arquivo' WHERE id = $usuario_id";

        if ($conn->query($sql_update) === TRUE) {
            $_SESSION['foto'] = $caminho_arquivo;
            echo "
            <script>
                alert('Foto de perfil atualizada com sucesso!');
                window.location.href = 'edita.php';
            </script>";
        } else {
            echo "
            <script>
                alert('Erro ao atualizar foto no banco de dados.');
                window.location.href = 'edita.php';
            </script>";
        }
    } else {
        echo "
        <script>
            alert('Erro ao fazer upload da imagem.');
            window.location.href = 'edita.php';
        </script>";
    }
} else {
    echo "
    <script>
        alert('Nenhuma imagem foi selecionada.');
        window.location.href = 'edita.php';
    </script>";
} 