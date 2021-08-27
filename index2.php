<?php
      $config = require 'config.php';
      echo "<script> var servidor = '" . $config['servidor_mapa'] . "'</script>";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
	<title>Geoportais</title>	
	<link type="text/css" rel="stylesheet" href="estilo.css" />
	<script src="algoritmo.js" ></script>	
	<link type="text/css" rel="stylesheet" href="Plugins/Leaflet/leaflet.css" />
	<script src="Plugins/Leaflet/leaflet.js" ></script>
	<link type="text/css" rel="stylesheet" href="Plugins/Mapa Visao Geral/dist/Control.MiniMap.min.css" />
	<script src="Plugins/Mapa Visao Geral/dist/Control.MiniMap.min.js" ></script>
	<link type="text/css" rel="stylesheet" href="Plugins/Coordenadas do Mouse/src/L.Control.MousePosition.css" />
	<script src="Plugins/Coordenadas do Mouse/src/L.Control.MousePosition.js" ></script>
	<script type="text/javascript" src="jquery-3.3.1.min.js"></script>	
    <script src="Plugins/Medicao/Leaflet.PolylineMeasure.js" ></script>    
	<link rel="stylesheet" href="Plugins/Geocoder/dist/Control.Geocoder.css" />
    <script src="Plugins/Geocoder/dist/Control.Geocoder.js"></script>	
	
	<link rel="stylesheet" href="Plugins/Leaflet.markercluster-1.4.1/dist/MarkerCluster.css" />
	<link rel="stylesheet" href="Plugins/Leaflet.markercluster-1.4.1/dist/MarkerCluster.Default.css" />
    <script src="Plugins/Leaflet.markercluster-1.4.1/dist/leaflet.markercluster-src.js"></script>
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/checkout/">
	<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
	 <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
	<link href="form-validation.css" rel="stylesheet">
	</head>
  <body class="bg-light">
    <!-- Plugin da Escala Numerica -->
    <link type="text/css" rel="stylesheet" href="Plugins/Escala/leaflet.scalefactor.css" />
	<script src="Plugins/Escala/leaflet.scalefactor.min.js" ></script>
    <!-- Mapa -->
    <div id="meumapa"></div>	
	
	<?php      
	  if(!$_SESSION['logindigitado'] || !$_SESSION["senhadigitada"]) {
	    header("Location: index.php");
	  }
	  
	  echo "<script> var login = '" . $_SESSION['logindigitado'] . "'</script>";
	  echo "<script> var senha = '" . $_SESSION['senhadigitada'] . "'</script>";
	  
	  if($_SESSION["logindigitado"] <> 'visualizadores'){
	    
		echo
		"
		<div class='container'>	
		<br>
	    <div class='row'>
          <div class='col-2'>Estado:</div>
          <div class='col-3'>Município:</div>
          <div class='col-3'>URL:</div>
          <div class='col-1'></div>
		  <div class='col-1'></div>
		  <div class='col-1'></div>
        </div>
		<form id='formulario' method='post' target='_blank'>
		<div class='row'>
          <div class='col-2'>                   
			        <select class='custom-select d-block w-100' id='estado' name='estado' onchange='lista_municipios()' required>
                    <option></option>
                    <option>AC</option>
					<option>AL</option>
					<option>AM</option>
					<option>AP</option>					
					<option>BA</option>					
					<option>CE</option>					
					<option>DF</option>					
					<option>ES</option>					
					<option>GO</option>
					<option>MA</option>
					<option>MG</option>
					<option>MS</option>
					<option>MT</option>					
					<option>PA</option>
					<option>PB</option>
					<option>PE</option>
					<option>PI</option>
					<option>PR</option>					
					<option>RJ</option>
					<option>RN</option>
					<option>RO</option>
					<option>RR</option>
					<option>RS</option>					
					<option>SC</option>
					<option>SE</option>
					<option>SP</option>					
					<option>TO</option>
                    </select>				  
		  </div>
          <div class='col-3'>	
            <select class='custom-select d-block w-100' id='municipio' name='municipio' required>			
			</select>         
          </div>
          <div class='col-3'>
		    <input class='form-control' type='url' id='url' name='url' placeholder='Ex: https://www.ufpr.br'></input>
		  </div>		 
		  <div class='col-1'>
		    <input class='btn btn-secondary' type='button' Value='X' onclick='limpar()'></input>
		  </div>
          <div class='col-1'>
		    <input class='btn btn-success' type='submit' value='Enviar' onclick='validar()'></input>
		  </div>	  
		  <div class='col-1'>
		    <input class='btn btn-danger' type='submit' Value='Remover' onclick='remover()'></input>
		  </div>		  
        </div>	
        <input class='form-control' id='validador' name='validador' hidden></input>
		</form>
	    </div>	
		";		
	  }	
	?>
		
    <script>      
	  function validar() {	   
        var url = document.getElementById("url").value;
        var pattern = /^(ftp|http|https):\/\/[^ "]+$/;
		
        if (pattern.test(url)) {		  
            $("#validador").val('adicionar');
			alert("URL enviada! Em alguns instantes o mapa será atualizado!");
            return true;
        } else{
            $("#validador").val('');
			alert("URL inválido!");						
            return false;
		}		
    }
	
	function limpar(){	    
	    $("#estado").val('');
		$("#municipio").val('');
		$("#url").val('');
        $("#validador").val('')
        $("#municipio").children().remove();
        $("#municipio").append("<option></option>");		
	}
	
	function lista_municipios(){	    
	   $.ajax({
		  type: "POST",
          url:'listar_municipios.php',
		  data: {estado: $("#estado").val()},
          success: function(lista_do_estado) {			  
		            
		  $("#municipio").children().remove();		
          $("#municipio").append("<option></option>");	  
		  for (var i=0; i<JSON.parse(lista_do_estado).length; i++){
			$("#municipio").append("<option>" + JSON.parse(lista_do_estado)[i] + "</option>");	  
		  }		  
		  
		  }				
        });	  
	}
	
	function remover(){
        if($('#estado').val() && $('#municipio').val())
		{
			 if($("#url").val() != ''){
				if(confirm("Tem certeza de que deseja remover a URL informada?")){
		    		$("#validador").val('remover');
			        alert("Em alguns instantes o mapa será atualizado!");
		        }else{
		            $("#validador").val('');
		        }				
			}else{
				if(confirm("Tem certeza de que deseja remover TODAS as URLs do município informado?")){
		    		$("#validador").val('remover');
			        alert("Em alguns instantes o mapa será atualizado!");
		        }else{
		            $("#validador").val('');
		        }				
			}			          
		}
	}
    </script>	
  </body>
</html>
