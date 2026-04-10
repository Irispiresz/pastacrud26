<div class="modal fade" id="delete-usuario" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Excluir Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir o usuário <strong id="customer-name"></strong>?
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-danger" id="confirm-delete">Excluir</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Script pra preencher o modal com o ID e nome
  var deleteModal = document.getElementById('delete-usuario');
  deleteModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var usuarioId = button.getAttribute('data-usuario');
    var usuarioNome = button.getAttribute('data-nome');

    var modalTitle = deleteModal.querySelector('.modal-title');
    var modalBodyNome = deleteModal.querySelector('#customer-name');
    var confirmDelete = deleteModal.querySelector('#confirm-delete');

    modalTitle.textContent = 'Excluir Usuário';
    modalBodyNome.textContent = usuarioNome;
    confirmDelete.href = 'delete.php?id=' + usuarioId;
  });
</script>