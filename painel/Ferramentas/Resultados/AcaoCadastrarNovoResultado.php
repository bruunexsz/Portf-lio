<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());
	
$UrlAmigavel = GerarUrlAmigavel(utf8_decode($CampoTituloDoResultado));

$SqlInserirResultado =  sprintf("INSERT INTO cadastroresultado(
						ID,
						AtivacaoDoResultado,
						DataDeCadastroDoResultado,
						DataDoResultado,
						TituloDoResultado,
						LocalDoResultado,
						TextoConteudoDoResultado,
						IDGaleriaDeFotos,
						UrlAmigavel
						)
						VALUES(
						'',
						'1',
						'".strftime("%Y-%m-%d %H:%M:%S")."',
						'%s',
						'%s',
						'%s',
						'%s',
						'%d',
						'%s'
						)",
						mysql_real_escape_string(utf8_decode($CampoAnoDoResultado).'-'.utf8_decode($CampoMesDoResultado).'-'.utf8_decode($CampoDiaDoResultado)),
						FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoTituloDoResultado))),
						FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoLocalDoResultado))),
						mysql_real_escape_string(utf8_decode($CampoTextAreaBBCode)),
						FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoGaleriaDeFotosDoResultado))),
						FiltrarCampos(mysql_real_escape_string(utf8_decode($UrlAmigavel)))
						);
$ResultadoInserirResultado = mysql_query($SqlInserirResultado) or die (mysql_error());	

echo "<script>alert('Cadastro realizado com sucesso!');</script>";
echo "<script>AlterarConteudo('Ferramentas/Resultados/ListarResultado.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>