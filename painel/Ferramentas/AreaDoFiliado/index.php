<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }
?>
<script language="javascript" type="text/javascript">window.scrollTo(0,0);</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" class="TextoArial20A">&Aacute;rea do filiado</td>
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
          <td align="center" class="TextoVerdana12A">Escolha uma das op&ccedil;&otilde;es abaixo</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><table width="470" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="150" height="109"><table width="149" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuGrande">
                                      <tr>
                                        <td width="149" height="105" onclick="AlterarConteudo('Ferramentas/AreaDoFiliado/Filiados/index.php','ConteudoInterno','');">Filiados</td>
                    </tr>
                </table></td>
              <td width="10">&nbsp;</td>
              <td width="150" height="109"><table width="149" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuGrande">
                <tr>
                  <td width="149" height="105" onclick="AlterarConteudo('Ferramentas/AreaDoFiliado/Mensagens/index.php','ConteudoInterno','');">Mensagens</td>
                </tr>
              </table></td>
              <td width="10">&nbsp;</td>
              <td width="150" height="109"><table width="149" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuGrande">
                <tr>
                  <td width="149" height="105" onclick="AlterarConteudo('Ferramentas/AreaDoFiliado/Fichas/index.php','ConteudoInterno','');">Fichas de<br />
                    inscri&ccedil;&atilde;o</td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" class="FundoLinhas">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><div id="DivResultadosInternos"/></td>
  </tr>
</table>
