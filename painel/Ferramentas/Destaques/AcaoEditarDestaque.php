<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$UpdateDestaques = sprintf("UPDATE ".BANCO.".cadastrodestaque 
			SET cadastrodestaque.TituloDoDestaque = '%s',
				cadastrodestaque.LinkDoDestaque   = '%s',
				cadastrodestaque.TextoConteudoDoDestaque  = '%s',
				cadastrodestaque.ImagemConteudoDoDestaque = '%s'
		  WHERE cadastrodestaque.ID = '%d'",
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoTituloDoDestaque))),
		  mysql_real_escape_string(utf8_decode($CampoLinkDoDestaque)),
		  mysql_real_escape_string(utf8_decode($CampoResumoDoDestaque)),
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoControleNomeEnvioFotos))),
		  FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoIDEditarDestaque)))
		  );
$ResultadoUpdateDestaques = mysql_query($UpdateDestaques) or die (mysql_error());

#chmod ($CaminhoRelativoXmlDestaques, 0777);

/*	$ConsultaGerarXml = @mysql_query("SELECT * FROM destaquerotativo WHERE destaquerotativo.AtivacaoDoDestaque  = '1' ORDER BY ID desc;");
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

$MsgSucesso = utf8_encode("Atualização realizada com sucesso!");
echo "<script>alert('".$MsgSucesso."');</script>";
echo "<script>AlterarConteudo('Ferramentas/Destaques/ListarDestaque.php','DivResultadosInternos','');</script>";
exit(0);
mysql_Close($ConexaoBanco); ?>