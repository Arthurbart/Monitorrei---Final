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
            <button class="nav-link" id="chamada-tab" data-bs-toggle="tab" data-bs-target="#chamada" type="button" role="tab" aria-controls="chamada" aria-selected="false">Chamada</button>
          </li>
        </ul>
        <div class="tab-content mt-3" id="monitoriaTabsContent">

          <!-- Parte para o professor visualizar os comentarios do monitor -->
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
          <!-- Parte para o professor visualizar a chamada da monitoria -->
          <div class="tab-pane fade" id="chamada" role="tabpanel" aria-labelledby="chamada-tab">
            <div class='card mb-3'>
              <div class='card-header'>
                <p class='card-text text-center'>Relatório da Chamada</p>
                <div class='d-flex align-items-center justify-content-center'>
                  <i class='bi bi-file-earmark-pdf fs-4 text-danger me-2'></i>
                  <a href='relatorio.php?id_monitoria=<?php echo $id_monitoria; ?>' class='text-decoration-none' target='_blank'>Gerar Relatório</a>
                </div>
              </div>
            </div>

            <div class="container mt-3">
              <?php
              $query_dias = "SELECT DISTINCT data_presenca FROM presencas WHERE monitoria_id = ? ORDER BY data_presenca DESC";
              $stmt_dias = $conn->prepare($query_dias);

              if ($stmt_dias) {
                $stmt_dias->bind_param('i', $id_monitoria);
                $stmt_dias->execute();

                $result_dias = $stmt_dias->get_result();
                if ($result_dias) {
                  $dias_monitoria = [];
                  while ($row = $result_dias->fetch_assoc()) {
                    $dias_monitoria[] = $row['data_presenca'];
                  }
                  $stmt_dias->close();
                } else {
                  echo "Erro ao obter os dias de monitoria.";
                  exit();
                }
              } else {
                echo "Erro ao preparar a consulta para buscar os dias de monitoria.";
                exit();
              }

              if (!empty($dias_monitoria)) {
                foreach ($dias_monitoria as $dia) {
                  $dia_formatado = date('d/m/Y', strtotime($dia));
                  echo "<div class='card mb-3'>
                        <div class='card-header'>
                            <strong>Monitoria do dia " . htmlspecialchars($dia_formatado) . "</strong>
                        </div>
                        <div class='card-body'>";

                  $query_alunos = "SELECT u.id, u.nome, u.matricula, p.feedback FROM presencas p 
                                 INNER JOIN usuario u ON p.usuario_id = u.id 
                                 WHERE p.monitoria_id = ? AND p.data_presenca = ?";
                  $stmt_alunos = $conn->prepare($query_alunos);

                  if ($stmt_alunos) {
                    $stmt_alunos->bind_param('is', $id_monitoria, $dia);
                    $stmt_alunos->execute();
                    $result_alunos = $stmt_alunos->get_result();

                    if ($result_alunos) {
                      echo "<ul class='list-group'>";
                      while ($aluno = $result_alunos->fetch_assoc()) {
                        echo "<li class='list-group-item'>" . htmlspecialchars($aluno['nome']) . " (" . htmlspecialchars($aluno['matricula']) . ")";

                        // Botão de olho (+) para ver o feedback do aluno
                        echo "<button class='btn btn-sm btn-info float-end ms-2' data-bs-toggle='modal' data-bs-target='#feedbackModal' 
                                  data-feedback='" . htmlspecialchars($aluno['feedback']) . "' data-aluno='" . htmlspecialchars($aluno['nome']) . "'>
                                  Ver Feedback
                                  </button>";

                        echo "</li>";
                      }
                      echo "</div>";
                      echo "</div>";
                      echo "</ul>";
                      $stmt_alunos->close();
                    } else {
                      echo "Erro ao buscar alunos presentes.";
                    }
                  } else {
                    echo "Erro ao preparar a consulta para buscar alunos.";
                  }
                }
              } else {
                echo "<div class='alert alert-info'>Nenhuma monitoria encontrada.</div>";
              }
              ?>
            </div>
          </div>
          <!-- Modal dinamico para o professor visualizar o feedback de um aluno -->
          <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="feedbackModalLabel">Feedback do Aluno</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <strong>Aluno: </strong><span id="alunoNome"></span><br><br>
                  <strong>Feedback: </strong>
                  <p id="feedbackTexto"></p>
                </div>
              </div>
            </div>
          </div>

          <!-- Script para preencher o Modal com os dados do aluno em questao -->
          <script>
            // Script para preencher os dados do modal
            var feedbackModal = document.getElementById('feedbackModal');
            feedbackModal.addEventListener('show.bs.modal', function(event) {
              // Botão que acionou o modal
              var button = event.relatedTarget;
              var feedback = button.getAttribute('data-feedback');
              var alunoNome = button.getAttribute('data-aluno');

              // Preencher o modal com os dados
              var modalFeedback = feedbackModal.querySelector('#feedbackTexto');
              var modalAlunoNome = feedbackModal.querySelector('#alunoNome');
              modalFeedback.textContent = feedback || 'Nenhum feedback disponível.';
              modalAlunoNome.textContent = alunoNome;
            });
          </script>