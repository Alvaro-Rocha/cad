<?php 
    ob_start();
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Brazil/East");
    // dados de conexão no MySQL
    $server = "abspmc.com";
    $user = "abspmcco_pauloro";
    $pw = "motheR@55";
    $dbname = "abspmcco_abspmc";        
    
    $conn = new mysqli($server,$user,$pw,$dbname);
    if($conn->connect_errno){
        echo "Failed to connect to MySQL: " . $conn->connect_error;
        exit();
    }
    $_LISTA = array('financeiro'=>'array',"mensagem"=>"string(255)");
    $conn->set_charset("utf8");
    $SQL = "SELECT fin.Id,fin.agencia, fin.objetivo, cat.nome as categoria,usr.usr_apelido as proprietario,ger.nome as gerentes, opr.nome as operadores FROM 50financeiro as fin "
          ."LEFT JOIN (01_categoria as cat)ON(fin.fk_cadastro_categoria=cat.Id)"
          ."LEFT JOIN (06user as usr)ON(fin.fk_user_master=usr.usr_Id)"
          ."LEFT JOIN (06_grupo as ger)ON(fin.fk_grupo_gerentes=ger.Id)"
          ."LEFT JOIN (06_grupo as opr)ON(fin.fk_grupo_operadores=opr.Id)";
    $result = $conn->query($SQL) or die(mysqli_error($conn));
    if ($result) {
        $alturaCat = $result -> num_rows > 10 ?  10 : $result -> num_rows;
        // Get field information for all fields
        while ($row = $result->fetch_assoc()) {
          $financeiro[$row["Id"]]['agencia'] = $row["agencia"];
          $financeiro[$row["Id"]]['objetivo'] = $row["objetivo"];    
          $financeiro[$row["Id"]]['categoria'] = $row["categoria"];    
          $financeiro[$row["Id"]]['proprietario'] = $row["categoria"];        
          $financeiro[$row["Id"]]['gerentes'] = $row["gerentes"];            
          $financeiro[$row["Id"]]['operadores'] = $row["operadores"];                
        }
    }
    //$mensagem = "";
$conn->close();       
if(($_SERVER['REQUEST_METHOD'] === 'POST') ) {    
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
  echo "<br/>===========Lista POST=================";
  $maiorRotulo = array_map(function ($item) {
    return strlen($item);
  }, array_keys($_POST));
  foreach ($_POST as $key => $value) {
    if (is_array($value)) {
      foreach ($value as $k => $v)
        echo "<br/>" . str_pad('Array[' . $k . '] ', max($maiorRotulo), ' ', STR_PAD_RIGHT) . " " . $v;
    } else {
      echo "<br/>" . str_pad($key, max($maiorRotulo), '=', STR_PAD_RIGHT) . "> " . $value;
    }
  }

}

?>