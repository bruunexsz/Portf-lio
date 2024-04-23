<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$UrlAmigavel = GerarUrlAmigavel(utf8_decode($CampoTituloDoResultado));

$SqlEditarResultado = sprintf("UPDATE ".BANCO.".cadastroresultado
			SET cadastroresultado.TituloDoResultado        = '%s',							
				cadastroresultado.LocalDoResultado         = '%s',	
				cadastroresultado.DataDoResultado          = '%s',				
				cadastroresultado.TextoConteudoDoResultado = '%s',	
				cadastroresultado.IDGaleriaDeFotos         = '%d',	
				cadastroresultado.UrlAmigavel              = '%s'
		  WHERE cadastroresultado.ID = '%d'
		  ",
		FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoTituloDoResultado))),
		FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoLocalDoResultado))),
		mysql_real_escape_string(utf8_decode($CampoAnoDoResultado)."-".utf8_decode($CampoMesDoResultado)."-".utf8_decode($CampoDiaDoResultado)),
		mysql_real_escape_string(utf8_decode($CampoTextAreaBBCode)),
		FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoGaleriaDeFotosDoResultado))),
		mysql_real_escape_string(utf8_decode($UrlAmigavel)),
		FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoIdResultado)))
		);
$ResultadoEditarResultado = mysql_query($SqlEditarResultado) or die (mysql_error());

$MsgSucesso = utf8_encode("Atualização realizada com sucesso!");
echo "<script>alert('".$MsgSucesso."');</script>";
echo "<script>AlterarConteudo('Ferramentas/Resultados/ListarResultado.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>
