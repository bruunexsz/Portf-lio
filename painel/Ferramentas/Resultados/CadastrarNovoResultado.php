<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$SelectGalerias = "SELECT cadastrogaleria.ID,
		cadastrogaleria.AtivacaoDaGaleria,
		cadastrogaleria.TituloDaGaleria			
	FROM ".BANCO.".cadastrogaleria
	WHERE cadastrogaleria.AtivacaoDaGaleria  = '1'
	ORDER BY ID desc";
	$ResultadoGalerias = mysql_query($SelectGalerias) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($ResultadoGalerias)){			
		$BuscaMostrarGalerias[$nCount]["ID"                       ] = trim($row[0]);
		$BuscaMostrarGalerias[$nCount]["AtivacaoDaGaleria"        ] = trim($row[1]);			
		$BuscaMostrarGalerias[$nCount]["TituloDaGaleria"          ] = trim($row[2]);		
	$nCount++;
	}
mysql_Free_Result($ResultadoGalerias);

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="1"></td>
  </tr>
  <tr>
    <td height="20" class="TextoVerdana12B">Aten&ccedil;&atilde;o, voc&ecirc; ir&aacute; cadastrar um novo resultado, preencha os campos abaixo e clique em enviar.</td>
  </tr>
  <tr>
    <td class="FundoLinhas">&nbsp;</td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td><!--/INICIO FORM CADASTRO RESULTADOS/-->
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><!--//-->
            
            <form id="FormCadastro" name="FormCadastro" method="post" enctype="multipart/form-data" class="FormsSemBordas" onsubmit="return false;">
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table border="0" cellpadding="0" cellspacing="3">
                      <tr>
                        <td class="TextoVerdana12A">Data de acontecimento:</td>
                      </tr>
                      <tr>
                        <td height="3" class="TextoVerdana12A"></td>
                      </tr>
                      <tr>
                        <td class="TextoVerdana12A"><input type="hidden" value="" id="ValorDiaDoResultado" />
                          <input type="hidden" value="" id="ValorMesDoResultado" />
                          <input type="hidden" value="" id="ValorAnoDoResultado" />
                          <select name="DiaDoResultado" id="DiaDoResultado" class="TextFields" onchange="document.getElementById('ValorDiaDoResultado').value = this.options[this.selectedIndex].value">
                            <option value="">Dia</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                          </select>
                          /
                          <select name="MesDoResultado" id="MesDoResultado" class="TextFields" onchange="document.getElementById('ValorMesDoResultado').value = this.options[this.selectedIndex].value">
                            <option value="">M&ecirc;s</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                          </select>
                          /
                          <select name="AnoDoResultado" id="AnoDoResultado" class="TextFields" onchange="document.getElementById('ValorAnoDoResultado').value = this.options[this.selectedIndex].value">
                            <option value="">Ano</option>
                            <option value="2003">2003</option>
                            <option value="2004">2004</option>
                            <option value="2005">2005</option>
                            <option value="2006">2006</option>
                            <option value="2007">2007</option>
                            <option value="2008">2008</option>
                            <option value="2009">2009</option>
                            <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                          </select></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                  <td height="10"><table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td class="TextoVerdana12A">Fotos do acontecimento:</td>
                      </tr>
                      <tr>
                        <td height="20"><!--/INICIO NOMES DAS GALERIAS/-->
                          
                          <input type="hidden" id="ValorGaleriaDeFotosDoResultado" name="ValorGaleriaDeFotosDoResultado" value="" />
                          <select name="GaleriaDeFotosDoResultado" id="GaleriaDeFotosDoResultado" class="TextFields" onchange="document.getElementById('ValorGaleriaDeFotosDoResultado').value = this.options[this.selectedIndex].value">
                            <option value="">Escolha uma galeria cadastrada</option>
                            <?php for($i=1;$i<=count($BuscaMostrarGalerias);$i++){ ?>
                            <option value="<?php echo $BuscaMostrarGalerias[$i]["ID"]; ?>"><?php echo utf8_encode($BuscaMostrarGalerias[$i]["TituloDaGaleria"]); ?></option>
                            <?php } ?>
                          </select>
                          
                          <!--/FIM DOS NOMES DAS GALERIAS/--></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                  <td height="10" align="left"><table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td class="TextoVerdana12A">Nome do campeonato/exame:</td>
                      </tr>
                      <tr>
                        <td height="20"><input name="TituloDoResultado" type="text" class="TextFields" id="TituloDoResultado" maxlength="88" style="width:660px;" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                  <td height="10" align="left"><table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td class="TextoVerdana12A">Local do campeonato/exame:</td>
                      </tr>
                      <tr>
                        <td height="20"><input name="LocalDoResultado" type="text" class="TextFields" id="LocalDoResultado" maxlength="150" style="width:660px;" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                  <td height="15" align="left"><table cellspacing="0" cellpadding="0" id="TabelaBBCodeConteudo">
                      <tr>
                        <td><table border="0" cellspacing="3" cellpadding="0">
                            <tr>
                              <td class="TextoVerdana12A"><div id="DivTituloVisualizacao" style="display:none">Visualiza&ccedil;&atilde;o do conte&uacute;do do resultado:</div></td>
                            </tr>
                            <tr>
                              <td><div id="DivConteudoResultado" style="display:none; height:200px; overflow:auto; background-color:#FFFFFF; border: 1px solid #666666; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:5px; width:654px; line-height:20px;"></div></td>
                            </tr>
                            <tr>
                              <td height="3"></td>
                            </tr>
                            <tr>
                              <td class="TextoVerdana12A">Conte&uacute;do do resultado:</td>
                            </tr>
                            <tr>
                              <td><div id="DivConteudoBBCode" style="display:block">
                                  <table border="0" cellspacing="0" cellpadding="0" class="BordaBBCode">
                                    <tr>
                                      <td class="BarraDeComandos"><table border="0" cellspacing="3" cellpadding="0">
                                          <tr>
                                            <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/negrito.gif" alt="Negrito" width="20" height="20" border="0" style="cursor:pointer" onclick="BBCode('[b]','[/b]','TextAreaBBCode')"></td>
                                            <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/italico.gif" alt="It&aacute;lico" width="20" height="20" border="0" style="cursor:pointer" onclick="BBCode('[i]','[/i]','TextAreaBBCode')"></td>
                                            <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/sublinhado.gif" alt="Sublinhado" width="20" height="20" border="0" style="cursor:pointer" onclick="BBCode('[u]','[/u]','TextAreaBBCode')"></td>
                                            <td align="center" valign="top"><img src="Img/BBCode/Separador.gif" width="6" height="18"></td>
                                            <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/alinhamentoesquerda.gif" alt="Alinhar a esquerda" width="20" height="20" border="0" style="cursor:pointer" onclick="BBCode('[align=left]','[/align]','TextAreaBBCode')"></td>
                                            <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/centralizado.gif" alt="Centralizar" width="20" height="20" border="0" style="cursor:pointer" onclick="BBCode('[align=center]','[/align]','TextAreaBBCode')"></td>
                                            <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/alinhamentodireita.gif" alt="Alinhar a direita" width="20" height="20" border="0" style="cursor:pointer" onclick="BBCode('[align=right]','[/align]','TextAreaBBCode')"></td>
                                            <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/justificado.gif" alt="Justificar" width="20" height="20" border="0" style="cursor:pointer" onclick="BBCode('[align=justify]','[/align]','TextAreaBBCode')"></td>
                                            <td align="center" valign="top"><img src="Img/BBCode/Separador.gif" width="6" height="18"></td>
                                            <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/InserirImagem-esquerda.gif" alt="Inserir imagem" width="20" height="20" border="0" style="cursor:pointer" onclick="BBCode('[img-left][/img]','','TextAreaBBCode')"></td>
                                            <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/InserirImagem.gif" alt="Inserir imagem" width="20" height="20" border="0" style="cursor:pointer" onclick="BBCode('[img][/img]','','TextAreaBBCode')"></td>
                                            <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/InserirImagem-direita.gif" alt="Inserir imagem" width="20" height="20" border="0" style="cursor:pointer" onclick="BBCode('[img-right][/img]','','TextAreaBBCode')"></td>
                                            <td align="center" valign="top"><img src="Img/BBCode/Separador.gif" width="6" height="18"></td>
                                            <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/Linkar.gif" alt="Inserir imagem" width="20" height="20" border="0" style="cursor:pointer" onclick="BBCode('[url=http://]','[/url]','TextAreaBBCode')"></td>
                                            <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/Linkar-blank.gif" alt="Inserir imagem" width="20" height="20" border="0" style="cursor:pointer" onclick="BBCode('[url-blank=http://]','[/url]','TextAreaBBCode')"></td>
                                            <td align="center" valign="top"><img src="Img/BBCode/Separador.gif" width="6" height="18"></td>
									 		<td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/youtube.gif" alt="Inserir imagem" width="20" height="20" border="0" style="cursor:pointer" onclick="BBCode('[youtube]','[/youtube]','TextAreaBBCode')"></td>
                                            <td align="center" valign="top"><img src="Img/BBCode/Separador.gif" width="6" height="18"></td>
                                            <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/MedalhaDeOuro.gif" alt="Inserir imagem" width="20" height="20" border="0" style="cursor:pointer" onclick="BBCode('[m-ouro]','','TextAreaBBCode')"></td>
                                            <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/MedalhaDePrata.gif" alt="Inserir imagem" width="20" height="20" border="0" style="cursor:pointer" onclick="BBCode('[m-prata]','','TextAreaBBCode')"></td>
                                            <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/MedalhaDeBronze.gif" alt="Inserir imagem" width="20" height="20" border="0" style="cursor:pointer" onclick="BBCode('[m-bronze]','','TextAreaBBCode')"></td>
                                            <td align="center" valign="top"><img src="Img/BBCode/Separador.gif" width="6" height="18"></td>
                                            <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/Topo.gif" alt="Subir ao topo" width="20" height="20" border="0" style="cursor:pointer" onclick="BBCode('[topo]','','TextAreaBBCode')"></td>
                                            <td align="center" valign="top"><img src="Img/BBCode/Separador.gif" width="6" height="18"></td>
                                            <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/visualizar.gif" alt="Inserir imagem" width="20" height="20" border="0" style="cursor:pointer" onclick="VisualizarConteudoBBCode(document.getElementById('TextAreaBBCode').value, 'Resultados','DivTituloVisualizacao','DivConteudoResultado','TabelaBBCodeConteudo');"></td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                    <tr>
                                      <td height="20"><textarea name="TextAreaBBCode" rows="20" cols="91" class="TextAreaBBCode" id="TextAreaBBCode"></textarea></td>
                                    </tr>
                                  </table>
                                </div></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                  <td height="15" align="right"><table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><input type="button" class="BotaoPadrao" 
                                    onClick="
                                     if (ValidarCamposNulos(FormCadastro.DiaDoResultado)){
                                     if (ValidarCamposNulos(FormCadastro.MesDoResultado)){
                                     if (ValidarCamposNulos(FormCadastro.AnoDoResultado)){
                                     if (ValidarCamposNulos(FormCadastro.TituloDoResultado)){
                                     if (ValidarCamposNulos(FormCadastro.TextAreaBBCode)){	                                                                        										
                                     EnviarFormularios('Ferramentas/Resultados/AcaoCadastrarNovoResultado.php','DivResultadosInternos','CampoDiaDoResultado='+encodeURIComponent(document.getElementById('ValorDiaDoResultado').value)+'&CampoMesDoResultado='+encodeURIComponent(document.getElementById('ValorMesDoResultado').value)+'&CampoAnoDoResultado='+encodeURIComponent(document.getElementById('ValorAnoDoResultado').value)+'&CampoTituloDoResultado='+encodeURIComponent(document.getElementById('TituloDoResultado').value)+'&CampoLocalDoResultado='+encodeURIComponent(document.getElementById('LocalDoResultado').value)+'&CampoGaleriaDeFotosDoResultado='+encodeURIComponent(document.getElementById('GaleriaDeFotosDoResultado').value)+'&CampoTextAreaBBCode='+encodeURIComponent(document.getElementById('TextAreaBBCode').value));
                                    }}}}}" value="Enviar"></td>
                        <td><input type="button" class="BotaoPadrao" 
                                    onclick="AlterarConteudo('Ferramentas/Resultados/ListarResultado.php','DivResultadosInternos','');" value="Cancelar" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="15" align="left"></td>
                </tr>
              </table>
            </form>
            
            <!--//--></td>
        </tr>
      </table>
      
      <!--/FIM FORM CADASTRO RESULTADOS/--></td>
  </tr>
</table>
<?php mysql_Close($ConexaoBanco); ?>