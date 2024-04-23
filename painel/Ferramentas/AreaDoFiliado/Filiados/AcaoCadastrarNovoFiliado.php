<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

#INICIO VERIFICAR SE O EMAIL JÁ EXISTE NO SISTEMA

	$SQLVerifica= sprintf("SELECT cadastrousuariofiliado.LoginUsuario,
	cadastrousuariofiliado.AtivacaoUsuario
	FROM ".BANCO.".cadastrousuariofiliado
	WHERE cadastrousuariofiliado.LoginUsuario = '%s'
	AND cadastrousuariofiliado.AtivacaoUsuario = '1'",
		FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoLoginNovoFiliado)))
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

 if(utf8_encode($CampoLoginNovoFiliado) == utf8_encode($VerificarSeFiliadoExiste[1]["LoginFiliado"])){
	 $MsgEmailJaExiste = utf8_encode("Desculpe, mas já existe um filiado cadastrado com este usuário no sistema, por favor tente novamente com outro usuário!");
	 echo "<script>alert('".$MsgEmailJaExiste."');</script>";
	 echo "<script>AlterarConteudo('Ferramentas/AreaDoFiliado/Filiados/CadastrarNovoFiliado.php','DivResultadosInternos','EmailCadastrante=$CampoCadastradoPorNovoFiliado');</script>";
 }else{
  
		$SelectInserirFiliado = sprintf("INSERT INTO cadastrousuariofiliado(
		ID,
		AtivacaoUsuario,									
		DataCadastroUsuario,									
		LoginUsuario,
		SenhaUsuario,
		EmailUsuario,
		NomeUsuario,
		CadastradoPor
		)
		VALUES(
		'',
		'1',									
		'".strftime("%Y-%m-%d %H:%M:%S")."',
		'%s',
		'%s',
		'%s',
		'%s',
		'%s'
		)",
		FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoLoginNovoFiliado))),
		FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoSenhaNovoFiliado))),
		FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoEmailNovoFiliado))),
		FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoNomeNovoFiliado))),
		FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoCadastradoPorNovoFiliado)))
		);
		$SqlInserirFiliado = mysql_query($SelectInserirFiliado) or die (mysql_error());

		
		echo "<script>alert('Cadastro realizado com sucesso!');</script>";
		echo "<script>AlterarConteudo('Ferramentas/AreaDoFiliado/Filiados/ListarFiliado.php','DivResultadosInternos','');</script>";
		exit(0);
	}

	mysql_Close($ConexaoBanco);
?>