<?php
require_once("functions.php");

if (isset($_GET["id"])) {
    try {
        $id = $_GET["id"];
        $usuario = find("usuarios", $id);

        if (!$usuario) {
            throw new Exception("Usuário não encontrado.");
        }

        // Caminho da foto
        $foto = basename($usuario['foto']);
        $filePath = __DIR__ . "/fotos/" . $foto;

        // Excluir imagem apenas se existir e não for a padrão
        if ($foto && $foto != "semimagem.jpg" && file_exists($filePath)) {
            unlink($filePath);
        }

        // Excluir usuário do banco
        delete($id);

        $_SESSION['message'] = "Usuário deletado com sucesso!";
        $_SESSION['type'] = "success";

    } catch (Exception $e) {
        $_SESSION['message'] = "Não foi possível realizar a operação: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }

    header("Location: index.php");
    exit;
} else {
    $_SESSION['message'] = "Nenhum usuário selecionado para exclusão.";
    $_SESSION['type'] = "warning";
    header("Location: index.php");
    exit;
}
?>
