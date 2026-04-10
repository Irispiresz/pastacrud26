

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

        // Buscar planta antes de excluir (para pegar o nome da foto)
        $planta = find('tabelaplantas', $id);

        if ($planta) {
            // caminho da pasta de uploads conforme functions.php
            $uploadDir = __DIR__ . '/uploads/';
            if (!empty($planta['foto']) && file_exists($uploadDir . $planta['foto'])) {
                @unlink($uploadDir . $planta['foto']);
            }

            // remover registro do banco
            remove('tabelaplantas', $id);

            $_SESSION['message'] = "Planta excluída com sucesso!";
            $_SESSION['type'] = "success";
        } else {
            throw new Exception("Planta não encontrada.");
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
