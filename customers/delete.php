<?php 
// delete.php - Versão corrigida
// Iniciar sessão se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../config.php');   // define BASEURL
require_once('../inc/auten.php');
require_login(); // qualquer usuário pode acessar

// Incluir funções
$functions_path = 'functions.php';
if (file_exists($functions_path)) {
    require_once($functions_path);
} else {
    die("Erro: Arquivo functions.php não encontrado.");
}

try {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        
        // Verificar se o ID é válido
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("ID inválido.");
        }
        
        // Executar a exclusão
        delete($id);
        
        // Mensagem de sucesso
        $_SESSION['message'] = "Cliente excluído com sucesso!";
        $_SESSION['type'] = "success";
        
    } else {
        throw new Exception("ERRO: ID não definido.");
    }
} catch (Exception $e) {
    // Mensagem de erro
    $_SESSION['message'] = $e->getMessage();
    $_SESSION['type'] = "danger";
}

// Redirecionar de volta para a lista de clientes
header("Location: index.php");
exit();
?>