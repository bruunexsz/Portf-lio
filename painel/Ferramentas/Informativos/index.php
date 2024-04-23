<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }
?>
<script language="javascript" type="text/javascript">AlterarConteudo('Ferramentas/Informativos/ListarEmail.php','DivResultadosInternos','');</script>
<script language="javascript" type="text/javascript">window.scrollTo(0,0);</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" class="TextoArial20A">Informativos</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td class="FundoLinhas">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><form name="BuscarEmails" id="BuscarEmails" method="post" onsubmit="return false;" class="FormsSemBordas">
              <table width="100%" border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td width="26%"><span class="TextoVerdana12A">Digite o e-mail  cadastrado:</span></td>
                  <td width="7%">&nbsp;</td>
                  <td width="67%">&nbsp;</td>
                  <td width="2%">&nbsp;</td>
                  <td width="15%">&nbsp;</td>
                  <td width="2%">&nbsp;</td>
                  <td width="15%">&nbsp;</td>
                </tr>
                <tr>
                  <td><input name="TituloDoEmail" type="text" class="TextFields" id="TituloDoEmail" size="38" /></td>
                  <td><input type="button" value="Listar e-mails" onClick="EnviarFormularios('Ferramentas/Informativos/ListarEmail.php','DivResultadosInternos','CampoBuscaTituloDoEmail='+encodeURIComponent(document.getElementById('TituloDoEmail').value)); document.getElementById('TituloDoEmail').value='';" class="BotaoPadrao"></td>
                  <td align="right"><a href="javascript:void(0);" onclick="AlterarConteudo('Ferramentas/Informativos/CadastrarEmail.php','DivResultadosInternos','');">
                    <input type="button" value="Cadastrar" style="width:90px;" class="BotaoPadrao"/>
                    </a></td>
                  <td width="2%" align="right">&nbsp;</td>
                  <td align="right"><a href="javascript:void(0);" onclick="AlterarConteudo('Ferramentas/Informativos/ExportarEmail.php','DivResultadosInternos','');">
                    <input type="button" value="Exportar" style="width:90px;" class="BotaoPadrao"/>
                    </a></td>
                  <td width="2%" align="right">&nbsp;</td>
                  <td align="right"><a href="javascript:void(0);" onclick="AlterarConteudo('Ferramentas/Informativos/ExcluirEmailEmLote.php','DivResultadosInternos','');">
                    <input type="button" value="Excluir" style="width:90px;" class="BotaoPadrao"/>
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
      </table></td>
  </tr>
  <tr>
    <td><div id="DivResultadosInternos"/></td>
  </tr>
</table>