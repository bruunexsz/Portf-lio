<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$IDNoticia = rtrim(FiltrarCampos($IDNoticia));
$IDNoticia = ltrim(FiltrarCampos($IDNoticia));

$ArrayParaSeparar = explode(" ", $IDNoticia);
for($i = 0; $i < count($ArrayParaSeparar); $i++) {
$TotalAExcluir = 'OR noticia.ID = "'.FiltrarCampos($ArrayParaSeparar[$i]).'" ';

$SqlExcluirNoticia = "UPDATE ".BANCO.".noticia
			SET noticia.Ativacao = '0'
		  	WHERE noticia.ID = ''
		  	".$TotalAExcluir."";
$ExcluirNoticia = mysql_query($SqlExcluirNoticia) or die (mysql_error());

###		
$cSQLSEL = "SELECT noticia.ID,								
	noticia.PastaDeConteudo
FROM ".BANCO.".noticia
WHERE noticia.ID  = ''
  ".$TotalAExcluir."";
$oRSSEL = mysql_query($cSQLSEL) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($oRSSEL)){			
	$BuscaMostrarImagensParaExclusao[$nCount]["ID"             ] = trim($row[0]);
	$BuscaMostrarImagensParaExclusao[$nCount]["PastaDeConteudo"] = trim($row[1]);
$nCount++;
}
if (!isset($BuscaMostrarImagensParaExclusao[1]["PastaDeConteudo"])) $BuscaMostrarImagensParaExclusao[1]["PastaDeConteudo"] = '';
$PastaASerRemovida = CAMINHO_RELATIVO_IMAGENS_NOTICIAS.$BuscaMostrarImagensParaExclusao[1]["PastaDeConteudo"];

	if(file_exists($PastaASerRemovida)){
		if($PastaASerRemovida != CAMINHO_RELATIVO_IMAGENS_NOTICIAS){
		#echo "PASTA EXISTE";
		chmod ($PastaASerRemovida, 0777);
		removeDirectory($PastaASerRemovida);
		}
	}
###
}
$MsgExclusaoSucesso = utf8_encode("Exclusão realizada com sucesso!");
echo "<script>alert('".$MsgExclusaoSucesso."');</script>";			
echo "<script>AlterarConteudo('Ferramentas/Noticias/ListarNoticia.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>