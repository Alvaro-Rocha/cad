<?php
class _page_index extends _conexao
{
  protected $_pages = array();  //Cadastro de todas as pages 
  protected $_css = array();  //Cadastro de todos os arquivos css disponiveis
  protected $_js = array();  //Cadastro de todos os arquivos javaScript disponiveis
  protected $_php = array();  //Cadastro de todos os arquivos e classes php disponiveis
  protected $_php_arg = array(); //Argumentos dos scripts php 
  protected $_grupos = array();  //Lista de grupos da plataforma
  protected $_users = array();  //Lista de usuarios da plataforma

  protected $_page_css = array();  //Relação de css com a page
  protected $_page_js = array();  //Relacao de js com a page
  protected $_page_php = array();  //Relacao php com a page
  protected $_page_grupos = array();  //Relacao de grupos com acesso a page
  protected $_page_users = array();  //Relacao de usuarios com acesso a page


  protected $_acessoTipo = array(0 => "Público", 1 => "Restrito", 2 => "privado(todos)", 3 => "Suspenso", 10 => "Não encontrado");
  //Antes de verificar os usuários que tem acesso a page em _userList é preciso verificar se a page não é de acesso EVERYONE
  //-------------------------------------------------------------------------------------
  /*Método construtor do banco de dados*/
  public function __construct()
  {  //Inicializando dados
    $this->loadCssBD();
    $this->loadJsBD();
    $this->loadPhpBD();
    $this->loadGruposBD();
    $this->loadUsersBD();
    $this->loadPagesBD();
  }
  //--------------------------------------------------------------------------------------
  //--------------------------------------------------------------------------------------
  /*Evita que a classe seja clonada*/
  private function __clone()
  {
  }
  //--------------------------------------------------------------------------------------
  //--------------------------------------------------------------------------------------
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
  //--------------------------------------------------------------------------------------
  public function getCSS()
  {
    return $this->_css;
  }
  //--------------------------------------------------------------------------------------
  public function getJS()
  {
    return $this->_js;
  }
  //--------------------------------------------------------------------------------------
  public function getPHP()
  {
    return $this->_php;
  }
  //--------------------------------------------------------------------------------------
  public function getPHParg()
  {
    return $this->_php_arg;
  }
  //--------------------------------------------------------------------------------------
  public function getPages()
  {
    return $this->_pages;
  }
  //--------------------------------------------------------------------------------------
  public function getCSSpage($page)
  {
    return (isset($this->_page_css[$page])   ? $this->_page_css[$page] : array());
  }
  //--------------------------------------------------------------------------------------
  //--------------------------------------------------------------------------------------
  public function getJSpage($page)
  {
    return (isset($this->_page_js[$page])   ? $this->_page_js[$page] : array());
  }
  //--------------------------------------------------------------------------------------
  //--------------------------------------------------------------------------------------
  public function getPHPpage($page)
  {
    return (isset($this->_page_php[$page])   ? $this->_page_php[$page] : array());
  }
  public function getPhpArgPage($page)
  {
    if (array_key_exists($page, $this->_php_arg)) {
      return $this->_php_arg[$page];
    } else {
      return null;
    }
  }
  public function getGrupos()
  {
    return $this->_grupos;
  }
  public function getUsers()
  {
    return $this->_users;
  }
  public function getUsersPage($page)
  {
    return (isset($this->_page_users[$page]) ? $this->_page_users[$page] : array());
  }
  public function getGruposPage($page)
  {
    return (isset($this->_page_grupos[$page]) ? $this->_page_grupos[$page] : array());
  }

  //--------------------------------------------------------------------------------------
  protected function loadCssBD()
  {
    $param = array();
    $SQL = "SELECT Id,name as nome,descricao,categoria,img_demo_link,href,obs FROM 20css css";

    $rs = $this->selectDB($SQL, $param);
    foreach ($rs as $key => $value) {
      $this->_css[$value->Id]['nome'] = $value->nome;
      $this->_css[$value->Id]['descricao'] = $value->descricao;
      $this->_css[$value->Id]['categoria'] = $value->categoria;
      $this->_css[$value->Id]['img_demo_link'] = $value->img_demo_link;
      $this->_css[$value->Id]['href'] = $value->href;
      $this->_css[$value->Id]['obs'] = $value->obs;
    }
  }
  //--------------------------------------------------------------------------------------
  //--------------------------------------------------------------------------------------
  protected function loadJsBD()
  {
    $param = array();
    $SQL = "SELECT Id,name as nome,descricao,versao,src,developer_site,howto FROM 20script_java";

    $rs = $this->selectDB($SQL, $param);
    foreach ($rs as $key => $value) {
      $this->_js[$value->Id]['nome'] = $value->nome;
      $this->_js[$value->Id]['descricao'] = $value->descricao;
      $this->_js[$value->Id]['versao'] = $value->versao;
      $this->_js[$value->Id]['src'] = $value->src;
      $this->_js[$value->Id]['developer_site'] = $value->developer_site;
      $this->_js[$value->Id]['howto'] = $value->howto;
    }
  }
  //--------------------------------------------------------------------------------------
  //--------------------------------------------------------------------------------------
  protected function loadPhpBD()
  {
    $param = array();
    $SQL = "SELECT * FROM 20php";

    $rs = $this->selectDB($SQL, $param);
    foreach ($rs as $key => $value) {
      $this->_php[$value->Id]['nome'] = $value->nome;
      $this->_php[$value->Id]['descricao'] = $value->descricao;
      $this->_php[$value->Id]['versao'] = $value->versao;
      $this->_php[$value->Id]['include'] = $value->include;
      $this->_php[$value->Id]['autor'] = $value->autor;
      $this->_php[$value->Id]['categoria'] = $value->categoria;
      $this->_php[$value->Id]['uso'] = $value->uso;
      $this->_php[$value->Id]['howto'] = $value->howto;
    }
  }
  //--------------------------------------------------------------------------------------
  //--------------------------------------------------------------------------------------
  protected function loadGruposBD()
  {
    $param = array();
    $SQL = "SELECT grp.*,usr.usr_apelido,usr.foto FROM 06_grupo grp LEFT JOIN 06user usr ON grp.fk_user_admin=usr.usr_Id";
    $rs = $this->selectDB($SQL, $param);
    foreach ($rs as $key => $value) {
      $this->_grupos[$value->Id]['nome'] = $value->nome;
      $this->_grupos[$value->Id]['cod'] = $value->cod;
      $this->_grupos[$value->Id]['senha'] = $value->senha;
      $this->_grupos[$value->Id]['descricao'] = $value->descricao;
      $this->_grupos[$value->Id]['fk_user_admin'] = $value->fk_user_admin;
      $this->_grupos[$value->Id]['session_chat'] = $value->session_chat;
      $this->_grupos[$value->Id]['icon'] = $value->icon;
      $this->_grupos[$value->Id]['disable'] = $value->disable;
      $this->_grupos[$value->Id]['admin'] = $value->usr_apelido;
      $this->_grupos[$value->Id]['admin_foto'] = $value->foto;
    }
  }
  //--------------------------------------------------------------------------------------
  //--------------------------------------------------------------------------------------
  protected function loadUsersBD()
  {
    $param = array();
    $SQL = "SELECT * FROM 06user usr";
    $rs = $this->selectDB($SQL, $param);
    foreach ($rs as $key => $value) {
      $this->_users[$value->usr_Id]['login'] = $value->usr_apelido;
      $this->_users[$value->usr_Id]['email'] = $value->usr_email;
      $this->_users[$value->usr_Id]['desc'] = $value->usr_desc;
      $this->_users[$value->usr_Id]['celular'] = $value->usr_movel;
      $this->_users[$value->usr_Id]['pseudo'] = $value->usr_pseudo;
      $this->_users[$value->usr_Id]['foto'] = $value->foto;
      $this->_users[$value->usr_Id]['disable'] = $value->disable;
    }
  }
  //--------------------------------------------------------------------------------------
  protected function loadPagesBD()
  {
    $param = array();
    $SQL = "SELECT page.*,css.fk_css,js.fk_script_java,php.fk_php, php.argumentos,grp.fk_grupo,usr.fk_user "
      . "FROM 20page_index page "
      . "LEFT JOIN 20page_css css ON        page.Id = css.fk_page_index "
      . "LEFT JOIN 20page_script_java js ON page.Id = js.fk_page_index "
      . "LEFT JOIN 20page_php php ON        page.Id = php.fk_page_index "
      . "LEFT JOIN 20_fk_grupo grp ON       page.Id = grp.fk_page "
      . "LEFT JOIN 20_fk_user usr ON        page.Id = usr.fk_page "
      . "WHERE css.disable=0 AND js.disable=0 AND php.disable=0 ";

    $rs = $this->selectDB($SQL, $param);
    foreach ($rs as $key => $value) {
      $this->_pages[$value->Id]['name_page'] = $value->name_page;
      $this->_pages[$value->Id]['descricao'] = $value->descricao;
      $this->_pages[$value->Id]['header'] = $value->header;
      $this->_pages[$value->Id]['footer'] = $value->footer;
      $this->_pages[$value->Id]['referencia'] = $value->referencia;
      $this->_pages[$value->Id]['conteudo'] = $value->conteudo;
      $this->_pages[$value->Id]['href'] = $value->href;
      $this->_pages[$value->Id]['pos_barra_navegacao'] = $value->pos_barra_navegacao;
      $this->_pages[$value->Id]['fk_categoria'] = $value->fk_categoria;
      $this->_pages[$value->Id]['acesso'] = $value->acesso;

      $this->_page_css[$value->Id][$value->fk_css] = $this->_css[$value->fk_css]['nome'];
      $this->_page_js[$value->Id][$value->fk_script_java] = $this->_js[$value->fk_script_java]['nome'];
      $this->_page_php[$value->Id][$value->fk_php] = $this->_php[$value->fk_php]['nome'];


      $this->_php_arg[$value->fk_php] = $value->argumentos;

      if (!empty($value->fk_grupo)) {

        $this->_page_grupos[$value->Id][$value->fk_grupo] = $this->_grupos[$value->fk_grupo]['nome'];
      }
      if (!empty($value->fk_user)) {

        $this->_page_users[$value->Id][$value->fk_user] = $this->_users[$value->fk_user]['login'];
      }
    }
    //return $rs;
  }
  //--------------------------------------------------------------------------------------


}

class _accessPage extends _conexao
{
  protected $_idPage = null;          //Id da página em 20page_index
  protected $_codePage = null;        //Código da página href em 20page_index
  protected $_groupList = array();  //Grupos que tem acesso a page 20_fk_grupos
  protected $_userList = array();   //Lista de usuario com acesso a page 20_fk_users
  protected $_phpList = array();     //Array de arquivos include php com seus argumentos
  protected $_cssList = array();     //Lista de arquivos de estilos css que são utilizados na page
  protected $_jsList = array();      //Lista de arquivos java script que são utilizados na page
  protected $_accessEveryone = false; //Todos os usuários tem acesso a page 
  protected $_acessoTipo = array(0 => "Público", 1 => "Restrito", 2 => "privado(todos)", 3 => "Suspenso", 10 => "Não encontrado");
  protected $_acesso = 2;
  protected $_page = [
    'Id'         => "",
    'name'       => "",
    'descricao'  => "",
    'header'     => "",
    'footer'     => "",
    'referencia' => "",
    'conteudo'   => "",
    'acesso'     => "",
    'pos_barra_navagacao' => ""
  ];
  //Antes de verificar os usuários que tem acesso a page em _userList é preciso verificar se a page não é de acesso EVERYONE
  //-------------------------------------------------------------------------------------
  /*Método construtor do banco de dados*/
  public function __construct($id, $code = "")
  {
    if (!empty($code)) {
      $this->_codePage = $code;
    } else {
      $this->_idPage = $id;
    }
    $page = $this->setPage($this->_idPage, $this->_codePage);

    if (empty($page)) {  //Serviço não encontrado
      $this->_acesso = 10;
      return;
    }
    foreach ($page as $key => $value) {
      $this->_page['Id'] = $value->Id;
      $this->_page['name'] = $value->name_page;
      $this->_page['descricao'] = $value->descricao;
      $this->_page['header'] = $value->header;
      $this->_page['footer'] = $value->footer;
      $this->_page['referencia'] = $value->referencia;
      $this->_page['conteudo'] = trim($value->conteudo);
      $this->_page['pos_barra_navegacao'] = $value->pos_barra_navegacao;
      $this->_page['acesso'] = $value->acesso;
    }
    $this->_idPage = $this->_page['Id'];  //Consiste idPage se paramentro fornecido for o codePage
    $this->_acesso = $this->_page['acesso'];

    if (in_array($this->_acesso, array(1, 2))) { //Se o serviço for restrito ou privado, busca grupos e usuários
      $grupos = $this->accessGroup($this->_idPage);
      foreach ($grupos as $value)
        $this->_groupList[] = $value->fk_grupo;

      if (in_array(1, $this->_groupList) || $this->_acesso == 2) { //Se a página possui acesseo EVERYONDE (todos) dado por grupo ou por serviço(script)
        $this->_accessEveryone = true;
        $this->_acesso = 2;  //Prioridade de definição do acesso EVERYONE é do script, se não definido o grupo poderá definir
      } else {
        $usuarios = $this->accessUser($this->_groupList);
        foreach ($usuarios as $value)
          $this->_userList[] = $value->Id;
      }
    }
  }
  //--------------------------------------------------------------------------------------
  //--------------------------------------------------------------------------------------
  /*Evita que a classe seja clonada*/
  private function __clone()
  {
  }
  //--------------------------------------------------------------------------------------
  //--------------------------------------------------------------------------------------
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
  //--------------------------------------------------------------------------------------
  //--------------------------------------------------------------------------------------
  /*Metodos que trazem o conteudo da variavel desejada
  @return   $xxx = conteudo da variavel solicitada*/
  public function getPage()
  {
    return $this->_page; //array com definições da pagina
  }
  public function getPageName()
  {
    return $this->_page['name']; //nome da pagina
  }
  public function getPageId()
  {
    return $this->_idPage;
  }
  public function getGrupos()
  {
    return $this->_groupList;
  }
  public function getUsuarios()
  {
    $todos = array("todos");
    return ($this->_accessEveryone ? $todos : $this->_userList);
  }
  public function getAcesso()
  {
    return $this->_acessoTipo[$this->_acesso];
  }
  public function getAcessoNum()
  {
    return $this->_acesso;
  }
  public function getConteudo()
  {
    return $this->_page['conteudo'];
  }
  public function getReferencia()
  {
    return $this->_page['referencia'];
  }
  public function getBarNavegacao()
  {
    return $this->_page['pos_barra_navegacao'];
  }
  public function getCss()
  {
    $this->cssList();
    return $this->_cssList;
  }
  public function getJs()
  {
    $this->jsList();
    return $this->_jsList;
  }
  //--------------------------------------------------------------------------------------
  function accessGroup($pageId)
  {
    $param = array("id" => $pageId);
    $SQL = "SELECT fk_grupo FROM(20page_index as page)LEFT JOIN (20_fk_grupo as fkg) ON (page.Id=fkg.fk_page)WHERE(page.id=:id)";
    $rs = $this->selectDB($SQL, $param);
    return $rs;
  }
  //--------------------------------------------------------------------------------------
  //--------------------------------------------------------------------------------------
  function accessUser(array $grupos)
  {
    $param = $grupos;
    array_push($param, $this->_idPage);
    $inQuery = implode(',', array_fill(0, count($grupos), '?'));
    $SQL = "(SELECT Id FROM(06user as usr)JOIN(06_fk_grupo as grp)ON(usr.usr_Id=grp.fk_user)WHERE fk_grupo IN(" . $inQuery . "))UNION"
      . "(SELECT fk_user as Id FROM 20_fk_user as fku LEFT JOIN (20page_index as page)ON(fku.fk_page=page.Id) WHERE fk_page=?)";
    $rs = $this->selectDB($SQL, $param);
    return $rs;
  }
  //--------------------------------------------------------------------------------------
  //--------------------------------------------------------------------------------------
  function setPage($id, $code)
  {
    if (empty($code)) {
      $param = array("id" => $id);
      $SQL = "SELECT Id,name_page,descricao,header,footer,referencia,conteudo,pos_barra_navegacao,acesso FROM(20page_index)WHERE Id=:id";
    } else {
      $param = array("code" => $code);
      $SQL = "SELECT Id,name_page,descricao,header,footer,referencia,conteudo,pos_barra_navegacao,acesso FROM(20page_index)WHERE href=:code";
    }
    $rs = $this->selectDB($SQL, $param);
    return $rs;
  }
  //--------------------------------------------------------------------------------------
  //--------------------------------------------------------------------------------------
  function getPhp()
  {
    $param = array("id" => $this->_idPage);
    $SQL = "SELECT php.include, rel.argumentos FROM (20page_php as rel)"
      . "INNER JOIN (20php as php)ON(rel.fk_php = php.Id)"
      . "INNER JOIN (20page_index as page)ON(rel.fk_page_index=page.Id) WHERE (rel.disable=0 AND page.Id=:id)";
    $rs = $this->selectDB($SQL, $param);
    foreach ($rs as $key => $value) {
      $this->_phpList[$key]['include'] = $value->include;
      $this->_phpList[$key]['argumentos'] = $value->argumentos;
    }
    return $this->_phpList;
  }
  //--------------------------------------------------------------------------------------
  //--------------------------------------------------------------------------------------
  function cssList()
  {
    $param = array("id" => $this->_idPage);
    $SQL = "SELECT css.Id, css.href FROM(20page_css as rel)JOIN(20css as css)ON(rel.fk_css=css.Id)JOIN(20page_index as page)ON(rel.fk_page_index=page.Id)WHERE(rel.disable=0 AND page.Id=:id)";
    $rs = $this->selectDB($SQL, $param);
    foreach ($rs as $key => $value)
      $this->_cssList[$value->Id] = $value->href;
    return $this->_cssList;
  }
  //--------------------------------------------------------------------------------------
  //--------------------------------------------------------------------------------------
  function jsList()
  {
    $param = array("id" => $this->_idPage);
    $SQL = "SELECT js.Id, js.src FROM(20page_script_java as rel)JOIN(20script_java as js)ON(rel.fk_script_java =js.Id)JOIN(20page_index as page)ON(rel.fk_page_index=page.Id)WHERE(rel.disable=0 AND page.Id=:id)";
    $rs = $this->selectDB($SQL, $param);
    foreach ($rs as $key => $value)
      $this->_jsList[$value->Id] = $value->src;
    return $this->_jsList;
  }
  //------------------------------------------------------------------

}
/* *********************************************************************************************************************** */
/* *********************************************************************************************************************** */
/* *********************************************************************************************************************** */
/* *********************************************************************************************************************** */
/* *********************************************************************************************************************** */
class _barra_navegar extends _conexao
{

  protected $_navBar  = array();     //Informações de itens da barra de navegação
  protected $_openPages = array();   //Páginas(serviços) abertos   (1,3,7) 
  protected $_barraNavegacao;         //string tipo "<1><3><5>"

  /* protected $_idSessao;
  protected $_idUser;
  protected $_dtaLogin;   */


  //-------------------------------------------------------------------------------------
  /*Método construtor do banco de dados*/
  public function __construct($pageId)
  {
    //Buscar a barra de navegação atual
    $this_barraNavegacao = (isset($_SESSION['barra_navegacao']) ? $_SESSION['barra_navegacao'] : null);

    //$this->_idSessao = $_SESSION['id_sessao']; 
    //$this->_idUser   = $_SESSION['user_id']; 
    //$this->_dtaLogin = $_SESSION['dta_login'];

    $this->_barraNavegacao = $this->gravaBarraNavegacao($pageId);
    $_SESSION['barra_navegacao'] = $this->_barraNavegacao;
  }
  //--------------------------------------------------------------------------------------
  //--------------------------------------------------------------------------------------
  /*Evita que a classe seja clonada*/
  private function __clone()
  {
  }
  //--------------------------------------------------------------------------------------
  //--------------------------------------------------------------------------------------
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
  //--------------------------------------------------------------------------------------
  /*Metodos que trazem o conteudo da variavel desejada*/
  public function getNavBar()
  {
    $this->barraNavegarItens();
    return $this->_navBar;
  }
  //--------------------------------------------------------------------------------------
  //=================================================================================================
  //Funcao para buscar o id das paginas (page_index) na formatacao da barra de navegacao <1><2><3><111><1112>...
  function pagesIndexId($barra_nav)
  {
    $temp_str = str_replace("><", "-", $barra_nav);
    $temp_str = str_replace("<", "", $temp_str);
    $temp_str = str_replace(">", "", $temp_str);
    return explode('-', $temp_str);
  }
  //--------------------------------------------------------------------------
  //Atualiza uma barra de navegacao retornando o id das paginas para montagem <a href=
  function updateBarraNavegacao($str_page)
  { //parametro <5>

    $tempBar = '&' . $this->_barraNavegacao;
    $pos = strpos($tempBar, $str_page);

    if ($pos) {
      $result = substr($tempBar, 1, $pos - 1);
    } else {
      $result = substr($tempBar, 1, strlen($tempBar));
    }
    $result .= $str_page;

    return $result;
  }
  //--------------------------------------------------------------------------
  function gravaBarraNavegacao($id)
  {
    $novaBarra = $this->_barraNavegacao;
    /*
    $id_sessao = $_SESSION['id_sessao']; 
    $user_id   = $_SESSION['user_id']; 
    $dta_login = $_SESSION['dta_login'];
    $barra_navegacao = $_SESSION['barra_navegacao'];
   */
    if (empty($this->_barraNavegacao)) {
      $this->_barraNavegacao = '<' . $id . '>';
      $this->_openPages = array($id); // $this->pagesIndexId($this->_barraNavegacao); 
    } else {
      $this->_barraNavegacao = $this->updateBarraNavegacao('<' . $id . '>');
      $this_openPages = $this->pagesIndexId($this->_barraNavegacao);
    }
    //Cancelado temporariamente a gravacao da barra de navegacao no BD
    /*
    $param = array("temp_barra" => $temp_barra,
                   'id_sessao'  => $id_sessao,
                   'id_user'    => $user_id,
                   'dta_login'  => $dta_login);
    $SQL = "UPDATE 18audit_log SET barra_navegacao=:temp_barra  WHERE (id_sessao=:id_sessao AND fk_id_user =:id_user AND dta_login=:dta_login)";
    //echo "SQL CMD..............: ".$SQL."<br/>";
    $rs = $this->selectDB($SQL,$param);
    if (!$rs) {
      echo "Falhou UPDATE tabela 18audit[barra_navegacao]<br/>-----------SQL------<br/>SQL:".$SQL; 
    }else{
       //echo "<img src='img/loader.gif' alt='Consulta' />"; 
    }
    */
    return $novaBarra;
  }
  //--------------------------------------------------------------------------------------
  function barraNavegarItens()
  {
    $inQuery = implode(',', array_fill(0, count($this->_openPages), '?'));
    $param = $this->_openPages;
    $SQL = "SELECT Id,name_page, href, descricao FROM 20page_index WHERE Id IN(" . $inQuery . ") ORDER BY FIELD(Id," . implode(',', $this->_openPages) . ")";
    $rs = $this->selectDB($SQL, $param);
    foreach ($rs as $key => $value) {
      $this->_navBar[$value->Id]['nome'] = $value->name_page;
      $this->_navBar[$value->Id]['href'] = $value->href;
      $this->_navBar[$value->Id]['desc'] = $value->descricao;
    }
    //return $this->_navBar;
  }
}
