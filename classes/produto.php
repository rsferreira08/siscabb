<?php

//require_once('../config/config.php');

class Produto
{
    /*=================================
    =            Variáveis            =
    =================================*/
    private $id;
    private $nome;
    private $idPrefixo;

    # Database
    private $databaseObj;
    /*=====  End of Variáveis  ======*/

    /*=====================================
    =            Gets and Sets            =
    =====================================*/
    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getIdPrefixo() { return $this->idPrefixo; }

    public function setId($id) { $this->id = $id; }
    public function setNome($nome) { $this->nome = $nome; }
    public function setIdPrefixo($idPrefixo) { $this->idPrefixo = $idPrefixo; }
    /*=====  End of Gets and Sets  ======*/

    /*===============================
    =            Funções            =
    ===============================*/
    public function __construct() {

        // Inicia Objeto do Banco de Dados
        $this->databaseObj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

        // Verifica se passou algum argumento
        $i = func_num_args();

        // Se passou argumento, carrega o Objeto
        if ($i > 0) {
            $args = func_get_args(); 

            if (!empty($args[0])) {
                call_user_func_array(array($this,'InitProdutos'),$args); 
            }
        }
    }

    /**
     * Inicia o objeto com os valores se foi passado um ID na chamada da classe.
     */
    private function InitProdutos($args) {

        // Verifica se passou um array
        if (is_array($args)) {

        } else {

            // Retorna o Item do Banco de dados
            $array_produtos = $this->databaseObj->row("SELECT * FROM tb_produtos WHERE id=?", array($args));

            // Se existe o registro, salva no objeto os valores para serem trabalhados pelo sistema
            if (!empty($array_produtos["id"])) {

                // Adiciona valores ao objeto
                $this->setId($array_produtos["id"]);
                $this->setNome($array_produtos["nome"]);
                $this->setIdPrefixo($array_produtos["idPrefixo"]);
            }
            
        }

    }


    /**
     * Busca todos os registros
     */
    public static function BuscaTodos($idPrefixo) {

        // Dabatase
        $databaseObj = new Db(DB_HOST, DB_NAME, DB_USER, DB_PASS);

        // Busca os registros no Banco de dados
        $returnArray = $databaseObj->query("SELECT a.nome as produto, b.idProduto, b.nome as segmentacao, b.id   FROM tb_produtos a, tb_segmentacaoproduto b WHERE a.id=b.idProduto AND a.idPrefixo=$idPrefixo AND a.ativo=1 ORDER BY a.nome, b.nome");

        // Close Connection
        $databaseObj->CloseConnection();

        return $returnArray;
    }



}

/*$v1 = new Produto;
// $mci, $idProduto, $idSegmentacaoProduto, $valorCartaoAtual="", $valorContratado="", $valorSeguroContratado="", $seguro="", $matriculaOferta
$ofertas = $v1->buscaOfertaPorMatricula("F8711433");

print_r($ofertas);*/

?>