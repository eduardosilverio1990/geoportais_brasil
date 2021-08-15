<?php        
	  $config = require 'config.php';
	  
	  $_SESSION["logindigitado"] = 'visualizadores';
      $_SESSION["senhadigitada"] = 'visualizadores';
	  
	  echo
		"	
		 	<!doctype html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name='description' content=''>
    <meta name='author' content='Mark Otto, Jacob Thornton, and Bootstrap contributors'>
    <meta name='generator' content='Jekyll v4.1.1'>
    <title>Mapa de Geoportais Brasileiros</title>
	<script type='text/javascript' src='jquery-3.3.1.min.js'></script>
	<script src='https://www.google.com/recaptcha/api.js' async defer></script>

    <link rel='canonical' href='https://getbootstrap.com/docs/4.5/examples/sign-in/'>

    <!-- Bootstrap core CSS -->
<link href='assets/dist/css/bootstrap.min.css' rel='stylesheet'>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href='signin.css' rel='stylesheet'>
  </head>
  <body class='text-center'>
  
  
	  
<form class='form-signin' action='verificalogin.php' method='post'>
  <img class='mb-4' src='ufpr.svg' alt='' width='150' height='100'>
  <img class='mb-4' src='cpgcg.svg' alt='' width='200' height='100'>
  <input type='text' id='loginentrar' name='logindigitado' class='form-control' placeholder='usuario' required autofocus onkeyup=formataloginentrar(this.value)>
  <input type='password' id='senhadigitada' name='senhadigitada' class='form-control' placeholder='senha' required>
  <br>
  <button class='btn btn-lg btn-primary btn-block' type='submit'>Entrar</button>  
  <a class='btn btn-lg btn-secondary btn-block' href='index2.php'>Acesso sem login</a>
</form>

<form class='form-signin' action='cadastrar.php' method='post'>
  <div class='row'>
    <div class='col'>
      <input name='nomecompletocriado' type='text' class='form-control' placeholder='Nome completo' required>
    </div>    
  </div>
  
  <br>
  
  <div class='row'>
    <div class='col'>
      <input name='cargocriado' type='text' class='form-control' placeholder='Cargo' required>
    </div>	
  </div>
  
  <br>
  
  <div class='row'>
    <div class='col'>
      <input name='instituicaocriada' type='text' class='form-control' placeholder='Instituição' required>
    </div>
       
  </div>
  
  <br>
  
  <div class='row'>
    <div class='col'>
      <input id='logincadastrar' name='logincriado' type='text' class='form-control' placeholder='usuario' required onkeyup=formatalogincadastrar(this.value)>
    </div> 
  </div>
  
  <br>
  
  <div class='row'>
  <div class='col'>
      <input name='senhacriada' type='password' class='form-control' placeholder='senha' required>
    </div>
	<div class='col'>
      <input name='confirmacaosenhacriada' type='password' class='form-control' placeholder='confirmar senha' required>
    </div>    	
  </div>
  
  <br>
  
  <div class='row'>
    <div class='col'>
      <input name='emailcriado' type='email' class='form-control' placeholder='email' required>
    </div>
    <div class='col'>
      <input name='confirmacaoemailcriado' type='email' class='form-control' placeholder='confirmar email' required>
    </div>
  </div>
  
  <br>
  <!-- recapctah localhost -->
  <div class='g-recaptcha' data-sitekey=" . $config['recaptcha'] . "></div>
  
  <br>  
  <button class='btn btn-lg btn-success btn-block' type='submit'>Cadastre-se</button>
</form>

  <script>
	  function formataloginentrar(loginentrar) {
		var loginentrarcorrigido = loginentrar.toLowerCase().replace(/[! @ ¹ ² ³ £ ¢ ¬ ¨ = § º ª & \/ \\ \[ \] # , + ( ) $ ~ % . ' ´ ` ç ^ | ; ° ' : * ? < > { } -]/g, '');
		$('#loginentrar').val(loginentrarcorrigido);
	  }
	  
	  function formatalogincadastrar(logincadastrar) {
		var logincadastrarcorrigido = logincadastrar.toLowerCase().replace(/[! @ ¹ ² ³ £ ¢ ¬ ¨ = § º ª & \/ \\ \[ \] # , + ( ) $ ~ % . ' ´ ` ç ^ | ; ° ' : * ? < > { } -]/g, '');
		$('#logincadastrar').val(logincadastrarcorrigido);
	  }
	  
  </script>
	
</body>
</html>
		";	  
?>


