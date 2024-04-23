<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$SQLVerifica= sprintf("SELECT cadastrousuariofiliado.LoginUsuario,
	cadastrousuariofiliado.AtivacaoUsuario
	FROM ".BANCO.".cadastrousuariofiliado
	WHERE cadastrousuariofiliado.LoginUsuario = '%s'
	AND cadastrousuariofiliado.LoginUsuario != '%s'
	AND cadastrousuariofiliado.AtivacaoUsuario = '1'",
	FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoLoginEditarFiliados))),
	FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoLoginInicialEditarFiliados)))
	);
$RSVerifica = mysql_query($SQLVerifica);
	$nCount=1;
	while ($row = mysql_fetch_array($RSVerifica)){
	$VerificarSeFiliadoExiste[$nCount]["LoginFiliado"] = trim($row[0]);
	$nCount++;
}
$RSVerifica = mysql_query($SQLVerifica) or die (mysql_error());
mysql_Free_Result($RSVerifica);

if (!isset($VerificarSeFiliadoExiste[1]["LoginFiliado"])) $VerificarSeFiliadoExiste[1]["LoginFiliado"] = '';
			
 if(utf8_encode($CampoLoginEditarFiliados) == utf8_encode($VerificarSeFiliadoExiste[1]["LoginFiliado"])){
 $MsgEmailJaExiste = utf8_encode("Desculpe, mas já existe um filiado cadastrado com este usuário no sistema, por favor tente novamente com outro usuário!");
 echo "<script>alert('".$MsgEmailJaExiste."');</script>";
 #echo utf8_encode($CampoEmailInicialEditarUsuarios);
 echo "<script>AlterarConteudo('Ferramentas/AreaDoFiliado/Filiados/EditarFiliado.php','DivResultadosInternos','IDFiliado=$CampoIDEditarFiliados');</script>";
 }else{

	
	$SqlAtualiza = sprintf("UPDATE ".BANCO.".cadastrousuariofiliado
				SET cadastrousuariofiliado.LoginUsuario  = '%s',
					cadastrousuariofiliado.SenhaUsuario  = '%s',
					cadastrousuariofiliado.EmailUsuario  = '%s',
					cadastrousuariofiliado.NomeUsuario	 = '%s'
			  WHERE cadastrousuariofiliado.ID = '%d'",
		FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoLoginEditarFiliados))),
		FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoNovaSenhaEditarFiliados))),
		FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoEmailEditarFiliados))),
		FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoNomeEditarFiliados))),
		FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoIDEditarFiliados)))
		);

	#echo $cSQL;
	$ResultadoAtualiza = mysql_query($SqlAtualiza) or die (mysql_error());
	$MsgSucesso = utf8_encode("Atualização realizada com sucesso!");
	echo "<script>alert('".$MsgSucesso."');</script>";
	echo "<script>AlterarConteudo('Ferramentas/AreaDoFiliado/Filiados/ListarFiliado.php','DivResultadosInternos','');</script>";								
	
	}
	mysql_Close($ConexaoBanco);
?>