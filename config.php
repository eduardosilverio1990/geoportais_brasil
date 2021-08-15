<?php
  session_start();
  
  //require 'vendor/autoload.php';

  //$dotenv = Dotenv\Dotenv::createImmutable('/var/www/html/');
  //$dotenv->load();

  return [
          'host' => getenv("HOST"),
	  'porta' => getenv("PORTA"),
	  'banco' => getenv("BANCO"),
	  'usuario' => getenv("USUARIO"),
	  'senha' => getenv("SENHA"),
	  'recaptcha' => getenv("RECAPTCHA")
  ]; 
?>
