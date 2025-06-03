<?php
include 'conexao.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aluno_id = $_POST['aluno_id'];
    $dia_presenca = $_POST['dia_presenca'];

    $query = "DELETE FROM presencas WHERE usuario_id = ? AND data_presenca = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('is', $aluno_id, $dia_presenca);

    if ($stmt->execute()) {
        echo "
        <script>
        alert('Aluno removido da chamada.');
        window.history.back();
        </script>";
        exit;    
    } else {
            echo "
            <script>
            alert('Erro aro remover aluno da chamada.');
            window.history.back();
            </script>";
            exit;    
        }
    $stmt->close();
}
?>
