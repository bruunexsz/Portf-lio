<?php
if(file_exists('Inc/Init.php')){ require_once 'Inc/Init.php'; }else{ die(''); }
if(file_exists('Inc/Config.php')){ require_once 'Inc/Config.php'; }else{ die(''); }
if(file_exists('Inc/Seguranca.php')){ require_once 'Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('Inc/Funcoes.php')){ require_once 'Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

	$SelectTema = "SELECT configuracao.ID,
				configuracao.TemaPainel
			FROM ".BANCO.".configuracao
			WHERE configuracao.ID = '1'
			LIMIT 1";
	$ResultadoTema = mysql_query($SelectTema) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($ResultadoTema)){			
		$BuscaMostrarConfiguracao[$nCount]["ID"        ] = trim($row[0]);
		$BuscaMostrarConfiguracao[$nCount]["TemaPainel"] = trim($row[1]);
	$nCount++;
	}
	mysql_Free_Result($ResultadoTema);	
	
	if($BuscaMostrarConfiguracao[1]["TemaPainel"] != $CampoTemaPainel){

		$SQLAtualizarTema = sprintf("UPDATE ".BANCO.".configuracao 
			  SET configuracao.TemaPainel = '%s'
			  WHERE configuracao.ID = '1'",
			  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoTemaPainel)))
			  );
		$ResultadoAtualizarTema = mysql_query($SQLAtualizarTema) or die (mysql_error());
	}	
		echo "<script>location.href='Principal.php';</script>";
		header("Content-Length: 0");
		exit(0);
	
	mysql_Close($ConexaoBanco);
?>