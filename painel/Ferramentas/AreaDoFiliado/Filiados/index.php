<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }
?>
<script language="javascript" type="text/javascript">AlterarConteudo('Ferramentas/AreaDoFiliado/Filiados/ListarFiliado.php','DivResultadosInternos','');</script>
<script language="javascript" type="text/javascript">window.scrollTo(0,0);</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" class="TextoArial20A">&Aacute;rea do filiado - Filiados</td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td class="FundoLinhas">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><form name="BuscarFiliados" id="BuscarFiliados" method="post" onsubmit="return false;" class="FormsSemBordas">
              <table width="100%" border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td width="26%"><span class="TextoVerdana12A">Digite o login ou nome do filiado:</span></td>
                  <td width="7%">&nbsp;</td>
                  <td width="67%">&nbsp;</td>
                </tr>
                <tr>
                  <td><input name="LoginFiliados" type="text" class="TextFields" id="LoginFiliados" size="40" /></td>
                  <td><input type="button" value="Listar filiados" onClick="EnviarFormularios('Ferramentas/AreaDoFiliado/Filiados/ListarFiliado.php','DivResultadosInternos','CampoBuscaLoginFiliados='+encodeURIComponent(document.getElementById('LoginFiliados').value)); document.getElementById('LoginFiliados').value='';" class="BotaoPadrao"></td>
                  <td align="right"><a href="javascript:void(0);" onclick="AlterarConteudo('Ferramentas/AreaDoFiliado/Filiados/CadastrarNovoFiliado.php','DivResultadosInternos','EmailCadastrante=<?php echo utf8_encode($ResultadoControleUsuario["EmailUsuario"]); ?>');">
                    <input type="button" value="Cadastrar novo filiado"  class="BotaoPadrao"/>
                    </a></td>
                </tr>
              </table>
            </form></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="FundoLinhas">&nbsp;</td>
        </tr>
      </table>
      </td>
  </tr>
  <tr>
    <td><div id="DivResultadosInternos"/></td>
  </tr>
</table>
