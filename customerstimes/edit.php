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
        'nome' => '',
        'estado' => '',
        'divisao' => '',
        'datacad' => '',
        'foto' => '',
    ];
}
?>
    
<h2>Editar Time "<?= htmlspecialchars($time['nome'] ?? 'N/A') ?>"</h2>

<form action="edit.php?id=<?= htmlspecialchars($time['id'] ?? '') ?>" method="post" enctype="multipart/form-data">
    
<div class="row">
    
        <div class="form-group col-md-3">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="time[nome]" maxlength="50" value="<?= htmlspecialchars($time['nome'] ?? '') ?>" required>
        </div>
        
  <div class="form-group col-md-4">
            <label for="estado">Escolha um Estado:</label>
            <select class="form-control" id="estado" name="time[estado]" value="<?= htmlspecialchars($time['estado'] ?? '') ?>" required>
               <option value="São Paulo - SP" <?= ($time['estado'] ?? '') == 'São Paulo - SP' ? 'selected' : '' ?>>São Paulo - SP</option>
                <option value="Rio de Janeiro - RJ" <?= ($time['estado'] ?? '') == 'Rio de Janeiro - RJ' ? 'selected' : '' ?>>Rio de Janeiro - RJ</option>
                <option value="Rio Grande do Sul - RS" <?= ($time['estado'] ?? '') == 'Rio Grande do Sul - RS' ? 'selected' : '' ?>>Rio Grande do Sul - RS</option>
                <option value="Minas Gerais - MG" <?= ($time['estado'] ?? '') == 'Minas Gerais - MG' ? 'selected' : '' ?>>Minas Gerais - MG</option>
                <option value="Bahia - BA" <?= ($time['estado'] ?? '') == 'Bahia - BA' ? 'selected' : '' ?>>Bahia - BA</option>
                <option value="Ceará - CE" <?= ($time['estado'] ?? '') == 'Ceará - CE' ? 'selected' : '' ?>>Ceará - CE</option>
                <option value="Pernambuco - PE" <?= ($time['estado'] ?? '') == 'Pernambuco - PE' ? 'selected' : '' ?>>Pernambuco - PE</option>
                <option value="Goiás - GO" <?= ($time['estado'] ?? '') == 'Goiás - GO' ? 'selected' : '' ?>>Goiás - GO</option>
                <option value="Santa Catarina - SC" <?= ($time['estado'] ?? '') == 'Santa Catarina - SC' ? 'selected' : '' ?>>Santa Catarina - SC</option>
                <option value="Paraná - PR" <?= ($time['estado'] ?? '') == 'Paraná - PR' ? 'selected' : '' ?>>Paraná - PR</option>
                <option value="Amazonas - AM" <?= ($time['estado'] ?? '') == 'Amazonas - AM' ? 'selected' : '' ?>>Amazonas - AM</option>
            </select>
    </div>
 <div class="form-group col-md-4">
        <label for="divisao">Escolha uma Divisão:</label>
        <select class="form-control" id="divisao" name="time[divisao]" value="<?= htmlspecialchars($time['divisao'] ?? '') ?>"required>
             <option value="">Selecione</option>
            <option value="Série A" <?= ($time['divisao'] ?? '') == 'Série A' ? 'selected' : '' ?>>Série A</option>
            <option value="Série B" <?= ($time['divisao'] ?? '') == 'Série B' ? 'selected' : '' ?>>Série B</option>
            <option value="Série C" <?= ($time['divisao'] ?? '') == 'Série C' ? 'selected' : '' ?>>Série C</option>
            <option value="Série D" <?= ($time['divisao'] ?? '') == 'Série D' ? 'selected' : '' ?>>Série D</option>
        </select>
    </div>
</div>

    

        <div class="form-group col-md-3">
            <label for="datacad">Data de Cadastro</label>
            <input type="date" class="form-control" id="datacad" name="time[datacad]" value="<?= htmlspecialchars(($time['datacad'] ?? false) ? date('Y-m-d', strtotime($time['datacad'])) : '1970-01-01') ?>" required>
        </div>

   <div class="row mt-3">

    <!-- INPUT -->
    <div class="form-group col-md-4">
        <label for="foto">Imagem</label>
        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
    </div>

    <!-- IMAGEM ATUAL -->
    <div class="form-group col-md-2">
        <label>Imagem Atual</label><br>

        <?php
        $fotoAtual = (!empty($time['foto']) && file_exists('uploads/' . $time['foto']))
            ? $time['foto']
            : 'semimagem.jpg';
        ?>

        <img src="uploads/<?php echo htmlspecialchars($fotoAtual); ?>" 
             style="width:120px;height:120px;object-fit:cover;border-radius:6px;">
    </div>

    <!-- PRÉ-VISUALIZAÇÃO -->
    <div class="form-group col-md-3">
        <label>Pré-visualização</label><br>

        <img src="uploads/semimagem.jpg" 
             id="imagem" 
             class="img-thumbnail shadow" 
             width="120px">
    </div>

</div>
        

    <div class="row mt-3">
        <div class="col-md-12">
            <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-floppy-disk"></i> Salvar Time</button>
            <a href="index.php" class="btn btn-light"><i class="fa-solid fa-ban"></i> Cancelar</a>
        </div>
    </div>
</form>
<script>
document.getElementById('foto').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagem').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>

<?php include(FOOTER_TEMPLATE); ?>
