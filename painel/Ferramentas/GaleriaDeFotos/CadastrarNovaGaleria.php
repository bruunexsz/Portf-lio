<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$PastaDeConteudoDaGaleria = strftime("%Y%m%d%H%M%S");
?>
<link href="../../Css/Estilos.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="1" align="center" class="TextoVerdana12B"></td>
  </tr>
  <tr>
    <td height="20" class="TextoVerdana12B"> Aten&ccedil;&atilde;o, voc&ecirc; ir&aacute; cadastrar uma nova galeria no sistema, preencha os campos abaixo e clique em enviar.</td>
  </tr>
  <tr>
    <td></td>
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
                        <td height="20"><input name="TituloDaGaleria" type="text" class="TextFields" id="TituloDaGaleria" size="109" maxlength="95" style="width:660px;" /></td>
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
                        <td height="20"><textarea name="ResumoDaGaleria" rows="7" class="TextFields" id="ResumoDaGaleria" style="width:660px;" onKeyUp="LimitarTextArea(ResumoDaGaleria,250);"></textarea></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
            </form>
            
            <!--//--></td>
        </tr>
        <tr>
          <td height="10" class="FundoLinhas"></td>
        </tr>
        <tr>
          <td align="right" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
              <tr>
                <td><input type="button" class="BotaoPadrao" 
                                    onClick="if (ValidarCamposNulos(FormCadastrarNovaGaleria.TituloDaGaleria)){
                                      EnviarFormularios('Ferramentas/GaleriaDeFotos/AcaoCadastrarNovaGaleria.php','DivResultadosInternos','CampoTituloDaGaleria='+encodeURIComponent(document.getElementById('TituloDaGaleria').value)+'&CampoResumoDaGaleria='+encodeURIComponent(document.getElementById('ResumoDaGaleria').value)+'&CampoPastaDeConteudoDaGaleria='+encodeURIComponent('<?php echo $PastaDeConteudoDaGaleria; ?>'));
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
