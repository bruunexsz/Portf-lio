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
    <td height="20" class="TextoVerdana12B">Segue abaixo o conte&uacute;do da p&aacute;gina: Palavra do presidente da Federa&ccedil;&atilde;o de Karat&ecirc; Paulista</td>
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
$SelectPalavraDoPresidente = "SELECT cadastropresidentefkp.ID,
	cadastropresidentefkp.AtivacaoDoPresidente,
	cadastropresidentefkp.UrlAmigavel
FROM ".BANCO.".cadastropresidentefkp
WHERE cadastropresidentefkp.AtivacaoDoPresidente = 1
AND cadastropresidentefkp.ID = 1
LIMIT 1";
$ResultadoPalavraDoPresidente = mysql_query($SelectPalavraDoPresidente) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoPalavraDoPresidente)){			
	$BuscaMostrarPalavraDoPresidente[$nCount]["ID"                  ] = trim($row[0]);
	$BuscaMostrarPalavraDoPresidente[$nCount]["AtivacaoDoPresidente"] = trim($row[1]);
	$BuscaMostrarPalavraDoPresidente[$nCount]["UrlAmigavel"         ] = trim($row[2]);
$nCount++;
}
mysql_Free_Result($ResultadoPalavraDoPresidente);	
#FIM SELECT
?></td>
  </tr>
  <tr>
    <td height="1"></td>
  </tr>
  <tr>
    <td><form id="FormListarPalavraDoPresidente">
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
		  if (!isset($BuscaMostrarPalavraDoPresidente[1]["ID"])) $BuscaMostrarPalavraDoPresidente[1]["ID"] = '';
		  for($i=1;$i<=count($BuscaMostrarPalavraDoPresidente);$i++){ ?>
          <tr class="FundoListaConteudo">
            <td width="80%" style="padding-left:3px;padding-right:3px;">Palavra do presidente da Federa&ccedil;&atilde;o de Karat&ecirc; Paulista</td>
            <td width="10%" align="center" style="padding-left:2px;padding-right:2px;"><a href="<?php echo CAMINHO_SITE_GERAL.'palavra-do-presidente-da-federacao-de-karate-paulista'?>/" target="_blank" class="LinkBlock">Visualizar</a></td>
            <td width="10%" align="center" style="padding-left:2px;padding-right:2px;"><a href="javascript:void(0);" onclick="EnviarFormularios('Ferramentas/PalavraDoPresidente/EditarPalavraDoPresidente.php','DivResultadosInternos','ID=<?php echo $BuscaMostrarPalavraDoPresidente[$i]["ID"] ?>');" class="LinkBlock">Editar</a></td>
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