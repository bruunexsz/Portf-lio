<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

#INICIO SELECT IMAGENS
$SelectImagens = sprintf("SELECT cadastroimagensdescricao.ID,
	cadastroimagensdescricao.ImagemConteudoDaDescricao,								
	cadastroimagensdescricao.PastaDeConteudoDaDescricao		
FROM ".BANCO.".cadastroimagensdescricao
WHERE cadastroimagensdescricao.PastaDeConteudoDaDescricao = '%s'			
ORDER BY ID asc",
FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoPastaDeConteudo)))
);
$ResultadoImagens = mysql_query($SelectImagens) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoImagens)){			
	$BuscaMostrarImagensThumbs[$nCount]["ID"             ] = trim($row[0]);
	$BuscaMostrarImagensThumbs[$nCount]["ImagemConteudo" ] = trim($row[1]);
	$BuscaMostrarImagensThumbs[$nCount]["PastaDeConteudo"] = trim($row[2]);

$nCount++;
}
#FIM SELECT IMAGENS
#INICIO MOSTRAR IMAGENS
if (!isset($BuscaMostrarImagensThumbs[1]["ID"])) $BuscaMostrarImagensThumbs[1]["ID"] = '';
if($BuscaMostrarImagensThumbs[1]["ID"] == ''){
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="TextoVerdana12B">Nenhuma imagem encontrada!</td>
  </tr>
  <tr>
    <td height="30" align="center">&nbsp;</td>
  </tr>
</table>
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
								
								$CaminhoImagensThumbs = "../../../Img/ConteudoDescricaoFKP/";																
								$CaminhoDaImagem = $CaminhoImagensThumbs."".$CampoPastaDeConteudo."/".$BuscaMostrarImagensThumbs[$i]["ImagemConteudo"];
								$CaminhoDaImagemInsert = CAMINHO_IMAGENS_DESCRICAO_FKP."".$CampoPastaDeConteudo."/".$BuscaMostrarImagensThumbs[$i]["ImagemConteudo"];
								$CaminhoDaImagemLink = substr(CAMINHO_SITE_GERAL, 7)."Img/ConteudoDescricaoFKP/".$CampoPastaDeConteudo."/".$BuscaMostrarImagensThumbs[$i]["ImagemConteudo"];
								?>
        <table border="0" cellspacing="0" cellpadding="0" id="<?php echo $BuscaMostrarImagensThumbs[$i]["ID"] ?>">
          <tr>
            <td><table border="0" cellspacing="0" cellpadding="0" style="border:solid 2px; border-color:#FFFFFF" id="<?php echo $BuscaMostrarImagensThumbs[$i]["ID"]."DescricaoFKP" ?>">
                <tr>
                  <td><table  border="0" cellpadding="0" cellspacing="1" bgcolor="#000000">
                      <tr>
                        <td bgcolor="#FFFFFF"><a href="javascript:SelecionarImagensBBCode('<?php echo $CaminhoDaImagemLink; ?>','<?php echo $BuscaMostrarImagensThumbs[$i]["ID"]."DescricaoFKP" ?>');"><img src="Ferramentas/DescricaoFKP/MostrarThumbs.php?Imagem=<?php echo $CaminhoDaImagem; ?>" border="0" /></a></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table>
        <table border="0" width="106" cellspacing="0" cellpadding="0">
          <tr>
            <td class="FundoExcluirImagens" align="center" valign="middle"><input type="checkbox" name="chave[]" id="chave[]" class="TextoVerdana12A" value="<?php echo $BuscaMostrarImagensThumbs[$i]["ID"]; ?>" onclick="SelecionarValoresPorCheckBox('FormListarImagens','chave','ValoresCheckbox');" /></td>
          </tr>
          <tr>
            <td height="10"></td>
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
    <td><table width="670" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="5" height="25" valign="middle" class="TextoVerdana12A"><input type="checkbox" name="CheckBoxMaster" id="CheckBoxMaster" class="TextoVerdana12A" onclick="SelecionarTodosCheckBox('FormListarImagens','chave','CheckBoxMaster','ValoresCheckbox');" /></td>
          <td class="TextoVerdana12A">Selecionar todas as fotos</td>
          <td align="right"><input type="button" class="BotaoPadrao" value="Excluir imagens selecionadas" onClick="ConfirmacaoExclusaoPorCheckBox('Ferramentas/DescricaoFKP/AcaoExcluirImagensDescricaoFKP.php','DivInserirImagem','IDImagens='+encodeURIComponent(document.getElementById('ValoresCheckbox').value)+'&CampoPastaDeConteudo='+encodeURIComponent('<?php echo $CampoPastaDeConteudo;  ?>'),'ValoresCheckbox');"/></td>
        </tr>
        <tr>
          <td class="TextoVerdana12A" height="25" valign="middle"><input type="hidden" value="" id="IdTabelaCampoAnterior" /></td>
          <td class="TextoVerdana12A">&nbsp;</td>
          <td align="right">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><table border="0" cellspacing="3" cellpadding="0">
        <tr>
          <td class="TextoVerdana12A">Clique sobre as imagens para visualizar o caminho.</td>
        </tr>
        <tr>
          <td height="20"><input name="CaminhoDaImagem" type="text" class="TextFields" style="width:660px;" id="CaminhoDaImagem" onclick="this.select();" /></td>
        </tr>
      </table></td>
  </tr>
</table>
<?php mysql_Free_Result($ResultadoImagens); }

#FIM MOSTRAR IMAGENS
mysql_Close($ConexaoBanco); ?>
