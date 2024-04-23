<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$IDImagens = rtrim(FiltrarCampos($IDImagens));
$IDImagens = ltrim(FiltrarCampos($IDImagens));

$ArrayParaSeparar = explode(" ", $IDImagens);
for($i = 0; $i < count($ArrayParaSeparar); $i++) {
$TotalAExcluir = "OR imagensnoticia.ID = '".FiltrarCampos($ArrayParaSeparar[$i])."' ";	

$SelectImagens = "SELECT imagensnoticia.ID,
	imagensnoticia.ImagemConteudo,								
	imagensnoticia.PastaDeConteudo
FROM ".BANCO.".imagensnoticia 
WHERE imagensnoticia.ID  = ''
  ".$TotalAExcluir."";
$ResultadoSelectImagens = mysql_query($SelectImagens) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoSelectImagens)){
	$BuscaMostrarImagensParaExclusao[$nCount]["ID"             ] = trim($row[0]);
	$BuscaMostrarImagensParaExclusao[$nCount]["ImagemConteudo" ] = trim($row[1]);
	$BuscaMostrarImagensParaExclusao[$nCount]["PastaDeConteudo"] = trim($row[2]);
$nCount++;
}
mysql_Free_Result($ResultadoSelectImagens);
		
$PastaDoArquivo = CAMINHO_RELATIVO_IMAGENS_NOTICIAS.$CampoPastaDeConteudo;
$ArquivoASerApagado = CAMINHO_RELATIVO_IMAGENS_NOTICIAS."".$CampoPastaDeConteudo."/".$BuscaMostrarImagensParaExclusao[1]["ImagemConteudo"];
#echo $ArquivoASerApagado;
	if(file_exists($ArquivoASerApagado)){
		#echo "PASTA EXISTE";
		#chmod ($PastaDoArquivo, 0777);
		unlink($ArquivoASerApagado);
	}
	$SqlDeleteImagens = "DELETE FROM ".BANCO.".imagensnoticia
			  WHERE imagensnoticia.ID = ''
			  ".$TotalAExcluir."
			  ";
	$ResultadoDeleteImagens = mysql_query($SqlDeleteImagens) or die (mysql_error());
	}
	#chmod ($PastaDoArquivo, 0755);
	$MsgExclusaoSucesso = utf8_encode("Exclusão realizada com sucesso!");
	echo "<script>alert('".$MsgExclusaoSucesso."');</script>";
	echo "<script>AlterarConteudo('Ferramentas/Noticias/InserirImagens.php','DivInserirImagem','CampoPastaDeConteudo=".$CampoPastaDeConteudo."');</script>";
mysql_Close($ConexaoBanco); ?>