<?php
include ('conexao.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dia_presenca = $_POST['dia_presenca'];
    $monitoria_id = $_POST['monitoria_id'];

    $query = "DELETE FROM presencas WHERE monitoria_id = ? AND data_presenca = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('is', $monitoria_id, $dia_presenca);

    if ($stmt->execute()) {
        echo "
        <script>
        alert('A chamada do dia selecionado foi deletada.');
        window.history.back();
        </script>";
        exit;    
    } else {
            echo "
            <script>
            alert('Erro ao excluir chamada do dia selecionado.');
            window.history.back();
            </script>";
            exit;    
        }
    $stmt->close();
}
?>
