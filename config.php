<?php
  session_start(); 

  return [
          'host' => $_ENV["POSTGRES_HOST"],
	  'porta' => $_ENV["POSTGRES_PORT"],
	  'banco' => $_ENV["POSTGRES_DATABASE"],
	  'usuario' => $_ENV["POSTGRES_USER"],
	  'senha' => $_ENV["POSTGRES_PASSWORD"],
	  'recaptcha' => $_ENV["RECAPTCHA_SITEKEY"],
	  'servidor_mapa' => $_ENV['GEOSERVER_URL']
  ]; 
?>
