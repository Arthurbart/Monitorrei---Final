<?php

include ('conexao.php');

$id_pai = $_POST['id_pai'];
$resposta = $_POST['resposta'];
$data_resposta = date('Y-m-d H:i:s'); 
$id_monitoria = $_SESSION['id_monitoria'];
$usuario_id = $_SESSION['usuario_id'];

$sql = "INSERT INTO pedidos_conteudo (usuario_id, monitoria_id, conteudo, data_pedido, status, id_pai) VALUES ('$usuario_id', '$id_monitoria', '$resposta', '$data_resposta', 'null', '$id_pai')";

if (mysqli_query($conn, $sql)) {
    echo "
    <script>
        alert('Resposta Enviada com sucesso!');
        window.history.back();
    </script>";
    exit();
} else {
    echo "
    <script>
        alert('Erro ao enviar resposta.');
        window.history.back();
    </script>";}
?>
