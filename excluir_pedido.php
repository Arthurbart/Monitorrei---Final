<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pedido_id = intval($_POST['pedido_id']);
    $usuario_id = $_SESSION['usuario_id'];

    $sql_verifica = "SELECT id FROM pedidos_conteudo WHERE id = ? AND usuario_id = ?";
    $stmt_verifica = $conn->prepare($sql_verifica);
    $stmt_verifica->bind_param('ii', $pedido_id, $usuario_id);
    $stmt_verifica->execute();
    $result = $stmt_verifica->get_result();

    if ($result->num_rows > 0) {
        $sql_excluir = "DELETE FROM pedidos_conteudo WHERE id = ? OR id_pai = ?";
        $stmt_excluir = $conn->prepare($sql_excluir);
        $stmt_excluir->bind_param('ii', $pedido_id, $pedido_id);

        if ($stmt_excluir->execute()) {
            echo "
            <script>
                alert('Pedido excluído com sucesso!');
                window.history.back();
            </script>";
            exit();
        } else {
            echo "
            <script>
                alert('Erro ao excluir o pedido');
                window.history.back();
            </script>";
            exit();
        }
    } else {
        echo "
        <script>
            alert('Pedido não encontrado');
            window.history.back();
        </script>";
        exit();
    }
}
?>
