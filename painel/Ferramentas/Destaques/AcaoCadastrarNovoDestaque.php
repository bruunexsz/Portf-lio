<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$SQLInserirDestaque = sprintf("INSERT INTO cadastrodestaque(
						ID,
						AtivacaoDoDestaque,
						DataDeCadastroDoDestaque,
						TituloDoDestaque,
						LinkDoDestaque,
						TempoDoDestaque,
						TextoConteudoDoDestaque,									
						PastaDeConteudoDoDestaque,
						ImagemConteudoDoDestaque
						)
						VALUES(
						'',
						'1',
						'".strftime("%Y-%m-%d %H:%M:%S")."',
						'%s',
						'%s',
						'',
						'%s',
						'%s',
						'%s'
						)",
				FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoTituloDoDestaque))),
				mysql_real_escape_string(utf8_decode($CampoLinkDoDestaque)),
				mysql_real_escape_string(utf8_decode($CampoResumoDoDestaque)),
				FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoPastaDeConteudoDoDestaque))),
				FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoControleNomeEnvioFotos)))
				);
$ResultadoInserirDestaque = mysql_query($SQLInserirDestaque) or die (mysql_error());
			
#chmod ($CaminhoRelativoXmlDestaques."destaques.xml", 0777);

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

#chmod ($CaminhoRelativoXmlDestaques."destaques.xml", 0755);
*/

echo "<script>alert('Cadastro realizado com sucesso!');</script>";
echo "<script>AlterarConteudo('Ferramentas/Destaques/index.php','ConteudoInterno','');</script>";
exit(0);
mysql_Close($ConexaoBanco); ?>
