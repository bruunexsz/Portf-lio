<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

if ($ResultadoControleUsuario["NivelDeAcesso"] == 1){

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

	$SQLAtualizarConfiguracao = sprintf("UPDATE ".BANCO.".configuracao 
		  SET configuracao.HostEmailContato = '%s',
			  configuracao.NomeEmailContato = '%s',
			  configuracao.EmailContato = '%s',
			  configuracao.SenhaEmailContato = '%s',
			  configuracao.AssuntoEmailContato = '%s',
			  configuracao.HostEmailIndicacao = '%s',
			  configuracao.NomeEmailIndicacao = '%s',
			  configuracao.EmailIndicacao = '%s',
			  configuracao.SenhaEmailIndicacao = '%s',
			  configuracao.AssuntoEmailIndicacao = '%s',
			  configuracao.DescricaoPrincipalDoSite = '%s',
			  configuracao.PalavrasChaveDoSite = '%s'
		  WHERE configuracao.ID = '1'",
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoHostEmailContato))),
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoNomeEmailContato))),
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoEmailContato))),
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoSenhaEmailContato))),
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoAssuntoEmailContato))),
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoHostEmailIndicacao))),
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoNomeEmailIndicacao))),
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoEmailIndicacao))),
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoSenhaEmailIndicacao))),
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoAssuntoEmailIndicacao))),
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoTextoPrincipal))),
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoPalavrasChave)))
		  );
	$ResultadoAtualizarConfiguracao = mysql_query($SQLAtualizarConfiguracao) or die (mysql_error());
	$MsgSucesso = utf8_encode('Atualização realizada com sucesso!');
	echo "<script>alert('".$MsgSucesso."');</script>";
	echo "<script>AlterarConteudo('Ferramentas/Configuracao/ConfiguracaoDoSite.php','DivResultadosInternos','');</script>";
	mysql_Close($ConexaoBanco);
	
}
?>