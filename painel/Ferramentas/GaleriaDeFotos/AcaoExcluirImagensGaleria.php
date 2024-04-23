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
    $TotalAExcluir = "OR cadastroimagensgalerias.ID = '".FiltrarCampos($ArrayParaSeparar[$i])."' ";	

	$SelectImagens= "SELECT cadastroimagensgalerias.ID,
		cadastroimagensgalerias.ImagemConteudoDaGaleria,
		cadastroimagensgalerias.PastaDeConteudoDaGaleria
	FROM ".BANCO.".cadastroimagensgalerias
	WHERE cadastroimagensgalerias.ID  = ''
	  ".$TotalAExcluir."";
	$ResultadoSelectImagens = mysql_query($SelectImagens) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($ResultadoSelectImagens)){			
		$BuscaMostrarImagensParaExclusao[$nCount]["ID"                      ] = trim($row[0]);
		$BuscaMostrarImagensParaExclusao[$nCount]["ImagemConteudoDaGaleria" ] = trim($row[1]);
		$BuscaMostrarImagensParaExclusao[$nCount]["PastaDeConteudoDaGaleria"] = trim($row[2]);
	$nCount++;
	}
	mysql_Free_Result($ResultadoSelectImagens);

	$PastaDoArquivo = CAMINHO_RELATIVO_IMAGENS_GALERIA_DE_FOTOS.$CampoPastaDeConteudoDaGaleria;
	$ArquivoASerApagado = CAMINHO_RELATIVO_IMAGENS_GALERIA_DE_FOTOS."/".$CampoPastaDeConteudoDaGaleria."/".$BuscaMostrarImagensParaExclusao[1]["ImagemConteudoDaGaleria"];

	if(file_exists($ArquivoASerApagado)){
		#echo "PASTA EXISTE";
		#chmod ($PastaDoArquivo, 0777);
		unlink($ArquivoASerApagado);
	}

	$SqlApagarImagens = "DELETE FROM ".BANCO.".cadastroimagensgalerias
			  WHERE cadastroimagensgalerias.ID = ''
			  ".$TotalAExcluir."";
	$ResultadoApagarImagens = mysql_query($SqlApagarImagens) or die (mysql_error());
	}
	#chmod ($PastaDoArquivo, 0755);
	
	#INICIO SELECT ID DA GALERIA
	$SelectIdGaleria = sprintf("SELECT cadastrogaleria.ID,
		cadastrogaleria.AtivacaoDaGaleria,
		cadastrogaleria.PastaDeConteudoDaGaleria
	FROM ".BANCO.".cadastrogaleria
	WHERE cadastrogaleria.AtivacaoDaGaleria = 1
	AND cadastrogaleria.PastaDeConteudoDaGaleria = '%s'
	LIMIT 1",
	FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoPastaDeConteudoDaGaleria)))
	);
	$ResultadoSelectIdGaleria = mysql_query($SelectIdGaleria) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($ResultadoSelectIdGaleria)){			
		$BuscaMostrarGalerias[$nCount]["ID"                      ] = trim($row[0]);
		$BuscaMostrarGalerias[$nCount]["AtivacaoDaGaleria"       ] = trim($row[1]);
		$BuscaMostrarGalerias[$nCount]["PastaDeConteudoDaGaleria"] = trim($row[2]);
	$nCount++;
	}
	mysql_Free_Result($ResultadoSelectIdGaleria);
#FIM SELECT ID DA GALERIA

$MsgExclusaoSucesso = utf8_encode("Exclusão realizada com sucesso!");
echo "<script>alert('".$MsgExclusaoSucesso."');</script>";
echo "<script>AlterarConteudo('Ferramentas/GaleriaDeFotos/EditarFotosGaleria.php','DivResultadosInternos','IDGaleria=".$BuscaMostrarGalerias[1]["ID"]."');</script>";
exit(0);
mysql_Close($ConexaoBanco); ?>