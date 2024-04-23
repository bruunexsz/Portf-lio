<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$UrlAmigavel = GerarUrlAmigavel(utf8_decode($CampoTituloPrincipal));

$SqlEditar = sprintf("UPDATE ".BANCO.".noticia 
			SET noticia.Titulo = '%s',
				noticia.TextoConteudo = '%s',				
				noticia.UrlAmigavel = '%s',
				noticia.ImagemDestaque = '%s',
				noticia.Chamada = '%s'
		  WHERE noticia.ID = '%d'",
		  mysql_real_escape_string(utf8_decode($CampoTituloPrincipal)),
		  mysql_real_escape_string(utf8_decode($CampoTextAreaBBCode)),
		  mysql_real_escape_string(utf8_decode($UrlAmigavel)),
		  mysql_real_escape_string(utf8_decode($CampoImagemDestaque)),
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoChamada))),
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoID)))
		  );
$ResultadoEditar= mysql_query($SqlEditar) or die (mysql_error());

$MsgSucesso = utf8_encode("Atualização realizada com sucesso!");
echo "<script>alert('".$MsgSucesso."');</script>";
echo "<script>AlterarConteudo('Ferramentas/Noticias/ListarNoticia.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>
