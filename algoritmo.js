window.onload = function() {  
 
	//Colocar cursor do mouse como ponteiro
	document.getElementById("meumapa").style.cursor = "pointer";
		
    //Mapa centrado no Brasil
	var map = L.map("meumapa", {
		center: [-15.0000, -51.0000],
		zoom: 4,
        maxZoom: 13,
        minZoom: 4
	});
    
	//Servidor
	var servidor = 'http://200.17.225.97/geoserver/wms';	
	
    //Camadas base		
    var osm = L.tileLayer("https://a.tile.openstreetmap.org/{z}/{x}/{y}.png ", {
		attribution: "© <a href='https://www.openstreetmap.org/copyright'>OpenStreetMap</a> contributors ",		
	}).addTo(map);
	
    //Camadas
	var estados = L.tileLayer.wms(servidor, {
      layers: 'estados',      
	  transparent: "true",
      format: "image/png"	  
    }).addTo(map);	
	
	var municipios = L.tileLayer.wms(servidor, {
      layers: 'municipios',
      transparent: "true",
      format: "image/png",      
      minZoom: 9	  
    }).addTo(map);
	
	var camadageojson = L.geoJSON().addTo(map);
	
	var markers = L.markerClusterGroup({
		showCoverageOnHover: true,
        zoomToBoundsOnClick: true,
		singleMarkerMode: false,
        maxClusterRadius: 30
	});
	
	function recarregaCamadas() {	  
	  $.ajax({
		  type: "POST",
          url:'recarregapontos.php',	
          dataType: 'JSON',
          success: function(resultado) {			  
			  markers.clearLayers();
	        for (var i = 0; i < resultado.length; i++) {	    
		        var marker = L.marker(new L.LatLng(resultado[i][2], resultado[i][3]));
		        marker.bindPopup(resultado[i][1]);
		        marker.bindTooltip(resultado[i][0]);
		        markers.addLayer(marker);
	        }
			markers.addTo(map);				  
		  }				
        });
    }
			
	recarregaCamadas();
		
    //Controle de Camadas
	var camadasBase = {	  	  
	  "OSM": osm
	}
			
	var camadasSobreposicao = {
	  "Estados": estados,
	  "Municipios": municipios,	  
	  "Geoportais": markers
	}
	
	var controleCamadas = new L.control.layers(camadasBase, camadasSobreposicao).addTo(map);
    
    //Mapa de Visao Geral
	var osmColorido2 = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png");	
	var mapaVisaoGeral = new L.Control.MiniMap(osmColorido2).addTo(map);
  
    //Coordenadas do mouse
	var coordenadasMouse = new L.control.mousePosition({
	  prefix: "Latitude: ",
	  separator: " Longitude: ",
	  numDigits: 4
	}).addTo(map);
  
    //Escala Gráfica
	var escalaGrafica = new L.control.scale({position: "bottomright"}).addTo(map);
    
	//Escala Numérica
	L.control.scalefactor({position: 'bottomleft'}).addTo(map);
		
	//Medicao
	var medicaoDistancias = new L.control.polylineMeasure().addTo(map);
	
	//Geocoder	
	L.Control.geocoder({geocoder: new L.Control.Geocoder.Nominatim()}).addTo(map);		
	
	//Incluir funcao de validacao no formulario	
	$("#formulario").submit(validacao);
	
	function validacao() {
	  if(document.getElementById("estado").value != '' && document.getElementById("municipio").value != '' && document.getElementById("validador").value != ''){		
		var retorno = false;
		
		var estado = $("#estado").val();
		var municipio = $("#municipio").val();
		var url = $("#url").val();
		var operacao = $("#validador").val();
		
		$.ajax({
		  type: "POST",
          url:'envia.php',
		  data: {estado: estado,
		         municipio: municipio,
				 url: url,
				 operacao: operacao},
          success: function() {			  
			  recarregaCamadas();
			  retorno = true;		  
		  }				
        });	
		
		return retorno;
	  } else {
	    return false;		
	  }
    }		
}
