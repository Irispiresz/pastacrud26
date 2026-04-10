<?php 
require_once 'functions.php';
session_start();

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
    
}

$id = intval($_GET['id']);
$time = find('times', $id);

if (!$time) {
    die('Time não encontrado.');
}

include(HEADER_TEMPLATE); 
?>

<h2 class="mb-4">Time #<?php echo htmlspecialchars($time['id'] ?? 'N/A'); ?> – <?php echo htmlspecialchars($time['nome'] ?? ''); ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo htmlspecialchars($_SESSION['type']); ?>">
        <?php echo htmlspecialchars($_SESSION['message']); ?>
    </div>
<?php endif; ?>

<div class="plant-details">

    <div class="card mb-4 shadow-sm">
        <div class="card-body text-center">
            <img src="uploads/<?php echo htmlspecialchars($time['foto'] ?? 'semimagem.jpg'); ?>" 
                 alt="<?php echo htmlspecialchars($time['nome'] ?? 'Time'); ?>" 
                 class="img-fluid mb-3" style="max-height: 300px;">
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Informações do Time</h5>

            <p><strong>Nome:</strong><br>
            <?php echo htmlspecialchars($time['nome'] ?? ''); ?></p>

            <p><strong>Estado:</strong><br>
            <?php echo htmlspecialchars($time['estado'] ?? ''); ?></p>

            <p><strong>Divisão:</strong><br>
            <?php echo htmlspecialchars($time['divisao'] ?? ''); ?></p>

            <p><strong>Data de Cadastro:</strong><br>
            <?php echo date('d/m/Y', strtotime($time['datacad'] ?? 'now')); ?></p>
        </div>
    </div>


</div>

    <a href="edit.php?id=<?php echo htmlspecialchars($time['id'] ?? ''); ?>" class="btn btn-primary me-2">
        <i class="fa-solid fa-edit"></i> Editar
    </a>
    <a href="index.php" class="btn btn-secondary">
        <i class="fa-solid fa-rotate-left"></i> Voltar à Lista
    </a>

<?php include(FOOTER_TEMPLATE); ?>