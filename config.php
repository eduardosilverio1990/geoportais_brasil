<?php
  session_start();
  
  //require 'vendor/autoload.php';

  //$dotenv = Dotenv\Dotenv::createImmutable('/var/www/html/');
  //$dotenv->load();

  return [
          'host' => getenv("POSTGRES_HOST"),
	  'porta' => getenv("POSTGRES_PORT"),
	  'banco' => getenv("POSTGRES_DATABASE"),
	  'usuario' => getenv("POSTGRES_USER"),
	  'senha' => getenv("POSTGRES_PASSWORD"),
	  'recaptcha' => getenv("RECAPTCHA")
  ]; 
?>
