<!-- modal.php -->
<div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModalLabel">Excluir Time</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir este time?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a id="confirm-delete" class="btn btn-danger" href="#">Excluir</a>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var deleteModal = document.getElementById('delete-modal');
    
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-bs-time-id');
            var nome = button.getAttribute('data-bs-time-nome');
            
            var modalTitle = this.querySelector('.modal-title');
            var timenome = this.querySelector('#time-nome');
            var confirmDelete = this.querySelector('#confirm-delete');
            
            if (modalTitle) modalTitle.textContent = 'Excluir Time: ' + nome;
            if (timenome) timenome.textContent = nome;
            if (confirmDelete) confirmDelete.href = 'delete.php?id=' + id;
        });
    }
});
</script>
