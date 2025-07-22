<?php
include('conexao.php');

if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['id_monitoria'])) {
    echo "
    <script>
        alert('Usuario não autenticado ou monitoria não existente');
        window.history.back();
    </script>";
    exit();
}

$data = $_POST['data'] ?? '';
$matricula = $_POST['matricula_monitor'] ?? '';
$comentario = $_POST['comentario'] ?? '';

$id_monitoria = $_SESSION['id_monitoria'];
try {
    $query_buscar_usuario = "SELECT id FROM usuario WHERE matricula = ?";
    $stmt_buscar = $conn->prepare($query_buscar_usuario);
    $stmt_buscar->bind_param('s', $matricula);
    $stmt_buscar->execute();
    $result_buscar = $stmt_buscar->get_result();

    if ($result_buscar->num_rows === 0) {
        echo "
        <script>
            alert('Essa matricula nao corresponde a nenhum aluno');
            window.history.back();
        </script>";
        exit();    }

    $aluno = $result_buscar->fetch_assoc();
    $aluno_id = $aluno['id'];

    $stmt_buscar->close();

    $query_inserir = "INSERT INTO presencas (usuario_id, monitoria_id, data_presenca, feedback) VALUES (?, ?, ?, ?)";
    $stmt_inserir = $conn->prepare($query_inserir);
    $stmt_inserir->bind_param('iiss', $aluno_id, $id_monitoria, $data, $comentario);

    if ($stmt_inserir->execute()) {
        echo "
        <script>
            alert('Presença registrada com sucesso!');
            window.history.back();
        </script>";
        exit();
    } else {
        echo "
        <script>
            alert('Erro ao registrar presença');
            window.history.back();
        </script>";
        exit();    
    }

    $stmt_inserir->close();
} catch (Exception $e) {
    echo "
    <script>
        alert('Erro ao registrar presença');
        window.history.back();
    </script>";
    exit();
}

?>

