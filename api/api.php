<?php
// carrega arquivo de configuração
require_once('../config/config.php');

// Define JSON para return
header('Content-Type: application/json');

// Verificação de segurança da API 
/*$headers = apache_request_headers();
if (isset($headers['CsrfToken'])) {
    if ($headers['CsrfToken'] !== $_SESSION['csrf_token']) {
        echo json_encode(array(
	        'status' => 'ERROR',
	        'mensagem' => "Invalid CSRF Token.",
	        'ret_data' => false,
	    ));
    	exit;
    }
} else {
   	echo json_encode(array(
        'status' => 'ERROR',
        'mensagem' => "Invalid CSRF Token.",
        'ret_data' => false,
    ));
	exit;
}*/

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

			case 'login':
				if ( empty($req_parametros['matricula']) ) {
					$retorno_mensagem[] = "Digite sua matricula";
				}
				if ( empty($req_parametros['senha']) ) {
					$retorno_mensagem[] = "Digite sua senha";
				}
				if ( empty($req_parametros['prefixo']) ) {
					$retorno_mensagem[] = "Selecione seu prefixo";
				}
				if ( empty($retorno_mensagem) ) {
					$usuario = Usuario::login($req_parametros['matricula'],$req_parametros['senha'],$req_parametros['prefixo'] );

					if ( !empty($usuario['id'])>0 ) {
						$retorno_status = "OK";
						$_SESSION['matricula'] = $usuario['matricula'];
						$_SESSION['idPrefixo'] = $usuario['idPrefixo'];
					} else {
						$retorno_mensagem[] = "Credenciais inválidas";
					}
				} else {
					$retorno_mensagem = implode('<br>', $retorno_mensagem);
				}
				break;

			// Cadastra Usuário
			case 'logoff':
				unset($_SESSION['matricula']);
				unset($_SESSION['idPrefixo']);
				$retorno_status = 'OK';
				break;

			case 'atualizaOferta':
					if ( empty($req_parametros['id']) ) {
						$retorno_mensagem[] = "Erro ao receber o ID. Contate o administrador";
					}

					/*if ( empty($req_parametros['negocioFechado']) ) {
						$retorno_mensagem[] = "Erro ao receber status do negócio. Contate o administrador";
					}*/

					// se não tiver erros, executa
					if ( empty($retorno_mensagem) ) {
						$negocioObj = new Negocio;

						$negocioObj->setId($req_parametros['id']);
						$negocioObj->setNegocioFechado($req_parametros['negocioFechado']);
						$negocioObj->setMatriculaNegocio($_SESSION['matricula']); // variavel de sessao

						try {
							if ( $negocioObj->finalizaOfertaPendente() ) {
								$retorno_status = "OK";
								if ( $req_parametros['negocioFechado'] == 1 ) {
									$retorno_mensagem = "Oferta confirmada com sucesso";
								} else {
									$retorno_mensagem = "Oferta recusada com sucesso";
								}
							} else {
								$retorno_mensagem = "Ocorreu um erro ao atualizar a oferta. Favor contactar o administrador.";
							} 
						} catch (Exception $e) {
							$retorno_mensagem = "".$e->getMessage();
						}
					} else {
						$retorno_mensagem = implode("<br>", $retorno_mensagem);
					}		
				break;

			// registra negocio
			case 'registraNegocio':
				if ( empty($req_parametros['mci']) ) {
					$retorno_mensagem[] = "Favor preencher o MCI do cliente";
				}

				if ( !empty($req_parametros['idProduto']) ) {
					switch($req_parametros['idProduto']) {
						case 1:
							if ( empty($req_parametros['valorContratado']) ) {
								$retorno_mensagem[] = "Favor preencher o valor do empréstimo contratado";
							}
							if ( $req_parametros['status'] == 2 ) {
								if (empty($req_parametros['numeroOperacaoCDC'])) {
									$retorno_mensagem[] = "Favor preencher o número do contrato";
								}
							}
							if ( $req_parametros['seguroOperacao'] == 1 ) {
								if ( empty($req_parametros['valorSeguroContratado']) ) {
									$retorno_mensagem[] = "Favor preencher o valor do seguro da operação";
								}
							}

							break;
						case 2:
							if ( empty($req_parametros['valorContratado']) ) {
								$retorno_mensagem[] = "Favor preencher o valor do prêmio";
							}

							break;
						case 3:
							if ( empty($req_parametros['valorContratado']) ) {
								$retorno_mensagem[] = "Favor preencher o valor investido";
							}

							break;
						case 4:
							if ( empty($req_parametros['valorContratado']) ) {
								$retorno_mensagem[] = "Favor preencher o valor contratado";
							}

							break;
						case 5:
							if ( empty($req_parametros['valorContratado']) ) {
								$retorno_mensagem[] = "Favor preencher o valor contrado";
							}

							break;

						case 7:
							if ( $req_parametros['idSegmentacaoProduto'] == 39) {
								if ( empty($req_parametros['valorCartaoAtual']) ) {
									$retorno_mensagem[] = "Favor preencher o limite atual do cartão";
								}
								if ( empty($req_parametros['valorContratado']) ) {
									$retorno_mensagem[] = "Favor preencher o novo limite do cartão";	
								}
							}

							break;

						default:
							$retorno_mensagem = "Favor preencher os campos corretamente";
							break;
					}
				} else {
					$retorno_mensagem[] = "Favor selecionar um produto";
				}

				if ( empty($retorno_mensagem) ) {
					// se não tiver erros, cria um objeto negocio
					$negocioObj = new Negocio;

					try {
						// formata valor monetario
						if ( !empty($req_parametros['valorCartaoAtual']) ) {
							$aux = explode(",",$req_parametros['valorCartaoAtual']);
							$valorCartaoAtual = str_replace('.','',$aux[0]) . "." . $aux[1];
						} else {
							$valorCartaoAtual = $req_parametros['valorCartaoAtual'];
						}
						if ( !empty($req_parametros['valorContratado']) ) {
							$aux = explode(",",$req_parametros['valorContratado']);
							$valorContratado = str_replace('.','',$aux[0]) . "." . $aux[1];
						} else {
							$valorContratado = $req_parametros['valorContratado'];
						}

						if ( !empty($req_parametros['valorSeguroContratado']) ) {
							$aux = explode(",",$req_parametros['valorSeguroContratado']);
							$valorSeguroContratado = str_replace('.','',$aux[0]) . "." . $aux[1];
						} else {
							$valorSeguroContratado = $req_parametros['valorSeguroContratado'];
						}

						$negocioObj->setMci($req_parametros['mci']);
						$negocioObj->setIdProduto($req_parametros['idProduto']);
						$negocioObj->setIdSegmentacaoProduto($req_parametros['idSegmentacaoProduto']);
						$negocioObj->setValorCartaoAtual($valorCartaoAtual);
						$negocioObj->setValorContratado($valorContratado);
						$negocioObj->setValorSeguroContratado($valorSeguroContratado);
						$negocioObj->setSeguro($req_parametros['seguroOperacao']);
						$negocioObj->setMatriculaOferta($_SESSION['matricula']); // variavel de sessao
						$negocioObj->setMatriculaNegocio($_SESSION['matricula']);
						$negocioObj->setNumeroOperacaoCDC(str_replace(".","",$req_parametros['numeroOperacaoCDC']));
						$negocioObj->setIdPrefixo($_SESSION['idPrefixo']); // variavel de sessao
						
						if ($req_parametros['status'] == 1) { // 1 = registro de oferta
							if ($negocioObj->registraOferta()) {
								$retorno_status = "OK";
								$retorno_mensagem = "Oferta incluída com sucesso";
							} else {
								$retorno_mensagem = "Ocorreu um erro ao incluir a oferta. Favor contactar o administrador.";
							} 
						} elseif ( $req_parametros['status'] == 2 ) { // negocio fechado
							if ($negocioObj->registraNegocio()) {
								$retorno_status = "OK";
								$retorno_mensagem = "Oferta incluída com sucesso";
							} else {
								$retorno_mensagem = "Ocorreu um erro ao incluir a oferta. Favor contactar o administrador.";
							} 
						} elseif ( $req_parametros['status'] == 3 ) { // negocio não efetuado
							if ($negocioObj->registraRecusa()) {
								$retorno_status = "OK";
								$retorno_mensagem = "Recusa incluída com sucesso";
							} else {
								$retorno_mensagem = "Ocorreu um erro ao incluir a oferta. Favor contactar o administrador.";
							} 
						}
					} catch (Exception $e) {
						$retorno_mensagem = "".$e->getMessage();
					}
				} else {
					$retorno_mensagem = implode("<br>", $retorno_mensagem);
				}			
				/*=====  End of Executa Solicitação  ======*/
				break;

			case 'registraContato':
				if ( empty($req_parametros['mci']) ) {
					$retorno_mensagem[] = "Favor preencher o MCI do cliente";
				}
				if ( empty($req_parametros['idDemanda']) || empty($req_parametros['idSegmentacaoDemanda']) ) {
					$retorno_mensagem[] = "Favor selecionar uma demanda";
				}

				if (empty($retorno_mensagem)) {
					$contato = new Contato;
					$contato->setMatricula($_SESSION['matricula']); // variavel de sessao
					$contato->setMci($req_parametros['mci']);
					$contato->setIdDemanda($req_parametros['idDemanda']);
					$contato->setIdSegmentacaoDemanda($req_parametros['idSegmentacaoDemanda']);
					$contato->setIdPrefixo($_SESSION['idPrefixo']); // variavel de sessao

					try {
						if ($contato->registraContato()) {
							$retorno_status = "OK";
							$retorno_mensagem = "Contato para o MCI " .  $req_parametros['mci'] . " incluído com sucesso";
						} else {
							$retorno_mensagem = "Ocorreu um erro ao incluir a oferta. Favor contactar o administrador.";
						}
					} catch (Exception $e) {
						$retorno_mensagem = "".$e->getMessage();
					}
				} else {
					$retorno_mensagem = implode("<br>", $retorno_mensagem);
				}

				break;

			case 'buscaOfertaPorMci':

				if ( empty($req_parametros['mci']) ) {
					$retorno_mensagem[] = "Favor preencher o MCI do cliente";
				}

				if ( !empty($req_parametros['idProduto']) ) {
					switch($req_parametros['idProduto']) {
						case 1:
							if ( empty($req_parametros['valorContratado']) ) {
								$retorno_mensagem[] = "Favor preencher o valor do empréstimo contratado";
							}
							if ( $req_parametros['status'] == 2 ) {
								if (empty($req_parametros['numeroOperacaoCDC'])) {
									$retorno_mensagem[] = "Favor preencher o número do contrato";
								}
							}
							if ( $req_parametros['seguroOperacao'] == 1 ) {
								if ( empty($req_parametros['valorSeguroContratado']) ) {
									$retorno_mensagem[] = "Favor preencher o valor do seguro da operação";
								}
							}

							break;
						case 2:
							if ( empty($req_parametros['valorContratado']) ) {
								$retorno_mensagem[] = "Favor preencher o valor do prêmio";
							}

							break;
						case 3:
							if ( empty($req_parametros['valorContratado']) ) {
								$retorno_mensagem[] = "Favor preencher o valor investido";
							}

							break;
						case 4:
							if ( empty($req_parametros['valorContratado']) ) {
								$retorno_mensagem[] = "Favor preencher o valor contratado";
							}

							break;
						case 5:
							if ( empty($req_parametros['valorContratado']) ) {
								$retorno_mensagem[] = "Favor preencher o valor contrado";
							}

							break;

						case 7:
							if ( $req_parametros['idSegmentacaoProduto'] == 39) {
								if ( empty($req_parametros['valorCartaoAtual']) ) {
									$retorno_mensagem[] = "Favor preencher o limite atual do cartão";
								}
								if ( empty($req_parametros['valorContratado']) ) {
									$retorno_mensagem[] = "Favor preencher o novo limite do cartão";	
								}
							}

							break;

						default:
							$retorno_mensagem = "Favor preencher os campos corretamente";
							break;
					}
				} else {
					$retorno_mensagem[] = "Favor selecionar um produto";
				}

				if ( empty($retorno_mensagem) ) {
					try {
						$retorno_data = Negocio::buscaOfertaPorMci($req_parametros['mci']);
						
						if ( empty($retorno_data) ) {
							$retorno_status = "VAZIO";
						} else {
							$retorno_status = "OK";
						}
					} catch (Exception $e) {
						$retorno_mensagem = "".$e->getMessage();
					}
				} else {
					$retorno_mensagem = implode("<br>", $retorno_mensagem);
				}

				break;

		}
	} else {
		// Limpa possíveis espaços em branco no início e fim dos parâmetros.
		$req_parametros = array_map('trim', $_GET);

		// Verifica qual ação será executada
		switch ($_GET['acao']) {
			//  buscar ofertas pendentes
			

			default:
				$retorno_mensagem = "Ocorreu um erro ao executar sua solicitação. Por favor, entre em contato com o administrador.";
				break;
		}
	}

	echo json_encode(array(
        'status' => $retorno_status,
        'mensagem' => $retorno_mensagem,
        'ret_data' => $retorno_data,
        ));
    exit;
}
?>