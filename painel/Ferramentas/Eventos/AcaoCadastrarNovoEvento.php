<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());
	
$UrlAmigavel = GerarUrlAmigavel(utf8_decode($CampoTituloDoEvento));

if(utf8_decode($CampoAnoDoEvento) != '' && utf8_decode($CampoMesDoEvento) != '' && utf8_decode($CampoDiaDoEvento) != ''){
	$DataDoEvento = utf8_decode($CampoAnoDoEvento)."-".utf8_decode($CampoMesDoEvento)."-".utf8_decode($CampoDiaDoEvento);
}else{
	$DataDoEvento = utf8_decode($CampoAnoDoEvento).'/'.utf8_decode($CampoMesDoEvento).'/00';
}

if(utf8_decode($CampoAnoDoEventoFinal) != '' && utf8_decode($CampoMesDoEventoFinal) != '' && utf8_decode($CampoDiaDoEventoFinal) != ''){
	$DataDoEventoFinal = utf8_decode($CampoAnoDoEventoFinal)."-".utf8_decode($CampoMesDoEventoFinal)."-".utf8_decode($CampoDiaDoEventoFinal);
}else{
	$DataDoEventoFinal = $DataDoEvento;
}
			$SqlInserirEvento = sprintf("INSERT INTO cadastroevento(
									ID,
									AtivacaoDoEvento,
									DataDeCadastroDoEvento,
									DataInicial,
									DataFinal,
									SeparadorData,
									DemaisDatas,
									TituloDoEvento,
									LocalDoEvento,
									TextoConteudoDoEvento,
									PastaDeConteudoDoEvento,
									UrlAmigavel,
									CartazDoEvento
									)
									VALUES(
									'',
									'1',
									'".strftime("%Y-%m-%d %H:%M:%S")."',
									'%s',
									'%s',
									'%s',
									'',
									'%s',
									'%s',
									'%s',
									'%s',
									'%s',
									'%s'
									)",
									mysql_real_escape_string(utf8_decode($DataDoEvento)),
									mysql_real_escape_string(utf8_decode($DataDoEventoFinal)),
									FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoSeparadorEvento))),
									FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoTituloDoEvento))),
									FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoLocalDoEvento))),
									mysql_real_escape_string(utf8_decode($CampoTextAreaBBCode)),
									FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoPastaDeConteudoDoEvento))),
									FiltrarCampos(mysql_real_escape_string(utf8_decode($UrlAmigavel))),
									mysql_real_escape_string(utf8_decode($CampoCartazDoEvento))
									);
			$ResultadoEvento = mysql_query($SqlInserirEvento) or die (mysql_error());	

echo "<script>alert('Cadastro realizado com sucesso!');</script>";
echo "<script>AlterarConteudo('Ferramentas/Eventos/ListarEvento.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>