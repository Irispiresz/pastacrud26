<?php 
include("../config.php");
include(HEADER_TEMPLATE);

if (session_status() === PHP_SESSION_NONE) session_start();

// Exibir mensagens salvas (alertas)
if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show mt-3" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php 
    unset($_SESSION['message']);
    unset($_SESSION['type']);

endif;  
?>



<div id="actions" class="mt-5 mb-5">
    
    <form action="valida.php" method="post">
        <div class="row">

            <!-- LOGIN -->
            <div class="form-floating col-12 mb-2">
                <input type="text" class="form-control" id="log" placeholder="Usuário" name="login">
                <label for="log">User</label>
            </div>

            <!-- SENHA -->
            <div class="form-floating col-12 mb-2">
                <input type="password" class="form-control" id="pass" placeholder="Senha" name="senha">
                 <span class="position-absolute top-50 end-0 translate-middle-y pe-5" style="cursor:pointer;" id="toggleSenha">
                      <i class="fa-regular fa-eye" id="iconSenha"></i>
                </span>
                <label for="pass">Senha</label>
            </div>

            <!-- BOTÕES -->
            <div class="col-12 mb-2">
                <button type="submit" class="btn btn-secondary btn-block mb-4">
                    <i class="fa-solid fa-user-check"></i> Conectar
                </button>

                <a href="<?php echo BASEURL; ?>" class="btn btn-light btn-block mb-4">
                    <i class="fa-solid fa-rotate-left"></i> Cancelar
                </a>
            </div>

        </div>
    </form>
</div>



<?php include(FOOTER_TEMPLATE); ?>
