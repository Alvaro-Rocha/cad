  <?php 
if (($_SERVER['REQUEST_METHOD'] === 'GET')) {
  $id = (isset($_GET['id']) ? $_GET['id'] : NULL);
}
if (!empty($id)) {
  echo "<br/>Valor recebido de id foi: " . $id;
} else {
  echo "id não especificado!";
  
}

define('RAIZ_SERVER', $_SERVER['DOCUMENT_ROOT']); //.DIRECTORY_SEPARATOR);
$path_class = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'atende' . DIRECTORY_SEPARATOR . 'class';
set_include_path(get_include_path() . PATH_SEPARATOR . $path_class);
require_once(RAIZ_SERVER . "/atende/login/" . "abspmc" . "/conexao.class.php"); //Definição do objeto de conexão
require_once("_page_index.class.php"); //Adiciona a classe _page_index
echo "<br/>Diretorio de classe:" . $path_class;
echo "<br/>Conexao do banco...:" . RAIZ_SERVER . "/atende/login/" . "abspmc" . "/conexao.class.php";

$page = new _page_index();



//print_r($ACESSO->getGrupo($id))
//print_r($page->getGrupos());
//
//print_r($page->getGruposPage(1)); 
//print_r($page->getUsers());
//echo "=========================<br>";
//print_r($page->getUsersPage(1));
//print_r($page->getPHP());
//print_r($page->getPHParg());
//print_r($page->getPages());
//print_r($page->getCSSpage($id));
//print_r($page->getJSpage(1));
//print_r($page->getPHPpage(1));




?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,user-scalable=yes">
    <meta charset="utf-8"/>
    <title>Ativo</title>
    <link rel="icon" sizes="192x192"   type="image/png"    href="img/logo.ico"/>
    <!--------------Link de arquivo css---------------------------------- -->
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <!-- ================================================================= -->    
    <style>
        label {
            font-size: 0.8rem;
        }
    
    </style>
    
</head>

<body>
    <h2 class="text-primary d-flex justify-content-center" ><b>Acesso</b></h2>
      <div class="container">
        <div class="row">  
              <label for="grupos" class="form-label">Grupos</label>
              <div class="col-5" style="padding:0;">
                
                <div  style="display:flex"> 
                  <select multiple id='grupos' class="esqa form-control input-lg" size="6" style="height: 100%;">
                      <?php foreach ($page->getGrupos() as $key => $value) { ?>
                        <?php if(!array_key_exists($key, $page->getGruposPage($id))) {?>
                          <option value="<?=$key?>"><?=$value['nome']?></option>
                        <?php } ?>
                      <?php } ?>
                  </select>
                </div>
              </div>                   
              <div class="col-2 mt-4">    
                <div style="display:flex; flex-direction:column">
                  <i class="fa fa-3x fa-arrow-right dira text-center" aria-hidden="true"></i>
                  <i class="fa fa-3x fa-arrow-left  esqa text-center" aria-hidden="true"></i>
                </div>
              </div>
              <div class="col-5" style="padding:0;">        
                <select multiple id='selecaoGrupos' name='selecaoGrupos[]' class="dira form-control input-lg"  size="6" style="height: 100%;">
                      <?php foreach ($page->getGruposPage($id) as $key => $value) { ?>
                        <option id="valor<?=$key?>"><?=$value?></option>
                      <?php } ?>
                </select>
              </div> 
        </div>
        
        

      
        <div class="row">
              <label for="usuarios" class="form-label">Usuarios</label>  
              <div class="col-5" style="padding:0;">
                
                <div  style="display:flex">
                  <select multiple id='usuarios' class="esqb form-control input-lg" size="6" style="height: 100%;">
                      <?php foreach ($page->getUsers() as $key => $value) { ?>
                        <?php if(!array_key_exists($key, $page->getUsersPage($id))) {?>
                          <option value="<?=$key?>"><?=$value['login']?></option>
                        <?php } ?>
                      <?php } ?>
                  </select>     
                </div>
              </div>                   
              <div class="col-2 mt-4">    
                <div style="display:flex; flex-direction:column">
                  <i class="fa fa-3x fa-arrow-right dirb text-center" aria-hidden="true"></i>
                  <i class="fa fa-3x fa-arrow-left  esqb text-center" aria-hidden="true"></i>
                </div>
              </div>
              <div class="col-5" style="padding:0;">        
                <select multiple id='selecaoUsuarios' name='selecaoUsuarios[]' class="dirb form-control input-lg"  size="6" style="height: 100%;">
                      <?php foreach ($page->getUsersPage($id) as $key => $value) { ?>
                        <option id="valor<?=$key?>"><?=$value?></option>
                      <?php } ?>
                </select>
              </div> 
        </div>
        <div class="mt-3 d-flex justify-content-end">    
          <input type="button" class="btn btn-danger" value="Voltar" onclick="history.go(-1)">
          <button type="button" class="btn btn-primary ms-2">Salvar</button>
        </div>
      </div>
        <!-- ========== Janela modal bootstrap ================================================================================= -->

<!-- Modal para alertas e avisos da pagina-->
<div class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
        <button type="button" class="btn btn-primary">Salvar</button>
      </div>
    </div>
  </div>
</div>
<!-- ============================================================================== -->

<!-- ============================================================================== -->    
 
    
    <!-- -----------Carga de arquivos bibliotecas javascript--------------- -->
    <script  src = "../inputmask/jquery.js"></script> 
    <script  src = "../inputmask/dist/jquery.inputmask.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <!-- ================================================================= -->    
    <!-- -----------Arquivo javascript incorporado nome_js.php------------ -->    
    <?php include_once('acesso_js.php'); ?>
    <!-- ================================================================= -->        
</body>
</html>