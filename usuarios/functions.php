<?php 
include("../config.php"); 
include(DBAPI); 

$usuarios = null; 
$usuario  = null; 


/**
 * LISTAGEM DE USUÁRIOS
 */
function index() {
    global $usuarios;

    if (!empty($_POST['users'])) {
        $usuarios = filter("usuarios", "nome LIKE '%" . $_POST['users'] . "%'");
    } else {
        $usuarios = find_all("usuarios");
    }
}


/**
 * UPLOAD DE IMAGEM
 */
function upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo) {

    try {
        if (file_exists($arquivo_destino)) {
            throw new Exception("O arquivo já existe!");
        }

        if ($tamanho_arquivo > 5000000) {
            throw new Exception("O arquivo é muito grande!");
        }

        if (!in_array($tipo_arquivo, ["jpg", "jpeg", "png", "gif"])) {
            throw new Exception("Apenas JPG, JPEG, PNG e GIF são permitidos.");
        }

        if (!move_uploaded_file($nome_temp, $arquivo_destino)) {
            throw new Exception("Falha ao enviar arquivo.");
        }

        return basename($arquivo_destino);

    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type']    = "danger";
        return null;
    }
}



/**
 * CADASTRO DE USUÁRIO
 */
function add() {

    if (!empty($_POST['usuario'])) {

        try {

            $usuario = $_POST['usuario'];
            $usuario['foto'] = "semimagem.png";

            /**
             * CONFIRMAÇÃO DE SENHA
             */
            if (empty($usuario['password'])) {
                throw new Exception("Digite uma senha.");
            }

            $password2 = $usuario['password2'] ?? "";

            if ($usuario['password'] !== $password2) {
                throw new Exception("As senhas não coincidem!");
            }

            // criptografa
            $usuario['password'] = password_hash($usuario['password'], PASSWORD_DEFAULT);
            unset($usuario['password2']);
/**
 * FOTO
 */
if (!empty($_FILES["foto"]["name"])) {

    $pasta_destino = __DIR__ . "/fotos/";

    // cria pasta se não existir
    if (!is_dir($pasta_destino)) {
        mkdir($pasta_destino, 0775, true);
    }

    $novo_nome = uniqid() . "_" . basename($_FILES["foto"]["name"]);
    $arquivo_destino = $pasta_destino . $novo_nome;

    $tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));

    $uploaded = upload(
        $pasta_destino,
        $arquivo_destino,
        $tipo_arquivo,
        $_FILES["foto"]["tmp_name"],
        $_FILES["foto"]["size"]
    );

    if ($uploaded !== null) {
        $usuario["foto"] = $uploaded;
    }
}


            /**
             * SALVAR
             */
            save("usuarios", $usuario);

            $_SESSION['message'] = "Usuário cadastrado com sucesso!";
            $_SESSION['type']    = "success";

            header("Location: index.php");
            exit;

        } catch (Exception $e) {
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type']    = "danger";
        }
    }
}



/**
 * EDIÇÃO DE USUÁRIO
 */
function edit() {
    

    try {

        if (!isset($_GET["id"])) {
            header("location: index.php");
            exit;
        }

        $id = $_GET["id"];
        $usuario_banco = find("usuarios", $id);

        if (!empty($_POST["usuario"])) {

            $usuario = $_POST["usuario"];

            /**
             * SENHA OPCIONAL
             */
            if (!empty($usuario["password"])) {

                $password2 = $usuario["password2"] ?? "";

                if ($usuario["password"] !== $password2) {
                    throw new Exception("As senhas não coincidem!");
                }

                $usuario["password"] = password_hash($usuario["password"], PASSWORD_DEFAULT);

            } else {
                unset($usuario["password"]);
            }

            unset($usuario["password2"]);


            /**
             * FOTO
             */
            if (!empty($_FILES["foto"]["name"])) {

                $pasta_destino = __DIR__ . "/fotos/";


                $novo_nome = uniqid() . "_" . basename($_FILES["foto"]["name"]);
                $arquivo_destino = $pasta_destino . $novo_nome;

                $tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));

                $uploaded = upload(
                    $pasta_destino,
                    $arquivo_destino,
                    $tipo_arquivo,
                    $_FILES["foto"]["tmp_name"],
                    $_FILES["foto"]["size"]
                );

                if ($uploaded) {

                    // remove foto antiga
                    if (!empty($usuario_banco["foto"]) && $usuario_banco["foto"] != "semimagem.png") {
                        $foto_antiga = $pasta_destino . $usuario_banco["foto"];
                        if (file_exists($foto_antiga)) unlink($foto_antiga);
                    }

                    $usuario["foto"] = $uploaded;
                }
            }


            update("usuarios", $id, $usuario);

            $_SESSION['message'] = "Usuário atualizado!";
            $_SESSION['type']    = "success";

            header("Location: index.php");
            exit;

        } else {

            global $usuario;
            $usuario = find("usuarios", $id);
        }

    } catch (Exception $e) {
        $_SESSION['message'] = "Erro: " . $e->getMessage();
        $_SESSION['type']    = "danger";
    }
}



/**
 * VISUALIZAR
 */
function view($id = null) {
    global $usuario;
    $usuario = find('usuarios', $id);
}



/**
 * EXCLUSÃO
 */
function delete($id = null) {

    try {
        remove("usuarios", $id);

        $_SESSION['message'] = "Usuário removido!";
        $_SESSION['type']    = "success";

    } catch (Exception $e) {
        $_SESSION['message'] = "Erro ao remover: " . $e->getMessage();
        $_SESSION['type']    = "danger";
    }

    header("location: index.php");
    exit;
}

?>
