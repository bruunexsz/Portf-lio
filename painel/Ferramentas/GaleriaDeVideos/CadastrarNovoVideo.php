<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="1"></td>
  </tr>
  <tr>
    <td height="20" class="TextoVerdana12B">Aten&ccedil;&atilde;o, voc&ecirc; ir&aacute; cadastrar um novo v&iacute;deo, preencha os campos abaixo e clique em enviar.</td>
  </tr>
  <tr>
    <td><!--/INICIO FORM CADASTRO VIDEOS/-->
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><!--//-->
            
            <form id="FormCadastro" name="FormCadastro" method="post" enctype="multipart/form-data" class="FormsSemBordas" onsubmit="return false;">
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                  <td height="10" align="left"><table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td class="TextoVerdana12A">T&iacute;tulo do v&iacute;deo:</td>
                      </tr>
                      <tr>
                        <td height="20"><input name="TituloDoVideo" type="text" class="TextFields" id="TituloDoVideo" maxlength="84" style="width:660px;" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                  <td height="10" align="left"><table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td class="TextoVerdana12A">URL do v&iacute;deo:</td>
                      </tr>
                      <tr>
                        <td height="20"><input name="UrlDoVideo" type="text" class="TextFields" id="UrlDoVideo" style="width:660px;" onclick="this.select();" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                  <tr>
                    <td class="TextoVerdana12A" align="right">&raquo; <a href="javascript:MostrarDivTestarVideo('GaleriaDeVideos',document.getElementById('UrlDoVideo').value);" class="TextoVerdana11A">Testar v&iacute;deo</a>&nbsp;&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="10"></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><!--/INICIO DIV TESTAR VIDEO/-->
                      <div class="DivTestarVideo" id="DivTestarVideo" style="display:block"></div>
                      <script>MostrarDivTestarVideo('GaleriaDeVideos',document.getElementById('UrlDoVideo').value);</script>
                      <!--/FIM DIV TESTAR VIDEO/-->
                    </td>
                  </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                  <td height="15" align="right"><table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><input type="button" class="BotaoPadrao" 
                                    onClick="if (ValidarCamposNulos(FormCadastro.TituloDoVideo)){
                                    if (ValidarCamposNulos(FormCadastro.UrlDoVideo)){
                                     EnviarFormularios('Ferramentas/GaleriaDeVideos/AcaoCadastrarNovoVideo.php','DivResultadosInternos','CampoTituloDoVideo='+encodeURIComponent(document.getElementById('TituloDoVideo').value)+'&CampoUrlDoVideo='+encodeURIComponent(document.getElementById('UrlDoVideo').value));
                                    }}" value="Enviar"></td>
                        <td><input type="button" class="BotaoPadrao" 
                                    onclick="AlterarConteudo('Ferramentas/GaleriaDeVideos/ListarVideo.php','DivResultadosInternos','');" value="Cancelar" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="15" align="left"></td>
                </tr>
              </table>
            </form>
            
            <!--//--></td>
        </tr>
      </table>
      
      <!--/FIM FORM CADASTRO VIDEOS/--></td>
  </tr>
</table>
