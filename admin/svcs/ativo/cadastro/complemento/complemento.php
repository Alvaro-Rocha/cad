<?php 
//$scriptName = explode('.', basename($_SERVER['SCRIPT_NAME']));
//include_once($scriptName[0] . '.sql.php');
$name = (isset($_POST['nome']) ? $_POST['nome'] : NULL);
$doc = (isset($_POST['doc']) ? $_POST['doc'] : NULL);
$ind = (isset($_POST['indicador']) ? $_POST['indicador'] : 0);

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

        .pad {
            padding:10px;
        }

        .azul {
            color:#0000CD;
        }

        .rosa{
            color:#FF00FF;
        }
    </style>
    
</head>

<body>
<div class="container">    
    <nav class="navbar  navbar-default" style="padding:10px">
        <div class="row">
            <img src="img/cadastro.png" class="col-2" alt="" width="64">
            <span class="h3 text-primary text-start col-6">
                Complemento Cadastral<br /><small class="text-info">Atende</small>
            </span>
        </div>    
    </nav>

    <div class="pad border border-dark rounded">
        <div class="row">
            <label class="col-6 text-success form-label" for="nome">Nome</label>
            <label class="col-6 text-success form-label" for="doc">Cpf</label>
        </div>    
        <div class="row">
            <div class="col-6" id="nome"><?= $name ?></div>
            <div class="col-6" id="doc"><?= $doc ?></div>
        </div>
    </div>    
    <input type="number" class="form-control" id="indica" value="<?= $ind ?>">
    <nav>
        <div class="nav nav-tabs mt-4" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Pessoal</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Endereço</button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contatos</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <form method="POST" action="">
                <div class="row">
                    <div class="col-6 col-md-8">
                        <p class="mt-5">Sexo: &nbsp;<i class="fa fa-3x fa-male" aria-hidden="true"></i> &nbsp; &nbsp;<i class="fa fa-3x fa-female" aria-hidden="true"></i></p>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Naturalidade" aria-label="naturalidade" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary naturalidade" type="button" id="button-addon2"><i class="fa fa-picture-o" aria-hidden="true"></i></button>
                        </div>
                        <div class="mb-3">
                            <label for="nomeMae" class="form-label">Nome da Mãe</label>
                            <input type="text" class="form-control" id="nomeMae">
                        </div>
                        <div class="mb-3">
                            <label for="dNascimento" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="dNascimento">
                        </div>        
                        <div class="mb-3">
                            <label for="nacionalidade" class="form-label">Nacionalidade</label>
                            <input type="text" class="form-control" id="Ex: Brasileiro">
                        </div>
                        <div class="mb-3">
                            <label for="profissao" class="form-label">Profissão</label>
                            <input type="text" class="form-control" id="profissao">
                        </div>
                    </div>
                    <div class="col-6 col-md-4 mt-4">
                        <div class="input-group mb-3 mt-3">
                            <input type="text" class="form-control" placeholder="RG" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary RG" type="button" id="button-addon2"><i class="fa fa-picture-o" aria-hidden="true"></i></button>
                        </div>
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary dExpedicao" type="button" id="button-addon2"><i class="fa fa-picture-o" aria-hidden="true"></i></button>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="UF expedidor" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary UF" type="button" id="button-addon2"><i class="fa fa-picture-o" aria-hidden="true"></i></button>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Orgão expedidor" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary Org" type="button" id="button-addon2"><i class="fa fa-picture-o" aria-hidden="true"></i></button>
                        </div>            
                        <div class="sep">    
                            <p>Pispasep: <input type="text" class="form-control" id="pispasep"></p>
                            <div class="mb-3">
                                <label for="eCivil" class="form-label">Estado cívil</label>
                                <input type="text" class="form-control" id="eCivil">
                            </div>        
                            <div class="mb-3">
                                <label for="tEleitor" class="form-label">Titulo de Eleitor</label>
                                <input type="text" class="form-control" id="tEleitor">
                            </div>
                            <div class="mb-3">
                                <label for="cMilitar" class="form-label">Certificado Militar</label>
                                <input type="text" class="form-control" id="cMilitar">
                            </div>
                        </div>   
                    </div>
                </div>
                <!--===============================================================================================================-->
                <div class="juridico d-none">
                    <div class="mb-3">
                        <label for="fantasia" class="form-label">Fantasia</label>
                        <input type="text" class="form-control" id="fantasia">
                    </div>
                    <div class="row">
                        <div class="col-6">

                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="iEstadual" class="form-label">Inscrição Estadual</label>
                                <input type="text" class="form-control" id="iEstadual">
                            </div>
                            <div class="mb-3">
                                <label for="iMunicipal" class="form-label">Inscrição Municipal</label>
                                <input type="text" class="form-control" id="iMunicipal">
                            </div>
                        </div>    
                    </div> 
                </div>
                <div class="d-flex justify-content-end  ">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>   
            </form>        
        </div>
        <!-- =================================================================================================================================== -->
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <form method="POST" action="">     
                <div class="input-group mb-5 mt-4">
                    <input type="number" class="form-control" placeholder="Digite seu CEP" aria-label="Digite seu CEP">
                    <button class="btn btn-outline-secondary" type="button" id="botao"><i class="fa fa-1.5x fa-search" aria-hidden="true"></i></button>
                </div>
                <div class="row">
                    <div class="col-4">
                        <select class="form-select">
                            <option selected>Estado</option>
                            <option value="Acre">AC</option>
                            <option value="Alagoas">AL</option>
                            <option value="Amapá">AP</option>
                            <option value="Amazonas">AM</option>
                            <option value="Bahia">BA</option>
                            <option value="Ceará">CE</option>
                            <option value="Distrito Federal">DF</option>
                            <option value="Espirito Santo">ES</option>
                            <option value="Goiás">GO</option>
                            <option value="Maranhão">MA</option>
                            <option value="Mato Grosso">MT</option>
                            <option value="Mato Grosso do Sul">MS</option>
                            <option value="Minas Gerais">MG</option>
                            <option value="Pará">PA</option>
                            <option value="Paraíba">PB</option>
                            <option value="Paraná">PR</option>
                            <option value="Pernambuco">PE</option>
                            <option value="Piauí">PI</option>
                            <option value="Rio de Janeiro">RJ</option>
                            <option value="Rio Grande do Norte">RN</option>
                            <option value="Rio Grande do Sul">RS</option>
                            <option value="Rondônia">RO</option>
                            <option value="Roraima">RR</option>
                            <option value="Santa Catarina">SC</option>
                            <option value="São Paulo">SP</option>
                            <option value="Sergipe">SE</option>
                            <option value="Tocantins">TO</option>
                        </select>
                    </div>
                    <div class="mb-3 col-8">
                        <input type="text" class="form-control" id="cidade" placeholder="Cidade">
                    </div>
                </div> 
                
                <div class="row">
                    <div class="mb-3 col-6">
                        <input type="text" class="form-control" id="rua" placeholder="Rua, casa/apartamento">
                    </div>
                    <div class="mb-3 col-3">
                        <input type="number" class="form-control" id="numero" placeholder="Número">
                    </div>
                    <div class="mb-3 col-3">
                        <input type="number" class="form-control" id="complemento" placeholder="Complemento">
                    </div>
                </div>

                <div class="mb-3 col-md-4 col-6">
                    <input type="text" class="form-control" id="ref" placeholder="referência">
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>        
        </div>
        <!-- =========================================================================================================== -->
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <form method="POST" action="">
                <div class="row mt-4">
                    <div class="col-4">
                        <select id="selec" class="form-select">
                            <option selected>tipo</option>
                            <option id="email" value="email">e-mail</option>
                            <option id="face" value="facebook">Facebook</option>
                            <option id="insta" value="insta">Instagram</option>
                            <option id="celular" value="celular">Telefone Celular</option>
                            <option id="comercial" value="comercial">Telefone Comercial</option>
                            <option id="fixo" value="fixo">Telefone Fixo</option>
                            <option id="whats" value="whats">Whatszapp</option>
                        </select>
                    </div>
                    <div class="col-8">
                        <div class="mb-3">
                            <label for="especif" class="form-label">Especificações</label>
                            <input type="text" class="form-control" id="especif" placeholder="">
                        </div>
                    </div>        
                </div>
                <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>        
        </div>
    </div>
</div>    
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
          <div></div>
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

    <?php include_once('js/complemento_js.php'); ?>

    <!-- ================================================================= -->        
</body>	
</html>