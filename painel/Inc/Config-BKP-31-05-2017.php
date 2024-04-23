<?php
	if (basename($_SERVER['PHP_SELF']) == 'Config.php') { die(''); }
	if(!defined('SERVIDOR')) define('SERVIDOR', 'cpmy0016.servidorwebfacil.com');
	if(!defined('USUARIO')) define('USUARIO', 'fekapl_usr');
	if(!defined('SENHA')) define('SENHA', '1f5d8r5b3n5f');
	if(!defined('BANCO')) define('BANCO', 'fekapl_pnlfkp');
	
	#INICIO CONFIGURAÇÃO DO TEMA
	$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
	mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());
	$SelectTema = "SELECT configuracao.ID,
				configuracao.TemaPainel
			FROM ".BANCO.".configuracao
			WHERE configuracao.ID = '1'
			LIMIT 1";
	$ResultadoTema = mysql_query($SelectTema) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($ResultadoTema)){			
		$BuscaMostrarConfiguracao[$nCount]["ID"        ] = trim($row[0]);
		$BuscaMostrarConfiguracao[$nCount]["TemaPainel"] = trim($row[1]);
	$nCount++;
	}
	mysql_Free_Result($ResultadoTema);	
	if (!isset($BuscaMostrarConfiguracao[1]["TemaPainel"])) $BuscaMostrarConfiguracao[1]["TemaPainel"] = '';
	
	if($BuscaMostrarConfiguracao[1]["TemaPainel"] == 'Verde'){
		if(!defined('CSS_TEMA')) define('CSS_TEMA', 'estilos-verde.css');
		if(!defined('CAMINHO_IMAGENS_TEMA')) define('CAMINHO_IMAGENS_TEMA', 'Img/Verde/');
	}else if($BuscaMostrarConfiguracao[1]["TemaPainel"] == 'Vermelho'){
		if(!defined('CSS_TEMA')) define('CSS_TEMA', 'estilos-vermelho.css');
		if(!defined('CAMINHO_IMAGENS_TEMA')) define('CAMINHO_IMAGENS_TEMA', 'Img/Vermelho/');
	}
	#FIM CONFIGURAÇÃO DO TEMA

	if(!defined('CAMINHO_FISICO')) define('CAMINHO_FISICO', '/home/fekapl/public_html/');
	if(!defined('CAMINHO_FISICO_IMAGENS')) define('CAMINHO_FISICO_IMAGENS', '/home/fekapl/public_html/Img/');
	if(!defined('CAMINHO_FISICO_ANEXOS')) define('CAMINHO_FISICO_ANEXOS', '/home/fekapl/public_html/Anexos/');

	if(!defined('NOME_DO_CLIENTE')) define('NOME_DO_CLIENTE', 'Federação de Karatê Paulista');
	if(!defined('CAMINHO_SITE_GERAL')) define('CAMINHO_SITE_GERAL', 'http://www.fkp.com.br/'); // Não esqueça a barra / no final da url.
	if(!defined('CAMINHO_PAGINA_LOGIN')) define('CAMINHO_PAGINA_LOGIN', CAMINHO_SITE_GERAL.'painel/index.php');
	if(!defined('CAMINHO_PAGINA_LOGOFF')) define('CAMINHO_PAGINA_LOGOFF', CAMINHO_SITE_GERAL.'painel/LogOff.php');
	
	if(!defined('CAMINHO_IMAGENS_NOTICIAS')) define('CAMINHO_IMAGENS_NOTICIAS', CAMINHO_SITE_GERAL.'Img/ConteudoNoticias/');
	if(!defined('CAMINHO_RELATIVO_IMAGENS_NOTICIAS')) define('CAMINHO_RELATIVO_IMAGENS_NOTICIAS', CAMINHO_FISICO_IMAGENS.'ConteudoNoticias/');
	
	if(!defined('CAMINHO_IMAGENS_EVENTOS')) define('CAMINHO_IMAGENS_EVENTOS', CAMINHO_SITE_GERAL.'Img/ConteudoEventos/');
	if(!defined('CAMINHO_RELATIVO_IMAGENS_EVENTOS')) define('CAMINHO_RELATIVO_IMAGENS_EVENTOS', CAMINHO_FISICO_IMAGENS.'ConteudoEventos/');
	
	if(!defined('CAMINHO_IMAGENS_GALERIA_DE_FOTOS')) define('CAMINHO_IMAGENS_GALERIA_DE_FOTOS', CAMINHO_SITE_GERAL.'Img/ConteudoGalerias/');
	if(!defined('CAMINHO_RELATIVO_IMAGENS_GALERIA_DE_FOTOS')) define('CAMINHO_RELATIVO_IMAGENS_GALERIA_DE_FOTOS', CAMINHO_FISICO_IMAGENS.'ConteudoGalerias/');
	
	if(!defined('CAMINHO_IMAGENS_DESTAQUES')) define('CAMINHO_IMAGENS_DESTAQUES', CAMINHO_SITE_GERAL.'Img/ConteudoDestaques/');
	if(!defined('CAMINHO_RELATIVO_IMAGENS_DESTAQUES')) define('CAMINHO_RELATIVO_IMAGENS_DESTAQUES', CAMINHO_FISICO_IMAGENS.'ConteudoDestaques/');
	
	if(!defined('CAMINHO_IMAGENS_DESCRICAO_FKP')) define('CAMINHO_IMAGENS_DESCRICAO_FKP', CAMINHO_SITE_GERAL.'Img/ConteudoDescricaoFKP/');
	if(!defined('CAMINHO_RELATIVO_IMAGENS_DESCRICAO_FKP')) define('CAMINHO_RELATIVO_IMAGENS_DESCRICAO_FKP', CAMINHO_FISICO_IMAGENS.'ConteudoDescricaoFKP/');
	
	if(!defined('CAMINHO_IMAGENS_PALAVRA_DO_PRESIDENTE')) define('CAMINHO_IMAGENS_PALAVRA_DO_PRESIDENTE', CAMINHO_SITE_GERAL.'Img/ConteudoPalavraDoPresidenteFKP/');
	if(!defined('CAMINHO_RELATIVO_IMAGENS_PALAVRA_DO_PRESIDENTE')) define('CAMINHO_RELATIVO_IMAGENS_PALAVRA_DO_PRESIDENTE', CAMINHO_FISICO_IMAGENS.'ConteudoPalavraDoPresidenteFKP/');
	
	if(!defined('CAMINHO_IMAGENS_PUBLICIDADE')) define('CAMINHO_IMAGENS_PUBLICIDADE', CAMINHO_SITE_GERAL.'Img/ConteudoPublicidade/');
	if(!defined('CAMINHO_RELATIVO_IMAGENS_PUBLICIDADE')) define('CAMINHO_RELATIVO_IMAGENS_PUBLICIDADE', CAMINHO_FISICO_IMAGENS.'ConteudoPublicidade/');
	
	if(!defined('CAMINHO_IMAGENS_MENSAGENS')) define('CAMINHO_IMAGENS_MENSAGENS', CAMINHO_SITE_GERAL.'Img/ConteudoMensagensFiliado/');
	if(!defined('CAMINHO_RELATIVO_IMAGENS_MENSAGENS')) define('CAMINHO_RELATIVO_IMAGENS_MENSAGENS', CAMINHO_FISICO_IMAGENS.'ConteudoMensagensFiliado/');
	
	if(!defined('CAMINHO_ANEXOS_MENSAGENS')) define('CAMINHO_ANEXOS_MENSAGENS', CAMINHO_SITE_GERAL.'Anexos/ConteudoMensagensFiliado/');
	if(!defined('CAMINHO_RELATIVO_ANEXOS_MENSAGENS')) define('CAMINHO_RELATIVO_ANEXOS_MENSAGENS', CAMINHO_FISICO_ANEXOS.'ConteudoMensagensFiliado/');

?>