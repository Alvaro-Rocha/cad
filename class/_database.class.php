<?php
abstract class _database
{
    //protected $_regs_atingidos = 0;
    /*Método construtor do banco de dados*/
    private function __construct()
    {
    }

    /*Evita que a classe seja clonada*/
    private function __clone()
    {
    }

    /*Método que destroi a conexão com banco de dados e remove da memória todas as variáveis setadas*/
    public function __destruct()
    {
        //$this->disconnect();
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
        foreach (array_keys(get_defined_vars()) as $var) {
            unset(${"$var"});
        }
        unset($var);
    }


    //----------------------------------------------------------------------------------------------------------------    
    abstract function connect();
    //----------------------------------------------------------------------------------------------------------------     

    //----------------------------------------------------------------------------------------------------------------     
    /*Método select que retorna um VO ou um array de objetos*/
    public function selectDB($sql, $params = null, $class = null)
    {
        $query = $this->connect()->prepare($sql);
        $query->execute($params);

        if (isset($class)) {
            $rs = $query->fetchAll(PDO::FETCH_CLASS, $class); // or die(print_r($query->errorInfo(), true));
        } else {
            $rs = $query->fetchAll(PDO::FETCH_OBJ); // or die(print_r($query->errorInfo(), true));
        }
        //$this->_regs_atingidos = $query->rowCount();
        //$this->__destruct(); //self::__destruct();
        return $rs;
    }
    /*Método insert que insere valores no banco de dados e retorna o último id inserido*/
    public function insertDB($sql, $params = null)
    {
        $conexao = $this->connect();
        $query = $conexao->prepare($sql);
        $query->execute($params);
        $rs = $conexao->lastInsertId(); // or die(print_r($query->errorInfo(), true));
        //self::__destruct();
        return $rs;
    }
    /*Método update que altera valores do banco de dados e retorna o número de linhas afetadas*/
    public function updateDB($sql, $params = null)
    {
        $query = $this->connect()->prepare($sql);
        $query->execute($params);
        $rs = $query->rowCount();  //or die(print_r($query->errorInfo(), true));
        //$this->__destruct; //self::__destruct();
        return $rs;
    }
    /*Método delete que excluí valores do banco de dados retorna o número de linhas afetadas*/
    public function deleteDB($sql, $params = null)
    {
        $query = $this->connect()->prepare($sql);
        $query->execute($params);
        $rs = $query->rowCount(); //or die(print_r($query->errorInfo(), true));
        //$this->__destruct; //self::__destruct();
        return $rs;
    }
    /*Método replace que insere novo valor, se já existir altera o valor */
    public function replaceDB($sql, $params = null)
    {
        $query = $this->connect()->prepare($sql);
        $query->execute($params);
        $rs = $query->rowCount();
        return $rs;
    }
}
//=================================================================
/* verificar depois
	mysql_query("SET NAMES 'utf8'");
    mysql_query('SET character_set_connection=utf8');
    mysql_query('SET character_set_client=utf8');
    mysql_query('SET character_set_results=utf8');
 */

/*
$cnn = new Conn();
$rs = $cnn->getInfo();

print_r ($rs);

$empresa_nome = "ABSPMC";
$local_site = "http://www.abspmc.com.br/atende";        
$nome_cliente="Associacao Beneficente dos Servidores da Prefeitura Municipal de Contagem";
$nome_short = "ABSPMC";
$dominio = "http://www.abspmc.com.br/atende";
$email_cliente = "abspmc@abspmc.com.br";


//Novas definições para a variável de dominio Mar-2017
$_dominio['nome'] = "ABSPMC";
$_dominio['razao_social'] = "Associacao Beneficente dos Servidores da Prefeitura Municipal de Contagem";
$_dominio['fantasia'] = "ABSPMC";
$_dominio['site'] = "http://www.abspmc.com.br";
$_dominio['e-mail'] = "abspmc@abspmc.com.br";
$_dominio['contato'] = "(31)3358-2000 / 2001";
$_dominio['end'] = "Rua Ant&ocirc;nio Augusto,50 - Bairro Nsa. de F&aacute;tima - Contagem - MG";


//CONSTANTES PARA GERENCIAMENTO DE PASTAS Mai-2017

$_dominio['ROOT_SITE'] = "/atende/admin/svcs/abspmc/www"; //Página www do %dominio%.atende
$_dominio['ROOT'] = "/atende/admin/svcs/"; //Mantem arquivos de uso do domínio e dos usuarios dos usuarios
*/
