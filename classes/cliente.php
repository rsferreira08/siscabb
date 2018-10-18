<?php

class Cliente {
	// variaveis
	private $id;
	private $quantidadeEmEspera;
	private $dataRegistro;
	private $matriculaRegistro;

	// gets
	public function getId() { return $this->id; }
	public function getQuantidadeEmEspera() { return $this->quantidadeEmEspera; }
	public function getDataRegistro() { return $this->dataRegistro; }
	public function getMatriculaRegistro() { return $this->matriculaRegistro; }
	
	// sets
	public function setId($id) { $this->id = $id; }
	public function setQuantidadeEmEspera($quantidadeEmEspera){$this->quantidadeEmEspera=$quantidadeEmEspera;} 
	public function setDataRegistro($dataRegistro) { $this->dataRegistro = $dataRegistro; }
	public function setMatriculaRegistro($matriculaRegistro) { $this->matriculaRegistro = $matriculaRegistro; }

	public function adicionaEmEspera() {

		$retorno = false;

		if ( !empty($this->quantidadeEmEspera) ) {

			$database_obj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

			// insere na base
			$retorno = $database_obj->query("INSERT INTO tb_clientesespera (quantidade,data,matricula) VALUES (?,?,?)",array($this->quantidadeEmEspera,strtotime("now"),$this->matriculaRegistro));

			$database_obj->CloseConnection();
		}

		return $retorno;
	}
}

?>