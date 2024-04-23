<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$IDFormularioDefiliacao = rtrim(FiltrarCampos($IDFormularioDefiliacao));
$IDFormularioDefiliacao = ltrim(FiltrarCampos($IDFormularioDefiliacao));

$ArrayParaSeparar = explode(" ", $IDFormularioDefiliacao);
for($i = 0; $i < count($ArrayParaSeparar); $i++) {
$TotalAExcluir = 'OR cadastrofiliacao.ID = "'.FiltrarCampos($ArrayParaSeparar[$i]).'" ';

$SqlExcluir = "UPDATE ".BANCO.".cadastrofiliacao
			SET cadastrofiliacao.AtivacaoFiliacao = '0'
		  	WHERE cadastrofiliacao.ID = ''
		  	".$TotalAExcluir."";
$Excluir = mysql_query($SqlExcluir) or die (mysql_error());

}
$MsgExclusaoSucesso = utf8_encode("Exclusão realizada com sucesso!");
echo "<script>alert('".$MsgExclusaoSucesso."');</script>";			
echo "<script>AlterarConteudo('Ferramentas/AreaDoFiliado/Fichas/ListarFormularioDeFiliacao.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>