<?php
// carrega arquivo de configuração
require_once('../config/config.php');

// Define JSON para return
header('Content-Type: application/json');

// Verificação de segurança da API 
$headers = apache_request_headers();
if (isset($headers['CsrfToken'])) {
    if ($headers['CsrfToken'] !== $_SESSION['csrf_token']) {
        echo json_encode(array(
	        'status' => 'ERROR',
	        'mensagem' => "&bull; Invalid CSRF Token.",
	        'ret_data' => false,
	    ));
    	exit;
    }
} else {
   	echo json_encode(array(
        'status' => 'ERROR',
        'mensagem' => "&bull; Invalid CSRF Token.",
        'ret_data' => false,
    ));
	exit;
}

// Verifica se o request veio via ajax
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

	// Inicia as variáveis 
    $retorno_status = 'ERROR';
    $retorno_mensagem = '';
    $retorno_data = array();
    $aux_checkerrors = false;

	// Verifica o método da requisição
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		// Limpa possíveis espaços em branco no início e fim dos parâmetros.
		$req_parametros = array_map('trim', $_POST);

		// Verifica qual ação será executada
		switch ($_POST['acao']) {

			// login
			case 'login':
			
		}
	}
}
?>