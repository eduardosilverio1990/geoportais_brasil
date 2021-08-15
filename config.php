<?php
  session_start();
  
  //require 'vendor/autoload.php';

  //$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  //$dotenv->load();

  return [
      'host' => $_ENV['HOST'],
	  'porta' => $_ENV['PORTA'],
	  'banco' => $_ENV['BANCO'],
	  'usuario' => $_ENV['USUARIO'],
	  'senha' => $_ENV['SENHA'],
	  'recaptcha' => $_ENV['RECAPTCHA']
  ]; 
?>
