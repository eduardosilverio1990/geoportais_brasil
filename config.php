<?php
  session_start();
  
  //require 'vendor/autoload.php';

  //$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  //$dotenv->load();

  return [
      'host' => $HOST,
	  'porta' => $PORTA,
	  'banco' => $BANCO,
	  'usuario' => $USUARIO,
	  'senha' => $SENHA,
	  'recaptcha' => $RECAPTCHA
  ]; 
?>
