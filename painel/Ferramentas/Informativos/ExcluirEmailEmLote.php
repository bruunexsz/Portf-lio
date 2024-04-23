<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }
?>

<form id="FormExcluirEmail" name="FormExcluirEmail" action="ExcluirEmail.php" method="post" enctype="multipart/form-data" class="FormsSemBordas" onsubmit="return false;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="1" align="center" class="TextoVerdana12B"></td>
    </tr>
    <tr>
      <td height="20" class="TextoVerdana12B"> Aten&ccedil;&atilde;o, voc&ecirc; ir&aacute; excluir e-mails no sistema, preencha os campos abaixo e clique em enviar.</td>
    </tr>
    <tr>
      <td class="FundoLinhas">&nbsp;</td>
    </tr>
    <tr>
      <td><!--/INICIO FORM EXCLUSÃO EMAILS/-->
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><table border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td class="TextoVerdana12A">Separador:</td>
                  <td class="TextoVerdana12A"><select name="Separador" id="Separador" class="TextFields" >
                      <option value=";">;</option>
                      <option value=",">,</option>
                      <option value="|">|</option>
                    </select></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td height="15" align="left" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td><table border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td class="TextoVerdana12A">E-mails para exclus&atilde;o:</td>
                </tr>
                <tr>
                  <td height="20"><textarea name="Emails" rows="20" class="TextFields" id="Emails" style="width:660px;"></textarea></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td height="10" align="left" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td align="right" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td><input type="button" class="BotaoPadrao" 
                                    onClick="if (ValidarCamposNulos(FormExcluirEmail.Separador)){
                                    if (ValidarCamposNulos(FormExcluirEmail.Emails)){
                                     EnviarFormularios('Ferramentas/Informativos/AcaoExcluirEmailEmLote.php','DivResultadosInternos','CampoSeparador='+encodeURIComponent(document.getElementById('Separador').value)+'&CampoEmails='+encodeURIComponent(document.getElementById('Emails').value));
                                    }}" value="Enviar"></td>
                  <td><input type="button" class="BotaoPadrao" onclick="AlterarConteudo('Ferramentas/Informativos/ListarEmail.php','DivResultadosInternos','');" value="Cancelar" /></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
        <!--/FIM FORM EXCLUSÃO EMAILS/--></td>
    </tr>
  </table>
</form>
