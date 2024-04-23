<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());
	
$UrlAmigavel = GerarUrlAmigavel(utf8_decode($CampoTituloPrincipal));

$CodigoAcompanhamento01 = rand(1, 10000);
$CodigoAcompanhamento02 = rand(1, 10000);  
$CodigoAcompanhamentoFinal = $CodigoAcompanhamento01."".strftime("%Y%m%d%H%M%S")."".$CodigoAcompanhamento02; 

$SqlInserirPublicidade = sprintf("INSERT INTO publicidade(
				ID,
				Ativacao,
				DataDeCadastro,
				Titulo,
				Site,
				PastaDeConteudo,
				UrlAmigavel,
				ControleVisualizacao,
				DataValidadeVisualizacao
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
					''
					)",
FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoTituloPrincipal))),
mysql_real_escape_string(utf8_decode($CampoSiteAnunciante)),
FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoPastaDeConteudo))),
mysql_real_escape_string(utf8_decode($UrlAmigavel)),
mysql_real_escape_string(utf8_decode($CodigoAcompanhamentoFinal))
);
$ResultadoInserirPublicidade = mysql_query($SqlInserirPublicidade) or die (mysql_error());
echo "<script>alert('Cadastro realizado com sucesso!');</script>";
echo "<script>AlterarConteudo('Ferramentas/Publicidade/ListarPublicidade.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>