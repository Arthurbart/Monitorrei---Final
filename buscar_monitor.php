<?php
    include('conexao.php');

    if (!$conn) {
        die("Erro ao conectar: " . mysqli_connect_error());
    }

    if (isset($_GET['matricula'])) {
        $matricula = mysqli_real_escape_string($conn, $_GET['matricula']);

        $sql = "SELECT nome FROM usuario WHERE matricula = '$matricula' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo json_encode(['sucesso' => true, 'nome' => $row['nome']]);
        } else {
            echo json_encode(['sucesso' => false]);
        }
    } else {
        echo json_encode(['sucesso' => false]);
    }

    mysqli_close($conn);
?>
