<?php 
require_once('functions.php'); 
session_start();
view(); 
include(HEADER_TEMPLATE); 
?>


<h2 class="mb-4">Cliente #<?php echo htmlspecialchars($customer['id'] ?? 'N/A'); ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo htmlspecialchars($_SESSION['type']); ?>">
        <?php echo htmlspecialchars($_SESSION['message']); ?>
    </div>
<?php endif; ?>

<div class="customer-details">

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Informações Pessoais</h5>
            
            <p><strong>Nome / Razão Social:</strong><br>
            <?php echo htmlspecialchars($customer['name'] ?? ''); ?></p>

            <p><strong>CPF / CNPJ:</strong><br>
            <?php echo htmlspecialchars($customer['cpf_cnpj'] ?? ''); ?></p>

            <p><strong>Data de Nascimento:</strong><br>
            <?php echo formatadata($customer['birthdate'] ?? null, 'd/m/Y'); ?></p>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Endereço e Datas</h5>
            
            <p><strong>Endereço:</strong><br>
            <?php echo htmlspecialchars($customer['address'] ?? ''); ?></p>

            <p><strong>Bairro:</strong><br>
            <?php echo htmlspecialchars($customer['hood'] ?? ''); ?></p>

            <p><strong>CEP:</strong><br>
            <?php echo htmlspecialchars($customer['zip_code'] ?? ''); ?></p>

            <p><strong>Data de Cadastro:</strong><br>
            <?php echo formatadata($customer['created'] ?? null, 'd/m/Y H:i:s'); ?></p>

            <p><strong>Data da última Atualização:</strong><br>
            <?php echo formatadata($customer['modified'] ?? null, 'd/m/Y H:i:s'); ?></p>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Contato e Outras Informações</h5>

            <p><strong>Cidade:</strong><br>
            <?php echo htmlspecialchars($customer['city'] ?? ''); ?></p>

            <p><strong>Telefone:</strong><br>
            <?php echo formataTel($customer['phone'] ?? ''); ?></p>

            <p><strong>Celular:</strong><br>
            <?php echo formataTel($customer['mobile'] ?? ''); ?></p>

            <p><strong>UF:</strong><br>
            <?php echo htmlspecialchars($customer['state'] ?? ''); ?></p>

            <p><strong>Inscrição Estadual:</strong><br>
            <?php echo htmlspecialchars($customer['ie'] ?? ''); ?></p>
        </div>
    </div>

</div>

<div id="actions" class="mb-5">
    <a href="edit.php?id=<?php echo htmlspecialchars($customer['id'] ?? ''); ?>" class="btn btn-secondary me-2">
        <i class="fa-solid fa-pen-to-square"></i> Editar
    </a>
    <a href="index.php" class="btn btn-light">
        <i class="fa-solid fa-rotate-left"></i> Voltar
    </a>
</div>

<?php include(FOOTER_TEMPLATE); ?>
