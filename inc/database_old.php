<?php

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR);

function open_database() {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $conn -> set_charset("utf8");
        return $conn;
    } catch (Exception $e) {
        echo $e->getMessage();
        return null;
    }
}

function close_database($conn) {
    try {
        mysqli_close($conn);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

/**
 * Pesquisa um Registro pelo ID em uma Tabela
 */
function find($table = null, $id = null) {
    $database = open_database();
    $found = null;

    try {
        if ($id) {
            $sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
            $result = $database->query($sql);

            if ($result->num_rows > 0) {
                $found = $result->fetch_assoc();
            }
        } else {
            $sql = "SELECT * FROM " . $table;
            $result = $database->query($sql);

            if ($result->num_rows > 0) {
                $found = [];
                while ($row = $result->fetch_assoc()) {
                    $found[] = $row;
                }
            }
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    }

    close_database($database);
    return $found;
}

/**
 * Pesquisa Todos os Registros de uma Tabela
 */
function find_all($table) {
    return find($table);
}

/**
 * Pesquisa um Registro pelo parâmetro informado
 */
function filter($table = null, $p = null) {
    $database = open_database();
    $found = null;

    try {
        if ($p) {
            $sql = "SELECT * FROM $table WHERE $p";
            $result = $database->query($sql);
            if ($result->num_rows > 0) {
                $found = array();
                while ($row = $result->fetch_assoc()) {
                    array_push($found, $row);
                }
            } else {
                throw new Exception("Não foram encontrados dados!");
            }
        }
    } catch (Exception $e) {
         $_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }

    close_database($database);
    return $found;
}

/**
 * Insere um registro no BD
 */
function save($table = null, $data = null) {
    $database = open_database();
    $columns = null;
    $values = null;

    foreach ($data as $key => $value) {
        $columns .= trim($key, "'") . ",";
        $values .= "'" . $value . "',";
    }

    $columns = rtrim($columns, ',');
    $values = rtrim($values, ',');

    $sql = "INSERT INTO $table ($columns) VALUES ($values);";

    try {
        $database->query($sql);
        $_SESSION["message"] = "Registro cadastrado com sucesso.";
        $_SESSION["type"] = "success";
    } catch (Exception $e) {
        $_SESSION["message"] = "Não foi possível realizar a operação.<br>{$e->getMessage()}";
        $_SESSION["type"] = "danger";
    }

    close_database($database);
}

/**
 * Atualiza um registro em uma tabela, por ID
 */
function update($table = null, $id = 0, $data = null) {
    $database = open_database();
    $items = null;

    foreach ($data as $key => $value) {
        $items .= trim($key, "'") . "='$value',";
    }

    $items = rtrim($items, ',');

    $sql = "UPDATE $table SET $items WHERE id = $id;";

    try {
        $database->query($sql);
        $_SESSION['message'] = 'Registro atualizado com sucesso.';
        $_SESSION['type'] = 'success';
    } catch (Exception $e) {
        $_SESSION['message'] = 'Não foi possível realizar a operação.';
        $_SESSION['type'] = 'danger';
    }

    close_database($database);
}

/**
 * Remove uma linha de uma tabela pelo ID do registro
 */
function remove($table = null, $id = null) {
    $database = open_database();

    try {
        if ($id) {
            $sql = "DELETE FROM $table WHERE id = $id";
            if ($database->query($sql)) {
                $_SESSION['message'] = "Registro removido com sucesso.";
                $_SESSION['type'] = 'success';
            }
        }
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    }

    close_database($database);
}


function clear_messages() {
    unset($_SESSION['message']);
    unset($_SESSION['type']);
}
?>
