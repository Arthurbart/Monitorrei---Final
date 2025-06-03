<?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_monitoria = intval($_GET['id']); 
    
    $sql = "
        SELECT 
            m.id, 
            m.nome, 
            m.horario, 
            m.sala, 
            m.curso, 
            m.dias, 
            m.usuario_id,
            m.img_banner,
            u.foto,
            u.nome AS nome_monitor 

        FROM monitorias m
        JOIN usuario u ON m.usuario_id = u.id
        WHERE m.id = $id_monitoria
    ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $monitoria = $result->fetch_assoc(); 
        $nome_monitoria = htmlspecialchars($monitoria['nome']);
        $monitor_nome = htmlspecialchars($monitoria['nome_monitor']);
        $curso = htmlspecialchars($monitoria['curso']);
        $sala = htmlspecialchars($monitoria['sala']);
        $dias = htmlspecialchars($monitoria['dias']);
        $horario = htmlspecialchars($monitoria['horario']);
        $id_monitor = htmlspecialchars($monitoria['usuario_id']);
        $foto_monitor = htmlspecialchars($monitoria['foto']);
        $img_banner = htmlspecialchars($monitoria['img_banner']);
        $_SESSION['id_monitoria'] = $id_monitoria;
        $_SESSION['dias'] = $dias;
        $_SESSION['curso'] = $curso;
        $_SESSION['id_monitor'] = $id_monitor;
        $_SESSION['horario'] = $horario;
        $_SESSION['sala'] = $sala;
        $_SESSION['nome_monitoria'] = $nome_monitoria;
        $_SESSION['monitor_nome'] = $monitor_nome;
        $_SESSION['foto_monitor'] = $foto_monitor;
        $_SESSION['img_banner'] = $img_banner;

    } else {
        echo "<script>
            alert('Monitoria não encontrada.');
            window.location.href = 'monitorias.php';
        </script>";
        exit();
    }
} else {
    echo "<script>
        alert('ID de monitoria inválido.');
        window.location.href = 'monitorias.php';
    </script>";
    exit();
}
?>