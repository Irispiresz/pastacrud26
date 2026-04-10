

<?php 
// delete.php - Versão corrigida para plantas

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('../config.php');   // define BASEURL
require_once('../inc/auten.php');
require_login();

$functions_path = 'functions.php';
if (file_exists($functions_path)) {
    require_once($functions_path);
} else {
    die("Erro: Arquivo functions.php não encontrado.");
}

try {
    if (isset($_GET["id"])) {
        $id = intval($_GET["id"]);
        if ($id <= 0) {
            throw new Exception("ID inválido.");
        }

        // Buscar time antes de excluir (para pegar o nome da foto)
        $time = find('time', $id);

        if ($time) {
            // caminho da pasta de uploads conforme functions.php
            $uploadDir = __DIR__ . '/uploads/';
            if (!empty($time['foto']) && file_exists($uploadDir . $time['foto'])) {
                @unlink($uploadDir . $time['foto']);
            }

            // remover registro do banco
            remove('time', $id);

            $_SESSION['message'] = "Time excluído com sucesso!";
            $_SESSION['type'] = "success";
        } else {
            throw new Exception("Time não encontrado.");
        }
    } else {
        throw new Exception("ERRO: ID não definido.");
    }
} catch (Exception $e) {
    $_SESSION['message'] = $e->getMessage();
    $_SESSION['type'] = "danger";
}

header("Location: index.php");
exit();
?>
