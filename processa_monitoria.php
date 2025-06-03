<?php
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome_monitoria = $conn->real_escape_string($_POST['nome_monitoria']);
    $matricula_monitor = $conn->real_escape_string($_POST['matricula_monitor']);
    $nome_monitor = $conn->real_escape_string($_POST['nome_monitor']);
    $curso = $conn->real_escape_string($_POST['curso']);
    $horario = $conn->real_escape_string($_POST['horario']);
    $sala = $conn->real_escape_string($_POST['local']);
    $dias = $conn->real_escape_string($_POST['dias']);
    
    $img_banner = $_FILES['img_banner'];
    $img_card = $_FILES['img_card'];

    $banner_destino = 'imgs/banner/default.jpg';
    $card_destino = 'imgs/card/default.jpg';

    if ($img_banner['name']) {
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $banner_ext = strtolower(pathinfo($img_banner['name'], PATHINFO_EXTENSION));
        
        if (!in_array($banner_ext, $allowed_extensions)) {
            echo "<script>
                    alert('Somente arquivos PNG, JPG ou JPEG são permitidos para o banner.');
                    window.history.back();
                  </script>";
            exit();
        }
        $nome_monitoria_banner = str_replace(" ", "_", $nome_monitoria);
        $banner_destino = 'imgs/banner/' . $nome_monitoria_banner . '_banner.' . $banner_ext;

    }

    if ($img_card['name']) {
        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        $card_ext = strtolower(pathinfo($img_card['name'], PATHINFO_EXTENSION));

        if (!in_array($card_ext, $allowed_extensions)) {
            echo "<script>
                    alert('Somente arquivos PNG, JPG ou JPEG são permitidos para o card.');
                    window.history.back();
                  </script>";
            exit();
        }
        $card_destino = 'imgs/card/' . $nome_monitoria . '_card.' . $card_ext;
    }

    $query_usuario = "SELECT id FROM usuario WHERE matricula = '$matricula_monitor' LIMIT 1";
    $resultado_usuario = $conn->query($query_usuario);

    if ($resultado_usuario && $resultado_usuario->num_rows > 0) {
        $row = $resultado_usuario->fetch_assoc();
        $id_monitor = $row['id'];

        $sql = "INSERT INTO monitorias (nome, sala, horario, usuario_id, curso, dias, img_banner, img_card) 
                VALUES ('$nome_monitoria', '$sala', '$horario', '$id_monitor', '$curso', '$dias', '$banner_destino', '$card_destino')";

        if ($conn->query($sql) === TRUE) {
            if ($img_banner['name'] && !move_uploaded_file($img_banner['tmp_name'], $banner_destino)) {
                echo "<script>
                        alert('Erro ao fazer upload da imagem do banner.');
                        window.history.back();
                      </script>";
                exit();
            }

            if ($img_card['name'] && !move_uploaded_file($img_card['tmp_name'], $card_destino)) {
                echo "<script>
                        alert('Erro ao fazer upload da imagem do card.');
                        window.history.back();
                      </script>";
                exit();
            }

            echo "<script>
                    alert('Monitoria adicionada com sucesso!');
                    window.location.href = 'monitorias.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Erro ao adicionar a monitoria.');
                    window.history.back();
                  </script>";
            exit();
        }
    } else {
        echo "<script>
                alert('Aluno não encontrado.');
                window.history.back();
              </script>";
        exit();
    }
}

?>
