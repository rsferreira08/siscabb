<?php

//require_once('../config/config.php');

class Prefixo {
	
	// variaveis
	private $id;
	private $prefixo;
	private $nome;
	private $abreviacao;
	private $ativado;

	// gets
	public function getId() { return $this->id; }
	public function getPrefixo() { return $this->prefixo; }
	public function getNome() { return $this->nome; }
	public function getAbreviacao() { return $this->abreviacao; }
	public function getAtivado() { return $this->ativado; }

	// sets
	public function setId($id) { $this->id = $id; }
	public function setPrefixo($prefixo) { $this->prefixo = $prefixo; }
	public function setNome($nome) { $this->nome = $nome; }
	public function setAbreviacao($abreviacao) { $this->abreviacao = $abreviacao; }
	public function setAtivado($ativado) { $this->ativado = $ativado; }

	// funcoes
	public function criaPrefixo($prefixo, $nome, $abreviacao) {

	}

	public function desativaPrefixo($prefixo) {

	}

	public function atualizaPrefixo($prefixo) {

	}
	
	public static function buscaTodos() {
		// conecta no DB
		$database_obj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

		// busca na base
		$retorno = $database_obj->query("SELECT * FROM tb_prefixos ORDER BY prefixo");

		// encerra conexão
		$database_obj->CloseConnection();

		return $retorno;
	}

}

//$var = Prefixo::buscaTodos();

//	echo $var["abreviacao"];

?>