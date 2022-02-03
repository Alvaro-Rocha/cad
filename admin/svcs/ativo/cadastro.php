<?php 

$scriptName = explode('.',basename($_SERVER['SCRIPT_NAME']));
//include_once($scriptName[0].'.sql.php');
//echo (isnull($retorno)?"CPF ainda não consultado" : "valor do retorno é:".$retorno);
//var_dump($financeiro);
/*
var_dump($_LISTA);
var_dump($financeiro);
var_dump($proprietarios);
var_dump($grupos);
var_dump($eletivos);
*/
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
    <link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- ================================================================= -->    
    <style>
        label {
            font-size: 0.8rem;
        }
    
    </style>
    
</head>

<body>
    
    <h2 class="text-primary d-flex justify-content-center" ><b>Financeiro - Atende</b></h2>
 
 <div class="container ">
 <button type="button" class="btn btn-primary ms-3 p-2" id="criarAgenciaNova">Nova Agência</button>  
 
 <div class="table-responsive">
   <table id="tabela" class="table mt-4">
     <thead class="table-active ">
         <td ><b>Agência</b></td>
         <td ><b>Objetivo</b></td>
         <td class="d-none d-sm-table-cell"><b>Categoria</b></td>
         <td class="d-none d-sm-table-cell"><b>Proprietário</b></td>
         <td class="d-none d-sm-table-cell"><b>Gerente</b></td>
         <td class="d-none d-sm-table-cell"><b>Operador</b></td>
         <td>Editar</td>
         <td>Modo</td>
     </thead>
     <tbody>
       
         <tr>
           <td class='nome'><?=$value['agencia'] ?></td>
           <td class='objetivo'><?=$value['objetivo'] ?></td>
           <td class='categoria d-none d-sm-table-cell'><?=$value['categoria'] ?></td>
           <td class='proprietario d-none d-sm-table-cell'><?=$value['proprietario'] ?></td>
           <td class='gerente d-none d-sm-table-cell'><?=$value['gerentes'] ?></td>
           <td class='operador d-none d-sm-table-cell'><?=$value['operadores'] ?></td>
           <td class='editarAgencia'><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><rect fill="none" height="24" width="24"/></g><g><g><g><path d="M3,21l3.75,0L17.81,9.94l-3.75-3.75L3,17.25L3,21z M5,18.08l9.06-9.06l0.92,0.92L5.92,19L5,19L5,18.08z"/></g><g><path d="M18.37,3.29c-0.39-0.39-1.02-0.39-1.41,0l-1.83,1.83l3.75,3.75l1.83-1.83c0.39-0.39,0.39-1.02,0-1.41L18.37,3.29z"/></g></g></g></svg></td>
           <td id="lixo" onclick="lixeira()"><?=($value["disable"]?'<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><rect fill="none" height="24" width="24"/><path d="M19,19H5V5h14V19z M3,3v18h18V3H3z M17,15.59L15.59,17L12,13.41L8.41,17L7,15.59L10.59,12L7,8.41L8.41,7L12,10.59L15.59,7 L17,8.41L13.41,12L17,15.59z"/></svg>':'<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm4.59-12.42L10 14.17l-2.59-2.58L6 13l4 4 8-8z"/></svg>')?></td>
         </tr>
       
     </tbody>
         
   </table>
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
    
    
    
<!-- Modal FORM AGENCIA -->
<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary">Agência.Ativo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form name="formAgencia" method="POST" action="financeiro.php" class="needs-validation" novalidate>
        <div class="modal-body">
              <input type='hidden' id="acao" name='acao' value="">   
              <div class="mb-2">
                <label for="formNome" class="form-label d-none d-sm-block mb-0 ">Nome:</label>    
                <input id="formNome" name='Nome' type='text' class='form-control' required aria-label='Agência' aria-describedby='texto nome da agência' placeholder='Nome da agência' value = ''>
                <div class="invalid-feedback">
                  Nome da agencia invalido 
                </div>
                <!--<div class="valid-feedback">
                Otimo
                </div>-->
              </div>
              <div class="mb-2">
                <label for="formObjetivo" class="form-label d-none d-sm-block mb-0 ">Objetivo:</label>  
                <input id='formObjetivo' name='objetivo' type="text" class="form-control" required aria-label="Objetivo" aria-describedby="texto do objetivo da agência" placeholder="Objetivo da Agência" value="">
                <div class="invalid-feedback">
                  Objetivo da agencia invalido 
                </div>
                <!--<div class="valid-feedback">
                Otimo
                </div>-->
              </div>

              <div class="mb-2">
                  <label for="formEletivo" class="form-label d-none d-sm-block mb-0 ">Categoria</label>
                  <select id="formEletivo" name="formEletivo" class="form-select"  required>
                    <option value="">Selecione a categoria</option>
                     
                        <option value="<?=$value?>"><?=$value?></option>
                       
                  </select>
                  <div class="invalid-feedback">
                  Você deve selecionar uma categoria 
                  </div>
                  <!--<div class="valid-feedback">
                Otimo
                </div>-->
              </div>

              <div class="mb-2">
                <label for="formOwnner" class="form-label d-none d-sm-block mb-0 ">Proprietarios</label>
                <select id="formOwnner" name="proprietario" class="form-select"  required>
                    <option value="">Selecione o Proprietario</option>
                        <?php foreach ($proprietarios as $key => $value) { ?>
                            <option value="<?=$value?>"><?=$value?></option>
                        <?php } ?>  
                </select>
                <div class="invalid-feedback">
                Você deve selecionar um proprietario 
                </div>
                <!--<div class="valid-feedback">
                Otimo
                </div>-->
              </div>

              <div class="mb-2">
                <label for="formManager" class="form-label d-none d-sm-block mb-0 ">Grupo Gerentes</label>
                <select id="formManager" name="gerente" class="form-select"  required>
                    <option value="">Gerente de contas</option>
                        <?php foreach ($grupos as $key => $value) { ?>
                            <option value="<?=$value['nome']?>"><?=$value['nome']?></option>
                        <?php } ?>  
                </select>
                <div class="invalid-feedback">
                Você deve selecionar um gerente 
                </div>
                <!--<div class="valid-feedback">
                Otimo
                </div>-->
              </div>

              <div class="mb-2">
                <label for="formOperator" class="form-label d-none d-sm-block mb-0 ">Grupo Operadores</label>
                <select id="formOperator" name="operador" class="form-select"  required>
                    <option value="">Operadores de contas</option>
                        <?php foreach ($grupos as $key => $value) { ?>
                            <option value="<?=$value['nome']?>"><?=$value['nome']?></option>
                        <?php } ?>  
                </select>
                <div class="invalid-feedback">
                Você deve selecionar um operador 
                </div>
                <!--<div class="valid-feedback">
                Otimo
                </div>-->
              </div>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
          <button id="save" type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>    
    </div>
  </div>
</div>
<!-- ============================================================================== -->    
 
    
    <!-- -----------Carga de arquivos bibliotecas javascript--------------- -->    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- ================================================================= -->    
    <!-- -----------Arquivo javascript incorporado nome_js.php------------ -->    

    <?php include_once($scriptName[0].'_js.php'); ?>

    <!-- ================================================================= -->        
</body>
</html>