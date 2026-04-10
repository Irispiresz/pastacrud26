<?php 
require_once "functions.php"; 
session_start();
edit();

include(HEADER_TEMPLATE); 
?>

<header>
    <h2>Editar o Usuário</h2>
</header>

<form action="edit.php?id=<?php echo htmlspecialchars($usuario['id'] ?? ''); ?>" method="post" enctype="multipart/form-data">
    <hr>

    <div class="row">
        <div class="form-group col-md-8">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="usuario[nome]" value="<?php echo htmlspecialchars($usuario['nome'] ?? ''); ?>">
        </div>
    </div>

    
  <div class="row">
    <div class="form-group col-md-5">
      <label for="user">User</label>
      <input type="text" class="form-control" inputmode="numeric" id="user" name="usuario[user]" maxlength="50" value="<?php echo htmlspecialchars($usuario['user'] ?? ''); ?>">
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

    <?php 
        // Se não tiver imagem, usa padrão
        $foto = !empty($usuario['foto']) ? htmlspecialchars($usuario['foto']) : "semimagem.png";
    ?>

    <div class="row">
        <div class="form-group col-md-4">
            <label for="foto">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
        </div>

        <div class="form-group col-md-2 text-center">
            <label>Pré-visualização</label><br>

            <!-- CORRIGIDO: caminho da imagem -->
            <img id="imgPreview" 
                 src="fotos/<?php echo $foto ?>" 
                 alt="Foto do Usuário"
                 class="shadow p-2 mb-2 bg-body rounded" 
                 width="120" 
                 style="border-radius: 8px;">
        </div>
    </div>

    <div id="actions" class="row mt-3">
        <div class="col-md-12">
            <button type="submit" class="btn btn-secondary">
                <i class="fa-solid fa-sd-card"></i> Salvar
            </button>
            <a href="index.php" class="btn btn-light">
                <i class="fa-solid fa-rotate-left"></i> Cancelar
            </a>
        </div>
    </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>
<script>
function previewImage(event) {
    const preview = document.getElementById('imgPreview');
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = () => preview.src = reader.result;
        reader.readAsDataURL(file);
    } else {
        preview.src = 'usuarios/fotos/semimagem.png';
    }
}
</script>

<!-- VALIDAR SENHAS ANTES DE ENVIAR -->
<script>
document.querySelector("form").addEventListener("submit", function(e) {

    const senha1 = document.getElementById("password").value.trim();
    const senha2 = document.getElementById("password2").value.trim();

    let aviso = document.getElementById("erro-senha");
    if (aviso) aviso.remove();

    const divErro = document.createElement("div");
    divErro.id = "erro-senha";
    divErro.className = "alert alert-danger mt-2";

    // se estiver editando e NÃO mudou a senha → permitir
    if (senha1 === "" && senha2 === "") return;

    // caso queira obrigar confirmar a senha se digitou algo:
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
    }
});
</script>

<!-- OLHO DOS DOIS CAMPOS -->
<script>
document.addEventListener("DOMContentLoaded", function() {

    function addToggle(btnId, inputId, iconId) {
        const btn = document.getElementById(btnId);
        if (!btn) return;

        btn.addEventListener("click", function() {
            const campo = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

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
    }

    addToggle("togglePassword",  "password",  "iconPassword");
    addToggle("togglePassword2", "password2", "iconPassword2");
});
</script>
