<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

//error_reporting(0);

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$ArrayParaSeparar = explode($CampoSeparador, $CampoEmails);

for($i = 0; $i < count($ArrayParaSeparar); $i++) {
$EmailsParaInserir = $ArrayParaSeparar[$i];
$EmailsParaInserir = rtrim($EmailsParaInserir);
$EmailsParaInserir = ltrim($EmailsParaInserir);

if($CampoTipoDeCadastro == '0'){

	$ArrayParaSepararFinal = explode('/', $EmailsParaInserir);
	
	if (!isset($ArrayParaSepararFinal[1])) $ArrayParaSepararFinal[1] = '';
	if($ArrayParaSepararFinal[1] != ''){
		
		$NomesEmailsParaInserir = $ArrayParaSepararFinal[0];
		$NomesEmailsParaInserir = rtrim($NomesEmailsParaInserir);
		$NomesEmailsParaInserir = ltrim($NomesEmailsParaInserir);
		
		$EmailsParaInserir = $ArrayParaSepararFinal[1];
		$EmailsParaInserir = rtrim($EmailsParaInserir);
		$EmailsParaInserir = ltrim($EmailsParaInserir);

		$NomesEmailsParaInserirFinal = $NomesEmailsParaInserir;
		$ArrayParaSepararFinal[0] = '';
		$ArrayParaSepararFinal[1] = '';
	}
		
}else if($CampoTipoDeCadastro == '1'){
	$NomesEmailsParaInserirFinal = $EmailsParaInserir;
}

$SelectUsuariosNewsletter = sprintf("SELECT usuarionewsletter.ID,
	usuarionewsletter.AtivacaoDosDestinatarios,
	usuarionewsletter.EmailsDosDestinatarios
FROM ".BANCO.".usuarionewsletter
WHERE usuarionewsletter.EmailsDosDestinatarios = '%s'
AND usuarionewsletter.AtivacaoDosDestinatarios = 1
LIMIT 1",
mysql_real_escape_string(utf8_decode($EmailsParaInserir))
);
$ResultadoUsuariosNewsletter = mysql_query($SelectUsuariosNewsletter) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoUsuariosNewsletter)){
	$BuscaMostrarEmails[$nCount]["ID"                      ] = trim($row[0]);
	$BuscaMostrarEmails[$nCount]["AtivacaoDosDestinatarios"] = trim($row[1]);
	$BuscaMostrarEmails[$nCount]["EmailsDosDestinatarios"  ] = trim($row[2]);
$nCount++;
}
mysql_Free_Result($ResultadoUsuariosNewsletter);
	
if (!isset($BuscaMostrarEmails[1]["EmailsDosDestinatarios"])) $BuscaMostrarEmails[1]["EmailsDosDestinatarios"] = '';
if($BuscaMostrarEmails[1]["EmailsDosDestinatarios"] == ''){
	$CodigoDesativar01 = rand(1, 10000);
	$CodigoDesativar02 = rand(1, 10000);
	$CodigoDesativacaoFinal = "".$CodigoDesativar02."".strftime("%Y%m%d%H%M%S")."".$CodigoDesativar01;

	$SqlInsertUsuarios = sprintf("INSERT INTO usuarionewsletter (
			 ID,
			 AtivacaoDosDestinatarios,
			 CodigoDesativacaoDosDestinatarios,
			 NomesDosDestinatarios,
			 EmailsDosDestinatarios,
			 DataDeCadastroDosDestinatarios
			 )
			 VALUES(
			 '',
			 '1',
			 '%s',
			 '%s',
			 '%s',
			 '".strftime("%Y-%m-%d %H:%M:%S")."'
			 )",
			 FiltrarCampos(mysql_real_escape_string(utf8_decode($CodigoDesativacaoFinal))),
			 mysql_real_escape_string(utf8_decode($NomesEmailsParaInserirFinal)),
			 mysql_real_escape_string(utf8_decode($EmailsParaInserir))
			 );
	$ResultadoInsertUsuarios = mysql_query($SqlInsertUsuarios) or die (mysql_error());
$CodigoDesativacaoFinal = '';
}
	$BuscaMostrarEmails[1]["EmailsDosDestinatarios"] = '';
	$NomesEmailsParaInserirFinal = '';
	$EmailsParaInserir = '';
}

$ValidarEmails = "DELETE FROM ".BANCO.".usuarionewsletter
		  		  WHERE usuarionewsletter.EmailsDosDestinatarios NOT RLIKE '@' ";
$ResultadoValidarEmails = mysql_query($ValidarEmails) or die (mysql_error());

$ValidarEmails1 = "DELETE FROM ".BANCO.".usuarionewsletter
		  		  WHERE usuarionewsletter.EmailsDosDestinatarios RLIKE ' ' ";
$ResultadoValidarEmails1 = mysql_query($ValidarEmails1) or die (mysql_error());

$ValidarEmails2 = "DELETE FROM ".BANCO.".usuarionewsletter
		  		  WHERE usuarionewsletter.EmailsDosDestinatarios RLIKE '-@' ";
$ResultadoValidarEmails2 = mysql_query($ValidarEmails2) or die (mysql_error());

$ValidarEmails3 = "DELETE FROM ".BANCO.".usuarionewsletter
		  		  WHERE usuarionewsletter.EmailsDosDestinatarios RLIKE '\"' ";
$ResultadoValidarEmails3 = mysql_query($ValidarEmails3) or die (mysql_error());

$ValidarEmails4 = "DELETE FROM ".BANCO.".usuarionewsletter
		  		  WHERE usuarionewsletter.EmailsDosDestinatarios RLIKE '. ' ";
$ResultadoValidarEmails4 = mysql_query($ValidarEmails4) or die (mysql_error());

$Espaco = '\\r\\';
$ValidarEmails5 = "DELETE FROM ".BANCO.".usuarionewsletter
		  		  WHERE usuarionewsletter.EmailsDosDestinatarios RLIKE '.$Espaco.' ";
$ResultadoValidarEmails5 = mysql_query($ValidarEmails5) or die (mysql_error());

$ValidarEmails6 = "DELETE FROM ".BANCO.".usuarionewsletter
		  		  WHERE usuarionewsletter.EmailsDosDestinatarios RLIKE '@mail.orkut.com' ";
$ResultadoValidarEmails6 = mysql_query($ValidarEmails6) or die (mysql_error());

$ValidarEmails7 = "DELETE FROM ".BANCO.".usuarionewsletter
		  		  WHERE usuarionewsletter.NomesDosDestinatarios = ''";
$ResultadoValidarEmails7 = mysql_query($ValidarEmails7) or die (mysql_error());

$ValidarEmails8 = "DELETE FROM ".BANCO.".usuarionewsletter
		  		  WHERE usuarionewsletter.EmailsDosDestinatarios RLIKE '/' ";
$ResultadoValidarEmails8 = mysql_query($ValidarEmails8) or die (mysql_error());

$Msg = utf8_encode("E-mails cadastrados com sucesso!");
echo "<script>alert('".$Msg."');</script>";		
echo "<script>AlterarConteudo('Ferramentas/Informativos/ListarEmail.php','DivResultadosInternos','');</script>";
exit(0);
mysql_Close($ConexaoBanco); ?>