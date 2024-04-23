<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }
$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

# DEFINIDO O TEMPO DE EXECUÇÃO DO SCRIPT PARA 7 HORAS
set_time_limit( ((60 * 60) * 7) );

$NomeDoArquivo = "../../../Emails/emails.txt";
$Arquivo = fopen("$NomeDoArquivo","w+");

fputs($Arquivo, '');
fclose($Arquivo);

$Msg = utf8_encode("Arquivo limpo com sucesso!");
echo "<script>alert('".$Msg."');</script>";		
echo "<script>AlterarConteudo('Ferramentas/Informativos/ListarEmail.php','DivResultadosInternos','');</script>";
exit(0);
mysql_Close($ConexaoBanco); ?>