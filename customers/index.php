<?php


   require_once("functions.php");
index();
require_once "../inc/auten.php";

    session_start();


include(HEADER_TEMPLATE); 

?>
        <header>
            <div class="row">
                <div class="col-sm-6">
                    <h2>Clientes</h2>
                </div>
                <div class="col-sm-6 text-right h2">
                    <a class="btn btn-secondary" href="add.php"><i class="fa-solid fa-user-plus"></i> Novo Cliente</a>
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
                    <th width="30%">Nome</th>
                    <th>CPF/CNPJ</th>
                    <th>Telefone</th>
                    <th>Atualizado em</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($customers) : ?>
            <?php foreach ($customers as $customer) : ?>
                <tr>
                    <td><?php echo $customer['id']; ?></td>
                    <td><?php echo $customer['name']; ?></td>
                    <td><?php echo $customer['cpf_cnpj']; ?></td>
                    <td><?php echo formataTel($customer['mobile']); ?></td>
                    <td><?php echo formatadata($customer['modified'], "d/m/Y - H:i:s"); ?></td>
                    <td class="actions">
                         <div class="d-flex flex-wrap gap-1">
                        <a href="view.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-dark"><i class="fa-solid fa-eye"></i> Visualizar</a>
                        <a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                      <a href="#" 
   class="btn btn-sm btn-light" 
   data-bs-toggle="modal" 
   data-bs-target="#delete-modal" 
   data-customer-id="<?php echo $customer['id']; ?>"
   data-customer-name="<?php echo htmlspecialchars($customer['name']); ?>">
   <i class="fa-solid fa-trash-can"></i> Excluir
</a>
                         </div>
                    </td>
                
                </tr>
            <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">Nenhum registro encontrado.</td>
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