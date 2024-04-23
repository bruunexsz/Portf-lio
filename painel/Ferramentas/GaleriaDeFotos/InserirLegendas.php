<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

#INICIO SELECT IMAGENS
$SelectLegenda = sprintf("SELECT cadastroimagensgalerias.ID,
	cadastroimagensgalerias.DataDeCadastroDaImagem,
	cadastroimagensgalerias.ImagemConteudoDaGaleria,
	cadastroimagensgalerias.PastaDeConteudoDaGaleria,
	cadastroimagensgalerias.LegendaImagemGaleria
FROM ".BANCO.".cadastroimagensgalerias
WHERE cadastroimagensgalerias.ID = '%d'",
FiltrarCampos(mysql_real_escape_string(utf8_decode($IDFoto)))
);
$ResultadoLegenda = mysql_query($SelectLegenda) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoLegenda)){			
	$BuscaMostrarImagensThumbsLegenda[$nCount]["ID"                      ] = trim($row[0]);
	$BuscaMostrarImagensThumbsLegenda[$nCount]["DataDeCadastroDaImagem"  ] = trim($row[1]);
	$BuscaMostrarImagensThumbsLegenda[$nCount]["ImagemConteudoDaGaleria" ] = trim($row[2]);				
	$BuscaMostrarImagensThumbsLegenda[$nCount]["PastaDeConteudoDaGaleria"] = trim($row[3]);
	$BuscaMostrarImagensThumbsLegenda[$nCount]["LegendaImagemGaleria"    ] = trim($row[4]);	
$nCount++;
}
mysql_Free_Result($ResultadoLegenda);	
#FIM SELECT IMAGENS

$CaminhoImagensGaleriasThumbs = "../../../Img/ConteudoGalerias/";																
$CaminhoDaImagem = $CaminhoImagensGaleriasThumbs."".$BuscaMostrarImagensThumbsLegenda[1]["PastaDeConteudoDaGaleria"]."/".$BuscaMostrarImagensThumbsLegenda[1]["ImagemConteudoDaGaleria"];
if (!isset($MensagemStatus)) $MensagemStatus = '';
?>
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td bgcolor="#FFFFFF"><table border="0" cellpadding="0" cellspacing="3">
        <tr>
          <td class="TextoVerdana12A"><!--//-->
            <table border="0" cellspacing="0" cellpadding="0" style="border:solid 2px; border-color:#FFFFFF">
              <tr>
                <td><table border="0" cellpadding="0" cellspacing="1" bgcolor="#333333">
                    <tr>
                      <td bgcolor="#FFFFFF"><img src="Ferramentas/GaleriaDeFotos/MostrarThumbs.php?Imagem=<?php echo $CaminhoDaImagem; ?>" border="0" /></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <!--//-->
          </td>
          <td height="20" valign="bottom"><table border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td class="TextoVerdana12A"><?php if($MensagemStatus == "ok"){ echo "&raquo; Legenda alterada com sucesso!";} ?></td>
                <td class="TextoVerdana12A">&nbsp;</td>
                <td class="TextoVerdana12A">&nbsp;</td>
              </tr>
              <tr>
                <td height="15" class="TextoVerdana12A"></td>
                <td height="5" class="TextoVerdana12A"></td>
                <td height="5" class="TextoVerdana12A"></td>
              </tr>
              <tr>
                <td class="TextoVerdana12A">Legenda:</td>
                <td class="TextoVerdana12A">&nbsp;</td>
                <td class="TextoVerdana12A">&nbsp;</td>
              </tr>
              <tr>
                <td height="20"><input name="LegendaImagem" type="text" class="TextFields" id="LegendaImagem" style="width:420px;" size="71" maxlength="200" value="<?php echo utf8_encode($BuscaMostrarImagensThumbsLegenda[1]["LegendaImagemGaleria"]); ?>" /></td>
                <td>&nbsp;</td>
                <td><input type="button" class="BotaoPadrao" onclick="AlterarConteudo('Ferramentas/GaleriaDeFotos/AcaoInserirLegendas.php','DivLegendasFotos','CampoLegendaImagem='+encodeURIComponent(document.getElementById('LegendaImagem').value)+'&CampoIDImagem='+encodeURIComponent('<?php echo $BuscaMostrarImagensThumbsLegenda[1]["ID"]; ?>'));" value="Gravar legenda" /></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<?php mysql_Close($ConexaoBanco); ?>