<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$IDGaleria = rtrim(FiltrarCampos($IDGaleria));
$IDGaleria = ltrim(FiltrarCampos($IDGaleria));

$ArrayParaSeparar = explode(" ", $IDGaleria);
for($i = 0; $i < count($ArrayParaSeparar); $i++) {
$TotalAExcluir = "OR cadastrogaleria.ID = '".FiltrarCampos($ArrayParaSeparar[$i])."' ";

	$cSQLUP = "UPDATE ".BANCO.".cadastrogaleria
				SET cadastrogaleria.AtivacaoDaGaleria = '0'
			  WHERE cadastrogaleria.ID = ''
			  ".$TotalAExcluir."";
	$oRSUP = mysql_query($cSQLUP) or die (mysql_error());
	###		
	$cSQLSEL = "SELECT cadastrogaleria.ID,								
		cadastrogaleria.PastaDeConteudoDaGaleria
	FROM ".BANCO.".cadastrogaleria
	WHERE cadastrogaleria.ID  = ''
	  ".$TotalAExcluir."";
	$oRSSEL = mysql_query($cSQLSEL) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($oRSSEL)){			
		$BuscaMostrarImagensParaExclusao[$nCount]["ID"                      ] = trim($row[0]);
		$BuscaMostrarImagensParaExclusao[$nCount]["PastaDeConteudoDaGaleria"] = trim($row[1]);
	$nCount++;
	}
	if (!isset($BuscaMostrarImagensParaExclusao[1]["PastaDeConteudoDaGaleria"])) $BuscaMostrarImagensParaExclusao[1]["PastaDeConteudoDaGaleria"] = '';
	$PastaASerRemovida = CAMINHO_RELATIVO_IMAGENS_GALERIA_DE_FOTOS.$BuscaMostrarImagensParaExclusao[1]["PastaDeConteudoDaGaleria"];
	
		if(file_exists($PastaASerRemovida)){
			if($PastaASerRemovida != CAMINHO_RELATIVO_IMAGENS_GALERIA_DE_FOTOS){
			#echo "PASTA EXISTE";
			chmod ($PastaASerRemovida, 0777);
			removeDirectory($PastaASerRemovida);
			}
		}		
	###
}
	$MsgExclusaoSucesso = utf8_encode("Exclusão realizada com sucesso!");
	echo "<script>alert('".$MsgExclusaoSucesso."');</script>";			
	echo "<script>AlterarConteudo('Ferramentas/GaleriaDeFotos/ListarGaleria.php','DivResultadosInternos','');</script>";
	exit(0);
mysql_Close($ConexaoBanco); ?>
