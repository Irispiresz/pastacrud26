<?php 
// index.php
require("functions.php");
session_start();
index();
include(HEADER_TEMPLATE);
require_once("../inc/auten.php");
require_admin(); // só admin

?>

<header style="margin-top:10px;">
  <div class="row">
    <div class="col-sm-6">
      <h2>Usuários</h2>
    </div>

    
    <div class="col-sm-6 text-end h2">
      <a class="btn btn-secondary" href="add.php"><i class="fa-solid fa-user-plus"></i> Novo Usuário</a>
      <a class="btn btn-light" href="index.php"><i class="fas fa-sync-alt"></i> Atualizar</a>
    </div>
  </div>
</header>

<form name="filtro" action="index.php" method="post">
  <div class="row">
    <div class="form-group col-md-4">
      <div class="input-group mb-3">
        <input type="text" class="form-control" maxlength="80" name="users" required>
        <button type="submit" class="btn btn-secondary"><i class="fa fa-search"></i> Consultar</button>
      </div>
    </div>
  </div>
</form>

<?php if (!empty($_SESSION['message'])) : ?>
  <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
    <?php echo $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-hover">  <thead>
    <tr>
      <th>ID</th>
      <th width="30%">Nome</th>
      <th>Login</th>
      <th>Foto</th>
      <th>Opções</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($usuarios) : ?>
      <?php foreach ($usuarios as $usuario) : ?>
        <tr>
          <td><?php echo $usuario['id']; ?></td>
          <td><?php echo $usuario['nome']; ?></td>
          <td><?php echo $usuario['user']; ?></td>

          <?php 
            // Se não tiver imagem, mostra padrão
            $foto = !empty($usuario['foto']) ? $usuario['foto'] : "semimagem.png";
          ?>

          <td>
            <img src="fotos/<?php echo $foto; ?>" 
                 class="img-thumbnail shadow" 
                 width="100" 
                 alt="Foto do usuário">
          </td>

         <td class="actions">
                         <div class="d-flex flex-wrap gap-1">
            <a href="view.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-dark">
              <i class="fa fa-eye"></i> Visualizar
            </a>
            <a href="edit.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-secondary">
              <i class="fa fa-edit"></i> Editar
            </a>
            <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete-usuario" data-usuario="<?php echo $usuario['id']; ?>" data-nome="<?php echo $usuario['nome']; ?>">
              <i class="fa-solid fa-trash-can"></i> Excluir
            </a>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else : ?>
      <tr>
        <td colspan="5">Nenhum registro encontrado.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>
</div>

<?php include("modal.php"); ?>
<?php include(FOOTER_TEMPLATE); ?>


