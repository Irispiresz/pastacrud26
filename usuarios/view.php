<?php
session_start();
include("../config.php");
require_once(DBAPI);

$usuario = null;
$is_admin = (isset($_SESSION['user']) && $_SESSION['user'] === 'admin');
$id_to_view = null;

function view($id) {
    global $usuario;
    $usuario = find('usuarios', $id); 
}

if (isset($_GET['id'])) {
    $id_to_view = $_GET['id'];
} elseif (isset($_SESSION['id'])) {
    $id_to_view = $_SESSION['id'];
}

if ($id_to_view) {
    view($id_to_view);
}

if (!$usuario) {
    $_SESSION['message'] = 'Usuário não encontrado.';
    $_SESSION['type'] = 'danger';
    header("Location:" . BASEURL . "usuarios/index.php"); 
    exit;
}

include(HEADER_TEMPLATE);
?>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show mt-3" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<h2 class="mb-4 mt-3">
    Usuário #<?php echo htmlspecialchars($usuario['id'] ?? 'N/A'); ?> – 
    <?php echo htmlspecialchars($usuario['nome'] ?? ''); ?>
</h2>
<hr>

<div class="container">

    <!-- FOTO -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body text-center">
            <img src="fotos/<?php echo htmlspecialchars($usuario['foto'] ?? 'semimagem.jpg'); ?>" 
                 alt="<?php echo htmlspecialchars($usuario['nome'] ?? 'Usuário'); ?>" 
                 class="img-fluid rounded" style="max-height: 300px; width:300px">
        </div>
    </div>

    <!-- INFORMAÇÕES -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h4 class="card-title mb-3">Informações do Usuário</h4>

            <p><strong>Nome:</strong><br>
                <?php echo htmlspecialchars($usuario['nome'] ?? ''); ?>
            </p>

            <p><strong>Login:</strong><br>
                <?php echo htmlspecialchars($usuario['user'] ?? ''); ?>
            </p>

            <p><strong>Hash da Senha:</strong><br>
                <code><?php echo htmlspecialchars($usuario['password'] ?? ''); ?></code>
            </p>
        </div>
    </div>

    <!-- AÇÕES -->
    <div class="mb-5">
        <a href="edit.php?id=<?php echo htmlspecialchars($usuario['id'] ?? ''); ?>" class="btn btn-primary me-2">
            <i class="fa-solid fa-edit"></i> Editar
        </a>
        <a href="index.php" class="btn btn-light">
            <i class="fa-solid fa-rotate-left"></i> Voltar
        </a>
    </div>

</div>

<?php 
clear_messages();
include(FOOTER_TEMPLATE); 
?>
