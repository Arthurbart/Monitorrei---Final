<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $documento_id = intval($_POST['arquivo_id']);
    $usuario_id = $_SESSION['usuario_id'];

    $sql_verifica = "SELECT id FROM documentos WHERE id = ? AND usuario_id = ?";
    $stmt_verifica = $conn->prepare($sql_verifica);
    $stmt_verifica->bind_param('ii', $documento_id, $usuario_id);
    $stmt_verifica->execute();
    $result = $stmt_verifica->get_result();

    if ($result->num_rows > 0) {
        
        $sql_excluir = "DELETE FROM documentos WHERE id = ?";
        $stmt_excluir = $conn->prepare($sql_excluir);
        $stmt_excluir->bind_param('i', $documento_id);

        if ($stmt_excluir->execute()) {
            echo "
            <script>
                alert('Documento excluído com sucesso!');
                window.history.back();
            </script>";
            exit();
        } else {
            echo "
            <script>
                alert('Erro ao excluir o documento');
                window.history.back();
            </script>";
            exit();
        }
    } else {
        echo "
        <script>
            alert('Documento não encontrado');
            window.history.back();
        </script>";
        exit();
    }
}
?>
