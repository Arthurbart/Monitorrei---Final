<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aviso_id = intval($_POST['aviso_id']);
    $usuario_id = $_SESSION['usuario_id'];

    $sql_verifica = "SELECT id FROM avisos WHERE id = ? AND usuario_id = ?";
    $stmt_verifica = $conn->prepare($sql_verifica);
    $stmt_verifica->bind_param('ii', $aviso_id, $usuario_id);
    $stmt_verifica->execute();
    $result = $stmt_verifica->get_result();

    if ($result->num_rows > 0) {
        
        $sql_excluir = "DELETE FROM avisos WHERE id = ?";
        $stmt_excluir = $conn->prepare($sql_excluir);
        $stmt_excluir->bind_param('i', $aviso_id);

        if ($stmt_excluir->execute()) {
            echo "
            <script>
                alert('Aviso excluído com sucesso!');
                window.history.back();
            </script>";
            exit();
        } else {
            echo "
            <script>
                alert('Erro ao excluir o aviso');
                window.history.back();
            </script>";
            exit();
        }
    } else {
        echo "
        <script>
            alert('Aviso não encontrado');
            window.history.back();
        </script>";
        exit();
    }
}
?>
