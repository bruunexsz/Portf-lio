<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }
$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

# DEFINIDO O TEMPO DE EXECUÇÃO DO SCRIPT PARA 7 HORAS
set_time_limit( ((60 * 60) * 7) );

$CampoEmails = rtrim($CampoEmails);
$CampoEmails = ltrim($CampoEmails);

if($CampoSeparador == ";"){
	$ArrayParaSeparar = explode(";", $CampoEmails);
}else if($CampoSeparador == ","){
	$ArrayParaSeparar = explode(",", $CampoEmails);
}else if($CampoSeparador == "|"){
	$ArrayParaSeparar = explode("|", $CampoEmails);
}

for($i = 0; $i < count($ArrayParaSeparar); $i++) {

	$ArrayParaSeparar[$i] = rtrim(FiltrarCampos($ArrayParaSeparar[$i]));
	$ArrayParaSeparar[$i] = ltrim(FiltrarCampos($ArrayParaSeparar[$i]));
	
    $TotalAExcluir = "OR usuarionewsletter.EmailsDosDestinatarios = '".$ArrayParaSeparar[$i]."'";
	$SqlUpdate = "UPDATE ".BANCO.".usuarionewsletter
				SET usuarionewsletter.AtivacaoDosDestinatarios = '0'							
			  	WHERE usuarionewsletter.EmailsDosDestinatarios = ''
			  ".$TotalAExcluir."";
	$ResultadoUpdate = mysql_query($SqlUpdate) or die (mysql_error());
}
	$MsgExclusaoSucesso = utf8_encode("Exclusão realizada com sucesso!");
	echo "<script>alert('".$MsgExclusaoSucesso."');</script>";			
	echo "<script>AlterarConteudo('Ferramentas/Informativos/ListarEmail.php','DivResultadosInternos','');</script>";
	mysql_Close($ConexaoBanco); ?>