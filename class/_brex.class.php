<?php

/************TESTE DA CLASS************
define('RAIZ_SERVER', $_SERVER['DOCUMENT_ROOT']); //.DIRECTORY_SEPARATOR);
$path_class = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'atende' . DIRECTORY_SEPARATOR . 'class';
set_include_path(get_include_path() . PATH_SEPARATOR . $path_class);
require_once(RAIZ_SERVER . "/atende/login/" . "abspmc" . "/conexao.class.php"); //Definição do objeto de conexão
//==========================================
 */

/* ********************************************************************************
/* abstract class _brexSt()  
/* 
/*              Leitura de todos os BREX e seus relacionamentos
/* ********************************************************************************* */
abstract class _brexS extends _conexao
{
    protected $_brex = array();           //array com os Benefícios recorrentes
    protected $_brex_id;                  //id do Brex Ativo;
    protected $_beneficio = array();      //Dados do beneficio especificado Id
    /*Método construtor do banco de dados*/
    public function __construct()
    {
        $this->_brex = $this->loadBrexDB();
    }
    /*Evita que a classe seja clonada*/
    private function __clone()
    {
    }

    /*Método que destroi a conexão com banco de dados e remove da memória todas as variáveis setadas*/
    public function __destruct()
    {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
        foreach (array_keys(get_defined_vars()) as $var) {
            unset(${"$var"});
        }
        unset($var);
    }
    //====================================================================
    /* Metodos que trazem o conteudo da variavel desejada
    @return $xxx = conteudo da variavel solicitada     */
    public function getBrex()
    {
        return $this->_brex;
    }

    //=========================================================
    public function loadBrexDB()
    {
        $param = array("dis" => 0);
        $SQL = "SELECT cad.nome,bre.*,COUNT(fk_conta) as contratos,cnv.fk_cadastro "
            . "FROM 50_brex bre "
            . "LEFT JOIN 50_brex_contrato con ON bre.Id=con.fk_brex "
            . "LEFT JOIN 50_convenio cnv ON bre.fk_convenio=cnv.Id "
            . "LEFT JOIN 01cadastro cad ON cnv.fk_cadastro=cad.Id "
            . "WHERE bre.disable=:dis "
            . "GROUP BY identifica";
        //Busca o centro de custo da agencia
        $rs = $this->selectDB($SQL, $param);
        //$this->_apps = json_decode(json_encode($apps), true);
        foreach ($rs as $key => $value) {
            $this->_brex[$value->Id]['fk_cadastro'] = $value->fk_cadastro;
            $this->_brex[$value->Id]['empresa'] = $value->nome;
            $this->_brex[$value->Id]['beneficio'] = $value->identifica;
            $this->_brex[$value->Id]['fk_convenio'] = $value->fk_convenio;
            $this->_brex[$value->Id]['requisito'] = $value->requisito;
            $this->_brex[$value->Id]['atributo_codigo'] = $value->atributo_codigo;
            $this->_brex[$value->Id]['referencia_valor'] = $value->referencia_valor;
            $this->_brex[$value->Id]['atributo_texto'] = $value->atributo_texto;
            $this->_brex[$value->Id]['atributo_valor'] = $value->atributo_valor;
            $this->_brex[$value->Id]['contratos'] = $value->contratos;
            $this->_brex[$value->Id]['disable'] = $value->disable;
        }
        return $this->_brex;
    }
    //------------------------------------------------------------------------
    //------------------------------------
    public function setBeneficio($id)
    {
        $this->_brex_id = $id;
        $this->_beneficio = (isset($this->_brex[$this->_brex_id]) ? $this->_brex[$this->_brex_id] : null);
    }
    //------------------------------------


}
/* ********************************************************************************
/* abstract class _brexImport()  
/* 
/*              Métodos para importação de arquivos de todos os BREX
/* ********************************************************************************* */
abstract class _importBrex extends _brexS
{
    protected $_arquivo;                  //Nome do arquivo de importação
    protected $_id_user;                  //id do usuário que faz a importação
    protected $_field     = array();      //Campos(colunas que será importada)
    protected $_data      = array();      //Todos os dados do arquivo
    protected $_fieldData = array();      //Filtro para o campo de interesse do arquivo
    protected $_colunas;                  //Total de colunas da planilha
    protected $_linhas;                   //Total de linhas da planilha   
    protected $_protocol;                 //Protocolo de importação / id table 50_brex_import
    protected $_line_header;              //Tabelo de importação possui linha de cabeçalho
    protected $_ignore_msg;               //Ignorar mensagens de tipo e tamanho de campo importado
    protected $_fields_import = array();  //Campos=>colunas a importar da planilha

    protected $_analitico_import = array();                  //Dados da importação
    protected $_sintetico_import = array('Contas' => 0, 'Contratos' => 0); //Totais da importação

    protected $_sum_atributo_valor = 0;                      //Total do atributo_valor
    protected $_codigo_count = 0;                            //Contador de codigos distintos
    protected $_texto_import_count = array();                //Agrupamento GROUP BY dos elementos quantidade de texto
    protected $_texto_import_sum_atributo_valor = array();   //Agrupamento GROUP BY dos elementos soma atributo_valor
    protected $_texto_import_sum_referencia_valor = array(); //Agrupamento GROUP BY dos elementos soma referencia_valor


    /*Método construtor*/
    public function __construct() // precisa entrar om nome do arquivo ou protocolo usano métodos SET
    {
        parent::__construct();
    }
    /*Evita que a classe seja clonada*/
    private function __clone()
    {
    }
    /*Método que destroi a conexão com banco de dados e remove da memória todas as variáveis setadas*/
    public function __destruct()
    {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
        foreach (array_keys(get_defined_vars()) as $var) {
            unset(${"$var"});
        }
        unset($var);
    }
    //====================================================================
    /* Metodos que trazem o conteudo da variavel desejada
    @return $xxx = conteudo da variavel solicitada     */
    public function leiaArquivo($user, $arquivo) //Leitura dos dados do arquivo de UPLOAD
    {
        $this->_arquivo = $arquivo;
        $this->_id_user = $user;
        $this->_data = $this->loadArquivo($this->_arquivo);
    }
    public function setProcolo($num)  //Armazena o protocolo para solicitar avaliar e importar
    {
        $this->_protocol = $num;
        $this->_arquivo = $this->leiaProtocolo($this->_protocol);
        //$this->_id_user = ; id do usuário é definida em 
        $this->_data = $this->loadArquivo($this->_arquivo);
    }
    public function getImportCols() //Colunas do arquivo de UPLOAD
    {
        return $this->_colunas;
    }
    public function getImportLines() //Linhas do arquivo de UPLOAD
    {
        return $this->_linhas;
    }
    public function getImportList() //Retorna os dados do arquivo de UPLOAD
    {
        return $this->_data;
    }
    public function getProtocolo()  //Retorna o protocolo de upload do arquivo de importação
    {
        return $this->_protocol;
    }
    public function setLineHeader($arg) //Define se importa ou não a primeira linha da planilha
    {
        $this->_line_header = $arg;
    }
    public function setIgnoreMsg($arg) //Define ignorar ou nao os tipos de campos importados e tamanho desses campos
    {
        $this->_ignore_msg = $arg;
    }
    public function setFieldsImport($arg) //Define as colunas e nome de campos a importar
    {
        $this->_fields_import = $arg;
    }
    public function getUserId()  //Id do usuário que solicitou a importaçao para 50_brex_import
    {
        return $this->_id_user;
    }
    public function getAnaliticoImport()  //Dados completos para serem inseridos no BD
    {
        return $this->_analitico_import;
    }
    public function getSinteticoImport()  //Retorna o total de contas, contratos e valores da importação
    {
        return $this->_sintetico_import;
    }
    public function getAtributoValorSum()  //Retorna a soma do atributo_valor TOTAL
    {
        return $this->_sum_atributo_valor;
    }
    public function getCodigoCount()  //Retorna a quantidade de atributo texto distinct
    {
        return $this->_codigo_count;
    }

    public function getTextoCount()  //Retorna a quantidade de atributo texto distinct
    {
        return $this->_texto_import_count;
    }
    public function getTextoSumAtributoValor()  //Retorna a soma do atributo_valor para cada tipo de atributo_texto
    {
        return $this->_texto_import_sum_atributo_valor;
    }
    public function getTextoSumReferenciaValor()  //Retorna a soma da referencia_valor para cada tipo de atributo_texto
    {
        return $this->_texto_import_sum_referencia_valor;
    }

    public function avaliarImport()  //Avalia dados para importação
    {
        if (empty($this->_fields_import)) {
            echo "Use método setFieldsImport(arg) para definir campos e colunas a avaliar";
            return false;
        }
        $this->avalImport();
        if (empty($this->_sintetico_import['Contas'])) {
            echo "Sem contratos a importar!";
            return false;
        }
        return true;
    }
    //=========================================================
    public function loadArquivo($arq)
    {
        $tmpFile = new DomDocument();
        $tmpFile->load($arq);
        //var_dump($tmpFile);
        $rows = $tmpFile->getElementsByTagName("Row");
        $fields = array();

        $i = 1; //referencia ao numero da linha da planilha
        $j = 1; //referencia ao numero da coluna da planilha
        $this->_linhas = count($rows);
        foreach ($rows as $row) {
            //echo $row->getElementsByTagName("Data")->item(10)->nodeValue;
            //echo "<br/>Done...<br/>";
            while (isset($row->getElementsByTagName("Data")->item($j - 1)->nodeValue)) {
                $fields[$i][$j] = $row->getElementsByTagName("Data")->item($j - 1)->nodeValue;
                //echo "Campo: " . $row->getElementsByTagName("Data")->item($j - 1)->nodeValue . "  <br>";
                $j++;
            }
            //echo "<hr>";
            $j = 1;
            $i++;
        }
        $this->_colunas = count($fields[1]);
        if (empty($this->protocol)) {
            $this->_protocol = $this->saveProtocolBD($this->_brex_id, $arq, $this->_id_user);
        }
        //print_r($fields);
        return $fields;
    }
    //------------------------------------------------------------------------
    //============================================s=========================
    public function saveProtocolBD($brexId, $arquivo, $user,  $field = null, $colunas = null, $registros = null, $valor = null) //salva protocolo de importação
    {
        //atualizando 50_brex_import
        $param = array("b" => $brexId, "a" => $arquivo, "u" => $user,  "fie" => $field, "col" => $colunas, "reg" => $registros, "val" => $valor);
        $SQL = "INSERT INTO 50_brex_import (fk_brex,arquivo,fk_user)VALUES(:b,:a,:u) ON DUPLICATE KEY UPDATE fields=:fie,colunas=:col,registros=:reg,valores=:val";
        //echo "<br/>" . $SQL; echo "<br/>arquivo/user: " . $arquivo . "/" . $user; exit();
        //Busca o protocolo
        $id = $this->insertDB($SQL, $param);
        if ($id == 0) {  //Não houve insert na tabela import
            $param = array("a" => $arquivo);
            $SQL = "SELECT Id FROM 50_brex_import WHERE arquivo=:a";
            $rs = $this->selectDB($SQL, $param);
            foreach ($rs as $key => $value)
                $id = $value->Id;
        }
        return $id;
    }
    //----------------------------------------------------------------------
    //=========================================================
    public function leiaProtocolo($p)
    {
        $param = array("protocol" => $p);
        $SQL = "SELECT fk_brex,arquivo,fk_user FROM 50_brex_import WHERE id=:protocol AND dta_efetiva is null";
        //Busca o centro de custo da agencia
        $rs = $this->selectDB($SQL, $param);
        //$this->_apps = json_decode(json_encode($apps), true);
        foreach ($rs as $key => $value) {

            $this->setBeneficio($value->fk_brex);
            $this->_arquivo = $value->arquivo;
            $this->_id_user = $value->fk_user;
        }
        return $this->_arquivo;
    }
    //------------------------------------------------------------------------
    function avalImport()
    {
        $reg = 0;
        $matriculas = array();
        $codigos = array();
        foreach ($this->getImportList() as $key => $value) {
            if ($key == 1 && $this->_line_header == "on") { //Saltar a primeira linha de cabeçalho
                continue;
            }
            $c = $this->confereConta($value[$this->_fields_import['conta']]);
            if ($c) {
                $reg++;
                $this->_sintetico_import['Contratos']++; //Somando contratos
                if (!in_array($c, $matriculas)) { //Somando contas distintas
                    $matriculas[] = $c;
                }
                $this->_analitico_import[$reg]['conta'] = $c;
                //-----------------------------------------------ref valor    
                if (!empty($this->_beneficio['referencia_valor'])) {
                    //$this->_analitico_import[] = $value[$this->_fields_import[ $this->_beneficio['referenciaatributo_valor'] ]];
                    //sintetico
                    //?????$this->_texto_import_sum_referencia_valor

                    $ref_valor = 1;
                }
                /*
                echo "<br>---Beneficio-------<br/>";
                print_r($this->_beneficio);
                echo "<br>---Campos-------<br/>";
                print_r($this->_fields_import);
                echo "<br>---Valores-------<br/>";
                print_r($value);
                echo "<br>---Array valor-------<br/>";
                   */
                //-----------------------------------------------atributo valor    
                if (!empty($this->_beneficio['atributo_valor'])) {
                    $this->_analitico_import[$reg][$this->_beneficio['atributo_valor']] = $value[$this->_fields_import[$this->_beneficio['atributo_valor']]];
                    if (!isset($this->_sintetico_import[$this->_beneficio['atributo_valor']])) {
                        $this->_sintetico_import[$this->_beneficio['atributo_valor']] = 0;
                    }
                    $this->_sintetico_import[$this->_beneficio['atributo_valor']] +=  $value[$this->_fields_import[$this->_beneficio['atributo_valor']]];

                    $this->_sum_atributo_valor += $value[$this->_fields_import[$this->_beneficio['atributo_valor']]];
                }

                //-----------------------------------------------atributo texto    
                if (!empty($this->_beneficio['atributo_texto'])) {
                    $this->_analitico_import[$reg][$this->_beneficio['atributo_texto']] = $value[$this->_fields_import[$this->_beneficio['atributo_texto']]];
                    if (!isset($this->_texto_import_count[$value[$this->_fields_import[$this->_beneficio['atributo_texto']]]])) {
                        $this->_texto_import_count[$value[$this->_fields_import[$this->_beneficio['atributo_texto']]]] = 0;
                    }
                    $this->_texto_import_count[$value[$this->_fields_import[$this->_beneficio['atributo_texto']]]]++;
                    if (!empty($this->_beneficio['referencia_valor'])) {
                        //buscar o valor para somar a referencia_valor por atributo texto GROUP BY
                        if (!isset($this->_texto_import_sum_referencia_valor[$value[$this->_fields_import[$this->_beneficio['atributo_texto']]]])) {
                            $this->_texto_import_sum_referencia_valor[$value[$this->_fields_import[$this->_beneficio['atributo_texto']]]] = 0;
                        }
                        $this->_texto_import_sum_referencia_valor[$value[$this->_fields_import[$this->_beneficio['atributo_texto']]]] += $ref_valor;
                    }
                    if (!empty($this->_beneficio['atributo_valor'])) {
                        //somar o atributo_valor  por atributo texto GROUP BY
                        if (!isset($this->_texto_import_sum_atributo_valor[$value[$this->_fields_import[$this->_beneficio['atributo_texto']]]])) {
                            $this->_texto_import_sum_atributo_valor[$value[$this->_fields_import[$this->_beneficio['atributo_texto']]]] = 0;
                        }
                        $this->_texto_import_sum_atributo_valor[$value[$this->_fields_import[$this->_beneficio['atributo_texto']]]] += $value[$this->_fields_import[$this->_beneficio['atributo_valor']]];
                    }
                }
                //-----------------------------------------------atributo codigo    
                if (!empty($this->_beneficio['atributo_codigo'])) {
                    $cod = $value[$this->_fields_import[$this->_beneficio['atributo_codigo']]];
                    //Conta os codigos distintos
                    if (!in_array($cod, $codigos)) { //Somando contas distintas
                        $codigos[] = $c;
                    }
                    $this->_analitico_import[$reg][$this->_beneficio['atributo_codigo']] = $cod;
                }
            }
        }
        $this->_sintetico_import['Contas'] = count($matriculas);
        $this->_codigo_count = count($codigos);
    }
    //==========================================================================
    public function confereConta($conta)
    {
        return $conta;
    }
}
/* ********************************************************************************
/* class _brexId(id)  
/* 
/* 
/* ********************************************************************************* */
class _brex extends _importBrex
{

    protected $_brexContrato = array();   //Contratos de um determniado benefício
    protected $_fields = array();         //Campos adicionais exclussivos do contrato
    /*Método construtor*/
    public function __construct($id = null)
    {
        parent::__construct();
        if (!empty($id) &&  is_numeric($id)) {
            $this->_brex_id = $id;
            $this->_beneficio = (isset($this->_brex[$this->_brex_id]) ? $this->_brex[$this->_brex_id] : null);
        }
    }
    /*Evita que a classe seja clonada*/
    private function __clone()
    {
    }

    /*Método que destroi a conexão com banco de dados e remove da memória todas as variáveis setadas*/
    public function __destruct()
    {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
        foreach (array_keys(get_defined_vars()) as $var) {
            unset(${"$var"});
        }
        unset($var);
    }
    //====================================================================
    /* Metodos que trazem o conteudo da variavel desejada
    @return $xxx = conteudo da variavel solicitada     */
    public function getBrexId($id = null)
    {
        if (empty($id)) {
            return $this->_beneficio;
        }
        return (isset($this->_brex[$id]) ? $this->_brex[$id] : null);
    }
    //------------------------------------
    public function getFields($id = null)  //Busca campos específicos de um beneficio
    {
        $arg = (empty($id) ? $this->_brex_id : $id);
        return $this->beneficioFields($arg);
    }
    //------------------------------------
    public function getContratos($contrato_id = null)
    {
        $this->loadContratosDB();
        if (!empty($contrato_id)) {
            return  $this->_brexContrato[$contrato_id];
        }
        return $this->_brexContrato;
    }

    public function getBeneficioId()
    {
        return $this->_brex_id;
    }

    //=========================================================
    public function beneficioFields($id = null)
    {
        $this->_fields = array();
        $ben = (empty($id) ? $this->_beneficio : $this->_brex[$id]);

        if (!empty($ben['atributo_codigo'])) {
            $this->_fields[] = $ben['atributo_codigo'];
        }
        if (!empty($this->ben['referencia_valor'])) {
            $this->_fields[] = $ben['referencia_valor'];
            $this->_fields[] = 'valor';
        }
        if (!empty($ben['atributo_texto'])) {
            $this->_fields[] = $ben['atributo_texto'];
        }
        if (!empty($ben['atributo_valor'])) {
            $this->_fields[] = $ben['atributo_valor'];
        }
        return $this->_fields;
    }
    //==========================================================================
    public function loadContratosDB()
    {
        if (empty($this->_brex_id)) {
            echo "<br>Benefício não definido!<br/>Use o método <b>->beneficioSet(id)</b> da classe <b>_brex</b></br>!";
            exit();
        }
        $param = array("id" => $this->_brex_id);
        $SQL = "SELECT con.Id,"
            . (empty($this->_brex[$this->_brex_id]['atributo_codigo'])  ? ''  : 'con.codigo,')
            . (empty($this->_brex[$this->_brex_id]['referencia_valor']) ? ''  : 'con.fk_referencia,val.valor,')
            . (empty($this->_brex[$this->_brex_id]['atributo_texto'])   ? ''  : 'con.atributo_texto,')
            . (empty($this->_brex[$this->_brex_id]['atributo_valor'])   ? ''  : 'con.atributo_valor,')
            . "con.fk_conta,con.fk_brex,con.dta_adesao,con.fk_cadastro,cad.nome, cad.doc "
            . "FROM 50_brex_contrato con "
            . "LEFT JOIN 50_brex_valor val ON (val.referencia=con.fk_referencia AND val.fk_brex=con.fk_brex)"
            . "LEFT JOIN 01cadastro cad ON cad.Id=con.fk_cadastro "
            . "WHERE con.fk_brex=:id ";
        //echo $SQL;echo "<br/>/*<br/>";return;
        //. "ORDER BY fk_conta ASC, Tipo DESC,nome ASC";
        //Busca o centro de custo da agencia
        $rs = $this->selectDB($SQL, $param);
        //$this->_apps = json_decode(json_encode($apps), true);
        foreach ($rs as $key => $value) {
            $this->_brexContrato[$value->Id]['fk_brex'] = $value->fk_brex;
            $this->_brexContrato[$value->Id]['conta']   = $value->fk_conta;
            $this->_brexContrato[$value->Id]['adesao']  = $value->dta_adesao;
            $this->_brexContrato[$value->Id]['fk_cadastro'] = $value->fk_cadastro;
            $this->_brexContrato[$value->Id]['nome'] = $value->nome;
            $this->_brexContrato[$value->Id]['doc'] = $value->doc;


            if (!empty($this->_brex[$this->_brex_id]['atributo_codigo'])) {
                $temp =  $this->_brex[$this->_brex_id]['atributo_codigo'];
                $this->_brexContrato[$value->Id][$temp] = $value->codigo;
            }
            if (!empty($this->_brex[$this->_brex_id]['referencia_valor'])) {
                $temp =  $this->_brex[$this->_brex_id]['referencia_valor'];
                $this->_brexContrato[$value->Id][$temp] = $value->fk_referencia;
                $this->_brexContrato[$value->Id]['valor'] = $value->valor;
            }
            if (!empty($this->_brex[$this->_brex_id]['atributo_texto'])) {
                $temp = $this->_brex[$this->_brex_id]['atributo_texto'];
                $this->_brexContrato[$value->Id][$temp] = $value->atributo_texto;
            }
            if (!empty($this->_brex[$this->_brex_id]['atributo_valor'])) {
                $temp = $this->_brex[$this->_brex_id]['atributo_valor'];
                $this->_brexContrato[$value->Id][$temp] = $value->atributo_valor;
            }
        }
        //return $this->_brexContrato;
    }
    //------------------------------------------------------------------------
}

/*
$arq = new _importData('pr01descontado.xml');
echo "<br/>Número de Colunas: " . $arq->getImportCols();
echo "<br/>Número de Linhas.: " . $arq->getImportLines();
?>

<table style='border: 1px solid'>
    <?php
    //Escrita do cabeçalho
    echo "<tr style='border: 1px solid'><th>x</th>";
    for ($i = 0; $i < $arq->getImportCols() || $i >= 90; $i++)
        echo "<th>" . chr(65 + $i) . "</th>";
    echo "</tr>";

    foreach ($arq->getImportList() as $key => $value) {
        echo "<tr><td>{$key}</td>";
        foreach ($value as $k => $val) {
            echo "<td>{$val}</td>";
        }
        echo "</tr>";
    }
    ?>
</table>

/*
$br = new _brex();
$test = 1;
echo "<br/>Beneficio..: <br/>";
print_r($br->getBrexId($test));
echo "<br/>Campos especificos..: <br/>";
print_r($br->getFieldsId($test));
echo "<br/>Contratos do beneficio: <br/>";
print_r($br->getContratos($test, 79));
/*
$br->getContratosBrex(4);
;
*/
