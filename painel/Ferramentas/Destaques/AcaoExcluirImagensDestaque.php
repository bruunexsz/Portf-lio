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
    $TotalAExcluir = "OR cadastroimagensdestaques.ID = '".FiltrarCampos($ArrayParaSeparar[$i])."' ";

	$SQLImagens = "SELECT cadastroimagensdestaques.ID,
		cadastroimagensdestaques.ImagemConteudoDoDestaque,								
		cadastroimagensdestaques.PastaDeConteudoDoDestaque
	FROM ".BANCO.".cadastroimagensdestaques  
	WHERE cadastroimagensdestaques.ID  = ''
	  ".$TotalAExcluir."";
	$ResultadoImagens = mysql_query($SQLImagens) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($ResultadoImagens)){			
		$BuscaMostrarImagensParaExclusao[$nCount]["ID"                       ] = trim($row[0]);
		$BuscaMostrarImagensParaExclusao[$nCount]["ImagemConteudoDoDestaque" ] = trim($row[1]);				
		$BuscaMostrarImagensParaExclusao[$nCount]["PastaDeConteudoDoDestaque"] = trim($row[2]);		
	$nCount++;
	}
	mysql_Free_Result($ResultadoImagens);
			
	$PastaDoArquivo = CAMINHO_RELATIVO_IMAGENS_DESTAQUES.$CampoPastaDeConteudoDoDestaque;
	$ArquivoASerApagado = CAMINHO_RELATIVO_IMAGENS_DESTAQUES.''.$CampoPastaDeConteudoDoDestaque.'/'.$BuscaMostrarImagensParaExclusao[1]["ImagemConteudoDoDestaque"];
	#echo $ArquivoASerApagado;
	if(file_exists($ArquivoASerApagado)){
		#chmod ($PastaDoArquivo, 0777);
		unlink($ArquivoASerApagado);
	}

	$SQLDeleteImagens = "DELETE FROM ".BANCO.".cadastroimagensdestaques
			  WHERE cadastroimagensdestaques.ID = ''
			  ".$TotalAExcluir."";
	$ResultadoDeleteImagens = mysql_query($SQLDeleteImagens) or die (mysql_error());
	}
	#chmod ($PastaDoArquivo, 0755);
	$MsgExclusaoSucesso = utf8_encode("Exclusão realizada com sucesso!");
	echo "<script>alert('".$MsgExclusaoSucesso."');</script>";			
	echo "<script>AlterarConteudo('Ferramentas/Destaques/InserirImagens.php','DivInserirImagem','CampoPastaDeConteudoDoDestaque=".$CampoPastaDeConteudoDoDestaque."');</script>";
mysql_Close($ConexaoBanco); ?>