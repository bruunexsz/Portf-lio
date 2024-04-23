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

$SqlEditar = sprintf("UPDATE ".BANCO.".cadastroevento
						SET cadastroevento.TituloDoEvento        = '%s',							
							cadastroevento.DataInicial           = '%s',
							cadastroevento.DataFinal             = '%s',
							cadastroevento.SeparadorData         = '%s',
							cadastroevento.LocalDoEvento         = '%s',
							cadastroevento.TextoConteudoDoEvento = '%s',
							cadastroevento.UrlAmigavel = '%s',
							cadastroevento.CartazDoEvento = '%s'
					  WHERE cadastroevento.ID = '%d'",
					 FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoTituloDoEvento))),
					 mysql_real_escape_string($DataDoEvento),
					 mysql_real_escape_string($DataDoEventoFinal),
					 FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoSeparadorEvento))),
					 FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoLocalDoEvento))),
					 mysql_real_escape_string(utf8_decode($CampoTextAreaBBCode)),
					 mysql_real_escape_string(utf8_decode($UrlAmigavel)),
					 mysql_real_escape_string(utf8_decode($CampoCartazDoEvento)),
					 FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoIDEditarEvento)))
					 );
			$ResultadoEditar = mysql_query($SqlEditar) or die (mysql_error());

$MsgSucesso = utf8_encode("Atualização realizada com sucesso!");
echo "<script>alert('".$MsgSucesso."');</script>";
echo "<script>AlterarConteudo('Ferramentas/Eventos/ListarEvento.php','DivResultadosInternos','');</script>";
mysql_Close($ConexaoBanco); ?>
