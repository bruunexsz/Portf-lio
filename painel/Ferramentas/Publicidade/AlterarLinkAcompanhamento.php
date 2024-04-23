<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$CodigoAcompanhamento01 = rand(1, 10000);
$CodigoAcompanhamento02 = rand(1, 10000);  
$CodigoAcompanhamentoFinal = $CodigoAcompanhamento01."".strftime("%Y%m%d%H%M%S")."".$CodigoAcompanhamento02; 

$SqlEditar = sprintf("UPDATE ".BANCO.".publicidade 
			SET publicidade.ControleVisualizacao = '%s'
		  WHERE publicidade.ID = '%d'",
		  mysql_real_escape_string(utf8_decode($CodigoAcompanhamentoFinal)),
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($IDPublicidade)))
		  );
$ResultadoEditar= mysql_query($SqlEditar) or die (mysql_error());

echo "<script>AlterarConteudo('Ferramentas/Publicidade/VisualizarCliques.php','DivResultadosInternos','IDPublicidade=".$IDPublicidade."');</script>";
mysql_Close($ConexaoBanco); ?>
