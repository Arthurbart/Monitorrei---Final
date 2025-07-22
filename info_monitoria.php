  <div class="banner">
    <div class="container py-4">
      <div class="pt-4">
        <?php echo "<h1>$nome_monitoria</h1>"; ?>
        <p>Instituto Federal Farroupilha</p>
      </div>
      <img src="<?= $foto_monitor ?>" alt="Monitor">
    </div>
  </div>

  <div class="container my-4">
    <div class="row">
      <div class="col-md-3">
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title">Monitor</h5>
            <?php echo "<p class='card-text'>$monitor_nome</p>"; ?>
            <h5 class="card-title">Curso Técnico</h5>
            <?php echo "<p class='card-text'>$curso</p>"; ?>
            <h5 class="card-title">Local</h5>
            <?php echo "<p class='card-text'>$sala</p>"; ?>
            <h5 class="card-title">Horário</h5>
            <?php echo "<p class='card-text pt-0 mt-0'>$dias</p>"; ?>
            <?php echo "<p class='card-text pt-0 mt-0'>$horario</p>"; ?>
          </div>
        </div>
      </div>
      <div class="col-md-9">

        <!-- Lista de navegacao -->
        <ul class="nav nav-tabs" id="monitoriaTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="comentarios-tab" data-bs-toggle="tab" data-bs-target="#comentarios" type="button" role="tab" aria-controls="comentarios" aria-selected="true">Comentários</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="arquivos-tab" data-bs-toggle="tab" data-bs-target="#arquivos" type="button" role="tab" aria-controls="arquivos" aria-selected="false">Arquivos</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="meus-pedidos-tab" data-bs-toggle="tab" data-bs-target="#meus-pedidos" type="button" role="tab" aria-controls="meus-pedidos" aria-selected="false">Meus Pedidos</button>
          </li>
        </ul>

        <div class="tab-content mt-3" id="monitoriaTabsContent">

          <!-- Parte do usuario visualizar os comentarios do monitor -->
          <div class="tab-pane fade show active" id="comentarios" role="tabpanel" aria-labelledby="comentarios-tab">

            <?php
            $sql_avisos = "SELECT id, conteudo, data_aviso, usuario_id 
                                FROM avisos 
                                WHERE monitoria_id = '$id_monitoria'
                                ORDER BY id DESC";

            $result_avisos = $conn->query($sql_avisos);

            if ($result_avisos && $result_avisos->num_rows > 0) {
              while ($aviso = $result_avisos->fetch_assoc()) {
                $aviso_id = htmlspecialchars($aviso['id']);
                $conteudo = htmlspecialchars($aviso['conteudo']);
                $data_aviso = $aviso['data_aviso'] ? date('d/m/Y', strtotime($aviso['data_aviso'])) : 'Data inválida';

                echo "
                        <div class='card mb-3'>
                            <div class='card-body'>
                                <div class='d-flex align-items-center mb-2'>
                                    <img src='$foto_monitor' alt='Monitor' class='rounded-circle me-2' width='40' height='40'>
                                    <div>
                                        <h6 class='card-title mb-0'>$monitor_nome</h6>
                                        <small class='text-muted'>$data_aviso</small>
                                    </div>
                                </div>
                                <p class='card-text'>$conteudo</p>
                            </div>
                        </div>
                        ";
              }
            } else {
              echo "
                    <div class='alert alert-info' role='alert'>
                        Nenhum comentario foi feito para esta monitoria ainda.
                    </div>
                    ";
            }
            ?>
          </div>

          <!-- Parte do usuario visualizar os arquivos da monitoria -->
          <div class="tab-pane fade" id="arquivos" role="tabpanel" aria-labelledby="arquivos-tab">
            <?php
            $sql_documentos = "SELECT d.id, d.descricao, d.doc, d.tipo, d.data_postagem, u.nome as usuario_nome 
                          FROM documentos d
                          JOIN usuario u ON d.usuario_id = u.id
                          WHERE d.monitoria_id = '$id_monitoria'
                          ORDER BY d.data_postagem DESC";

            $result_documentos = $conn->query($sql_documentos);

            if ($result_documentos && $result_documentos->num_rows > 0) {
              while ($documento = $result_documentos->fetch_assoc()) {
                $descricao = htmlspecialchars($documento['descricao']);
                $doc = htmlspecialchars($documento['doc']);
                $tipo = htmlspecialchars($documento['tipo']);
                $data_postagem = $documento['data_postagem'] ? date('d/m/Y', strtotime($documento['data_postagem'])) : 'Data inválida';
                $usuario_nome = htmlspecialchars($documento['usuario_nome']);

                $badge_class = $tipo == 'Atividade' ? 'bg-danger' : 'bg-primary';

                echo "
                    <div class='card mb-3'>
                        <div class='card-body'>
                            <div class='d-flex align-items-center mb-2'>
                                <img src='$foto_monitor' alt='Monitor' class='rounded-circle me-2' width='40' height='40'>
                                <div>
                                    <h6 class='card-title mb-0'>$usuario_nome</h6>
                                    <small class='text-muted'>$data_postagem</small>
                                </div>
                            </div>
                            <p class='card-text'>$descricao</p>
                            <div class='d-flex align-items-center'>
                                <i class='bi bi-file-earmark-pdf fs-4 text-danger me-2'></i>
                                <a href='uploads/$doc' class='text-decoration-none' target='_blank'>$doc</a>
                            </div>
                            <span class='badge $badge_class mt-2'>$tipo</span>
                        </div>
                    </div>
                    ";
              }
            } else {
              echo "
                    <div class='alert alert-info' role='alert'>
                        Nenhum documento foi enviado para esta monitoria ainda.
                    </div>
                ";
            }
            ?>
          </div>

          <!-- Parte do usuario fazer os pedidos para a monitoria -->
          <div class="tab-pane fade" id="meus-pedidos" role="tabpanel" aria-labelledby="meus-pedidos-tab">

            <div class="mb-3">
              <form action="processa_pedido.php" method="POST">
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-person"></i></span>
                  <input type="text" class="form-control" name="pedido" placeholder="Solicitar conteúdo / material específico..." required>
                  <button type="submit" class="form-control">Enviar</button>
                </div>
              </form>
            </div>

            <?php
            $sql_pedidos = "SELECT id, conteudo, data_pedido, status, usuario_id 
                FROM pedidos_conteudo 
                WHERE monitoria_id = '$id_monitoria' AND usuario_id = '{$_SESSION['usuario_id']}' AND id_pai IS NULL
                AND status IN ('Em Aguardo', 'aceito', 'negado')
                ORDER BY id DESC";

            $result_pedidos = $conn->query($sql_pedidos);

            if ($result_pedidos && $result_pedidos->num_rows > 0) {
              while ($pedido = $result_pedidos->fetch_assoc()) {
                $pedido_id = htmlspecialchars($pedido['id']);
                $conteudo = htmlspecialchars($pedido['conteudo']);
                $data_pedido = $pedido['data_pedido'] ? date('d/m/Y', strtotime($pedido['data_pedido'])) : 'Data inválida';
                $status = htmlspecialchars($pedido['status']);
                $foto = $_SESSION['foto'];

                $badge_class = 'bg-info';
                if ($status === 'aceito') $badge_class = 'bg-success';
                elseif ($status === 'negado') $badge_class = 'bg-danger';

                echo "
                  <div class='container mt-4'>
                    <div class='card mb-4'>
                      <div class='card-body'>
                        <div class='d-flex justify-content-between mb-2'>
                          <div class='d-flex align-items-center mb-2'>
                            <img src='$foto' alt='Você' class='rounded-circle me-2' width='40' height='40'>
                            <div>
                              <h6 class='card-title mb-0'>Você</h6>
                              <small class='text-muted'>$data_pedido</small>
                            </div>
                          </div>
                          <div class='dropdown'>
                            <button class='btn btn-sm btn-light dropdown-toggle' type='button' data-bs-toggle='dropdown'>
                              <i class='bi bi-three-dots'></i>
                            </button>
                            <ul class='dropdown-menu dropdown-menu-end'>
                              <li>
                                <form action='excluir_pedido.php' method='POST' style='margin: 0;'>
                                  <input type='hidden' name='pedido_id' value='$pedido_id'>
                                  <button class='dropdown-item text-danger' type='submit' onclick=\"return confirm('Tem certeza que deseja excluir este pedido?');\">Excluir Pedido</button>
                                </form>
                              </li>
                            </ul>
                          </div>
                        </div>

                        <p class='card-text'>$conteudo</p>
                        <div class='d-flex justify-content-between align-items-center'>
                          <span class='badge $badge_class'>$status</span>

                          <button type='button' class='btn btn-primary btn-sm' onclick='toggleRespostaForm($pedido_id)'>↩</button>
                        </div>
                ";

                echo "
                  <div id='resposta-form-$pedido_id' class='mt-3 d-none'>
                    <form action='processa_resposta.php' method='POST'>
                      <input type='hidden' name='id_pai' value='$pedido_id'>
                      <textarea name='resposta' class='form-control mb-2' rows='2' placeholder='Digite sua resposta...' required></textarea>
                      <button type='submit' class='btn btn-success btn-sm'>Enviar resposta</button>
                    </form>
                  </div>
                ";



                $sql_respostas = "SELECT pc.*, u.nome, u.foto 
                                  FROM pedidos_conteudo pc
                                  JOIN usuario u ON pc.usuario_id = u.id
                                  WHERE pc.id_pai = '$pedido_id'
                                  ORDER BY pc.id ASC";

                $respostas = $conn->query($sql_respostas);

                if ($respostas && $respostas->num_rows > 0) {
                  echo "<div class='mt-4 ps-4'>";

                  while ($resposta = $respostas->fetch_assoc()) {
                    $resposta_nome = htmlspecialchars($resposta['nome']);
                    $resposta_foto = $resposta['foto'];
                    $resposta_conteudo = htmlspecialchars($resposta['conteudo']);
                    $resposta_data = $resposta['data_pedido'] ? date('d/m/Y', strtotime($resposta['data_pedido'])) : '';
                    if ($resposta_nome == $_SESSION['nome_usuario']) {
                      $resposta_nome = 'Você';
                    }
                    echo "
                        <div class='d-flex justify-content-between align-items-start mb-3'>
                          <div class='d-flex'>
                            <img src='$resposta_foto' class='rounded-circle me-2' width='30' height='30' alt=''>
                            <div>
                              <strong>$resposta_nome</strong><br>
                              <small class='text-muted'>$resposta_data</small>
                              <p class='mb-0'>$resposta_conteudo</p>
                            </div>
                          </div>


                    ";
                    if ($resposta['usuario_id'] == $_SESSION['usuario_id']) {
                      echo "
                        <div class='dropdown'>
                          <button class='btn btn-sm btn-light dropdown-toggle' type='button' id='dropdownMenuButton{$resposta['id']}' data-bs-toggle='dropdown' aria-expanded='false'>
                            <i class='bi bi-three-dots-vertical'></i>
                          </button>
                          <ul class='dropdown-menu dropdown-menu-end' aria-labelledby='dropdownMenuButton{$resposta['id']}'>
                            <li>
                              <form action='excluir_pedido.php' method='POST' style='margin: 0;'>
                                <input type='hidden' name='pedido_id' value='{$resposta['id']}'>
                                <button class='dropdown-item text-danger' type='submit' onclick=\"return confirm('Tem certeza que deseja excluir este aviso?');\">Excluir Resposta</button>
                              </form>
                            </li>
                          </ul>
                      </div>";

                  }
                  echo"</div>";
                  }
                  echo "</div>";
                }

                echo "
                      </div>
                    </div>
                  </div>
                ";
              }
            } else {
              echo "
                <div class='alert alert-info' role='alert'>
                    Nenhum pedido foi feito para esta monitoria ainda.
                </div>
              ";
            }
            ?>
          </div>

        </div>
      </div>
    </div>
<script>
  function toggleRespostaForm(pedidoId) {
    const form = document.getElementById('resposta-form-' + pedidoId);
    if (form) {
      form.classList.toggle('d-none');
    }
  }
</script>
