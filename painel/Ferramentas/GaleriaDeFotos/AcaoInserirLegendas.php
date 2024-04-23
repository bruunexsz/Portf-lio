<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$SqlInserirLegenda = sprintf("UPDATE ".BANCO.".cadastroimagensgalerias
							SET cadastroimagensgalerias.LegendaImagemGaleria = '%s'
							WHERE cadastroimagensgalerias.ID = '%d'",
							FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoLegendaImagem))),
							FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoIDImagem)))
							);
$ResultadoInserirLegenda = mysql_query($SqlInserirLegenda) or die (mysql_error());
echo "<script>AlterarConteudo('Ferramentas/GaleriaDeFotos/InserirLegendas.php','DivLegendasFotos','MensagemStatus='+encodeURIComponent('ok')+'&IDFoto='+encodeURIComponent('".$CampoIDImagem."'));</script>";
mysql_Close($ConexaoBanco); ?>