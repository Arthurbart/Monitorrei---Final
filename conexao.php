<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    echo "
    <script>
        alert('Usuário não logado');
          window.location.href = 'index.html';
    </script>";
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "monitorrei";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>