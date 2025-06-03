<?php
    session_start();

    $_SESSION['matricula'] = $_POST['matricula'];

    $_SESSION['senha'] = $_POST['senha'];

    $matricula = $_SESSION['matricula'];

    $senha = $_SESSION['senha'];

    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "monitorrei";
    

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
    $query = "SELECT * FROM usuario WHERE matricula = '$matricula' AND senha = '$senha'";
    $result = mysqli_query($conn, $query);
 
    if (mysqli_num_rows($result) > 0) {
      $user = mysqli_fetch_assoc($result);
      $_SESSION['usuario_id'] = $user['id']; 
      $_SESSION['cargo'] = $user['cargo']; 
      $_SESSION['nome_usuario'] = $user['nome']; 
      $_SESSION['curso'] = $user['curso']; 
      $_SESSION['foto'] = $user['foto']; 

      echo "
      <script>
          alert('Login realizado com sucesso, bem-vindo!');
          window.location.href = 'monitorias.php';
      </script>";
      exit();
    } else {
      echo "
      <script>
          alert('Matrícula ou senha incorretos');
          window.location.href = 'index.html';
      </script>";
      exit();
    }
?>