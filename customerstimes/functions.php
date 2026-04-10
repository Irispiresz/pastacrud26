<?php
include("../config.php");
include(DBAPI);

$times = null;
$time  = null;

/**
 * Listagem de times
 */
function index() {
    global $times;
    $times = find_all("times");
}

/**
 * Adicionar nova time (trata dados enviados por POST)
 * Espera $_POST['time'] com campos: nome, estado, divisao, datacad, foto
 */
function add() {
    if (!empty($_POST['time'])) {
        $today = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        $time = $_POST['time'];
        $time['datacad'] = $today->format("Y-m-d H:i:s");

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
                $time['foto'] = $newName;
            }
        }

        save('times', $time);
        header("Location: index.php");
        exit();
    }
}

/**
 * Editar time
 * - Se vier POST atualiza (tratando upload -> substitui arquivo antigo)
 * - Se não vier POST, carrega $time para o formulário
 */
function edit() {
    $now = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));

    if (isset($_GET["id"])) {
        $id = intval($_GET["id"]);

        if (isset($_POST["time"])) {
            $time = $_POST["time"];
            $time["datacad"] = $now->format("Y-m-d H:i:s");

            // buscar registro atual para tratar foto antiga, se necessário
            $current = find('times', $id);

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
                    $time['foto'] = $newName;
                }
            } else {
                // se não enviou nova foto, manter a existente (se houver)
                if (!empty($current['foto'])) {
                    $time['foto'] = $current['foto'];
                }
            }

            update("times", $id, $time);
            header("Location: index.php");
            exit();
        } else {
            global $time;
            $time = find("times", $id);
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
    global $time;
    $time = find('times', $id);
}

/**
 * Remover uma time (após confirmação)
 * Aqui só chama remove() — a exclusão do arquivo é tratada no delete.php
 * para ter acesso fácil à foto antes de remover o registro.
 */
function delete_record($id = null) {
    remove("times", $id);
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
