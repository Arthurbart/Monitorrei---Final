<?php 
include('conexao.php');

$senha_atual = $_POST['senha_atual'];
$nova_senha = $_POST['nova_senha'];
$confirmar_senha = $_POST['confirmar_senha'];

if ($nova_senha != $confirmar_senha) {
    echo "
    <script>
        alert('As senhas não coincidem!');
        window.location.href = 'edita.php';
    </script>";
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$sql_verifica = "SELECT senha FROM usuario WHERE id = ?";
$stmt = $conn->prepare($sql_verifica);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if ($senha_atual != $usuario['senha']) {
    echo "
    <script>
        alert('Senha atual incorreta!');
        window.location.href = 'edita.php';
    </script>";
    exit();
}


$sql_update = "UPDATE usuario SET senha = ? WHERE id = ?";
$stmt = $conn->prepare($sql_update);
$stmt->bind_param("si", $nova_senha, $usuario_id);

if ($stmt->execute()) {
    echo "
    <script>
        alert('Senha alterada com sucesso!');
        window.location.href = 'edita.php';
    </script>";
} else {
    echo "
    <script>
        alert('Erro ao alterar a senha!');
        window.location.href = 'edita.php';
    </script>";
}
?>
