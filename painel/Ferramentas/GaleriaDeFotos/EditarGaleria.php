<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$SelectGaleria = sprintf("SELECT cadastrogaleria.ID,
	cadastrogaleria.AtivacaoDaGaleria,
	cadastrogaleria.DataDeCadastroDaGaleria,
	cadastrogaleria.TituloDaGaleria,
	cadastrogaleria.TextoConteudoDaGaleria,
	cadastrogaleria.PastaDeConteudoDaGaleria,
	cadastrogaleria.UrlAmigavelDaGaleria
FROM ".BANCO.".cadastrogaleria
WHERE cadastrogaleria.ID = '%d'
LIMIT 1",
FiltrarCampos(mysql_real_escape_string(utf8_decode($IDGaleria)))
);	
$ResultadoGaleria = mysql_query($SelectGaleria) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoGaleria)){			
	$BuscaMostrarGalerias[$nCount]["ID"                      ] = trim($row[0]);
	$BuscaMostrarGalerias[$nCount]["AtivacaoDaGaleria"       ] = trim($row[1]);
	$BuscaMostrarGalerias[$nCount]["DataDeCadastroDaGaleria" ] = trim($row[2]);				
	$BuscaMostrarGalerias[$nCount]["TituloDaGaleria"         ] = trim($row[3]);
	$BuscaMostrarGalerias[$nCount]["TextoConteudoDaGaleria"  ] = trim($row[4]);
	$BuscaMostrarGalerias[$nCount]["PastaDeConteudoDaGaleria"] = trim($row[5]);
	$BuscaMostrarGalerias[$nCount]["UrlAmigavelDaGaleria"    ] = trim($row[6]);		
$nCount++;
}
mysql_Free_Result($ResultadoGaleria);

$PastaDeConteudoDaGaleria = $BuscaMostrarGalerias[1]["PastaDeConteudoDaGaleria"];
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="1" align="center" class="TextoVerdana12B"></td>
  </tr>
  <tr>
    <td height="20" class="TextoVerdana12B"> Aten&ccedil;&atilde;o, voc&ecirc; ir&aacute; alterar o conte&uacute;do da galeria: <?php echo utf8_encode($BuscaMostrarGalerias[1]["TituloDaGaleria"]); ?>.</td>
  </tr>
  <tr>
    <td class="FundoLinhas">&nbsp;</td>
  </tr>
  <tr>
    <td><!--/INICIO FORM CADASTRO GALERIAS/-->
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><!--//-->
            
            <form id="FormCadastrarNovaGaleria" name="FormCadastrarNovaGaleria" action="CadastrarNovaGaleria.php" method="post" enctype="multipart/form-data" class="FormsSemBordas">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td class="TextoVerdana12A">T&iacute;tulo da galeria:</td>
                      </tr>
                      <tr>
                        <td height="20"><input type="hidden" value="" id="ControleEnvioFotos" />
                          <input name="TituloDaGaleria" type="text" class="TextFields" id="TituloDaGaleria" value="<?php echo utf8_encode($BuscaMostrarGalerias[1]["TituloDaGaleria"]); ?>" style="width:660px;" size="109" maxlength="95" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                  <td><table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td class="TextoVerdana12A">Resumo da galeria:</td>
                      </tr>
                      <tr>
                        <td height="20"><textarea name="ResumoDaGaleria" rows="7" class="TextFields" id="ResumoDaGaleria" style="width:660px;" onKeyUp="LimitarTextArea(ResumoDaGaleria,250);"><?php echo utf8_encode($BuscaMostrarGalerias[1]["TextoConteudoDaGaleria"]); ?></textarea></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
              </table>
            </form>
            
            <!--//--></td>
        </tr>
        <tr>
          <td align="right" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
              <tr>
                <td><input type="button" class="BotaoPadrao" 
                                    onClick="if (ValidarCamposNulos(FormCadastrarNovaGaleria.TituloDaGaleria)){
                                      EnviarFormularios('Ferramentas/GaleriaDeFotos/AcaoEditarGaleria.php','DivResultadosInternos','CampoTituloDaGaleria='+encodeURIComponent(document.getElementById('TituloDaGaleria').value)+'&CampoResumoDaGaleria='+encodeURIComponent(document.getElementById('ResumoDaGaleria').value)+'&CampoIDEditarGaleria='+encodeURIComponent('<?php echo $BuscaMostrarGalerias[1]["ID"] ?>'));
                                    }" value="Enviar"></td>
                <td><input type="button" class="BotaoPadrao" onclick="AlterarConteudo('Ferramentas/GaleriaDeFotos/ListarGaleria.php','DivResultadosInternos','');" value="Cancelar" /></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
      
      <!--/FIM FORM CADASTRO GALERIAS/--></td>
  </tr>
</table>
<?php mysql_Close($ConexaoBanco); ?>
