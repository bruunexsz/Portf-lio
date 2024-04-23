<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());
	
$UrlAmigavel = GerarUrlAmigavel(utf8_decode($CampoTituloDoVideo));

$SqlInserirVideo =  sprintf("INSERT INTO cadastrovideo(
						ID,
						AtivacaoDoVideo,
						DataDeCadastroDoVideo,
						TituloDoVideo,
						UrlDoVideo,
						TextoConteudoDoVideo,
						UrlAmigavel
						)
						VALUES(
						'',
						'1',
						'".strftime("%Y-%m-%d %H:%M:%S")."',
						'%s',
						'%s',
						'',
						'%s'
						)",
						FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoTituloDoVideo))),
						mysql_real_escape_string(utf8_decode($CampoUrlDoVideo)),
						mysql_real_escape_string(utf8_decode($UrlAmigavel))
						);
$ResultadoInserirVideo = mysql_query($SqlInserirVideo) or die (mysql_error());	

echo "<script>alert('Cadastro realizado com sucesso!');</script>";
echo "<script>AlterarConteudo('Ferramentas/GaleriaDeVideos/ListarVideo.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>