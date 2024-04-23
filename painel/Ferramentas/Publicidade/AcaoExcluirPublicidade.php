<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$IDPublicidade = rtrim(FiltrarCampos($IDPublicidade));
$IDPublicidade = ltrim(FiltrarCampos($IDPublicidade));

$ArrayParaSeparar = explode(" ", $IDPublicidade);
for($i = 0; $i < count($ArrayParaSeparar); $i++) {
$TotalAExcluir = 'OR publicidade.ID = "'.FiltrarCampos($ArrayParaSeparar[$i]).'" ';

$SqlExcluirPublicidade = "UPDATE ".BANCO.".publicidade
			SET publicidade.Ativacao = '0'
		  	WHERE publicidade.ID = ''
		  	".$TotalAExcluir."";
$ExcluirPublicidade = mysql_query($SqlExcluirPublicidade) or die (mysql_error());

###		
$cSQLSEL = "SELECT publicidade.ID,								
	publicidade.PastaDeConteudo
FROM ".BANCO.".publicidade
WHERE publicidade.ID  = ''
  ".$TotalAExcluir."";
$oRSSEL = mysql_query($cSQLSEL) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($oRSSEL)){			
	$BuscaMostrarImagensParaExclusao[$nCount]["ID"             ] = trim($row[0]);
	$BuscaMostrarImagensParaExclusao[$nCount]["PastaDeConteudo"] = trim($row[1]);
$nCount++;
}
if (!isset($BuscaMostrarImagensParaExclusao[1]["PastaDeConteudo"])) $BuscaMostrarImagensParaExclusao[1]["PastaDeConteudo"] = '';
$PastaASerRemovida = CAMINHO_RELATIVO_IMAGENS_PUBLICIDADE.$BuscaMostrarImagensParaExclusao[1]["PastaDeConteudo"];

	if(file_exists($PastaASerRemovida)){
		if($PastaASerRemovida != CAMINHO_RELATIVO_IMAGENS_PUBLICIDADE){
		#echo "PASTA EXISTE";
		chmod ($PastaASerRemovida, 0777);
		removeDirectory($PastaASerRemovida);
		}
	}
###
}
$MsgExclusaoSucesso = utf8_encode("Exclusão realizada com sucesso!");
echo "<script>alert('".$MsgExclusaoSucesso."');</script>";			
echo "<script>AlterarConteudo('Ferramentas/Publicidade/ListarPublicidade.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>