<?php 
require_once "functions.php"; 
session_start();
require_once('../inc/auten.php');
require_login();

edit(); // isso carrega $time ou processa o POST
include(HEADER_TEMPLATE);


if (!isset($time) || !is_array($time)) {
    $time = [
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
    
<h2>Editar time$time <?= htmlspecialchars($time['id'] ?? 'N/A') ?></h2>

<form action="edit.php?id=<?= htmlspecialchars($time['id'] ?? '') ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="especie">Nome</label>
            <input type="text" class="form-control" id="especie" name="time$time[especie]" maxlength="50" value="<?= htmlspecialchars($time['especie'] ?? '') ?>" required>
        </div>

        <div class="form-group col-md-6">
            <label for="tipo">Tipo</label>
            <input type="text" class="form-control" id="tipo" name="time$time[tipo]" maxlength="40" value="<?= htmlspecialchars($time['tipo'] ?? '') ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label for="porte">Porte (cm)</label>
            <input type="number" class="form-control" id="porte" name="time$time[porte]" min="1" max="10000" value="<?= htmlspecialchars($time['porte'] ?? '') ?>" required>
        </div>

        <div class="form-group col-md-4">
            <label for="datacad">Data de Cadastro</label>
            <input type="date" class="form-control" id="datacad" name="time$time[datacad]" value="<?= htmlspecialchars(($time['datacad'] ?? false) ? date('Y-m-d', strtotime($time['datacad'])) : '1970-01-01') ?>" required>
        </div>

      

        <div class="form-group col-md-4">
            <label for="foto">Imagem</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            <?php if (!empty($time['foto'])): ?>
                <small>Foto atual:</small><br>
                <img src="uploads/<?= htmlspecialchars($time['foto']); ?>" alt="Foto" style="width:100px;height:100px;object-fit:cover;margin-top:5px;border-radius:4px;">
            <?php endif; ?>
        </div>
    </div>

    <div class="row mt-2">
        <div class="form-group col-md-12">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="time$time[descricao]" rows="4" maxlength="250"><?= htmlspecialchars($time['descricao'] ?? '') ?></textarea>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-floppy-disk"></i> Salvar time$time</button>
            <a href="index.php" class="btn btn-light"><i class="fa-solid fa-ban"></i> Cancelar</a>
        </div>
    </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>
