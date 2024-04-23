<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$IDDestaque = rtrim(FiltrarCampos($IDDestaque));
$IDDestaque = ltrim(FiltrarCampos($IDDestaque));

	$ArrayParaSeparar = explode(" ", $IDDestaque);
	for($i = 0; $i < count($ArrayParaSeparar); $i++) {
	$TotalAExcluir = "OR cadastrodestaque.ID = '".FiltrarCampos($ArrayParaSeparar[$i])."' ";
	
	$SQLDeleteDestaques = "UPDATE ".BANCO.".cadastrodestaque 
				SET cadastrodestaque.AtivacaoDoDestaque = '0'							
			  WHERE cadastrodestaque.ID = ''
			  ".$TotalAExcluir."";
	$ResultadoDeleteDestaques = mysql_query($SQLDeleteDestaques) or die (mysql_error());

	###		
	$cSQLSEL = "SELECT cadastrodestaque.ID,								
		cadastrodestaque.PastaDeConteudoDoDestaque
	FROM ".BANCO.".cadastrodestaque
	WHERE cadastrodestaque.ID  = ''
	  ".$TotalAExcluir."";
	$oRSSEL = mysql_query($cSQLSEL) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($oRSSEL)){			
		$BuscaMostrarImagensParaExclusao[$nCount]["ID"                       ] = trim($row[0]);
		$BuscaMostrarImagensParaExclusao[$nCount]["PastaDeConteudoDoDestaque"] = trim($row[1]);
	$nCount++;
	}
	if (!isset($BuscaMostrarImagensParaExclusao[1]["PastaDeConteudoDoDestaque"])) $BuscaMostrarImagensParaExclusao[1]["PastaDeConteudoDoDestaque"] = '';
	$PastaASerRemovida = CAMINHO_RELATIVO_IMAGENS_DESTAQUES.$BuscaMostrarImagensParaExclusao[1]["PastaDeConteudoDoDestaque"];
	
		if(file_exists($PastaASerRemovida)){
			if($PastaASerRemovida != CAMINHO_RELATIVO_IMAGENS_DESTAQUES){
			#echo "PASTA EXISTE";
			chmod ($PastaASerRemovida, 0777);
			removeDirectory($PastaASerRemovida);
			}
		}		
	###
}

/*
	#chmod ($CaminhoRelativoXmlDestaques, 0777);
	$ConsultaGerarXml = @mysql_query("SELECT * FROM destaquerotativo WHERE cadastrodestaque.AtivacaoDoDestaque = '1' ORDER BY ID desc;");
	$ManipuladorDoArquivo = fopen(CAMINHO_RELATIVO_XML_DESTAQUES."destaques.xml","w+");				
	@fwrite($ManipuladorDoArquivo,"<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n<ConteudoPlayer>\n<DestaquesPlayer>\n");
					
	while($Exibir = @mysql_fetch_array($ConsultaGerarXml)){				
	$xml = "\n<Conteudo id=\"".$Exibir[0]."\">\n";
	$xml .= "<Titulo>".$Exibir[3]."</Titulo>\n";
	$xml .= "<Caminho>Img/ConteudoDestaques/".$Exibir[7]."/".$Exibir[8]."</Caminho>\n";
	$xml .= "<Link>".$Exibir[4]."</Link>\n";
	$xml .= "<Tempo>".$Exibir[5]."</Tempo>\n";
	$xml .= "<Texto>".$Exibir[6]."</Texto>\n";				
	$xml .= "</Conteudo>\n";								
	@fwrite($ManipuladorDoArquivo,$xml);
	}
	@fwrite($ManipuladorDoArquivo,"\n</DestaquesPlayer>\n</ConteudoPlayer>");	

#chmod ($CaminhoRelativoXmlDestaques, 0755);

*/

	$MsgExclusaoSucesso = utf8_encode("Exclusão realizada com sucesso!");
	echo "<script>alert('".$MsgExclusaoSucesso."');</script>";			
	echo "<script>AlterarConteudo('Ferramentas/Destaques/index.php','ConteudoInterno','');</script>";
	exit(0);
mysql_Close($ConexaoBanco); ?>
