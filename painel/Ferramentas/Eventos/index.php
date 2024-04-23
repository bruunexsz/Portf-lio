<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }
?>
<script language="javascript" type="text/javascript">AlterarConteudo('Ferramentas/Eventos/ListarEvento.php','DivResultadosInternos','');</script>
<script language="javascript" type="text/javascript">window.scrollTo(0,0);</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" class="TextoArial20A">Eventos</td>
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
          <td><form name="BuscaPrincipal" id="BuscaPrincipal" method="post" onsubmit="return false;" class="FormsSemBordas">
              <table width="100%" border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td width="26%"><span class="TextoVerdana12A">Digite o t&iacute;tulo do evento cadastrado:</span></td>
                  <td width="7%">&nbsp;</td>
                  <td width="67%">&nbsp;</td>
                </tr>
                <tr>
                  <td><input name="Titulo" type="text" class="TextFields" id="Titulo" size="41" /></td>
                  <td><input type="button" value="Listar eventos" onClick="EnviarFormularios('Ferramentas/Eventos/ListarEvento.php','DivResultadosInternos','CampoBuscaTitulo='+encodeURIComponent(document.getElementById('Titulo').value)); document.getElementById('Titulo').value='';" class="BotaoPadrao"></td>
                  <td align="right"><a href="javascript:void(0);" onclick="AlterarConteudo('Ferramentas/Eventos/CadastrarNovoEvento.php','DivResultadosInternos','');">
                    <input type="button" value="Cadastrar evento"  class="BotaoPadrao"/>
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
