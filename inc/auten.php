<?php
//if (session_status() === PHP_SESSION_NONE) session_start();

function require_login() {
    if (!isset($_SESSION['user'])) {
        $_SESSION['message'] = "Você precisa estar logado para acessar esta página.";
        $_SESSION['type'] = "warning";
        header("Location: " . BASEURL . "inc/login.php");
        exit;
    }
}

function require_admin() {
    require_login();
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        $_SESSION['message'] = "Você precisa ser administrador para acessar esta página.";
        $_SESSION['type'] = "danger";
        header("Location: " . BASEURL . "index.php");
        exit;
    }
}
?>
