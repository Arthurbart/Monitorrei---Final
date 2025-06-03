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

    $pedido = $conn->real_escape_string($_POST['pedido']);
    $usuario_id = $_SESSION['usuario_id'];
    $data_pedido = date('Y-m-d H:i:s'); 
    $status = 'Em Aguardo'; 
    $id_monitoria = $_SESSION['id_monitoria'];

    $sql = "INSERT INTO pedidos_conteudo (conteudo, monitoria_id, usuario_id, data_pedido, status) 
            VALUES ('$pedido', '$id_monitoria', '$usuario_id', '$data_pedido', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "
        <script>
        alert('Pedido enviado com sucesso!');
        window.history.back();
        </script>";
        exit;
    } else {
        echo "
        <script>
        alert('Erro ao enviar pedido.');
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
