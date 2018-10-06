<?php

require_once('../config/config.php');

class Usuario {
	// variaveis
	private $id;
	private $idPrefixo;
	private $matricula;
	private $nome;
	private $senha;
	private $nivelPermissao;
	private $ata;
	private $faleCom;
	private $ativado;

	// gets
	public function getId() { return $this->id; }
	public function getIdPrefixo() { return $this->idPrefixo; }
	public function getMatricula() { return $this->matricula; }
	public function getNome() { return $this->nome; }
	public function getSenha() { return $this->senha; }
	public function getNivelPermissao() { return $this->nivelPermissao; }
	public function getAta() { return $this->ata; }
	public function getFaleCom() { return $this->faleCom; }
	public function getAtivado() { return $this->ativado; }

	// sets
	public function setId($id) { $this->id = $id; }
	public function setIdPrefixo($idPrefixo) { $this->idPrefixo = $idPrefixo; }
	public function setMatricula($matricula) { $this->matricula = $matricula; }
	public function setNome($nome) { $this->nome = $nome; }
	public function setSenha($senha) { $this->senha = $senha; }
	public function setNivelPermissao($nivelPermissao) { $this->nivelPermissao = $nivelPermissao; }
	public function setAta($ata) { $this->ata = $ata; }
	public function setFaleCom($faleCom) { $this->faleCom = $faleCom; }
	public function setAtivado($ativado) { $this->ativado = $ativado; }

	// funcoes
	public static function login($matricula, $senha, $idPrefixo) {

		// conecta na DB
	    $database_obj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

	    // faz hash da senha
	    $senhaCriptografada = Funcoes::hash_password($senha);

	    // faz consulta das credenciais
	    $retorno = $database_obj->row("SELECT * FROM tb_usuarios WHERE matricula=? AND senha=? AND idPrefixo=?",array($matricula, $senhaCriptografada, $idPrefixo));

	    // encerra conexão
		$database_obj->CloseConnection();

		return $retorno;
	}

	public function criaUsuario($idPrefixo, $matricula, $nome, $senha, $nivelPermissao, $ata, $faleCom) {
		
		$retorno = false;

		if ( !empty($matricula) ) {
			// conecta na DB
	        $database_obj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

	        // criptografa a senha
	        $senhaCriptografada = Funcoes::hash_password($senha);

	        // insere usuario no banco
	        $retorno = $database_obj->query("INSERT INTO tb_usuarios (idPrefixo, matricula, nome, senha, nivelPermissao, ata, faleCom) VALUES (?,?,?,?,?,?,?)",array($idPrefixo, $matricula, $nome, $senhaCriptografada, $nivelPermissao, $ata, $faleCom));
	    }

	    // encerra conexão
		$database_obj->CloseConnection();

	    return $retorno;
	}

	public function atualizaUsuario($idPrefixo="", $matricula, $nome="", $nivelPermissao="") {
		
	}

	public function alteraSenha($matricula,$senhaAntiga,$senhaNova) {

		$retorno = false;

		// se passou matricula, altera senha
		if ( !empty($matricula) ) {
			$senhaAntigaCriptografada = Funcoes::hash_password($senhaAntiga);

			// conecta no DB
			$database_obj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

			// pesquisa se senha é igual
			$senhaCorreta = $database_obj->row("SELECT * FROM tb_usuarios WHERE matricula=? AND senha=?",array($matricula, $senhaAntigaCriptografada));

			if ( !empty($senhaCorreta) ) {
				$senhaNovaCriptografada = Funcoes::hash_password($senhaNova);

				// atualiza senha usuario
				$retorno = $database_obj->query("UPDATE tb_usuarios SET senha=? WHERE matricula=?",array($senhaNovaCriptografada,$matricula));
			}
		}

		// encerra conexão
		$database_obj->CloseConnection();

		return $retorno;
	}

	public function desativaUsuario($matricula) {

	}

	public function alteraSkill($skill,$ativado) {

	}
}

//echo Funcoes::hash_password('123');

//$usuario = new Usuario;
//$usuario->criarUsuario(1,'F9999999','Rodrigo Ferreira','123',1,0,1);

//var_dump($usuario->alteraSenha('F8711434','1234','123'));

?>