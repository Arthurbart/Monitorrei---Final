<!DOCTYPE html>
<html lang="pt-br">
<?php 
    include('conexao.php');
    include('dados_monitoria.php');
    if ($status == 'desativado') {
        echo "
            <script>
                alert('Monitoria não está ativa');
                window.location.href = 'monitorias.php';
            </script>";
        exit();
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Monitoria - <?php echo $_SESSION["nome_monitoria"];?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .banner {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.6)), url(<?=$img_banner?>) no-repeat center;
            background-size: cover;
            background-position: center;
            color: white;
            height: 200px;
            position: relative;
        }
        .banner img {
            position: absolute;
            bottom: -30px;
            right: 20px;
            border-radius: 50%;
            border: 4px solid white;
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
    <?php
    include('navbar.php');
    if ($_SESSION['usuario_id'] == $id_monitor) {
        include('info_monitor.php');
    } elseif ($_SESSION['cargo'] == 'docente') {
        include('info_professor.php');
    } else {
        include('info_monitoria.php');
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>