<div class="modal fade" id="delete-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Excluir Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir o cliente <strong id="customer-name"></strong>?
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-danger" id="confirm-delete">Excluir</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var deleteModal = document.getElementById('delete-modal');

    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // botão que acionou o modal
        var id = button.getAttribute('data-customer-id');
        var name = button.getAttribute('data-customer-name');

        // Atualiza o conteúdo do modal
        var modalTitle = deleteModal.querySelector('.modal-title');
        var customerName = deleteModal.querySelector('#customer-name');
        var confirmDelete = deleteModal.querySelector('#confirm-delete');

        modalTitle.textContent = 'Excluir Cliente: ' + id;
        customerName.textContent = name;
        confirmDelete.href = 'delete.php?id=' + id; // link real para deletar
    });
});
</script>
