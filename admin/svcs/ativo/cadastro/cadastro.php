<?php 
$scriptName = explode('.', basename($_SERVER['SCRIPT_NAME']));
include_once($scriptName[0] . '.sql.php');

//print_r($categoria)

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

        .tamanho-2 {
            font-size: 2.5rem
        }

    
    </style>
    
</head>

<body>
    <h2 class="text-primary d-flex justify-content-center" ><b>Cadastro atende</b></h2>
    <form id="princ" method="POST" action="cadastro.php">
        <div class="container">
            <div class="row">
                <!--Cpf ou Cnpj-->
                <p class="text-primary display-6 col-6 col-lg-4">Novo Cadastro</p>
                <div class="col-6 col-lg-2 mt-2">
                    <div class="row">
                        <i id="industry" class="fa fa-2x fa-industry col-4" aria-hidden="true"></i>
                        <div class="form-check form-switch col-4 d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" id="checkInput" checked>
                        </div>
                        <i id="person" class="fa fa-2x fa-user col-4 text-success" aria-hidden="true"></i>
                    </div>    
                </div>
                <div class="col-lg-6">
            </div>
            
            <!---->
            <!--Caixas de texto-->
            <input type="number" hidden class="form-control" name="indicador" id="indica" placeholder="000.000.000-00">
            <div class="mb-3">
                <label id="cpfcnpjLabel" for="cpfcnpj" class="form-label">Digite o cpf</label>
                <input type="number" class="form-control" name="doc" id="cpfcnpj" placeholder="000.000.000-00">
            </div>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome completo</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome completo">
            </div>
            <label for="dataC" class="form-label">Data cadastrada</label>
            <div class="row">
                <div class="mb-3 col-6">  
                    <input type="date" name="data" class="form-control" id="dataC">   
                </div>
                <div class="col-6 mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">Cadastro ativado</label>
                    </div>
                </div>    
            </div>
            <!--Select-->
            <label class="form-label" for="categorias">Categorias</label> 
            <div class="row mb-3">
                
                <div class="col">    
                    <select id="categorias" class="form-select dir" multiple aria-label="multiple select example">
                        <?php foreach ($categoria as $key => $value) { ?>
                            <option value='<?= $value["nome"]?>'><?= $value["nome"]?></th>
                        <?php } ?>
                        
                    </select>
                </div>
                <div class="col-2 text-center">    
                    <i class="fa fa-3x fa-arrow-right d-block esq" aria-hidden="true"></i>
                    <i class="fa fa-3x fa-arrow-left d-block dir" aria-hidden="true"></i>
                </div>
                <div class="col">    
                    <select name="cat" class="form-select esq" multiple aria-label="multiple select example">
                    </select>
                </div>
            </div>   
            <!---->
        </div>
        <!--Salvar cadastro-->
        <div class="d-flex justify-content-end">
            <button id="botaoS" type="submit" class="btn btn-primary">Salvar cadastro</button>
        </div>
    </form>        
<!-- ============================================================================== -->
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
        <button id="modal-btn-T" type="button" class="btn btn-primary" data-bs-dismiss="modal">Salvar</button>
        
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

    <?php include_once('js/cadastro_js.php'); ?>

    <!-- ================================================================= -->        
</body>	
</html>