<?php
include("../config.php");
include(DBAPI);

$plantas = null;
$planta  = null;

/**
 * Listagem de Plantas
 */
function index() {
    global $plantas;
    $plantas = find_all("tabelaplantas");
}

/**
 * Adicionar nova planta (trata dados enviados por POST)
 * Espera $_POST['planta'] com campos: especie, tipo, porte
 * e um upload em $_FILES['foto'] (opcional)
 */
function add() {
    if (!empty($_POST['planta'])) {
        $today = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        $planta = $_POST['planta'];
        $planta['datacad'] = $today->format("Y-m-d H:i:s");

        // Tratar upload de foto (opcional)
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $tmpName = $_FILES['foto']['tmp_name'];
            $origName = basename($_FILES['foto']['name']);
            // criar nome único para evitar sobrescrita
            $newName = time() . '_' . preg_replace('/[^A-Za-z0-9\._-]/', '_', $origName);
            if (move_uploaded_file($tmpName, $uploadDir . $newName)) {
                $planta['foto'] = $newName;
            }
        }

        save('tabelaplantas', $planta);
        header("Location: index.php");
        exit();
    }
}

/**
 * Editar planta
 * - Se vier POST atualiza (tratando upload -> substitui arquivo antigo)
 * - Se não vier POST, carrega $planta para o formulário
 */
function edit() {
    $now = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));

    if (isset($_GET["id"])) {
        $id = intval($_GET["id"]);

        if (isset($_POST["planta"])) {
            $planta = $_POST["planta"];
            $planta["datacad"] = $now->format("Y-m-d H:i:s");

            // buscar registro atual para tratar foto antiga, se necessário
            $current = find('tabelaplantas', $id);

            // tratar upload: se enviar nova foto, excluir antiga e gravar nova
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $tmpName = $_FILES['foto']['tmp_name'];
                $origName = basename($_FILES['foto']['name']);
                $newName = time() . '_' . preg_replace('/[^A-Za-z0-9\._-]/', '_', $origName);
                if (move_uploaded_file($tmpName, $uploadDir . $newName)) {
                    // excluir foto antiga se existir
                    if (!empty($current['foto']) && file_exists($uploadDir . $current['foto'])) {
                        @unlink($uploadDir . $current['foto']);
                    }
                    $planta['foto'] = $newName;
                }
            } else {
                // se não enviou nova foto, manter a existente (se houver)
                if (!empty($current['foto'])) {
                    $planta['foto'] = $current['foto'];
                }
            }

            update("tabelaplantas", $id, $planta);
            header("Location: index.php");
            exit();
        } else {
            global $planta;
            $planta = find("tabelaplantas", $id);
        }
    } else {
        header("Location: index.php");
        exit();
    }
}

/**
 * Visualizar
 */
function view($id = null) {
    global $planta;
    $planta = find('tabelaplantas', $id);
}

/**
 * Remover uma planta (após confirmação)
 * Aqui só chama remove() — a exclusão do arquivo é tratada no delete.php
 * para ter acesso fácil à foto antes de remover o registro.
 */
function delete_record($id = null) {
    remove("tabelaplantas", $id);
}

/**
 * Formatacao de datas
 */
function formatadata($data, $formato) {
    if (empty($data) || !strtotime($data)) {
        return '';
    }
    $df = new DateTime($data, new DateTimeZone("America/Sao_Paulo"));
    return $df->format($formato);
}

?>
