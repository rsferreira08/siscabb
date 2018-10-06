<?php

class Contato {
	// variaveis
	private $id;
	private $matricula;
	private $mci;
	private $idDemanda;
	private $idSegmentacaoDemanda;
	private $dataContato;
	private $idPrefixo;

	// gets
	public function getId() { return $this->id; }
	public function getMatricula() { return $this->matricula; }
	public function getMci() { return $this->mci; }
	public function getIdDemanda() { return $this->idDemanda; }
	public function getIdSegmentacaoDemanda() { return $this->idSegmentacaoDemanda; }
	public function getDataContato() { return $this->dataContato; }
	public function getIdPrefixo() { return $this->idPrefixo; }

	// sets
	public function setId($id) { $this->id = $id; }
	public function setMatricula($matricula) { $this->matricula = $matricula; }
	public function setMci($mci) { $this->mci = $mci; }
	public function setIdDemanda($idDemanda) { $this->idDemanda = $idDemanda; }
	public function setIdSegmentacaoDemanda($idSegmentacaoDemanda) { $this->idSegmentacaoDemanda = $idSegmentacaoDemanda; }
	public function setDataContato($dataContato) { $this->dataContato = $dataContato; }
	public function setIdPrefixo($idPrefixo) { $this->idPrefixo = $idPrefixo; }

	public function registraContato() {
		// Dabatase
        $databaseObj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

        // inserre na base
        $retorno = $databaseObj->query("INSERT INTO tb_contatos (matricula,mci,idDemanda,idSegmentacaoDemanda,dataContato,idPrefixo) VALUES (?,?,?,?,?,?)",array($this->matricula, $this->mci, $this->idDemanda, $this->idSegmentacaoDemanda, strtotime("now"), $this->idPrefixo));

        // fecha conexão com o DB
        $databaseObj->CloseConnection();

        return $retorno;
	}

}

?>