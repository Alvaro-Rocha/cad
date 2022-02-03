<?php 
define('RAIZ_SERVER', $_SERVER['DOCUMENT_ROOT']); //.DIRECTORY_SEPARATOR);
$path_class = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'atende' . DIRECTORY_SEPARATOR . 'class';
set_include_path(get_include_path() . PATH_SEPARATOR . $path_class);
require_once(RAIZ_SERVER . "/atende/login/" . "abspmc" . "/conexao.class.php"); //Definição do objeto de conexão
require_once("_page_index.class.php"); //Adiciona a classe _page_index
echo "<br/>Diretorio de classe:" . $path_class;
echo "<br/>Conexao do banco...:" . RAIZ_SERVER . "/atende/login/" . "abspmc" . "/conexao.class.php";

$page = new _page_index();

//print_r($page->getCSS());
//print_r($page->getJS());
//print_r($page->getPHP());
//print_r($page->getPHParg());
//print_r($page->getPages());
//print_r($page->getCSSpage(1));
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
    <h2 class="text-primary d-flex justify-content-center" ><b>Serviços</b></h2>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Lista</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Novo formulario</button>
        </div> 
    </nav>
    <div class="container">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="table-responsive">    
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="id" scope="col">Id</th> 
                                <th class="nome" scope="col">Nome</th>
                                <th class="ref" scope="col">Ref</th>
                                <th class="conteudo" scope="col">Conteudo</th>
                                <th class="href" scope="col">Href</th>
                                <th class="descricao" hidden scope="col">descricao</th>
                                <th class="status" scope="col">status</th>
                                <th class="acoes" scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="tb">
                            <?php foreach ($page->getPages() as $key => $value) { ?>
                                <tr class="lForm">
                                    <td class="id" ><?=$key?></td>
                                    <td class="nome"><?=$value['name_page']?></td>
                                    <td class="ref"><?=$value['referencia']?></td>
                                    <td class="conteudo"><?=$value['conteudo']?></td>
                                    <td class="href"><?=$value['href']?></td>
                                    <td class="descricao" hidden><?=$value['descricao']?></td>
                                    <td class="cat" hidden><?=$value['fk_categoria']?></td>
                                    <td class="status"><?=$value['acesso']?></td>
                                    <td class="acoes"><svg class="edit" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><rect fill="none" height="24" width="24"/></g><g><g><g><path d="M3,21l3.75,0L17.81,9.94l-3.75-3.75L3,17.25L3,21z M5,18.08l9.06-9.06l0.92,0.92L5.92,19L5,19L5,18.08z"/></g><g><path d="M18.37,3.29c-0.39-0.39-1.02-0.39-1.41,0l-1.83,1.83l3.75,3.75l1.83-1.83c0.39-0.39,0.39-1.02,0-1.41L18.37,3.29z"/></g></g></g></svg> <svg class="lixo" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"/></svg></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>



            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <form method="get" action="/atende/admin/svcs/ativo/pages/pages.php" onsubmit="subativado()">
                    <button id="bot" class="btn btn-primary mt-4" type="reset">Novo formulario</button>
                    <div class="row mt-4 mb-3">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text"  class="form-control" id="nome" placeholder="Digite o nome do formulario">
                            </div>
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição</label>
                                <input type="text" class="form-control" id="descricao" placeholder="Insira a descrição">
                            </div>
                        </div>
                        <!---->
                        <div class="col-6">
                        <label for="status" class="form-label">Status</label>
                            <select id="status" class="form-select mb-3" aria-label="Default select example">
                                <option selected>Defina o status</option>
                                <option  value="0">publico</option>
                                <option  value="1">todos</option>
                                <option  value="2">privado</option>
                            </select>
                            <!---->
                            <label for="categoria" class="form-label">categoria</label>
                            <select id="categoria" class="form-select mb-3" aria-label="Default select example">
                                <option selected>Escolha uma categoria</option>
                            </select>
                        </div>
                    </div>    
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Adicione o conteudo" id="conteudo" style="height: 100px"></textarea>
                        <label for="conteudo">Conteudo</label>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="form-check form-switch mb-4">
                                <input class="form-check-input" type="checkbox" id="barra-de-navegacao" checked>
                                <label class="form-check-label" for="barra-de-navegacao">Barra de navegação</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="desabilitado" >
                                <label class="form-check-label" for="desabilitado">Desabilitado</label>
                            </div>
                        </div>
                        <div class="col-6 ">
                            <div class="d-flex justify-content-end mb-3">
                                <a id="abibli" href="biblioteca/biblioteca.php"> <button class="btn btn-secondary" type="button">Referenciar Scripts</button></a>
                            </div>
                            <div class="d-flex justify-content-end mb-3">
                                <a id="aAcesso" href="acesso/acesso.php?id=1"><button class="btn btn-secondary" type="button">Selecionar o acesso</button></a>       
                            </div>
                        </div>
                    </div>    
                    <div class="d-flex justify-content-end">
                        <button id="formSub" class="btn btn-primary" type="submit">Salvar formulario</button>       
                    </div>
                </form> 
            </div>
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
          <p></p>
       </div>
      <div class="modal-footer">
        <button id="modal-btn-F" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Sair</button>
        <button id='modal-btn-T' type='button' class='btn btn-primary d-none' data-bs-dismiss='modal'>Salvar</button>
        <button id='modal-btn-V' type='button' class='btn btn-primary d-none' data-bs-dismiss='modal'>Salvar</button>
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

    <?php include_once('js/pages_js.php'); ?>

    <!-- ================================================================= -->        
</body>	
</html>