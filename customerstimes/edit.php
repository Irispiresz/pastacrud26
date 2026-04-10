<?php 
require_once "functions.php"; 
session_start();
require_once('../inc/auten.php');
require_login();

edit(); // isso carrega $planta ou processa o POST
include(HEADER_TEMPLATE);


if (!isset($planta) || !is_array($planta)) {
    $planta = [
        'id' => '',
        'especie' => '',
        'tipo' => '',
        'porte' => '',
        'datacad' => '',
        'foto' => '',
        'descricao' => ''
    ];
}
?>
    
<h2>Editar Planta <?= htmlspecialchars($planta['id'] ?? 'N/A') ?></h2>

<form action="edit.php?id=<?= htmlspecialchars($planta['id'] ?? '') ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="especie">Espécie</label>
            <input type="text" class="form-control" id="especie" name="planta[especie]" maxlength="50" value="<?= htmlspecialchars($planta['especie'] ?? '') ?>" required>
        </div>

        <div class="form-group col-md-6">
            <label for="tipo">Tipo</label>
            <input type="text" class="form-control" id="tipo" name="planta[tipo]" maxlength="40" value="<?= htmlspecialchars($planta['tipo'] ?? '') ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label for="porte">Porte (cm)</label>
            <input type="number" class="form-control" id="porte" name="planta[porte]" min="1" max="10000" value="<?= htmlspecialchars($planta['porte'] ?? '') ?>" required>
        </div>

        <div class="form-group col-md-4">
            <label for="datacad">Data de Cadastro</label>
            <input type="date" class="form-control" id="datacad" name="planta[datacad]" value="<?= htmlspecialchars(($planta['datacad'] ?? false) ? date('Y-m-d', strtotime($planta['datacad'])) : '1970-01-01') ?>" required>
        </div>

      

        <div class="form-group col-md-4">
            <label for="foto">Imagem</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            <?php if (!empty($planta['foto'])): ?>
                <small>Foto atual:</small><br>
                <img src="uploads/<?= htmlspecialchars($planta['foto']); ?>" alt="Foto" style="width:100px;height:100px;object-fit:cover;margin-top:5px;border-radius:4px;">
            <?php endif; ?>
        </div>
    </div>

    <div class="row mt-2">
        <div class="form-group col-md-12">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="planta[descricao]" rows="4" maxlength="250"><?= htmlspecialchars($planta['descricao'] ?? '') ?></textarea>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-floppy-disk"></i> Salvar Planta</button>
            <a href="index.php" class="btn btn-light"><i class="fa-solid fa-ban"></i> Cancelar</a>
        </div>
    </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>
