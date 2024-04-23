<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$ArrayParaSeparar = explode(" ", $CampoValoresListBox);
for($i = 0; $i < count($ArrayParaSeparar); $i++) {
			
   $cSQL = sprintf("SELECT controlemensagemfiliado.ID,
		controlemensagemfiliado.IDUsuarioFiliado,
		controlemensagemfiliado.IDMensagensFiliado
	FROM ".BANCO.".controlemensagemfiliado
	WHERE controlemensagemfiliado.IDUsuarioFiliado = '%s'
	AND controlemensagemfiliado.IDMensagensFiliado = '%d'
	ORDER BY ID desc",
	mysql_real_escape_string($ArrayParaSeparar[$i]),
	FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoIDMensagem)))
	);
	$oRS = mysql_query($cSQL) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($oRS)){			
		$BuscaMostrarMensagens[$nCount]["ID"                 ] = trim($row[0]);
		$BuscaMostrarMensagens[$nCount]["IDUsuarioFiliado"   ] = trim($row[1]);
		$BuscaMostrarMensagens[$nCount]["IDMensagensFiliado" ] = trim($row[2]);			
	$nCount++;
	}
	mysql_Free_Result($oRS);
	
	if (!isset($BuscaMostrarMensagens[1]["ID"])) $BuscaMostrarMensagens[1]["ID"] = '';
	if($BuscaMostrarMensagens[1]["ID"] != ''){
	$cSQL = sprintf("DELETE FROM ".BANCO.".controlemensagemfiliado 
				   WHERE controlemensagemfiliado.IDUsuarioFiliado = '%s'
				   AND controlemensagemfiliado.IDMensagensFiliado = '%d'",
			mysql_real_escape_string($ArrayParaSeparar[$i]),
			FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoIDMensagem)))
			);
	#echo $cSQL;
	$oRS = mysql_query($cSQL) or die (mysql_error());	
	}			
			
}
	$MsgExclusaoSucesso = utf8_encode("Usuários removidos com sucesso!");
	echo "<script>alert('".$MsgExclusaoSucesso."');</script>";
	echo "<script>AlterarConteudo('Ferramentas/AreaDoFiliado/Mensagens/ListarMensagem.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>