<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

#INICIO SELECT PARA SABER O TOTAL DE REGISTROS COM FILTRO
$SQLValidarQtd = "SELECT * from cadastrodestaque
		 WHERE cadastrodestaque.AtivacaoDoDestaque = 1";
$RSValidarQtd = mysql_query($SQLValidarQtd) or die (mysql_error());
$NumeroTotalDeRegistros = mysql_num_rows($RSValidarQtd); 
mysql_Free_Result($RSValidarQtd);
#FIM SELECT PARA SABER O TOTAL DE REGISTROS COM FILTRO

?>
<script language="javascript" type="text/javascript">AlterarConteudo('Ferramentas/Destaques/ListarDestaque.php','DivResultadosInternos','');</script>
<script language="javascript" type="text/javascript">window.scrollTo(0,0);</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" class="TextoArial20A">Destaques</td>
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
          <td><form name="BuscarDestaques" id="BuscarDestaques" method="post" onsubmit="return false;" class="FormsSemBordas">
              <table width="100%" border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td width="26%"><span class="TextoVerdana12A">Digite o t&iacute;tulo do destaque cadastrado:</span></td>
                  <td width="7%">&nbsp;</td>
                  <td width="67%">&nbsp;</td>
                </tr>
                <tr>
                  <td><input name="TituloDestaque" type="text" class="TextFields" id="TituloDestaque" size="41" /></td>
                  <td><input type="button" value="Listar destaques" onClick="EnviarFormularios('Ferramentas/Destaques/ListarDestaque.php','DivResultadosInternos','CampoBuscaTituloDestaque='+encodeURIComponent(document.getElementById('TituloDestaque').value)); document.getElementById('TituloDestaque').value='';" class="BotaoPadrao"></td>
                  <td align="right">
                  <?php if($NumeroTotalDeRegistros < 10){ ?>
                  	<a href="javascript:void(0);" onclick="AlterarConteudo('Ferramentas/Destaques/CadastrarNovoDestaque.php','DivResultadosInternos','');"><input type="button" value="Cadastrar novo destaque"  class="BotaoPadrao"/>
                  	</a>
                  <?php }else{ ?>
                  Foi alcan&ccedil;ado o limite de 10 destaques!
                  <?php } ?>
                  </td>
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
<?php mysql_Close($ConexaoBanco); ?>
