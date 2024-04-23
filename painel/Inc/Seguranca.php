<?php
session_start();
if (basename($_SERVER['PHP_SELF']) == 'Seguranca.php'){ die(''); }
require_once 'Funcoes.php';

	if (array_key_exists('HTTP_USER_AGENT', $_SESSION)){
		if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT'])){
			/* Acesso inválido. O header User-Agent mudou durante a mesma sessão. */
			header("Location:".CAMINHO_PAGINA_LOGIN);
			header("Content-Length: 0");
			exit(0);
		}
	}else{
		/* Primeiro acesso do usuário, vamos gravar na sessão um hash md5 do header User-Agent */
		$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
	}
	
	if(!isset($_SESSION["DadosParaSessao"])){
		header("Location:".CAMINHO_PAGINA_LOGIN);
		header("Content-Length: 0");
		exit(0);
	}
	$DadosParaSessao = isset($_SESSION["DadosParaSessao"]) ? $_SESSION["DadosParaSessao"] : unserialize($_COOKIE["DadosParaSessao"]);

	if (!isset($ConexaoBanco)) $ConexaoBanco = '';
		$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
		mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());
	
		$ControleUsuario = mysql_query("select ID, NomeUsuario, EmailUsuario, NivelDeAcesso from usuariopainel where EmailUsuario = '".FiltrarCampos($DadosParaSessao["EmailUsuario"])."' and ID = '".FiltrarCampos($DadosParaSessao["ID"])."'");
		$ResultadoControleUsuario = mysql_fetch_array($ControleUsuario);
	
		if($ResultadoControleUsuario["ID"] == '' && $ResultadoControleUsuario["EmailUsuario"] != $DadosParaSessao["EmailUsuario"] && $ResultadoControleUsuario["NivelDeAcesso"] == 0 || $ResultadoControleUsuario["NivelDeAcesso"] == 0 || $ResultadoControleUsuario["ID"] == '' || $ResultadoControleUsuario["EmailUsuario"] != $DadosParaSessao["EmailUsuario"]){
			header("Location:".CAMINHO_PAGINA_LOGOFF);
			header("Content-Length: 0");
			exit(0);
		}
		mysql_Close($ConexaoBanco);
?>