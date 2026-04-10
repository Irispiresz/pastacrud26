<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>CRUD com Bootstrap</title>
    <meta name="description" content="Projeto Plantas Iris e Giovana">
    <meta name="Keywords" content="Site CRUD, Bootstrap, PHP.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo BASEURL; ?>css/plantas.css">
<link rel="stylesheet" href="<?php echo BASEURL; ?>css/awesome/all.min.css">


</head>

<body>
<nav class="navbar navbar-expand-xxl navbar-dark bg-dark fixed-top" data-bs-theme="dark">
    <div class="container-fluid">

        <!-- LOGO -->
        <a class="navbar-brand" href="<?php echo BASEURL; ?>">
            <i class="fa-solid fa-shield"></i> Times
        </a>

        <!-- BOTÃO MOBILE -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse" id="navbar">

            <!-- ITENS ESQUERDA -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <!-- CLIENTES -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-users"></i> Clientes
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers"><i class="fa-solid fa-users"></i> Gerenciar Clientes</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers/add.php"><i class="fa-solid fa-user-plus"></i> Novo Cliente</a></li>
                    </ul>
                </li>

                <!-- PLANTAS -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-leaf"></i> Plantas
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customersplantas"><i class="fa-solid fa-leaf"></i> Gerenciar Plantas</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customersplantas/add.php"><i class="fa-solid fa-plus"></i> Nova Planta</a></li>
                    </ul>
                </li>

                <!-- USUÁRIOS (somente admin) -->
                <?php if (isset($_SESSION['user']) && $_SESSION['user'] == "admin") : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user-gear"></i> Usuários
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios"><i class="fa-solid fa-user-gear"></i> Gerenciar Usuários</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios/add.php"><i class="fa-solid fa-user-plus"></i> Novo Usuário</a></li>
                    </ul>
                </li>
                <?php endif; ?>

            </ul>

            <!-- BOTÃO DESLOGAR / LOGIN -->
            <div class="d-flex ms-auto">

                <?php if (isset($_SESSION['user'])) : ?>
                    <a class="btn btn-outline-light btn-sm" href="<?php echo BASEURL; ?>inc/logout.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Sair (<?php echo $_SESSION['user']; ?>)
                    </a>
                <?php else : ?>
                    <a class="btn btn-success btn-sm" href="<?php echo BASEURL; ?>inc/login.php">
                        <i class="fa-solid fa-right-to-bracket"></i> Login
                    </a>
                <?php endif; ?>

            </div>

        </div>
    </div>
</nav>


<main class="container mt-5 pt-2">


