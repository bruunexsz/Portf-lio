<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$UrlAmigavel = GerarUrlAmigavel(utf8_decode($CampoTituloPrincipal));

$SqlEditar = sprintf("UPDATE ".BANCO.".publicidade 
			SET publicidade.Titulo = '%s',
				publicidade.Site = '%s',				
				publicidade.UrlAmigavel = '%s'
		  WHERE publicidade.ID = '%d'",
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoTituloPrincipal))),
		  mysql_real_escape_string(utf8_decode($CampoSiteAnunciante)),
		  mysql_real_escape_string(utf8_decode($UrlAmigavel)),
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoIDPublicidade)))
		  );
$ResultadoEditar= mysql_query($SqlEditar) or die (mysql_error());

$MsgSucesso = utf8_encode("Atualização realizada com sucesso!");
echo "<script>alert('".$MsgSucesso."');</script>";
echo "<script>AlterarConteudo('Ferramentas/Publicidade/ListarPublicidade.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>
