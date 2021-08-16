<?php
  session_start(); 

  return [
          'host' => getenv("POSTGRES_HOST"),
	  'porta' => getenv("POSTGRES_PORT"),
	  'banco' => getenv("POSTGRES_DATABASE"),
	  'usuario' => getenv("POSTGRES_USER"),
	  'senha' => getenv("POSTGRES_PASSWORD"),
	  'recaptcha' => getenv("RECAPTCHA")
  ]; 
?>
