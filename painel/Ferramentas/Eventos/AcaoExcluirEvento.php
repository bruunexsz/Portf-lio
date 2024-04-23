<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$IDEvento = rtrim(FiltrarCampos($IDEvento));
$IDEvento = ltrim(FiltrarCampos($IDEvento));

$ArrayParaSeparar = explode(" ", $IDEvento);
for($i = 0; $i < count($ArrayParaSeparar); $i++) {
$TotalAExcluir = 'OR cadastroevento.ID = "'.FiltrarCampos($ArrayParaSeparar[$i]).'" ';

$SqlExcluirEvento = "UPDATE ".BANCO.".cadastroevento
			SET cadastroevento.AtivacaoDoEvento = '0'
		  	WHERE cadastroevento.ID = ''
		  	".$TotalAExcluir."";
$ExcluirEvento = mysql_query($SqlExcluirEvento) or die (mysql_error());

###		
$cSQLSEL = "SELECT cadastroevento.ID,								
	cadastroevento.PastaDeConteudoDoEvento
FROM ".BANCO.".cadastroevento
WHERE cadastroevento.ID  = ''
  ".$TotalAExcluir."";
$oRSSEL = mysql_query($cSQLSEL) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($oRSSEL)){			
	$BuscaMostrarImagensParaExclusao[$nCount]["ID"             ] = trim($row[0]);
	$BuscaMostrarImagensParaExclusao[$nCount]["PastaDeConteudoDoEvento"] = trim($row[1]);
$nCount++;
}
if (!isset($BuscaMostrarImagensParaExclusao[1]["PastaDeConteudoDoEvento"])) $BuscaMostrarImagensParaExclusao[1]["PastaDeConteudoDoEvento"] = '';
$PastaASerRemovida = CAMINHO_RELATIVO_IMAGENS_EVENTOS.$BuscaMostrarImagensParaExclusao[1]["PastaDeConteudoDoEvento"];

	if(file_exists($PastaASerRemovida)){
		if($PastaASerRemovida != CAMINHO_RELATIVO_IMAGENS_EVENTOS){
		#echo "PASTA EXISTE";
		chmod ($PastaASerRemovida, 0777);
		removeDirectory($PastaASerRemovida);
		}
	}
###
}
$MsgExclusaoSucesso = utf8_encode("Exclusão realizada com sucesso!");
echo "<script>alert('".$MsgExclusaoSucesso."');</script>";			
echo "<script>AlterarConteudo('Ferramentas/Eventos/ListarEvento.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>