<?php 

$scriptName = explode('.',basename($_SERVER['SCRIPT_NAME']));
include_once($scriptName[0].'.sql.php');
//var_dump ($_LISTA);
//exit();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,user-scalable=yes">
    <meta charset="utf-8"/>
    <title>Financeiro</title>


    <!--------------Link de arquivo css---------------------------------- -->
    <!-- Latest compiled and minified CSS -->
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- ================================================================= -->    
    
</head>

<body>
    <div class="container">
    
    <table class="table">
        <thead class="table-active">
          <th scope="row"></th>
          <td>vida</td>
          <td>toda</td>
        </thead>
        <tbody>
          <tr>
            <th scope="row">0</th>
            <td >hdrgsk</td>
            <td>Larry the Bird</td>
            <td><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><rect fill="none" height="24" width="24"/></g><g><g><g><path d="M3,21l3.75,0L17.81,9.94l-3.75-3.75L3,17.25L3,21z M5,18.08l9.06-9.06l0.92,0.92L5.92,19L5,19L5,18.08z"/></g><g><path d="M18.37,3.29c-0.39-0.39-1.02-0.39-1.41,0l-1.83,1.83l3.75,3.75l1.83-1.83c0.39-0.39,0.39-1.02,0-1.41L18.37,3.29z"/></g></g></g></svg></td>
          </tr>
          <tr>
            <th scope="row">1</th>
            <td >@twitter</td>
            <td>Larry the Bird</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td >@twitter</td>
            <td>Larry the Bird</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td >@twitter</td>
            <td>Larry the Bird</td>
          </tr>
          <tr>
            <th scope="row">4</th>
            <td >@twitter</td>
            <td>Larry the Bird</td>
          </tr>
          <tr>
            <th scope="row">5</th>
            <td >@twitter</td>
            <td>Larry the Bird</td>
          </tr>
        </tbody>
      </table>
</div>   
     
        
        
        
        
        
        <!-- ========== Janela modal bootstrap ================================================================================= -->
        <div class="modal fade modal-lg" id="myModal" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title no-print text-primary">Modal Header</h4>
                </div>
                <div class="modal-body">
                  <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default no-print" data-dismiss="modal">Fechar</button>
                </div>
              </div>

            </div>
          </div>   
        <!-- ============================================================================== -->
    </div>
    
    <!-- -----------Carga de arquivos bibliotecas javascript--------------- -->    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <!-- ================================================================= -->    
    <!-- -----------Arquivo javascript incorporado nome_js.php------------ -->    
    <?php include_once($scriptName[0].'_js.php'); ?>
    <!-- ================================================================= -->        
</body>
</html>