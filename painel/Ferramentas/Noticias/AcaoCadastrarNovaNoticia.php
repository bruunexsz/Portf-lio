<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());
	
$UrlAmigavel = GerarUrlAmigavel(utf8_decode($CampoTituloPrincipal));

$SqlInserirNoticia = sprintf("INSERT INTO noticia(
				ID,
				Ativacao,
				DataDeCadastro,
				Titulo,
				TextoConteudo,
				PastaDeConteudo,
				UrlAmigavel,
				ImagemDestaque,
				Chamada
				)
				VALUES(
					'',
					'1',
					'".strftime("%Y-%m-%d %H:%M:%S")."',
					'%s',
					'%s',
					'%s',
					'%s',
					'%s',
					'%s'
					)",
mysql_real_escape_string(utf8_decode($CampoTituloPrincipal)),
mysql_real_escape_string(utf8_decode($CampoTextAreaBBCode)),
FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoPastaDeConteudo))),
mysql_real_escape_string(utf8_decode($UrlAmigavel)),
mysql_real_escape_string(utf8_decode($CampoImagemDestaque)),
FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoChamada)))
);
$ResultadoInserirNoticia = mysql_query($SqlInserirNoticia) or die (mysql_error());
echo "<script>alert('Cadastro realizado com sucesso!');</script>";
echo "<script>AlterarConteudo('Ferramentas/Noticias/ListarNoticia.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>