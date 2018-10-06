<?php

class Demanda {
	// variaveis
	private $id;
	private $demanda;
	private $idPrefixo;
	private $ativo;

	// gets
	public function getId() { return $this->id; }
	public function getDemanda() { return $this->demanda; }
	public function getIdPrefixo() { return $this->idPrefixo; }
	public function getAtivo() { return $this->ativo; }

	// sets
	public function setId($id) { $this->id = $id; }
	public function setDemanda($demanda) { $this->demanda = $demanda; }
	public function setIdPrefixo($idPrefixo) { $this->idPrefixo = $idPrefixo; }
	public function setAtivo($ativo) { $this->ativo = $ativo; }

	// funcoes
	public static function BuscaTodasDemandas($idPrefixo) {
		 // Dabatase
        $databaseObj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

        // Busca os registros no Banco de dados
        $returnArray = $databaseObj->query("SELECT * FROM tb_demandas WHERE idPrefixo=? AND ativo=1  ORDER BY demanda",array($idPrefixo));

        // Close Connection
        $databaseObj->CloseConnection();

        return $returnArray;
	}

	// funcoes
	public static function BuscaTodasSegmentacoesDemandas($idPrefixo) {
		// Dabatase
        $databaseObj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

        // Busca os registros no Banco de dados
        $returnArray = $databaseObj->query("SELECT * FROM tb_segmentacaodemanda WHERE idPrefixo=? AND ativo=1  ORDER BY segmentacao",array($idPrefixo));

        // Close Connection
        $databaseObj->CloseConnection();

        return $returnArray;
	}

	public static function BuscaTodos($idPrefixo) {
		// Dabatase
        $databaseObj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

        // Busca os registros no Banco de dados
        $returnArray = $databaseObj->query("SELECT a.demanda as demanda, b.idDemanda, b.segmentacao as segmentacao, b.id FROM tb_demandas a, tb_segmentacaodemanda b WHERE a.id=b.idDemanda AND a.idPrefixo=? AND a.ativo=1  ORDER BY a.demanda, b.segmentacao",array($idPrefixo));

        // Close Connection
        $databaseObj->CloseConnection();

        return $returnArray;
	}
}

?>