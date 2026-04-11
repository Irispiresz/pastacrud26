<?php
require_once "config.php";
require_once DBAPI;

// start da sessão antes de incluir header (header pode usar sessão)
if (!isset($_SESSION)) session_start();

include(HEADER_TEMPLATE);

// abre DB (pode retornar false ou null se falhar)
$db = open_database();
?>

<h1>Tela Inicial</h1>
<hr>

<?php if ($db) : ?>

<div class="row mb-2">
    <!-- Mostrar botão 'Novo Cliente' SOMENTE se o usuário estiver logado -->
    <?php if (isset($_SESSION['user'])) : ?>
    <div class="col-xs-6 col-sm-3 col-md-2">
        <a href="<?php echo BASEURL; ?>customers/add.php" class="btn btn-secondary">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <i class="fa-solid fa-user-plus fa-5x"></i>
                </div>
                <div class="col-xs-12 text-center">
                    <p>Novo Cliente</p>
                </div>
            </div>
        </a>
    </div>
    <?php endif; ?>

    <div class="col-xs-6 col-sm-3 col-md-2">
        <a href="<?php echo BASEURL; ?>customers" class="btn btn-index">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <i class="fa-solid fa-users fa-5x"></i>
                </div>
                <div class="col-xs-12 text-center">
                    <p>Clientes</p>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row mt-2">
    <?php if (isset($_SESSION['user'])) : ?>
    <div class="col-xs-6 col-sm-3 col-md-2" id="btn-nova-planta">
        <a href="<?php echo BASEURL; ?>customersplantas/add.php" class="btn btn-secondary">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <i class="fa-solid fa-leaf fa-5x"></i>
                </div>
                <div class="col-xs-12 text-center">
                    <p>Nova Planta</p>
                </div>
            </div>
        </a>
    </div>
    <?php endif; ?>

    <div class="col-xs-6 col-sm-3 col-md-2" id="btn-plantas">
        <a href="<?php echo BASEURL; ?>customersplantas/index.php" class="btn btn-index">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <i class="fa-solid fa-seedling fa-5x"></i>
                </div>
                <div class="col-xs-12 text-center">
                    <p>Plantas</p>
                </div>
            </div>
        </a>
    </div>
</div>


<!-- parte do customers times-->
<div class="row mt-2">
    <?php if (isset($_SESSION['user'])) : ?>
    <div class="col-xs-6 col-sm-3 col-md-2" id="btn-nova-planta">
        <a href="<?php echo BASEURL; ?>customerstimes/add.php" class="btn btn-secondary">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <i class="fa-solid fa-plus fa-5x"></i>
                </div>
                <div class="col-xs-12 text-center">
                    <p>Novo Time</p>
                </div>
            </div>
        </a>
    </div>
    <?php endif; ?>

    <div class="col-xs-6 col-sm-3 col-md-2" id="btn-plantas">
        <a href="<?php echo BASEURL; ?>customerstimes/index.php" class="btn btn-index">
            <div class="row">
                <div class="col-xs-12 text-center">
                  <i class="fa-solid fa-trophy fa-5x"></i>
                </div>
                <div class="col-xs-12 text-center">
                    <p>Times</p>
                </div>
            </div>
        </a>
    </div>
</div>

<?php if (isset($_SESSION['user'])) : ?>
    <?php if ($_SESSION['user'] === "admin") : ?>
        <div class="row mt-2" id="actions"> 
            <div class="col-lg-2 col-sm-3 col-md-2">
                <a href="<?php echo BASEURL; ?>usuarios/add.php" class="btn btn-secondary">
                    <div class="row">
                        <div class="col-xl-12 text-center">
                            <i class="fa-solid fa-user-gear fa-5x"></i>
                        </div>
                        <div class="col-xl-12 text-center">
                            <p>Novo Usuário</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-2 col-sm-3 col-md-2" id="btn-usuarios">
                <a href="<?php echo BASEURL; ?>usuarios" class="btn btn-index">
                    <div class="row">
                        <div class="col-xl-12 text-center">
                            <i class="fa-solid fa-users-gear fa-5x"></i>
                        </div>
                        <div class="col-xl-12 text-center">
                            <p>Usuários</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php else: // se $db for falso ?>
    <div class="alert alert-danger" role="alert">
        <p><strong>ERRO:</strong> Não foi possível conectar ao Banco de Dados!</p>
    </div>
<?php endif; ?>

<!-- Mensagens de sessão (exibir só a mensagem real, sem prefixo fixo) -->
<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo (!empty($_SESSION['type']) ? $_SESSION['type'] : 'info'); ?> alert-dismissible" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php clear_messages(); ?>
<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>
    