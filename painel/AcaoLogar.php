<?php
session_start();
session_regenerate_id();
if (file_exists('Inc/Init.php')){ require_once 'Inc/Init.php'; }else{ die(''); }
if (file_exists('Inc/Config.php')){ require_once 'Inc/Config.php'; } else { die(''); }
if (!isset($EmailUsuario)) $EmailUsuario = '';
if (!isset($SenhaUsuario)) $SenhaUsuario = '';
if($_POST['EmailUsuario'] != '' && $_POST['SenhaUsuario'] != ''){
	if (!isset($ConexaoBanco)) $ConexaoBanco = '';
	require_once 'Inc/Funcoes.php';
	
	if(getenv('REQUEST_METHOD') == 'POST'){
		$EmailUsuario = isset($_POST['EmailUsuario']) ? FiltrarCampos($_POST['EmailUsuario']) : '';
		$SenhaUsuario = isset($_POST['SenhaUsuario']) ? FiltrarCampos($_POST['SenhaUsuario']) : '';
	
		$ConsultaQtdUsuario = sprintf("select count(*) from usuariopainel where EmailUsuario = '%s' and SenhaUsuario = '%s' and AtivacaoUsuario = '1'", FiltrarCampos($EmailUsuario), FiltrarCampos($SenhaUsuario));
		$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
		mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());
	
		$ResultadoQtdUsuario = mysql_query($ConsultaQtdUsuario) or die(mysql_error());
		if(mysql_result($ResultadoQtdUsuario, 0)){
			$ResultadoQtdUsuario = mysql_query("select * from usuariopainel where EmailUsuario = '$EmailUsuario' and SenhaUsuario = '$SenhaUsuario' and AtivacaoUsuario = '1'") or die(mysql_error());
			$ResultadoDadosUsuario = mysql_fetch_array($ResultadoQtdUsuario);
	
			if($ResultadoDadosUsuario['NivelDeAcesso'] > 0){
				$DadosParaSessao = array();
				$DadosParaSessao['ID'] = $ResultadoDadosUsuario['ID'];
				$DadosParaSessao['EmailUsuario'] = $EmailUsuario;
				$_SESSION['DadosParaSessao'] = $DadosParaSessao;
				
				$IpUsuario = getenv("REMOTE_ADDR");
				$GravarLog = "INSERT INTO logusuariopainel (ID, IDUsuario, EmailUsuario, DataHoraLogin, IpUsuario)					
				VALUES ('', '".$ResultadoDadosUsuario['ID']."', '".$DadosParaSessao['EmailUsuario']."', '".strftime( "%Y-%m-%d %H:%M:%S" )."', '$IpUsuario')";
				
				$ResultadoGravarLog = mysql_query($GravarLog) or die (mysql_error());									
				
				header('Location: Principal.php');
			}else{
				header('Location: index.php');
				header("Content-Length: 0");
				exit(0);
			}
		}else{
			header('Location: index.php');
			header("Content-Length: 0");
			exit(0);
		}
	}
	if($ConexaoBanco != ''){ mysql_Close($ConexaoBanco); }
}else{
	header('Location: index.php');
	header("Content-Length: 0");
	exit(0);
}
?>