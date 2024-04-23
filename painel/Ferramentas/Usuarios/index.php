<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }
?>
<script language="javascript" type="text/javascript">AlterarConteudo('Ferramentas/Usuarios/ListarUsuarios.php','DivResultadosInternos','');</script>
<script language="javascript" type="text/javascript">window.scrollTo(0,0);</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" class="TextoArial20A">Usu&aacute;rios</td>
  </tr>
  <tr>
    <td><?php if ($ResultadoControleUsuario["NivelDeAcesso"] == 1){?>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td class="FundoLinhas">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><form name="BuscarUsuarios" id="BuscarUsuarios" method="post" onsubmit="return false;" class="FormsSemBordas">
              <table width="100%" border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td width="26%"><span class="TextoVerdana12A">Digite o email ou o nome do usu&aacute;rio:</span></td>
                  <td width="7%">&nbsp;</td>
                  <td width="67%">&nbsp;</td>
                </tr>
                <tr>
                  <td><input name="EmailUsuarios" type="text" class="TextFields" id="EmailUsuarios" size="40" /></td>
                  <td><input type="button" value="Listar usu&aacute;rios" onClick="EnviarFormularios('Ferramentas/Usuarios/ListarUsuarios.php','DivResultadosInternos','CampoBuscaEmailUsuarios='+encodeURIComponent(document.getElementById('EmailUsuarios').value)); document.getElementById('EmailUsuarios').value='';" class="BotaoPadrao"></td>
                  <td align="right"><a href="javascript:void(0);" onclick="AlterarConteudo('Ferramentas/Usuarios/CadastrarNovoUsuario.php','DivResultadosInternos','EmailCadastrante=<?php echo utf8_encode($ResultadoControleUsuario["EmailUsuario"]); ?>');">
                    <input type="button" value="Cadastrar novo usu&aacute;rio"  class="BotaoPadrao"/>
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
      <?php }else{?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="FundoLinhas">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td class="TextoVerdana12B">Somente o administrador do sistema pode alterar todos os usu&aacute;rios, voc&ecirc; tem a permiss&atilde;o apenas para editar seus dados de cadastro.</td>
        </tr>
        <tr>
          <td class="TextoVerdana12A">&nbsp;</td>
        </tr>
        <tr>
          <td class="FundoLinhas">&nbsp;</td>
        </tr>
      </table>
      <?php }?></td>
  </tr>
  <tr>
    <td><div id="DivResultadosInternos"/></td>
  </tr>
</table>
