<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }
$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$ContarQtdDeRegistrosTotal = "SELECT COUNT(*) FROM ".BANCO.".usuarionewsletter WHERE usuarionewsletter.AtivacaoDosDestinatarios = '1'";
list($TotalDeRegistrosTotal) = mysql_fetch_array(mysql_query($ContarQtdDeRegistrosTotal, $ConexaoBanco));

$ConsultaEmailsExportados = "SELECT exportarusuariosnewsletter.ID,
	exportarusuariosnewsletter.IDUltimoUsuario,
	exportarusuariosnewsletter.QuantidadeExportado
FROM ".BANCO.".exportarusuariosnewsletter";

$ResultadoEmailsExportados = mysql_query($ConsultaEmailsExportados, $ConexaoBanco) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoEmailsExportados)){			
	$BuscaMostrarEmailsExportados[$nCount]["ID"] = trim($row[0]);
	$BuscaMostrarEmailsExportados[$nCount]["IDUltimoUsuario"    ] = trim($row[1]);
	$BuscaMostrarEmailsExportados[$nCount]["QuantidadeExportado"] = trim($row[2]);
$nCount++;
}
mysql_Free_Result($ResultadoEmailsExportados);
if (!isset($BuscaMostrarEmailsExportados[1]["ID"])) $BuscaMostrarEmailsExportados[1]["ID"] = '';
if($BuscaMostrarEmailsExportados[1]["ID"] == ''){
	$TotalEmailExportados = 0;
}else{
	$TotalEmailExportados = $BuscaMostrarEmailsExportados[1]["QuantidadeExportado"];
}

?>
<form id="FormExportarEmail" name="FormExportarEmail" action="ExportarEmail.php" method="post" enctype="multipart/form-data" class="FormsSemBordas" onsubmit="return false;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="1" align="center" class="TextoVerdana12B"></td>
    </tr>
    <tr>
      <td height="20" class="TextoVerdana12B"> Aten&ccedil;&atilde;o, ir&aacute; voc&ecirc; exportar os e-mails cadastrados no sistema. <br />
        <br />
        At&eacute; o momento voc&ecirc; exportou <strong><?php echo number_format($TotalEmailExportados, 0, ",", "."); ?></strong> de <strong><?php echo number_format($TotalDeRegistrosTotal, 0, ",", "."); ?></strong> e-mails, para continuar clique no bot&atilde;o exportar, logo abaixo.</td>
    </tr>
    <tr>
      <td><!--/INICIO FORM CADASTRO EMAILS/-->
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="20" align="left" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td align="center" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td><input type="button" class="BotaoPadrao" 
                                    onClick="
                                     EnviarFormularios('Ferramentas/Informativos/AcaoExportarEmail.php','DivResultadosInternos','');
                                    " value="Exportar"></td>
                  <td><input type="button" class="BotaoPadrao" onclick="AlterarConteudo('Ferramentas/Informativos/ListarEmail.php','DivResultadosInternos','');" value="Cancelar" /></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
        <!--/FIM FORM CADASTRO EMAILS/--></td>
    </tr>
  </table>
</form>
<?php mysql_Close($ConexaoBanco); ?>
