<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$IDVideo = rtrim(FiltrarCampos($IDVideo));
$IDVideo = ltrim(FiltrarCampos($IDVideo));

$ArrayParaSeparar = explode(" ", $IDVideo);
for($i = 0; $i < count($ArrayParaSeparar); $i++) {
$TotalAExcluir = 'OR cadastrovideo.ID = "'.FiltrarCampos($ArrayParaSeparar[$i]).'" ';

$SqlExcluirResultado = "UPDATE ".BANCO.".cadastrovideo
			SET cadastrovideo.AtivacaoDoVideo = '0'
		  	WHERE cadastrovideo.ID = ''
		  	".$TotalAExcluir."";
$ExcluirResultado = mysql_query($SqlExcluirResultado) or die (mysql_error());

}
$MsgExclusaoSucesso = utf8_encode("Exclusão realizada com sucesso!");
echo "<script>alert('".$MsgExclusaoSucesso."');</script>";			
echo "<script>AlterarConteudo('Ferramentas/GaleriaDeVideos/ListarVideo.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>