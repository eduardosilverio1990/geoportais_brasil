<?php    
  $config = require 'config.php';
  
  $conexao = pg_connect("host=" . $config['host'] . " port=" . $config['porta'] . " dbname=" . $config['banco'] . " user=" . $config['usuario'] . " password=" . $config['senha']);
    
  $consulta_estado = pg_query($conexao, "SELECT unaccent(nm_municip) FROM public.municipios where left(municipios.cd_geocmu, 2)::int = (select siglas.geocodigo from siglas where sigla = '" . $_POST["estado"] . "') order by unaccent(nm_municip)");
  
  for($i=0; $i < pg_num_rows($consulta_estado); $i++) {
     $vetor_lista_estado[$i] = pg_fetch_row($consulta_estado, $i);
  } 
  
  echo json_encode($vetor_lista_estado);
?>