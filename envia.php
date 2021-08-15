<?php   
  $config = require 'config.php';
  
  $conexao = pg_connect("host=" . $config['host'] . " port=" . $config['porta'] . " dbname=" . $config['banco'] . " user=" . $config['usuario'] . " password=" . $config['senha']);    
    
  if($_POST["estado"] && $_POST["municipio"] && $_POST["operacao"] == 'adicionar'){	
	//verifica se j? existe o URL para o municipio informado
	$resultado_urls = pg_query($conexao, "select urls.url from urls where urls.cd_geocmu = (select municipios.cd_geocmu from municipios where unaccent(nm_municip) = '" . $_POST["municipio"] . "' AND (select text(geocodigo) from siglas where siglas.sigla = '" . $_POST["estado"] . "') = left(cd_geocmu, 2)) AND urls.url = '" . $_POST["url"] . "'");
	$vetor_urls = pg_fetch_row($resultado_urls);
	
	if($vetor_urls[0]) {
	  //ja possui este URL	  
    } else {
      //insere o URL informado		
	  pg_query($conexao, "INSERT INTO urls (cd_geocmu, latitude, longitude, url)
        VALUES(
	      (select cd_geocmu from municipios where unaccent(nm_municip) = '" . $_POST["municipio"] . "' AND (select text(geocodigo) from siglas where siglas.sigla = '" . $_POST["estado"] . "') = left(cd_geocmu, 2)),
          (select st_y(st_pointonsurface(municipios.geom)) AS latitude from municipios where unaccent(nm_municip) = '" . $_POST["municipio"] . "' AND (select text(geocodigo) from siglas where siglas.sigla = '" . $_POST["estado"] . "') = left(cd_geocmu, 2)),
          (select st_x(st_pointonsurface(municipios.geom)) AS longitude from municipios where unaccent(nm_municip) = '" . $_POST["municipio"] . "' AND (select text(geocodigo) from siglas where siglas.sigla = '" . $_POST["estado"] . "') = left(cd_geocmu, 2)),
          '" . $_POST["url"] . "')");	  
    } 
  } elseif($_POST["estado"] && $_POST["municipio"] && $_POST["operacao"] == 'remover'){
		if($_POST["url"] <> ''){
			//apaga o url informado do municipio
		    pg_query($conexao, "delete from urls
              where (select text(municipios.cd_geocmu) from municipios where unaccent(municipios.nm_municip) = '" . $_POST["municipio"] . "') = urls.cd_geocmu AND
                    (select text(siglas.geocodigo) from siglas where siglas.sigla = '" . $_POST["estado"] . "') = left(urls.cd_geocmu, 2) AND
	                 urls.url = '" . $_POST["url"] . "'");
		}else{
			//apaga todos os urls do municipio
			pg_query($conexao, "delete from urls
              where (select text(municipios.cd_geocmu) from municipios where unaccent(municipios.nm_municip) = '" . $_POST["municipio"] . "') = urls.cd_geocmu AND
                    (select text(siglas.geocodigo) from siglas where siglas.sigla = '" . $_POST["estado"] . "') = left(urls.cd_geocmu, 2)");
			
		}	
		
	}  
?>