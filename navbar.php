<nav class="navbar navbar-light bg-light px-3">
  <div class="d-flex align-items-center">
    <button class="btn btn-outline-secondary me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu">
      <i class="bi bi-list"></i>
    </button>
    <a class="navbar-brand" href="monitorias.php">
      <img src="imgs/mini_logo_iffar_c.png" alt="Logo Instituto Federal" width="30px" height="30px">
      MoniTorrei
    </a>
  </div>

  <div class="dropdown">
    <a href="#" class="d-flex align-items-center text-decoration-none" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
      <?php echo "" . $_SESSION['nome_usuario'] . "  <img style='width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 1px solid rgb(0, 47, 255);' class='ms-3' src='" . $_SESSION['foto'] . "' alt=''> " ?>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
        <li><a class="dropdown-item text-success" href="edita.php">Visualizar perfil</a></li>
        <li><a class="dropdown-item text-danger" href="logout.php">Sair da conta</a></li>
      </ul>
  </div>
</nav>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasMenuLabel">Monitorias</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="list-group">
      <?php
      $sql = "SELECT id, nome FROM monitorias WHERE status = 'ativo'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $nomeMonitoria = htmlspecialchars($row['nome']);
          echo "<a href='monitoria.php?id=" . htmlspecialchars($row['id']) . "' class='text-decoration-none'>
                  <li class='list-group-item'>$nomeMonitoria</li>
                </a>";
        }
      } else {
        echo "<li class='list-group-item text-muted'>Nenhuma monitoria ativa</li>";
      }
      ?>
    </ul>
  </div>
</div>