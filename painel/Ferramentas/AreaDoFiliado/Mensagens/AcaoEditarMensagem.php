<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

	$cSQL = sprintf("UPDATE ".BANCO.".cadastromensagemfiliado
				SET cadastromensagemfiliado.TituloDaMensagem        = '%s',
					cadastromensagemfiliado.TextoConteudoDaMensagem = '%s'
			  WHERE cadastromensagemfiliado.ID = '%d'",
			FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoTituloDaMensagem))),
			mysql_real_escape_string(utf8_decode($CampoTextAreaBBCode)),
			FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoIDEditarMensagem)))
			);

	#echo $cSQL;
	$oRS = mysql_query($cSQL) or die (mysql_error());
	$MsgSucesso = utf8_encode("Atualização realizada com sucesso!");
	echo "<script>alert('".$MsgSucesso."');</script>";
	echo "<script>AlterarConteudo('Ferramentas/AreaDoFiliado/Mensagens/ListarMensagem.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>