<?php 
include('conexao.php');

$sql = "UPDATE usuario SET foto = 'imgs/usuario/default.jpg' WHERE id = {$_SESSION['usuario_id']}";
if ($conn->query($sql) === TRUE) {
    $_SESSION['foto'] = 'imgs/usuario/default.jpg';
    echo "
    <script>
        alert('Foto de perfil removida com sucesso!');
        window.location.href = 'edita.php';
    </script>";
} else {
    echo "
    <script>
        alert('Erro ao remover foto de perfil.');
        window.location.href = 'edita.php';
    </script>";
}

?>