<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

#INICIO VERIFICAR SE O EMAIL JÁ EXISTE NO SISTEMA
$SQLVerifica = sprintf("SELECT usuariopainel.EmailUsuario,
						usuariopainel.AtivacaoUsuario
						FROM ".BANCO.".usuariopainel
				WHERE usuariopainel.EmailUsuario = '%s'
				AND usuariopainel.EmailUsuario != '%s'
				AND usuariopainel.AtivacaoUsuario = '1'",
				FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoEmailEditarUsuarios))),
				FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoEmailInicialEditarUsuarios)))
				);
$RSVerifica = mysql_query($SQLVerifica) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($RSVerifica)){
	$VerificarSeUsuarioExiste[$nCount]["EmailUsuario"   ] = trim($row[0]);
	$VerificarSeUsuarioExiste[$nCount]["AtivacaoUsuario"] = trim($row[1]);
$nCount++;
}
mysql_Free_Result($RSVerifica);
if (!isset($VerificarSeUsuarioExiste[1]["EmailUsuario"])) $VerificarSeUsuarioExiste[1]["EmailUsuario"] = '';
#FIM VERIFICAR SE O EMAIL JÁ EXISTE NO SISTEMA
			
if(utf8_encode($CampoEmailEditarUsuarios) == utf8_encode($VerificarSeUsuarioExiste[1]["EmailUsuario"])){
	 $MsgEmailJaExiste = utf8_encode("Desculpe, mas já existe um usuário cadastrado com este e-mail no sistema, por favor tente novamente com outro e-mail!");
	 echo "<script>alert('".$MsgEmailJaExiste."');</script>";
	 echo "<script>AlterarConteudo('Ferramentas/Usuarios/EditarUsuarios.php','DivResultadosInternos','IDUsuario=$CampoIDEditarUsuarios');</script>";
	 exit(0);
}else{
	
	if ($ResultadoControleUsuario["NivelDeAcesso"] > 0){
		$cSQL = sprintf("UPDATE ".BANCO.".usuariopainel
					SET usuariopainel.EmailUsuario = '%s',
						usuariopainel.SenhaUsuario = '%s',
						usuariopainel.NomeUsuario = '%s'
					WHERE usuariopainel.ID = '%d'",
					FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoEmailEditarUsuarios))),
					FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoNovaSenhaEditarUsuarios))),
					FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoNomeEditarUsuarios))),
					FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoIDEditarUsuarios)))
					);
		$oRS = mysql_query($cSQL) or die (mysql_error());
		$MsgSucesso = utf8_encode("Atualização realizada com sucesso!");
		echo "<script>alert('".$MsgSucesso."');</script>";
		echo "<script>AlterarConteudo('Ferramentas/Usuarios/ListarUsuarios.php','DivResultadosInternos','');</script>";	
	}
}
	mysql_Close($ConexaoBanco);
?>