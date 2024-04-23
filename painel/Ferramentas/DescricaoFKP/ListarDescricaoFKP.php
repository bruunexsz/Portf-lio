<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());
?>
<script language="javascript" type="text/javascript">window.scrollTo(0,0);</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="20" class="TextoVerdana12B">Segue abaixo o conte&uacute;do da p&aacute;gina: Conhe&ccedil;a a Federa&ccedil;&atilde;o de Karat&ecirc; Paulista</td>
  </tr>
  <tr>
    <td class="FundoLinhas">&nbsp;</td>
  </tr>  
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?php
#INICIO SELECT
$SelectDescriccaoFKP = "SELECT cadastrodescricaofkp.ID,
	cadastrodescricaofkp.AtivacaoDaDescricao,
	cadastrodescricaofkp.UrlAmigavel
FROM ".BANCO.".cadastrodescricaofkp
WHERE cadastrodescricaofkp.AtivacaoDaDescricao = 1
AND cadastrodescricaofkp.ID = 1
LIMIT 1";
$ResultadoDescriccaoFKP = mysql_query($SelectDescriccaoFKP) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoDescriccaoFKP)){			
	$BuscaMostrarDescricaoFKP[$nCount]["ID"                 ] = trim($row[0]);
	$BuscaMostrarDescricaoFKP[$nCount]["AtivacaoDaDescricao"] = trim($row[1]);
	$BuscaMostrarDescricaoFKP[$nCount]["UrlAmigavel"        ] = trim($row[2]);
$nCount++;
}
mysql_Free_Result($ResultadoDescriccaoFKP);	
#FIM SELECT
?></td>
  </tr>
  <tr>
    <td height="1"></td>
  </tr>
  <tr>
    <td><form id="FormListarDescricaoFKP">
        <table width="100%" border="0" cellspacing="2" cellpadding="0">
          
          <tr>
            <td width="80%" class="TextoVerdana12A"><strong>T&iacute;tulo</strong></td>
            <td width="10%" align="center">&nbsp;</td>
            <td width="10%" align="center">&nbsp;</td>
          </tr>
          <tr>
            <td height="3" colspan="3" class="FundoLinhas"></td>
          </tr>
          <?php	
		  if (!isset($BuscaMostrarDescricaoFKP[1]["ID"])) $BuscaMostrarDescricaoFKP[1]["ID"] = '';
		  for($i=1;$i<=count($BuscaMostrarDescricaoFKP);$i++){ ?>
          <tr class="FundoListaConteudo">
            <td width="80%" style="padding-left:3px;padding-right:3px;">Conhe&ccedil;a a Federa&ccedil;&atilde;o de Karat&ecirc; Paulista</td>
            <td width="10%" align="center" style="padding-left:2px;padding-right:2px;"><a href="<?php echo CAMINHO_SITE_GERAL.'conheca-a-federacao-de-karate-paulista'?>/" target="_blank" class="LinkBlock">Visualizar</a></td>
            <td width="10%" align="center" style="padding-left:2px;padding-right:2px;"><a href="javascript:void(0);" onclick="EnviarFormularios('Ferramentas/DescricaoFKP/EditarDescricaoFKP.php','DivResultadosInternos','ID=<?php echo $BuscaMostrarDescricaoFKP[$i]["ID"] ?>');" class="LinkBlock">Editar</a></td>
          </tr>
          <tr>
            <td colspan="3" class="FundoLinhas" height="3"></td>
          </tr>
          <?php } ?>
        </table>
      </form></td>
  </tr>
</table>
<?php mysql_Close($ConexaoBanco); ?>