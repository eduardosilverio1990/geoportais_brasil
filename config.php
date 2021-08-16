<?php
  session_start(); 

  return [
          'host' => $_ENV["HOST"],
	  'porta' => $_ENV["PORTA"],
	  'banco' => $_ENV["BANCO"],
	  'usuario' => $_ENV["USUARIO"],
	  'senha' => $_ENV["SENHA"],
	  'recaptcha' => $_ENV["RECAPTCHA"]
  ]; 
?>
