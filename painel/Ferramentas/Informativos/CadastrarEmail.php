<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }
?>
<form id="FormCadastrarEmail" name="FormCadastrarEmail" action="CadastrarEmail.php" method="post" enctype="multipart/form-data" class="FormsSemBordas" onsubmit="return false;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="1" align="center" class="TextoVerdana12B"></td>
    </tr>
    <tr>
      <td height="20" class="TextoVerdana12B"> Aten&ccedil;&atilde;o, voc&ecirc; ir&aacute; cadastrar e-mails no sistema, preencha os campos abaixo e clique em enviar.</td>
    </tr>
    <tr>
      <td class="FundoLinhas">&nbsp;</td>
    </tr>
    <tr>
      <td><!--/INICIO FORM CADASTRO EMAILS/-->
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
                  <td>&nbsp;</td>
                  <td class="TextoVerdana12A">Tipo de cadastro:</td>
                  <td class="TextoVerdana12A"><select name="TipoDeCadastro" id="TipoDeCadastro" class="TextFields" onchange="javascript:AvisoCadastroDeEmails(this.value);">
                      <option value="" selected="selected">Selecione</option>
                      <option value="0">Com nome</option>
                      <option value="1">Somente e-mails</option>
                    </select></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td height="15" align="left" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td class="TextoVerdana12A">
            <div id="DivComNomes" style="display:none; height:85px;">
            <font class="TextoVerdana12B"><strong>Informa&ccedil;&atilde;o</strong></font>: Cadastre utilizando o seguinte formato, "<i>nome/email</i>". <font class="TextoVerdana12B"><strong>Ex</strong></font>: nome/email@email.com.br;<br /><br />Muita aten&ccedil;&atilde;o aos e-mails inseridos no campo, pois a s&iacute;ntese errada pode cadastrar v&aacute;rios e-mails de forma incorreta.
            </div>
            <div id="SomenteEmails" style="display:none; height:35px;">
            <font class="TextoVerdana12B"><strong>Informa&ccedil;&atilde;o</strong></font>: Cadastre somente os e-mails. <font class="TextoVerdana12B"><strong>Ex</strong></font>: email1@email1.com.br; email2@email2.com.br;
            </div>
            </td>
          </tr>
          <tr>
            <td><table border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td class="TextoVerdana12A">E-mails para cadastro:</td>
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
                                    onClick="if (ValidarCamposNulos(FormCadastrarEmail.Separador)){
                                    if (ValidarCamposNulos(FormCadastrarEmail.TipoDeCadastro)){
                                    if (ValidarCamposNulos(FormCadastrarEmail.Emails)){
                                     EnviarFormularios('Ferramentas/Informativos/AcaoCadastrarEmail.php','DivResultadosInternos','CampoSeparador='+encodeURIComponent(document.getElementById('Separador').value)+'&CampoEmails='+encodeURIComponent(document.getElementById('Emails').value)+'&CampoTipoDeCadastro='+encodeURIComponent(document.getElementById('TipoDeCadastro').value));
                                    }}}" value="Enviar"></td>
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
