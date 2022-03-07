<?php 
    ob_start();
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Brazil/East");
    $page_source = $_SERVER['REQUEST_URI'];
    $retorno = -2;
    //$mensagem = "";


    // dados de conexão no MySQL
    $server = "abspmc.com";
    $user = "abspmcco_pajor";
    $pw = "ativo#13579@pajor";
    $dbname = "abspmcco_abspmc";        
    
    $conn = new mysqli($server,$user,$pw,$dbname);
    if($conn->connect_errno){
        echo "Failed to connect to MySQL: " . $conn->connect_error;
        exit();
    }

    $conn->set_charset("utf8");
    $_LISTA = array('$categoria'=>"(array) Categorias disponíveis para o cadastro",
                    '$cadastro'=>"(array) Resuldado de busca após consulta",
                    '$retorno'=>"0: cadastro inexistente, 1:doc já cadastrado no sistema",
                    '$mensagem'=>"Mensagem do retorno do request");
    //busca as agências cadastradas
    $SQL = "SELECT Id,nome FROM 01_categoria";
    $result = $conn->query($SQL) or die(mysqli_error($conn));
    if ($result) {
        // Get field information for all fields
        while ($row = $result->fetch_assoc()) {
          $categoria[$row["Id"]]['nome'] = $row["nome"];
        }
    }
    
    
if(($_SERVER['REQUEST_METHOD'] === 'POST') ) {    
  
  $doc   =(isset($_POST['doc']) ? $_POST['doc'] : NULL);    
  $check=false;    
/*
  echo "<br/>Diretório de execução do script....:" . __DIR__;
    echo "<br/>===============FILES(upload)==========";
  var_dump($_FILES);
  echo "                                           Done!<br/>";
  echo "<br/>===============POST===================";
  var_dump($_POST);
  echo "                                           Done!<br/>";
  echo "<br/>===============GET====================";
  var_dump($_GET);
  echo "                                           Done!<br/>";
*/  
  echo "<br/>===========Lista POST=================";
  $maiorRotulo = array_map(function ($item) {
    return strlen($item);
  }, array_keys($_POST));
  foreach ($_POST as $key => $value) {
    if (is_array($value)) {
      foreach ($value as $k => $v)
        echo "<br/>" . str_pad('Array[' . $k . '] ', max($maiorRotulo), ' ', STR_PAD_RIGHT) . " " . $v;
    } else {
      echo "<br/>" . str_pad($key, max($maiorRotulo), '=', STR_PAD_RIGHT) . ": " . $value;
    }
  }
  echo "<br/>----------------------------fim Lista POST --";    
$SQL = "SELECT cad.Id,cat.Id as IdCat,cat.nome as cat,cad.nome,cad.tipo,cad.doc,cad.dta_cadastro,cad.disable FROM 01cadastro cad "
      ."LEFT JOIN(01_categoria_fk fkc)ON(fkc.fk_cadastro=cad.Id)"
      ."LEFT JOIN(01_categoria cat)ON(cat.Id=fkc.fk_categoria)"
      ."WHERE doc='$doc'";
    $result = $conn->query($SQL) or die(mysqli_error($conn));
    if ($result) {
        // Get field information for all fields
        while ($row = $result->fetch_assoc()) {
          $cadastro['Id'      ] = $row["Id"];  
          $cadastro['cat'     ] = $row["cat"];      
          $cadastro['nome'    ] = $row["nome"];
          $cadastro['tipo'  ] = $row["tipo"];    
          $cadastro['doc'] = $row["doc"];        
          $cadastro['dta_cadastro'] = $row["dta_cadastro"];            
          $cadastro['disable' ] = $row["disable"];                
          $categoria[$row["IdCat"]]['categoria'] = $row["cat"];    
        }
    }
    
    if(isset($cadastro)){
        $retorno =1;
        $mensagem = "Doc já possui cadastro na plataforma atende!";  
        
    }else{
        $retorno =0;
        $mensagem = "Doc não cadastrado na plataforma atende!";  
    }
    
    echo "<br/>** Variáveis disponibilizadas para o front-end *******************"; 
    var_dump($_LISTA);
    echo "<br/>-- categoria -----------------------------------------------------"; 
    var_dump($categoria);
    echo "<br/>-- cadastro ------------------------------------------------------"; 
    var_dump( (isset($cadastro) ? $cadastro : array() ) );
    echo "<br/>-- retorno ------------------------------------------------------"; 
    echo "<br/>Request retorno: ".$retorno;
    echo "<br/>Request mensagem: ".$mensagem;
    echo "<br/>***************************************************************************** fim REQUEST!"; 
}
$conn->close();  
?>   
<!--
<form method="post" action="<?= $page_source ?>" >   
    <label for="doc" class="form-label">Doc:</label>
    <input id="doc" name='doc' type="text"  value=''>
    <button type="submit">Enviar</button>
</form>
-->