<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['usuario_id'])) {
        echo "
        <script>
        alert('Você não está logado, direcionando para página de login...');
        window.location.href = 'index.html';
        </script>";
        exit;
    }
    $numero_documento = $_POST['numero_documento'];
    $descricao = $conn->real_escape_string($_POST['explicacao']);
    $tipo = $conn->real_escape_string($_POST['tipo']);
    $usuario_id = $_SESSION['usuario_id'];
    $id_monitoria = $_SESSION['id_monitoria'];

    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
        $nome_arquivo = $numero_documento . "_" . $id_monitoria . "_" . $_FILES['arquivo']['name'];
        $caminho_temporario = $_FILES['arquivo']['tmp_name'];
        $destino = "uploads/" . basename($nome_arquivo);

        if (move_uploaded_file($caminho_temporario, $destino)) {
            $sql = "INSERT INTO documentos (descricao, monitoria_id, usuario_id, data_postagem, doc, tipo) 
                    VALUES ('$descricao', '$id_monitoria', '$usuario_id', NOW(), '$nome_arquivo', '$tipo')";

            if ($conn->query($sql) === TRUE) {
                echo "
                <script>
                alert('Documento enviado com sucesso!');
                window.history.back();
                </script>";
                exit;
            } else {
                echo "
                <script>
                alert('Erro ao salvar os dados no banco.');
                window.history.back();
                </script>";
                exit;
            }
        } else {
            echo "
            <script>
            alert('Erro ao mover o arquivo para o diretório de uploads.');
            window.history.back();
            </script>";
            exit;
        }
    } else {
        echo "
        <script>
        alert('Erro no envio do arquivo.');
        window.history.back();
        </script>";
        exit;
    }
} else {
    echo "
    <script>
    alert('Acesso inválido.');
    window.history.back();
    </script>";
    exit;
}

// Fecha a conexão
$conn->close();
?>
