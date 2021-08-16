<?php
  if($_POST["g-recaptcha-response"] && $_POST["nomecompletocriado"] && $_POST["cargocriado"] && $_POST["instituicaocriada"] && $_POST["logincriado"] && $_POST["senhacriada"] && $_POST["confirmacaosenhacriada"] && $_POST["emailcriado"] && $_POST["confirmacaoemailcriado"]){
    $config = require 'config.php';
  
    $conexao = pg_connect("host=" . $config['host'] . " port=" . $config['porta'] . " dbname=" . $config['banco'] . " user=" . $config['usuario'] . " password=" . $config['senha']);
	
    $resultado_pessoas = pg_query ($conexao, "SELECT * FROM pessoas WHERE email='" . md5($_POST["emailcriado"]) . "'");
    $vetor_pessoas = pg_fetch_row($resultado_pessoas);
    
    $resultado_senhas = pg_query ($conexao, "SELECT * FROM senhas WHERE login='" . md5($_POST["logincriado"]) . "'");
    $vetor_senhas = pg_fetch_row($resultado_senhas);
	
    if(!$vetor_pessoas[0] && !$vetor_senhas[0]) {
	  if($_POST["senhacriada"] == $_POST["confirmacaosenhacriada"]) {	
	    if($_POST["emailcriado"] == $_POST["confirmacaoemailcriado"]) {
	      //Create user
	      pg_query ($conexao, "INSERT INTO pessoas(nome, cargo, instituicao, email) VALUES ('" . $_POST["nomecompletocriado"] . "', '" . $_POST["cargocriado"] . "', '" . $_POST["instituicaocriada"] . "', '" . md5($_POST["emailcriado"]) . "');");
	    
	      //Create password
	      $resultado_idpessoa = pg_query($conexao, "SELECT id_pessoa FROM pessoas WHERE email='" . md5($_POST["emailcriado"]) . "'");
	      $vetor_idpessoa = pg_fetch_row($resultado_idpessoa);
	      pg_query($conexao, "INSERT INTO senhas(id_pessoa, login, senha) VALUES (MD5(text(" . $vetor_idpessoa[0] . ")), '" . md5($_POST["logincriado"]) . "', '" . md5($_POST["senhacriada"]) . "');");
		
	      echo("Cadastro realizado com sucesso!");
	    } else {
	      echo("Emails informados devem ser iguais!");
	    }
	  } else {
	      echo("Senhas informadas devem ser iguais!");
	  }	
    } else {
	  echo("Email ou login já cadastrado! Tente novamente com dados diferentes.");
    }
    } else {
	  header("Location: index.php");	
    }  
?>
