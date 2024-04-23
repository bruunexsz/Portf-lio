<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());
			
	$SQLUpdate = sprintf("UPDATE ".BANCO.".cadastrousuariofiliado
				SET cadastrousuariofiliado.AtivacaoUsuario = '%d'
			  WHERE cadastrousuariofiliado.ID = '%d'",
			  FiltrarCampos(mysql_real_escape_string(utf8_decode(0))),
			  FiltrarCampos(mysql_real_escape_string($IDFiliado))
			  );
	$ResultadoUpdate = mysql_query($SQLUpdate) or die (mysql_error());
	$MsgExclusaoSucesso = utf8_encode("Exclusão realizada com sucesso!");
	echo "<script>alert('".$MsgExclusaoSucesso."');</script>";
	echo "<script>AlterarConteudo('Ferramentas/AreaDoFiliado/Filiados/ListarFiliado.php','DivResultadosInternos','');</script>";
	exit(0);
mysql_Close($ConexaoBanco);
?>
