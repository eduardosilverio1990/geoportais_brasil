<?php		
  $config = require 'config.php';
  
  $conexao = pg_connect("host=" . $config['host'] . " port=" . $config['porta'] . " dbname=" . $config['banco'] . " user=" . $config['usuario'] . " password=" . $config['senha']);
    
  //Buscar dados dos pontos (nome municipio, link, ultima edicao, coordenadas)  
  $resultado_coordenadas = pg_query ($conexao , "select municipios.nm_municip, urls.url, urls.latitude, urls.longitude from urls, municipios where urls.cd_geocmu = municipios.cd_geocmu");
  
  $vetor_coordenadas = [];
  for($i=0; $i<pg_num_rows($resultado_coordenadas); $i++){  
	$vetor_coordenadas[$i] = pg_fetch_row($resultado_coordenadas, $i);
  } 
  
  echo json_encode($vetor_coordenadas);
?>