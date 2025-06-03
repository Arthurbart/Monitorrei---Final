<?php
include('conexao.php');

if (isset($_POST['monitoria_id'])) {
    $monitoriaId = $_POST['monitoria_id'];
    
    $sql = "SELECT status FROM monitorias WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $monitoriaId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $statusAtual = $row['status'];
        
        if ($statusAtual == 'ativo') {
            $novoStatus = 'desativado';
        } else {
            $novoStatus = 'ativo';
        }

        $sqlUpdate = "UPDATE monitorias SET status = ? WHERE id = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("si", $novoStatus, $monitoriaId);
        $stmtUpdate->execute();

        echo "
        <script>
        alert('Monitoria alterada com sucesso.');
        window.history.back();
        </script>";
        exit;    
    }
}
?>
