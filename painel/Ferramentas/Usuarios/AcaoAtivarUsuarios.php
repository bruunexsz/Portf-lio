<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$SQLVerifica = sprintf("SELECT usuariopainel.ID,
					usuariopainel.AtivacaoUsuario,
					usuariopainel.NivelDeAcesso
					FROM ".BANCO.".usuariopainel
					WHERE usuariopainel.ID = '%s'
					AND usuariopainel.AtivacaoUsuario = '1'",
					FiltrarCampos(mysql_real_escape_string(utf8_decode($IDUsuario)))
					);
$RSVerifica = mysql_query($SQLVerifica);
	$nCount=1;
	while ($row = mysql_fetch_array($RSVerifica)){
	$VerificarAtivacao[$nCount]["ID"             ] = trim($row[0]);
	$VerificarAtivacao[$nCount]["AtivacaoUsuario"] = trim($row[1]);
	$VerificarAtivacao[$nCount]["NivelDeAcesso"  ] = trim($row[2]);
	$nCount++;
}
$RSVerifica = mysql_query($SQLVerifica) or die (mysql_error());
mysql_Free_Result($RSVerifica);

if (!isset($VerificarAtivacao[1]["NivelDeAcesso"])) $VerificarAtivacao[1]["NivelDeAcesso"] = '';

if($VerificarAtivacao[1]["NivelDeAcesso"] == '0' && $VerificarAtivacao[1]["NivelDeAcesso"] != '1'){
	$NivelDeAcesso = '2';
}else{
	$NivelDeAcesso = '0';
}
	$SQLNivelAcesso = sprintf("UPDATE ".BANCO.".usuariopainel
			  SET usuariopainel.NivelDeAcesso = '%d'
			  WHERE usuariopainel.ID = '%d'",
			  FiltrarCampos(mysql_real_escape_string(utf8_decode($NivelDeAcesso))),
			  FiltrarCampos(mysql_real_escape_string(utf8_decode($VerificarAtivacao[1]["ID"])))
			  );
	$ResultadoNivelAcesso = mysql_query($SQLNivelAcesso) or die (mysql_error());
	$MsgSucesso = utf8_encode('Atualização realizada com sucesso!');
	echo "<script>alert('".$MsgSucesso."');</script>";
	echo "<script>AlterarConteudo('Ferramentas/Usuarios/ListarUsuarios.php','DivResultadosInternos','');</script>";
	mysql_Close($ConexaoBanco);
?>