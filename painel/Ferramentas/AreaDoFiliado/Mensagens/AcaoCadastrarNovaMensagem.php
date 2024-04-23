<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());
	
			$cSQL = sprintf("INSERT INTO cadastromensagemfiliado(
									ID,
									AtivacaoDaMensagem,
									DataDeCadastroDaMensagem,
									TituloDaMensagem,
									TextoConteudoDaMensagem,
									PastaDeConteudoDaMensagem
									)
									VALUES(
									'',
									'1',
									'".strftime("%Y-%m-%d %H:%M:%S")."',
									'%s',
									'%s',
									'%s'
									)",
			FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoTituloDaMensagem))),
			mysql_real_escape_string(utf8_decode($CampoTextAreaBBCode)),
			FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoPastaDeConteudoDaMensagem)))
			);
			$oRS = mysql_query($cSQL) or die (mysql_error());	

echo "<script>alert('Cadastro realizado com sucesso!');</script>";
echo "<script>AlterarConteudo('Ferramentas/AreaDoFiliado/Mensagens/ListarMensagem.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>