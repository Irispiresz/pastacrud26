<?php
include("../config.php");
require_once(DBAPI);

if (session_status() === PHP_SESSION_NONE) session_start();

if (empty($_POST['login']) || empty($_POST['senha'])) {
    $_SESSION['message'] = "Preencha os campos!";
    $_SESSION['type'] = "warning";
    header("Location: login.php");
    exit;
}

$login = trim($_POST['login']);
$senhaDigitada = $_POST['senha'];

$db = open_database();

try {
    // Usando prepared statement do PDO (mais seguro que real_escape_string)
    $sql = "SELECT * FROM usuarios WHERE user = ? LIMIT 1";
    $stmt = $db->prepare($sql);
    $stmt->execute([$login]);
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        if (password_verify($senhaDigitada, $row['password'])) {

            $_SESSION['user'] = $row['user'];      // usado no header
            $_SESSION['user_name'] = $row['nome'];
            $_SESSION['role'] = ($row['tipo'] === "admin") ? "admin" : "user";

            $_SESSION['message'] = "Logado com sucesso!";
            $_SESSION['type'] = "success";

            header("Location: " . BASEURL . "index.php");
            exit;

        } else {
            $_SESSION['message'] = "Senha incorreta!";
            $_SESSION['type'] = "danger";
            header("Location: login.php");
            exit;
        }

    } else {
        $_SESSION['message'] = "Usuário não existe!";
        $_SESSION['type'] = "warning";
        header("Location: login.php");
        exit;
    }

} catch (Exception $e) {
    $_SESSION['message'] = "Erro no login: " . $e->getMessage();
    $_SESSION['type'] = "danger";
    header("Location: login.php");
    exit;

} finally {
    close_database($db);
}


