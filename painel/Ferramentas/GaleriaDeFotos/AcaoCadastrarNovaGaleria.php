<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

#NO AR
$PastaACriar = CAMINHO_RELATIVO_IMAGENS_GALERIA_DE_FOTOS."/".$CampoPastaDeConteudoDaGaleria."/";

#VERIFICA SE A PASTA EXISTE
if(file_exists($PastaACriar)){ 
	#echo "PASTA EXISTE";
	chmod ($PastaACriar, 0777);
}else{
	if($CampoPastaDeConteudoDaGaleria != ""){
		if(mkdir($PastaACriar, 1777)){	
			chmod ($PastaACriar, 0777);
		}else{
			$MsgErro = utf8_encode("A galeria não foi salva, por favor tente novamente!");
			echo "<script>alert('".$MsgErro."');</script>";	
			echo "<script>AlterarConteudo('Ferramentas/GaleriaDeFotos/ListarGaleria.php','DivResultadosInternos','');</script>";
		}
	}else{
		exit(0);
	}
}
#$TituloFiltrado = FiltrarCampos(utf8_decode($CampoTituloDaGaleria));
$UrlAmigavel = GerarUrlAmigavel(utf8_decode($CampoTituloDaGaleria));

$SqlCadastrarGaleria = sprintf("INSERT INTO cadastrogaleria(
						ID,
						AtivacaoDaGaleria,
						DataDeCadastroDaGaleria,
						TituloDaGaleria,
						TextoConteudoDaGaleria,
						PastaDeConteudoDaGaleria,
						UrlAmigavelDaGaleria
						)
						VALUES(
						'',
						'1',
						'".strftime("%Y-%m-%d %H:%M:%S")."',
						'%s',
						'%s',
						'%s',
						'%s'
						)",
						FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoTituloDaGaleria))),
						mysql_real_escape_string(utf8_decode($CampoResumoDaGaleria)),
						FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoPastaDeConteudoDaGaleria))),
						mysql_real_escape_string(utf8_decode($UrlAmigavel))
						);
$ResultadoCadastrarGaleria = mysql_query($SqlCadastrarGaleria) or die (mysql_error());			

echo "<script>alert('Cadastro realizado com sucesso!');</script>";
echo "<script>AlterarConteudo('Ferramentas/GaleriaDeFotos/ListarGaleria.php','DivResultadosInternos','');</script>";
exit(0);
mysql_Close($ConexaoBanco); ?>