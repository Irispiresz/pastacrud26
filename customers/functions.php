
<?php
//esses dois pontinhos antes do config é pra volar 
// duas pastas para achar o config php, usa pra alguma coisa dps//
include("../config.php");
include(DBAPI);

$customers = null;
$customer = null;

/**
 *  Listagem de Clientes
 */
function index() {
	global $customers;
	$customers = find_all("customers");
}

//<?php
/**
 *  Cadastro de Clientes
 */
function add() {

  if (!empty($_POST['customer'])) {
    
    $today = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

    $customer = $_POST['customer'];
    $customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");
    
    save('customers', $customer);
    header("location: index.php");
  }
}

/**
 *	Atualizacao/Edicao de Cliente
 */
function edit() {

  $now = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));

  if (isset($_GET["id"])) {

    $id = $_GET["id"];

    if (isset($_POST["customer"])) {

      $customer = $_POST["customer"];
      $customer["modified"] = $now->format("Y-m-d H:i:s");

      update("customers", $id, $customer);
      header("location: index.php");
    } else {

      global $customer;
      $customer = find("customers", $id);
    } 
  } else {
    header("location: index.php");
  }
}


function view() {
    global $customer;

    // pega id da URL
    $id = $_GET['id'] ?? null;

    // se não tiver id, volta pro index
    if ($id === null) {
        $_SESSION['message'] = "Nenhum cliente foi selecionado.";
        $_SESSION['type'] = "danger";
        header("Location: index.php");
        exit;
    }

    // busca o cliente
    $customer = find("customers", $id);

    // se não encontrar, volta
    if (!$customer) {
        $_SESSION['message'] = "Cliente não encontrado!";
        $_SESSION['type'] = "danger";
        header("Location: index.php");
        exit;
    }
}

/**
 *  Exclusão de um Cliente
 */
function delete($id = null) {

  global $customer;
  $customer = remove("customers", $id);

  header("location: index.php");
}
/**
 *	formatacao de datas
 */
function formatadata($data, $formato) {
  if (empty($data) || !strtotime($data)) {
    return '';
  }
  $df = new DateTime($data, new DateTimeZone("America/Sao_Paulo"));
  return $df->format($formato);
}

/**
 * Formatação de CPF
 */
function formataCPF($cpf) {
    $cpf = preg_replace('/\D/', '', $cpf);
    if (strlen($cpf) !== 11) return $cpf; // se não for válido, retorna sem mudar

    return substr($cpf, 0, 3) . '.' 
         . substr($cpf, 3, 3) . '.' 
         . substr($cpf, 6, 3) . '-' 
         . substr($cpf, 9, 2);
}

/**
 * Formatação de telefone brasileiro
 * Aceita 10 dígitos (fixo) ou 11 dígitos (celular)
 */
function formataTel($telefone) {
    // deixa só números
    $telefone = preg_replace('/\D/', '', $telefone);

    if (strlen($telefone) === 10) {
        // fixo: (xx)xxxx-xxxx
        return "(" . substr($telefone, 0, 2) . ") " 
               . substr($telefone, 2, 4) . "-" 
               . substr($telefone, 6, 4);
    } elseif (strlen($telefone) === 11) {
        // celular: (xx)xxxxx-xxxx
        return "(" . substr($telefone, 0, 2) . ") " 
               . substr($telefone, 2, 5) . "-" 
               . substr($telefone, 7, 4);
    } else {
        // se não tiver 10 ou 11 dígitos, devolve sem mexer
        return $telefone;
    }
}




