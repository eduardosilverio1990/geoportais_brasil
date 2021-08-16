<?php
  session_start(); 

  return [
          'host' => $_SERVER["HOST"],
	  'porta' => $_SERVER["PORTA"],
	  'banco' => $_SERVER["BANCO"],
	  'usuario' => $_SERVER["USUARIO"],
	  'senha' => $_SERVER["SENHA"],
	  'recaptcha' => $_SERVER["RECAPTCHA"]
  ]; 
?>
