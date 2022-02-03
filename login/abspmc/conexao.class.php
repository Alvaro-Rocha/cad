<?php
require_once("_database.class.php");
class _conexao extends _database
{
    // dados de conexão no MySQL
    private static $dbtype   = "mysql";
    private static $host     = "abspmc.com"; //"abspmc.com";
    private static $port     = "3306";
    private static $user     = "abspmcco_pajor"; //"abspmcco_pauloro";
    private static $pw       = "ativo#13579@pajor"; //"motheR@55";
    private static $dbname   = "abspmcco_abspmc";
    protected static $dominio = "abspmc";
    protected static $dominioPath = "/atende/dominio"; //Mantem arquivos de uso do domínio e dos usuarios dos usuarios
    protected static $site   = "/atende/dominio/abspmc/www"; //Página www do %dominio%.atende
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
        $this->disconnect();
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
        foreach (array_keys(get_defined_vars()) as $var) {
            unset(${"$var"});
        }
        unset($var);
    }

    /*Metodos que trazem o conteudo da variavel desejada
    @return   $xxx = conteudo da variavel solicitada*/
    private function getDBType()
    {
        return self::$dbtype;
    }
    private function getHost()
    {
        return self::$host;
    }
    private function getPort()
    {
        return self::$port;
    }
    private function getUser()
    {
        return self::$user;
    }
    private function getPassword()
    {
        return self::$pw;
    }
    private function getDB()
    {
        return self::$dbname;
    }
    protected function getDominio()
    {
        return self::$dominio;
    }
    public function getDominioPath()
    {
        return self::$dominioPath;
    }
    public function getSite()
    {
        return self::$site;
    }
    //----------------------------------------------------------------------------------------------------------------    
    //@override
    public function connect()
    {
        try {
            $this->conexao = new PDO(
                $this->getDBType() . ":host=" . $this->getHost() . ";port=" . $this->getPort() . ";dbname=" . $this->getDB(),
                $this->getUser(),
                $this->getPassword(),
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                )
            ); //em vez de array usar 'charset=utf8');
        } catch (PDOException $i) { //se houver exceção, exibe
            die("Erro: <code>" . $i->getMessage() . "</code>");
        }
        return ($this->conexao);
    }
    //----------------------------------------------------------------------------------------------------------------     
    private function disconnect()
    {
        $this->conexao = null;
    }
    //----------------------------------------------------------------------------------------------------------------     
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
