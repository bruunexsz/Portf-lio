<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="1" align="center" class="TextoVerdana12B"></td>
  </tr>
  <tr>
    <td height="20" class="TextoVerdana12B"> Aten&ccedil;&atilde;o, voc&ecirc; ir&aacute; cadastrar um novo filiado no sistema, preencha os campos abaixo e clique em enviar.</td>
  </tr>
  <tr>
    <td class="FundoLinhas">&nbsp;</td>
  </tr>
  <tr>
    <td height="13"></td>
  </tr>
  <tr>
    <td><form  name="FormCadastrarFiliado" id="FormCadastrarFiliado" method="post" class="FormsSemBordas" onsubmit="return false;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td>Nome da associa&ccedil;&atilde;o:</td>
                  <td>Usu&aacute;rio:</td>
                  <td>Email:</td>
                </tr>
                <tr>
                  <td height="20"><input type="hidden" name="CadastradoPorNovoFiliado" id="CadastradoPorNovoFiliado" value="<?php echo $EmailCadastrante; ?>" />
                    <input name="NomeNovoFiliado" type="text" class="TextFields" id="NomeNovoFiliado" style="width:240px;" /></td>
                  <td><input name="LoginNovoFiliado" type="text" class="TextFields" id="LoginNovoFiliado" style="width:160px;" /></td>
                  <td><input name="EmailNovoFiliado" type="text" class="TextFields" id="EmailNovoFiliado" style="width:240px;" /></td>
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
                  <td><input name="SenhaNovoFiliado" type="text" class="TextFields" id="SenhaNovoFiliado" style="width:160px;" /></td>
                  <td><input name="RedigiteSenhaNovoFiliado" type="text" class="TextFields" id="RedigiteSenhaNovoFiliado" style="width:160px;" /></td>
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
                                    onClick="if (ValidarCamposNulos(FormCadastrarFiliado.NomeNovoFiliado)){                                     
                                     if (ValidarCamposNulos(FormCadastrarFiliado.LoginNovoFiliado)){                               
                                     if (ValidarCamposNulos(FormCadastrarFiliado.SenhaNovoFiliado)){
                                     if (ValidarCamposNulos(FormCadastrarFiliado.RedigiteSenhaNovoFiliado)){                                    
                                     if (ValidarSenhas(FormCadastrarFiliado.SenhaNovoFiliado,FormCadastrarFiliado.RedigiteSenhaNovoFiliado)){                                     
										EnviarFormularios('Ferramentas/AreaDoFiliado/Filiados/AcaoCadastrarNovoFiliado.php','DivResultadosInternos','CampoCadastradoPorNovoFiliado='+encodeURIComponent(document.getElementById('CadastradoPorNovoFiliado').value)+'&CampoNomeNovoFiliado='+encodeURIComponent(document.getElementById('NomeNovoFiliado').value)+'&CampoLoginNovoFiliado='+encodeURIComponent(document.getElementById('LoginNovoFiliado').value)+'&CampoEmailNovoFiliado='+encodeURIComponent(document.getElementById('EmailNovoFiliado').value)+'&CampoSenhaNovoFiliado='+encodeURIComponent(document.getElementById('SenhaNovoFiliado').value));
                                    }}}}}" value="Enviar"></td>
                  <td><input type="button" class="BotaoPadrao" 
                                    onclick="AlterarConteudo('Ferramentas/AreaDoFiliado/Filiados/ListarFiliado.php','DivResultadosInternos','');" value="Cancelar" /></td>
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
