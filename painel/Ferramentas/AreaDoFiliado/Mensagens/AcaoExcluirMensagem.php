<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$IDMensagem = rtrim(FiltrarCampos($IDMensagem));
$IDMensagem = ltrim(FiltrarCampos($IDMensagem));

$ArrayParaSeparar = explode(" ", $IDMensagem);
for($i = 0; $i < count($ArrayParaSeparar); $i++) {
$TotalAExcluir = 'OR cadastromensagemfiliado.ID = "'.FiltrarCampos($ArrayParaSeparar[$i]).'" ';

$SqlExcluir = "UPDATE ".BANCO.".cadastromensagemfiliado
			SET cadastromensagemfiliado.AtivacaoDaMensagem = '0'
		  	WHERE cadastromensagemfiliado.ID = ''
		  	".$TotalAExcluir."";
$ResultadoExcluir = mysql_query($SqlExcluir) or die (mysql_error());

###		
$cSQLSEL = "SELECT cadastromensagemfiliado.ID,								
	cadastromensagemfiliado.PastaDeConteudoDaMensagem
FROM ".BANCO.".cadastromensagemfiliado
WHERE cadastromensagemfiliado.ID  = ''
  ".$TotalAExcluir."";
$oRSSEL = mysql_query($cSQLSEL) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($oRSSEL)){			
	$BuscaMostrarImagensParaExclusao[$nCount]["ID"             ] = trim($row[0]);
	$BuscaMostrarImagensParaExclusao[$nCount]["PastaDeConteudo"] = trim($row[1]);
$nCount++;
}
if (!isset($BuscaMostrarImagensParaExclusao[1]["PastaDeConteudo"])) $BuscaMostrarImagensParaExclusao[1]["PastaDeConteudo"] = '';
$PastaASerRemovida = CAMINHO_RELATIVO_IMAGENS_MENSAGENS.$BuscaMostrarImagensParaExclusao[1]["PastaDeConteudo"];

	if(file_exists($PastaASerRemovida)){
		if($PastaASerRemovida != CAMINHO_RELATIVO_IMAGENS_MENSAGENS){
		#echo "PASTA EXISTE";
		chmod ($PastaASerRemovida, 0777);
		removeDirectory($PastaASerRemovida);
		}
	}
###
###		
if (!isset($BuscaMostrarImagensParaExclusao[1]["PastaDeConteudo"])) $BuscaMostrarImagensParaExclusao[1]["PastaDeConteudo"] = '';
$PastaASerRemovidaArq = CAMINHO_RELATIVO_ANEXOS_MENSAGENS.$BuscaMostrarImagensParaExclusao[1]["PastaDeConteudo"];

	if(file_exists($PastaASerRemovidaArq)){
		if($PastaASerRemovidaArq != CAMINHO_RELATIVO_ANEXOS_MENSAGENS){
		#echo "PASTA EXISTE";
		chmod ($PastaASerRemovidaArq, 0777);
		removeDirectory($PastaASerRemovidaArq);
		}
	}
###
}
$MsgExclusaoSucesso = utf8_encode("Exclusão realizada com sucesso!");
echo "<script>alert('".$MsgExclusaoSucesso."');</script>";			
echo "<script>AlterarConteudo('Ferramentas/AreaDoFiliado/Mensagens/ListarMensagem.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>