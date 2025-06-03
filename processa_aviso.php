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

    $aviso = $conn->real_escape_string($_POST['aviso']);
    $usuario_id = $_SESSION['usuario_id'];
    $data_aviso = date('Y-m-d'); 
    $id_monitoria = $_SESSION['id_monitoria'];

    $sql = "INSERT INTO avisos (conteudo, monitoria_id, usuario_id, data_aviso) 
            VALUES ('$aviso', '$id_monitoria', '$usuario_id', '$data_aviso')";

    if ($conn->query($sql) === TRUE) {
        echo "
        <script>
        alert('Aviso enviado com sucesso!');
        window.history.back();
        </script>";
        exit;
    } else {
        echo "
        <script>
        alert('Erro ao enviar aviso.');
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

$conn->close();
?>
