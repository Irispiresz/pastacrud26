<?php 
  require_once "functions.php"; 
  session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    add();
}


  include(HEADER_TEMPLATE); 
?>

<h2>Novo Usuário</h2>

<form action="add.php" method="post" enctype="multipart/form-data">
  <hr />

  <div class="row">
    <div class="form-group col-md-7">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" id="nome" name="usuario[nome]" maxlength="100">
    </div>
  </div>

  <div class="row">
    <div class="form-group col-md-5">
      <label for="user">User</label>
      <input type="text" class="form-control" inputmode="numeric" id="user" name="usuario[user]" maxlength="50">
    </div>
  </div>

 <div class="form-group col-md-4 position-relative">
  <label for="password">Senha</label>
  <input type="password" class="form-control" id="password" name="usuario[password]" maxlength="100">
  <span class="position-absolute top-50 end-0 translate-middle-x pe-4" style="cursor:pointer;" id="togglePassword">
    <i class="fa-solid fa-eye" id="iconPassword"></i>
  </span>
</div>

<div class="form-group col-md-4 position-relative">
  <label for="password2">Confirmar Senha</label>
  <input type="password" class="form-control" id="password2" name="usuario[password2]" maxlength="100">
  <span class="position-absolute top-50 end-0 translate-middle-x pe-4" style="cursor:pointer;" id="togglePassword2">
    <i class="fa-solid fa-eye" id="iconPassword2"></i>
  </span>
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

  <div id="actions" class="row mt-2">
    <div class="col-md-12">
      <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-floppy-disk"></i> Salvar</button>
      <a href="index.php" class="btn btn-light"><i class="fa-solid fa-ban"></i> Cancelar</a>
    </div>
  </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>

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
<script>
document.querySelector("form").addEventListener("submit", function(e) {

    const senha1 = document.getElementById("password").value.trim();
    const senha2 = document.getElementById("password2").value.trim();

    // apagar mensagens antigas
    let aviso = document.getElementById("erro-senha");
    if (aviso) aviso.remove();

    // criar elemento de erro
    const divErro = document.createElement("div");
    divErro.id = "erro-senha";
    divErro.className = "alert alert-danger mt-2";

    // validações
    if (senha1 === "" || senha2 === "") {
        e.preventDefault();
        divErro.textContent = "Preencha os dois campos de senha.";
        document.querySelector("form").prepend(divErro);
        return;
    }

    if (senha1 !== senha2) {
        e.preventDefault();
        divErro.textContent = "As senhas não coincidem!";
        document.querySelector("form").prepend(divErro);
        return;
    }

});
</script>
<script>
  // Toggle senha principal
  document.getElementById("togglePassword").addEventListener("click", function() {
      const campo = document.getElementById("password");
      const icon = document.getElementById("iconPassword");
      if (campo.type === "password") {
          campo.type = "text";
          icon.classList.remove("fa-eye");
          icon.classList.add("fa-eye-slash");
      } else {
          campo.type = "password";
          icon.classList.remove("fa-eye-slash");
          icon.classList.add("fa-eye");
      }
  });

  // Toggle senha de confirmação
  document.getElementById("togglePassword2").addEventListener("click", function() {
      const campo = document.getElementById("password2");
      const icon = document.getElementById("iconPassword2");
      if (campo.type === "password") {
          campo.type = "text";
          icon.classList.remove("fa-eye");
          icon.classList.add("fa-eye-slash");
      } else {
          campo.type = "password";
          icon.classList.remove("fa-eye-slash");
          icon.classList.add("fa-eye");
      }
  });
</script>

