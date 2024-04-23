<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$SqlEditarPalavraDoPresidente = sprintf("UPDATE ".BANCO.".cadastropresidentefkp 
			SET cadastropresidentefkp.TextoConteudoDoPresidente = '%s'
		  WHERE cadastropresidentefkp.ID = '1'",
		  mysql_real_escape_string(utf8_decode($CampoTextAreaBBCode))
		  );
$ResultadoEditarPalavraDoPresidente = mysql_query($SqlEditarPalavraDoPresidente) or die (mysql_error());

$MsgSucesso = utf8_encode("Atualização realizada com sucesso!");
echo "<script>alert('".$MsgSucesso."');</script>";
echo "<script>AlterarConteudo('Ferramentas/PalavraDoPresidente/ListarPalavraDoPresidente.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>
