<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>

      <title>HOLODROIDE ADMIN</title>        

      <meta charset="utf-8">

      <!-- ===================== Mobile Specific ============================= -->
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

      <!-- ==================== BootStrap ====================== -->   
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>        
      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      
      <!-- Custom CSS -->
    <link href="css/holodroide.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" rel="stylesheet">
    
    <!-- Custom fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/ionicons.min.css" rel="stylesheet" type="text/css">
    <link href="css/animate.min.css" rel="stylesheet" type="text/css">

        <style type="text/css">

        #myBtn {
          display: none;
          position: fixed;
          bottom: 20px;
          right: 30px;
          z-index: 99;
          font-size: 18px;
          border: none;
          outline: none;
          background-color: red;
          color: white;
          cursor: pointer;
          padding: 15px;
          border-radius: 4px;
        }

        #myBtn:hover {
          background-color: #555;
        }

    </style>  

  </head>
  <body>
    <!-- Botão para voltar ao topo -->
    <button onclick="topFunction()" id="myBtn" title="Voltar para o topo">Top</button>    
    <div class="container" style="margin-bottom:10px;">
      <!-- Cabeçalho (logotipo, menu top horizontal e mensagem de boas vindas -->
      <div class="row">
        <div class="col-md-12" style="text-align:LEFT;margin:20px 0 0 0;">
          <h4><img src="../images/logo_holodroide_sistema.png" width="200" alt=""/> | ADMIN SISTEMA</h4><br>
        </div>
      </div>

      <!-- Menu topo horizontal Início -->
      <div class="row">
        <div class="col-md-12" style="text-align:left;margin:0 0 10px 0;">
          <div style="margin:0 auto;text-align:center;border:1px;max-width:800px;display: inline">
            <div style="display: inline">
              <a href="index.php" class="btn btn-success" role="button">INICIAL</a>           
            </div>
            <div class="dropdown" style="display: inline">
          		<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                ADMINISTRADORES
                <span class="caret"></span>
  		        </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                  <li><a href="adm-painel.php">LISTAR</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="adm-add-form.php" style="color:#0000ff;">CADASTRAR</a></li>
                </ul>
						</div>
            <div class="dropdown" style="display: inline">
          		<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                CLIENTES
                <span class="caret"></span>
            	</button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <li><a href="cli-painel.php">LISTAR</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="cli-add-form.php" style="color:#0000ff;">CADASTRAR</a></li>  
              </ul>
						</div>
          <div class="dropdown" style="display: inline">
        		<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              USUÁRIOS
              <span class="caret"></span>
          	</button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
              <li><a href="usr-painel.php">LISTAR</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="usr-add-form.php" style="color:#0000ff;">CADASTRAR</a></li>
            </ul>
					</div>
          <div style="display: inline">
            <a href="adm-logout.php" class="btn btn-danger" role="button" aria-pressed="true">LOGOUT</a>    
          </div>
        </div>
      </div>  
    </div>
  </div><!-- container -->            
  <!-- Menu topo horizontal Fim -->