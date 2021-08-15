<?php
  session_start();
  
  require 'vendor/autoload.php';

  $dotenv = Dotenv\Dotenv::createImmutable('/var/www/html/');
  $dotenv->load();

  return [
          'host' => $_SERVER['HOST'],
	  'porta' => $_SERVER['PORTA'],
	  'banco' => $_SERVER['BANCO'],
	  'usuario' => $_SERVER['USUARIO'],
	  'senha' => $_SERVER['SENHA'],
	  'recaptcha' => $_SERVER['RECAPTCHA']
  ]; 
?>
