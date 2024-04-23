<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="1" align="center" class="TextoVerdana12B"></td>
  </tr>
  <tr>
    <td height="20" class="TextoVerdana12B"> Aten&ccedil;&atilde;o, voc&ecirc; ir&aacute; cadastrar um novo usu&aacute;rio no sistema, preencha os campos abaixo e clique em enviar.</td>
  </tr>
  <tr>
    <td class="FundoLinhas">&nbsp;</td>
  </tr>
  <tr>
    <td height="13"></td>
  </tr>
  <tr>
    <td><form  name="FormCadastrarUsuario" id="FormCadastrarUsuario" method="post" class="FormsSemBordas" onsubmit="return false;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td>Nome:</td>
                  <td>Email:</td>
                </tr>
                <tr>
                  <td height="20"><input type="hidden" name="CadastradoPorNovoUsuario" id="CadastradoPorNovoUsuario" value="<?php echo $EmailCadastrante ?>" />
                    <input name="NomeNovoUsuario" type="text" class="TextFields" id="NomeNovoUsuario" style="width:330px;" /></td>
                  <td><input name="EmailNovoUsuario" type="text" class="TextFields" id="EmailNovoUsuario" style="width:320px;" /></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td height="10" align="left" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td align="left" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td>Senha:</td>
                  <td>Redigite a  senha:</td>
                </tr>
                <tr>
                  <td><input name="SenhaNovoUsuario" type="text" class="TextFields" id="SenhaNovoUsuario" style="width:160px;" /></td>
                  <td><input name="RedigiteSenhaNovoUsuario" type="text" class="TextFields" id="RedigiteSenhaNovoUsuario" style="width:160px;" /></td>
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
                                    onClick="if (ValidarCamposNulos(FormCadastrarUsuario.NomeNovoUsuario)){
                                     if (ValidarCamposNulos(FormCadastrarUsuario.EmailNovoUsuario)){
                                     if (ValidarEmail(FormCadastrarUsuario.EmailNovoUsuario)){
                                     if (ValidarCamposNulos(FormCadastrarUsuario.SenhaNovoUsuario)){
                                     if (ValidarCamposNulos(FormCadastrarUsuario.RedigiteSenhaNovoUsuario)){
                                     if (ValidarSenhas(FormCadastrarUsuario.SenhaNovoUsuario,FormCadastrarUsuario.RedigiteSenhaNovoUsuario)){
										EnviarFormularios('Ferramentas/Usuarios/AcaoCadastrarNovoUsuario.php','DivResultadosInternos','CampoCadastradoPorNovoUsuario='+encodeURIComponent(document.getElementById('CadastradoPorNovoUsuario').value)+'&CampoNomeNovoUsuario='+encodeURIComponent(document.getElementById('NomeNovoUsuario').value)+'&CampoEmailNovoUsuario='+encodeURIComponent(document.getElementById('EmailNovoUsuario').value)+'&CampoSenhaNovoUsuario='+encodeURIComponent(document.getElementById('SenhaNovoUsuario').value));
                                    }}}}}}" value="Enviar"></td>
                  <td><input type="button" class="BotaoPadrao" 
                                    onclick="AlterarConteudo('Ferramentas/Usuarios/ListarUsuarios.php','DivResultadosInternos','');" value="Cancelar" /></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td align="left"></td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
