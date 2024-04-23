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
				AND usuariopainel.AtivacaoUsuario = '1'",
				FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoEmailNovoUsuario)))
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
			
if(utf8_encode($CampoEmailNovoUsuario) == utf8_encode($VerificarSeUsuarioExiste[1]["EmailUsuario"])){
	 $MsgEmailJaExiste = utf8_encode("Desculpe, mas já existe um usuário cadastrado com este e-mail no sistema, por favor tente novamente com outro e-mail!");
	 echo "<script>alert('".$MsgEmailJaExiste."');</script>";
	 echo "<script>AlterarConteudo('Ferramentas/Usuarios/CadastrarNovoUsuario.php','DivResultadosInternos','EmailCadastrante=$CampoCadastradoPorNovoUsuario');</script>";
	 exit(0);
}else{
	if ($ResultadoControleUsuario["NivelDeAcesso"] == 1){
		$SQLInserirUsuario = sprintf("INSERT INTO usuariopainel(
								ID,
								AtivacaoUsuario,
								DataCadastroUsuario,
								EmailUsuario,
								SenhaUsuario,
								NomeUsuario,
								NivelDeAcesso,
								CadastradoPor
								)
								VALUES(
								'',
								'1',
								'".strftime("%Y-%m-%d %H:%M:%S")."',
								'%s',
								'%s',
								'%s',
								'%d',
								'%s'
								)",
							FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoEmailNovoUsuario))),
							FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoSenhaNovoUsuario))),
							FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoNomeNovoUsuario))),
							FiltrarCampos(mysql_real_escape_string(utf8_decode(2))),
							FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoCadastradoPorNovoUsuario)))
							);
		$ResultadoInserirUsuario = mysql_query($SQLInserirUsuario) or die (mysql_error());			
		
		echo "<script>alert('Cadastro realizado com sucesso!');</script>";
		echo "<script>AlterarConteudo('Ferramentas/Usuarios/ListarUsuarios.php','DivResultadosInternos','');</script>";
		exit(0);
	}
}
	mysql_Close($ConexaoBanco);
?>