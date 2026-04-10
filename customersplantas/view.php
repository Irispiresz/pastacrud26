<?php 
require_once 'functions.php';
session_start();

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
    
}

$id = intval($_GET['id']);
$planta = find('tabelaplantas', $id);

if (!$planta) {
    die('Planta não encontrada.');
}

include(HEADER_TEMPLATE); 
?>

<h2 class="mb-4">Planta #<?php echo htmlspecialchars($planta['id'] ?? 'N/A'); ?> – <?php echo htmlspecialchars($planta['especie'] ?? ''); ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo htmlspecialchars($_SESSION['type']); ?>">
        <?php echo htmlspecialchars($_SESSION['message']); ?>
    </div>
<?php endif; ?>

<div class="plant-details">

    <div class="card mb-4 shadow-sm">
        <div class="card-body text-center">
            <img src="uploads/<?php echo htmlspecialchars($planta['foto'] ?? 'semimagem.jpg'); ?>" 
                 alt="<?php echo htmlspecialchars($planta['especie'] ?? 'Planta'); ?>" 
                 class="img-fluid mb-3" style="max-height: 300px;">
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Informações da Planta</h5>

            <p><strong>Espécie:</strong><br>
            <?php echo htmlspecialchars($planta['especie'] ?? ''); ?></p>

            <p><strong>Tipo:</strong><br>
            <?php echo htmlspecialchars($planta['tipo'] ?? ''); ?></p>

            <p><strong>Porte:</strong><br>
            <?php 
                $porte = $planta['porte'] ?? 0;
                echo htmlspecialchars($porte) . ' cm (' . number_format($porte / 100, 2) . ' m)';
            ?></p>

            <p><strong>Data de Cadastro:</strong><br>
            <?php echo date('d/m/Y', strtotime($planta['datacad'] ?? 'now')); ?></p>
        </div>
    </div>

    <?php if (!empty($planta['descricao'])) : ?>
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Descrição</h5>
            <p><?php echo nl2br(htmlspecialchars($planta['descricao'])); ?></p>
        </div>
    </div>
    <?php endif; ?>

</div>

    <a href="edit.php?id=<?php echo htmlspecialchars($planta['id'] ?? ''); ?>" class="btn btn-primary me-2">
        <i class="fa-solid fa-edit"></i> Editar
    </a>
    <a href="index.php" class="btn btn-secondary">
        <i class="fa-solid fa-rotate-left"></i> Voltar à Lista
    </a>

<?php include(FOOTER_TEMPLATE); ?>
