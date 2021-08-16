<?php
  session_start();
  
  //require 'vendor/autoload.php';

  //$dotenv = Dotenv\Dotenv::createImmutable('/var/www/html/');
  //$dotenv->load();

  return [
          'host' => getenv("HOST"),
	  'porta' => getenv("PORTA"),
	  'banco' => getenv("BANCO"),
	  'usuario' => getenv("POSTGRES_USER"),
	  'senha' => getenv("POSTGRES_PASSWORD"),
	  'recaptcha' => getenv("RECAPTCHA")
  ]; 
?>
