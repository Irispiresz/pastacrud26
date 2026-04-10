<?php
    require_once("functions.php");
    session_start();
    index();
    include(HEADER_TEMPLATE);
?>
        <header>
            <div class="row">
                <div class="col-sm-6">
                    <h2>Times</h2> <!-- Alterado de Clientes para Plantas -->
                </div>
                <div class="col-sm-6 text-right h2">
                    <a class="btn btn-secondary" href="add.php"><i class="fa-solid fa-user-plus"></i> Novo Time</a> <!-- Alterado -->
                <a class="btn btn-light" href="index.php"><i class="fas fa-sync-alt"></i> Atualizar</a>
                </div>
            </div>
        </header>

        <?php if (!empty($_SESSION['message'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
            // Limpar mensagens após exibir
            unset($_SESSION['message']);
            unset($_SESSION['type']);
            ?>
        <?php endif; ?>

        <hr>

        <div class="table-responsive">
    <table class="table table-hover">
            <thead>
                 <tr>
                    <th>ID</th>
                    <th width="20%">Espécie</th>
                    <th>Tipo</th>
                    <th>Porte (cm)</th>
                    <th>Data Cad.</th>
                    <th>Foto</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($plantas) : ?>
            <?php foreach ($plantas as $planta) : ?>
               <tr>
                    <td><?php echo $planta['id']; ?></td>
                    <td><?php echo htmlspecialchars($planta['especie']); ?></td>
                    <td><?php echo htmlspecialchars($planta['tipo']); ?></td>
                    <td><?php echo htmlspecialchars($planta['porte']); ?></td>
                    <td><?php echo formatadata($planta['datacad'], 'd/m/Y'); ?></td>
                    <td>
                        <?php if (!empty($planta['foto'])): ?>
                            <img src="uploads/<?php echo htmlspecialchars($planta['foto']); ?>" 
                                 alt="<?php echo htmlspecialchars($planta['especie']); ?>" 
                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                        <?php else: ?>
                            <img src="uploads/semimagem.jpg" 
                                alt="Sem imagem" 
                                style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                         <?php endif; ?>

                    </td>
                    <td class="actions text-right">
                        <a href="view.php?id=<?php echo $planta['id']; ?>" class="btn btn-sm btn-dark"><i class="fa-solid fa-eye"></i> Visualizar</a>
                        <a href="edit.php?id=<?php echo $planta['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                        <a href="#" 
                            class="btn btn-sm btn-light" 
                            data-bs-toggle="modal" 
                            data-bs-target="#delete-modal" 
                            data-bs-planta-id="<?php echo $planta['id']; ?>"
                            data-bs-planta-name="<?php echo htmlspecialchars($planta['especie']); ?>">
                            <i class="fa-solid fa-trash-can"></i> Excluir
                        </a>


                    </td>
                </tr>
            <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7">Nenhum registro encontrado.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        </div>

        <!-- Bootstrap JavaScript -->
        <!-- JavaScript para o modal -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteModal = document.getElementById('delete-modal');
            
            if (deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget;
                    var id = button.getAttribute('data-bs-planta-id');
                    var name = button.getAttribute('data-bs-planta-name');
                    
                    var modalTitle = this.querySelector('.modal-title');
                    var plantaName = this.querySelector('#planta-name');
                    var confirmDelete = this.querySelector('#confirm-delete');
                    
                    if (modalTitle) modalTitle.textContent = 'Excluir Planta: ' + id;
                    if (plantaName) plantaName.textContent = name;
                    if (confirmDelete) confirmDelete.href = 'delete.php?id=' + id;
                });
            }
        });
        </script>

<?php
    include "modal.php"; 
    include(FOOTER_TEMPLATE); 
?>