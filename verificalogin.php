<?php  
  $config = require 'config.php';
  
  $conexao = pg_connect("host=" . $config['host'] . " port=" . $config['porta'] . " dbname=" . $config['banco'] . " user=" . $config['usuario'] . " password=" . $config['senha']);
  
  $resultado_busca = pg_query ($conexao , "SELECT * FROM senhas WHERE login='" . md5($_POST["logindigitado"]) . "' AND senha='" . md5($_POST["senhadigitada"]) . "'");
  $vetor_confirmacao = pg_fetch_row($resultado_busca);
  
  if($vetor_confirmacao[0]) {    
	$_SESSION["logindigitado"] = $_POST["logindigitado"];
    $_SESSION["senhadigitada"] = $_POST["senhadigitada"]; 
	header("Location: index2.php");
  } else {    
	header("Location: index.php");
  }  
?>