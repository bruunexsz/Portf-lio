<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

#INICIO SELECT IMAGENS
	$SelectImagens = sprintf("SELECT cadastroimagensgalerias.ID,
		cadastroimagensgalerias.DataDeCadastroDaImagem,
		cadastroimagensgalerias.ImagemConteudoDaGaleria,
		cadastroimagensgalerias.PastaDeConteudoDaGaleria
	FROM ".BANCO.".cadastroimagensgalerias
	WHERE cadastroimagensgalerias.PastaDeConteudoDaGaleria = '%s'
	ORDER BY ID asc",
	FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoPastaDeConteudoDaGaleria)))
	);
	$ResultadoSelectImagens = mysql_query($SelectImagens) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($ResultadoSelectImagens)){			
		$BuscaMostrarImagensThumbs[$nCount]["ID"                      ] = trim($row[0]);
		$BuscaMostrarImagensThumbs[$nCount]["DataDeCadastroDaImagem"  ] = trim($row[1]);
		$BuscaMostrarImagensThumbs[$nCount]["ImagemConteudoDaGaleria" ] = trim($row[2]);				
		$BuscaMostrarImagensThumbs[$nCount]["PastaDeConteudoDaGaleria"] = trim($row[3]);

	$nCount++;
	}
	mysql_Free_Result($ResultadoSelectImagens);	
#FIM SELECT IMAGENS
#INICIO MOSTRAR IMAGENS
if (!isset($BuscaMostrarImagensThumbs[1]["ID"])) $BuscaMostrarImagensThumbs[1]["ID"] = '';
if($BuscaMostrarImagensThumbs[1]["ID"] == ''){
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="TextoVerdana12B">Nenhuma imagem encontrada!</td>
  </tr>
  <tr>
    <td align="center" height="40">&nbsp;</td>
  </tr>
</table>
<script>ValidarControleImagensGaleria('');</script>
<?php }else{
	$total = 6;
?>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><form id="FormListarImagens">
        <?php
				echo '<table border="0" cellpadding="0" cellspacing="0">';
						echo "<tr>";
						#INICIO VALIDANDO VARIAVEIS VAZIAS
							if (!isset($atual)) $atual = "";
						#FIM VALIDANDO VARIAVEIS VAZIAS 
						for($i=1;$i<=count($BuscaMostrarImagensThumbs);$i++){
							if($total == $atual) {
								echo"</tr><tr>";
							$atual = 0;
							}
								echo "<td align=center>";
								$CaminhoImagensGaleriasThumbs = "../../../Img/ConteudoGalerias/";																
								$CaminhoDaImagem = $CaminhoImagensGaleriasThumbs."".$CampoPastaDeConteudoDaGaleria."/".$BuscaMostrarImagensThumbs[$i]["ImagemConteudoDaGaleria"];
								?>
        <table border="0" cellspacing="0" cellpadding="0" style="border:solid 2px; border-color:#FFFFFF" id="<?php echo $BuscaMostrarImagensThumbs[$i]["ID"] ?>">
          <tr>
            <td><table border="0" cellpadding="0" cellspacing="1" bgcolor="#333333">
                <tr>
                  <td bgcolor="#FFFFFF"><a href="javascript:void(0);" onclick="AlterarConteudo('Ferramentas/GaleriaDeFotos/InserirLegendas.php','DivLegendasFotos','IDFoto=<?php echo $BuscaMostrarImagensThumbs[$i]["ID"] ?>'); document.getElementById('DivControleTamanhoLinha').style.height = '100px';"><img src="Ferramentas/GaleriaDeFotos/MostrarThumbs.php?Imagem=<?php echo $CaminhoDaImagem; ?>" border="0" /></a></td>
                </tr>
              </table></td>
          </tr>
        </table>
        <table border="0" width="106" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="#E0E0E0" height="25" align="center" valign="middle"><input type="checkbox" name="chave[]" id="chave[]" class="TextoVerdana12A" value="<?php echo $BuscaMostrarImagensThumbs[$i]["ID"]; ?>" onclick="SelecionarValoresPorCheckBox('FormListarImagens','chave','ValoresCheckbox');" /></td>
          </tr>
          <tr>
            <td height="15"></td>
          </tr>
        </table>
        <?php
								echo'</td>';
                                								
							$atual++;
							}

							echo'</tr>';
						echo'</table>';
						?>
      </form></td>
  </tr>
  <tr>
    <td><input type="hidden" id="ValoresCheckbox" /></td>
  </tr>
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td class="TextoVerdana12A" height="25" valign="middle" width="5%"><input type="checkbox" name="CheckBoxMaster" id="CheckBoxMaster" class="TextoVerdana12A" onclick="SelecionarTodosCheckBox('FormListarImagens','chave','CheckBoxMaster','ValoresCheckbox');" /></td>
          <td class="TextoVerdana12A" width="75%">Selecionar todas as fotos</td>
          <td width="20%" align="right"><input type="button" class="BotaoPadrao" value="Excluir imagens selecionadas" onClick="ConfirmacaoExclusaoPorCheckBox('Ferramentas/GaleriaDeFotos/AcaoExcluirImagensGaleria.php','DivInserirImagem','IDImagens='+encodeURIComponent(document.getElementById('ValoresCheckbox').value)+'&CampoPastaDeConteudoDaGaleria='+encodeURIComponent('<?php echo $CampoPastaDeConteudoDaGaleria  ?>'),'ValoresCheckbox');"/></td>
        </tr>
      </table></td>
  </tr>
</table>
<script>ValidarControleImagensGaleria('1');</script>
<?php
}
#FIM MOSTRAR IMAGENS
mysql_Close($ConexaoBanco); ?>
