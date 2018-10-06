<?php

class Negocio {
	// variaveis
	private $id;
	private $mci;
	private $idProduto;
	private $idSegmentacaoProduto;
	private $valorCartaoAtual;
	private $valorContratado;
	private $valorSeguroContratado;
	private $seguro;
	private $ofertado;
	private $matriculaOferta;
	private $negocioFechado;
	private $matriculaNegocio;
	private $dataOferta;
	private $dataNegocio;
	private $pendente;
	private $numeroOperacaoCDC;
	private $idPrefixo;

	//gets
	public function getId() { return $this->id; }
	public function getMci() { return $this->mci; }
	public function getIdProduto() { return $this->idProduto; }
	public function getIdSegmentacaoProduto() { return $this->idSegmentacaoProduto; }
	public function getValorCartaoAtual() { return $this->valorCartaoAtual; }
	public function getValorContratado() { return $this->valorContratado; }
	public function getValorSeguroContratado() { return $this->valorSeguroContratado; }
	public function getSeguro() { return $this->seguro; }
	public function getOfertado() { return $this->ofertado; }
	public function getMatriculaOferta() { return $this->matriculaOferta; }
	public function getNegocioFechado() { return $this->negocioFechado; }
	public function getMatriculaNegocio() { return $this->matriculaNegocio; }
	public function getDataOferta() { return $this->dataOferta; }
	public function getDataNegocio() { return $this->dataNegocio; }
	public function getPendente() { return $this->pendente; }
	public function getNumeroOperacaoCDC() { return $this->numeroOperacaoCDC; }
	public function getIdPrefixo() { return $this->idPrefixo; }

	// sets
	public function setId($id) { $this->id = $id; }
	public function setMci($mci) { $this->mci = $mci; }
	public function setIdProduto($idProduto) { $this->idProduto = $idProduto; }
	public function setIdSegmentacaoProduto($idSegmentacaoProduto) { $this->idSegmentacaoProduto = $idSegmentacaoProduto; }
	public function setValorCartaoAtual($valorCartaoAtual) { $this->valorCartaoAtual = $valorCartaoAtual; }
	public function setValorContratado($valorContratado) { $this->valorContratado = $valorContratado; }
	public function setValorSeguroContratado($valorSeguroContratado) { $this->valorSeguroContratado = $valorSeguroContratado; }
	public function setSeguro($seguro) { $this->seguro = $seguro; }
	public function setOfertado($ofertado) { $this->ofertado = $ofertado; }
	public function setMatriculaOferta($matriculaOferta) { $this->matriculaOferta = $matriculaOferta; }
	public function setNegocioFechado($negocioFechado) { $this->negocioFechado = $negocioFechado; }
	public function setMatriculaNegocio($matriculaNegocio) { $this->matriculaNegocio = $matriculaNegocio; }
	public function setDataOferta($dataOferta) { $this->dataOferta = $dataOferta; }
	public function setDataNegocio($dataNegocio) { $this->dataNegocio = $dataNegocio; }
	public function setPendente($pendente) { $this->pendente = $pendente; }
	public function setNumeroOperacaoCDC($numeroOperacaoCDC) { $this->numeroOperacaoCDC = $numeroOperacaoCDC; }
	public function setIdPrefixo($idPrefixo) { $this->idPrefixo = $idPrefixo; }

	
	public function registraOferta() {
        
        $retorno = false;
        $mci = $this->mci;
        $idProduto = $this->idProduto;
        $idSegmentacaoProduto = $this->idSegmentacaoProduto;
        $valorCartaoAtual = $this->valorCartaoAtual;
        $valorContratado = $this->valorContratado; 
        $valorSeguroContratado = $this->valorSeguroContratado;
        $seguro = $this->seguro;
        $matriculaOferta = $this->matriculaOferta;
        $numeroOperacaoCDC = $this->numeroOperacaoCDC;
        $idPrefixo = $this->idPrefixo;

        // se recebeu os parametros, insere na base
        if ( !empty(array($mci,$idProduto,$idSegmentacaoProduto,$matriculaOferta)) ) {
            // conecta na BD
            $databaseObj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

            // insere oferta de negocio no banco
            $retorno = $databaseObj->query("INSERT INTO tb_negocios (mci,idProduto,idSegmentacaoProduto,valorCartaoAtual,valorContratado,valorSeguroContratado,seguro,ofertado,matriculaOferta,dataOferta,pendente,numeroOperacaoCDC) VALUES (?,?,?,?,?,?,?,1,?,?,1,?)",array($mci, $idProduto, $idSegmentacaoProduto, $valorCartaoAtual, $valorContratado, $valorSeguroContratado, $seguro, $matriculaOferta, strtotime("now"),$numeroOperacaoCDC));

            // fecha conexão
            $databaseObj->CloseConnection();

        }

        return $retorno;
    }

    public function registraNegocio() {

        $retorno = false;
        $mci = $this->mci;
        $idProduto = $this->idProduto;
        $idSegmentacaoProduto = $this->idSegmentacaoProduto;
        $valorCartaoAtual = $this->valorCartaoAtual;
        $valorContratado = $this->valorContratado; 
        $valorSeguroContratado = $this->valorSeguroContratado;
        $seguro = $this->seguro;
        $matricula = $this->matriculaNegocio;
        $numeroOperacaoCDC = $this->numeroOperacaoCDC;
        $idPrefixo = $this->idPrefixo;

        // se recebeu os parametros, insere na base
        if ( !empty(array($mci,$idProduto,$idSegmentacaoProduto,$matricula)) ) {
            // conecta na BD
            $databaseObj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

            // insere oferta de negocio no banco
            $retorno = $databaseObj->query("INSERT INTO tb_negocios (mci,idProduto,idSegmentacaoProduto,valorCartaoAtual,valorContratado,valorSeguroContratado,seguro,ofertado,matriculaOferta,negocioFechado,matriculaNegocio,dataOferta,dataNegocio,pendente,numeroOperacaoCDC,idPrefixo) VALUES (?,?,?,?,?,?,?,1,?,1,?,?,?,0,?,?)",array($mci, $idProduto, $idSegmentacaoProduto, $valorCartaoAtual, $valorContratado, $valorSeguroContratado, $seguro, $matricula, $matricula,strtotime("now"),strtotime("now"),$numeroOperacaoCDC,$idPrefixo));

            // fecha conexão
            $databaseObj->CloseConnection();

        }

        return $retorno;
    }

    public function registraRecusa() {

        $retorno = false;
        $mci = $this->mci;
        $idProduto = $this->idProduto;
        $idSegmentacaoProduto = $this->idSegmentacaoProduto;
        $valorCartaoAtual = $this->valorCartaoAtual;
        $valorContratado = $this->valorContratado; 
        $valorSeguroContratado = $this->valorSeguroContratado;
        $seguro = $this->seguro;
        $matricula = $this->matriculaNegocio;
        $numeroOperacaoCDC = $this->numeroOperacaoCDC;
        $idPrefixo = $this->idPrefixo;

        // se recebeu os parametros, insere na base
        if ( !empty(array($mci,$idProduto,$idSegmentacaoProduto,$matricula)) ) {
            // conecta na BD
            $databaseObj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

            // insere oferta de negocio no banco
            $retorno = $databaseObj->query("INSERT INTO tb_negocios (mci,idProduto,idSegmentacaoProduto,valorCartaoAtual,valorContratado,valorSeguroContratado,seguro,ofertado,matriculaOferta,negocioFechado,matriculaNegocio,dataOferta,dataNegocio,pendente,numeroOperacaoCDC,idPrefixo) VALUES (?,?,?,?,?,?,?,1,?,0,?,?,?,0,?,?)",array($mci, $idProduto, $idSegmentacaoProduto, $valorCartaoAtual, $valorContratado, $valorSeguroContratado, $seguro, $matricula, $matricula,strtotime("now"),strtotime("now"),$numeroOperacaoCDC,$idPrefixo));

            // fecha conexão
            $databaseObj->CloseConnection();

        }

        return $retorno;
    }

    public function finalizaOfertaPendente() {

        $retorno = false;
        $id = $this->id;
        $matricula = $this->matriculaNegocio;
        $negocioFechado = $this->negocioFechado;

        // se nao tiver id da oferta, não atualiza
        if ( !empty($id) ) {
            // conecta na BD
            $databaseObj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

            // atualiza registro
            $retorno = $databaseObj->query("UPDATE tb_negocios SET negocioFechado=?, matriculaNegocio=?,dataNegocio=?, pendente=0 WHERE id=? LIMIT 1", array($negocioFechado,$matricula,strtotime("now"),$id));

            // fecha conexão
            $databaseObj->CloseConnection();
        }

        return $retorno;
    }

    public static function buscaOfertaPorMci($mci) {

        $retorno = false;

        if ( !empty($mci) ) {

            // conecta na BD
            $databaseObj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

            // pesquisa registros
            //$retorno = $databaseObj->query("SELECT * FROM tb_negocios WHERE ofertado=1 AND negocioFechado=0 AND mci='$mci' AND pendente=1 ORDER BY dataOferta");
            $retorno = $databaseObj->query("SELECT c.id, a.nome as produto, b.nome as segmentacao, c.valorContratado as valorOferta, c.matriculaOferta, c.dataOferta FROM tb_produtos a, tb_segmentacaoproduto b, tb_negocios c WHERE a.id=b.idProduto AND a.id=c.idProduto AND b.id=c.idSegmentacaoProduto AND c.pendente=1 AND MCI='$mci' ORDER BY c.dataOferta");

            // fecha conexão
            $databaseObj->CloseConnection();
        }

        return $retorno;

    }

    public static function buscaOfertaPorMatricula($matricula) {

        $retorno = false;

        if ( !empty($matricula) ) {

            // conecta na BD
            $databaseObj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

            // pesquisa registros
            $retorno = $databaseObj->query("SELECT a.mci, b.nome as 'produto', c.nome as 'segmentacao', a.valorCartaoAtual, a.valorContratado, a.valorSeguroContratado, a.seguro, a.matriculaOferta, a.dataOferta FROM tb_negocios a, tb_produtos b, tb_segmentacaoproduto c WHERE a.idProduto=b.id AND a.idSegmentacaoProduto=c.id AND c.idProduto=b.id AND a.pendente=1 AND a.matriculaOferta='$matricula' ORDER BY a.dataOferta");

            // fecha conexão
            $databaseObj->CloseConnection();
        }

        return $retorno;

    }

    public static function buscaOfertasPendentes() {
        // conecta na BD
        $databaseObj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

        // pesquisa registros
        $retorno = $databaseObj->query("SELECT a.mci, b.nome as 'produto', c.nome as 'segmentacao', a.valorCartaoAtual, a.valorContratado, a.valorSeguroContratado, a.seguro, a.matriculaOferta, a.dataOferta FROM tb_negocios a, tb_produtos b, tb_segmentacaoproduto c WHERE a.idProduto=b.id AND a.idSegmentacaoProduto=c.id AND c.idProduto=b.id AND a.pendente=1 ORDER BY a.dataOferta");

        // fecha conexão
        $databaseObj->CloseConnection();

        return $retorno;
    }

    public static function buscaNegociosFechados() {
        // conecta na BD
        $databaseObj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

        // pesquisa registros
        $retorno = $databaseObj->query("SELECT a.mci, b.nome as 'produto', c.nome as 'segmentacao', a.valorCartaoAtual, a.valorContratado, a.valorSeguroContratado, a.seguro, a.matriculaOferta, a.dataOferta,a.matriculaNegocio, a.dataNegocio FROM tb_negocios a, tb_produtos b, tb_segmentacaoproduto c WHERE a.idProduto=b.id AND a.idSegmentacaoProduto=c.id AND c.idProduto=b.id AND a.pendente=0 AND a.negocioFechado=1 ORDER BY a.dataOferta");

        // fecha conexão
        $databaseObj->CloseConnection();

        return $retorno;
    }

    public static function taxaConversaoIndividual($matricula) {
        // conecta na DB
        $databaseObj = new DB(DB_HOST, DB_NAME, DB_USER, DB_PASS);

        // pesquisa valores
        $retorno = $databaseObj->row("SELECT SUM(ofertado) as 'qtdOfertas',SUM(negocioFechado) as 'qtdNegociosFechados' FROM db_siscabb.tb_negocios WHERE matriculaNegocio = MatriculaOferta AND MatriculaOferta=? AND pendente=0",array($matricula));

        // fecha conexão
        $databaseObj->CloseConnection();

        return $retorno;;

    }

}

?>