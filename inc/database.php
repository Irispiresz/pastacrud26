<?php

	//mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR);

	function open_database()
	{
		try {
			// $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			// $conn->set_charset("utf8");
			$conn = new PDO(DB_DSN, DB_USER, DB_PASSWORD, [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES => false,
			]);

			return $conn;
		} catch (Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	function close_database($conn)
	{
		try {
			//mysqli_close($conn);
			$conn = null;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	/**
	 *  Pesquisa um Registro pelo ID em uma Tabela
	 */
	function find($table = null, $id = null)
	{

		try {
			$database = open_database();
			$found = null;

			if ($id) {
				$sql = "SELECT * FROM $table WHERE id = ?";
				$stmt = $database->prepare($sql);
				$stmt->bindParam(1, $id, PDO::PARAM_INT);
				$stmt->execute();
				// Retorna um único registro como array associativo
				$found = $stmt->fetch(PDO::FETCH_ASSOC);
			} else {
				$stmt = $database->prepare("SELECT * FROM $table");
				$stmt->execute();
				// Retorna todos os registros como array de arrays
				$found = [];
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$found[] = $row;
				}
			}
		} catch (Exception $e) {
			if (!isset($_SESSION)) session_start();
			$_SESSION['message'] = $e->getMessage();
			$_SESSION['type'] = 'danger';
		}
		return $found;
	}
	/**
	 *  Pesquisa Todos os Registros de uma Tabela
	 */
	function find_all($table)
	{
		return find($table);
	}
	/**
	 * Insere um registro no BD usando PDO
	 */
	function save($table = null, $data = null)
	{
		try {
			$database = open_database();
			
			if (!$table || !$data) {
				throw new Exception("Tabela e dados são obrigatórios.");
			}

			$columns = implode(', ', array_keys($data));
			$placeholders = implode(', ', array_fill(0, count($data), '?'));
			$sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

			$stmt = $database->prepare($sql);
			$stmt->execute(array_values($data));

			if (!isset($_SESSION)) session_start();
			$_SESSION['message'] = 'Registro cadastrado com sucesso.';
			$_SESSION['type'] = 'success';
		} catch (Exception $e) {
			if (!isset($_SESSION)) session_start();
			$_SESSION['message'] = 'Não foi possível realizar a operação. ' . $e->getMessage();
			$_SESSION['type'] = 'danger';
		}
	}

	/**
	 * Atualiza um registro em uma tabela pelo ID usando PDO
	 */
	function update($table = null, $id = null, $data = null)
	{
		try {
			$database = open_database();
			
			if (!$table || !$id || !$data) {
				throw new Exception("Tabela, ID e dados são obrigatórios.");
			}

			$setClause = implode(', ', array_map(function($key) {
				return "$key = ?";
			}, array_keys($data)));

			$sql = "UPDATE $table SET $setClause WHERE id = ?";
			
			$stmt = $database->prepare($sql);
			$values = array_values($data);
			$values[] = $id;
			$stmt->execute($values);

			if (!isset($_SESSION)) session_start();
			$_SESSION['message'] = 'Registro atualizado com sucesso.';
			$_SESSION['type'] = 'success';
		} catch (Exception $e) {
			if (!isset($_SESSION)) session_start();
			$_SESSION['message'] = 'Não foi possível realizar a operação. ' . $e->getMessage();
			$_SESSION['type'] = 'danger';
		}
	}

	/**
	 * Remove uma linha de uma tabela pelo ID usando PDO
	 */
	function remove($table = null, $id = null)
	{
		try {
			$database = open_database();
			
			if (!$table || !$id) {
				throw new Exception("Tabela e ID são obrigatórios.");
			}

			$sql = "DELETE FROM $table WHERE id = ?";
			$stmt = $database->prepare($sql);
			$stmt->execute([$id]);

			if (!isset($_SESSION)) session_start();
			$_SESSION['message'] = 'Registro removido com sucesso.';
			$_SESSION['type'] = 'success';
		} catch (Exception $e) {
			if (!isset($_SESSION)) session_start();
			$_SESSION['message'] = $e->getMessage();
			$_SESSION['type'] = 'danger';
		}
	}

	/**
	 * Limpa as mensagens de sessão
	 */
	function clear_messages()
	{
		if (isset($_SESSION['message'])) {
			unset($_SESSION['message']);
		}
		if (isset($_SESSION['type'])) {
			unset($_SESSION['type']);
		}
	}