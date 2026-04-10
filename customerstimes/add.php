<?php 
require_once "functions.php"; 
session_start();
 require_once('../inc/auten.php');
    require_login(); // qualquer usuário pode acessar
add(); // função do functions.php de plantas
include(HEADER_TEMPLATE); 

?>
<h2>Nova Planta</h2>

<form action="add.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="especie" >Espécie</label>
            <input type="text" class="form-control" id="especie" name="planta[especie]" maxlength="50" placeholder="Ex: Alecrim" required>
        </div>

        <div class="form-group col-md-6">
            <label for="tipo">Tipo</label>
            <input type="text" class="form-control" id="tipo" name="planta[tipo]" maxlength="40" placeholder="Ex: Briófitas" required>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label for="porte">Porte (cm)</label>
            <input type="number" class="form-control" id="porte" name="planta[porte]" min="1" max="999"  placeholder="Ex: 12" required>
        </div>

        <div class="form-group col-md-4">
            <label for="datacad">Data de Cadastro</label>
            <input type="date" class="form-control" id="datacad" name="planta[datacad]" value="<?= date('Y-m-d') ?>" required>
        </div>
  </div>
  
  <div class="form-group col-md-4">
            <label for="foto">Imagem</label>   <?php 
        // Se não tiver imagem, usa padrão
        $foto = !empty($usuario['foto']) ? $usuario['foto'] : "semimagem.png";
    ?>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
        </div>

        <div class="form-group col-md-4">
            <label for="imagem">Pré-Visualização:</label><br>
            <img src="uploads/semimagem.jpg" id="imagem" class="img-thumbnail shadow" width="150px">
         </div>
    </div>

    <div class="row mt-2">
        <div class="form-group col-md-12">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="planta[descricao]" rows="4" maxlength="250"></textarea>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <button type="submit" class="btn btn-secondary">
                <i class="fa-solid fa-floppy-disk"></i> Salvar Planta
            </button>
            <a href="index.php" class="btn btn-light"><i class="fa-solid fa-ban"></i> Cancelar</a>
        </div>
    </div>
</form>

<script src="<?php echo BASEURL; ?>js/jquery-3.7.1.min.js"></script>
<script>
  $(document).ready(function() {
    $('#foto').on('change', function(event) {
      const file = event.target.files[0];
      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
          $('#imagem').attr('src', e.target.result).show();
        };
        reader.readAsDataURL(file);
      } else {
        $('#imagem').attr('src', 'uploads/semimagem.jpg').hide();
      }
    });
  });
</script>

<?php include(FOOTER_TEMPLATE); ?>
