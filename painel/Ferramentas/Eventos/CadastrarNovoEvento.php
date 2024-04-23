<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }
$PastaDeConteudo = strftime("%Y%m%d%H%M%S");
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="1"></td>
  </tr>
  <tr>
    <td height="20" class="TextoVerdana12B">Aten&ccedil;&atilde;o, voc&ecirc; ir&aacute; cadastrar um novo evento, preencha os campos abaixo e clique em enviar.</td>
  </tr>
  <tr>
    <td class="FundoLinhas">&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><!--/INICIO FORM UPLOAD IMAGENS/-->
            <table border="0" width="100%" cellspacing="3" cellpadding="0">
              <tr>
                <td><link href="Css/SwfUploader.css" rel="stylesheet" type="text/css" />
                  <?php $MsgBotao = utf8_encode("Clique aqui para cadastrar as imagens. Largura máxima de 650 pixels."); ?>
                  <script type="text/javascript">			
                    var swfu;		
                        var settings = {
                            flash_url : "Inc/SwfUploader/swfupload.swf",
                            upload_url: "Ferramentas/Eventos/UpLoadImagensEvento.php?PastaDeConteudo=<?php echo $PastaDeConteudo; ?>&Controle=<?php echo $ResultadoControleUsuario['ID']; ?>",
                            post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
                            file_size_limit : "2 MB",
                            file_types : "*.JPG",
                            file_types_description : "Arquivos de imagens",
                            file_upload_limit : 1000,
                            file_queue_limit : 10,
                            custom_settings : {
                                progressTarget : "fsUploadProgress",
                                cancelButtonId : "btnCancel"
                            },
                            debug: false,
            
                            // Button settings
                            button_image_url: "<?php echo CAMINHO_IMAGENS_TEMA; ?>botao-upload-imagens.png",
                            button_width: "670",
                            button_height: "25",
                            button_placeholder_id: "spanButtonPlaceHolder",
                            button_text: '<span class="EstiloBotao"><?php echo $MsgBotao; ?></span>',
                            button_text_style: ".EstiloBotao { font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; }",
                            button_text_left_padding: 10,
                            button_text_top_padding: 3,
                            
                            // The event handler functions are defined in handlers.js
                            file_queued_handler : fileQueued,
                            file_queue_error_handler : fileQueueError,
                            file_dialog_complete_handler : fileDialogComplete,
                            upload_start_handler : uploadStart,
                            upload_progress_handler : uploadProgress,
                            upload_error_handler : uploadError,
                            upload_success_handler : uploadSuccess,
                            upload_complete_handler : uploadComplete,
                            queue_complete_handler : queueComplete	// Queue plugin event
                        };
                        swfu = new SWFUpload(settings);	     
                </script>
                  <div id="content">
                    <div class="fieldset flash" id="fsUploadProgress"></div>
                    <div id="divStatus"></div>
                    <div> <span id="spanButtonPlaceHolder"></span> <span id="btnCancel"></span></div>
                  </div></td>
              </tr>
            </table>
            <!--/FIM FORM UPLOAD IMAGENS/--></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td class="FundoLinhas">&nbsp;</td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td class="TextoVerdana12A" align="right">&raquo; <a href="javascript:MostrarDivInserirImagem('<?php echo $PastaDeConteudo; ?>','Eventos');" class="TextoVerdana11A">Atualizar imagens</a>&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td align="left" valign="top"><!--/INICIO DIV ESCOLHA IMAGENS/-->
      <div class="DivInserirImagem" id="DivInserirImagem" style="display:block"></div>
      <script>MostrarDivInserirImagem('<?php echo $PastaDeConteudo; ?>','Eventos');</script>
      <!--/FIM DIV ESCOLHA IMAGENS/-->
    </td>
  </tr>
  <tr>
    <td height="10" class="FundoLinhas">&nbsp;</td>
  </tr>
  <tr>
    <td><!--/INICIO FORM CADASTRO EVENTOS/-->
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><!--//-->
            <form id="FormCadastro" name="FormCadastro" method="post" enctype="multipart/form-data" class="FormsSemBordas" onsubmit="return false;">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
                  

                    
		<table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td class="TextoComum">Data inicial do evento:</td>
                        <td class="TextoComum">&nbsp;</td>
                        <td class="TextoComum">&nbsp;</td>
                        <td class="TextoComum">&nbsp;</td>
                        <td class="TextoComum">Data final do evento:</td>
                      </tr>
                      <tr>
                        <td height="3" class="TextoComum"></td>
                        <td class="TextoComum"></td>
                        <td class="TextoComum"></td>
                        <td class="TextoComum"></td>
                        <td class="TextoComum"></td>
                      </tr>
                      <tr>
                        <td class="TextoComum"><select name="DiaDoEvento" id="DiaDoEvento" class="TextFields">
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
                          <select name="MesDoEvento" id="MesDoEvento" class="TextFields">
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
                          <select name="AnoDoEvento" id="AnoDoEvento" class="TextFields">
                            <option value="<?php echo strftime("%Y"); ?>" selected="selected"><?php echo strftime("%Y"); ?></option>                           
                          </select></td>
                        <td align="center" class="TextoComum">-</td>
                        <td class="TextoComum"><select name="SeparadorEvento" id="SeparadorEvento" class="TextFields">
                        	<option value="" selected="selected"></option>
                            <option value="a">a</option>
                            <option value="e">e</option>
                          </select></td>
                        <td align="center" class="TextoComum">-</td>
                        <td class="TextoComum"><select name="DiaDoEventoFinal" id="DiaDoEventoFinal" class="TextFields">
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
                          <select name="MesDoEventoFinal" id="MesDoEventoFinal" class="TextFields">
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
                          <select name="AnoDoEventoFinal" id="AnoDoEventoFinal" class="TextFields">
                            <option value="">Ano</option>
                            <option value="<?php echo strftime("%Y"); ?>"><?php echo strftime("%Y"); ?></option>                            
                          </select></td>
                      </tr>
                  </table>
                    
                    
                    
                    </td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                	<td>
                  <table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td class="TextoVerdana12A">T&iacute;tulo do evento:</td>
                      </tr>
                      <tr>
                        <td height="20"><input name="TituloDoEvento" type="text" class="TextFields" id="TituloDoEvento" maxlength="68" style="width:660px;" /></td>
                      </tr>
                    </table>
                    </td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                	<td>
                  <table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td class="TextoVerdana12A">Local do evento:</td>
                      </tr>
                      <tr>
                        <td height="20"><input name="LocalDoEvento" type="text" class="TextFields" id="LocalDoEvento" maxlength="150" style="width:660px;" /></td>
                      </tr>
                    </table>
                    </td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                	<td>
                  <table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td class="TextoVerdana12A">Cartaz do evento: (Tamanho obrigat&oacute;rio de 222x276 pixels)</td>
                      </tr>
                      <tr>
                        <td height="20"><input name="CartazDoEvento" type="text" class="TextFields" onclick="this.select();" id="CartazDoEvento" maxlength="150" style="width:660px;" /></td>
                      </tr>
                    </table>
                    </td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                  <td height="15" align="left"><table cellspacing="0" cellpadding="0" id="TabelaBBCodeConteudo">
                <tr>
                  <td><table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td class="TextoVerdana12A"><div id="DivTituloVisualizacao" style="display:none">Visualiza&ccedil;&atilde;o do conte&uacute;do do evento:</div></td>
                      </tr>
                      <tr>
                        <td><div id="DivConteudoEvento" style="display:none; height:200px; overflow:auto; background-color:#FFFFFF; border: 1px solid #666666; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:5px; width:654px; line-height:20px;"></div></td>
                      </tr>
                      <tr>
                        <td height="3"></td>
                      </tr>
                      <tr>
                        <td class="TextoVerdana12A">Descri&ccedil;&atilde;o do evento:</td>
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
                                      <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/visualizar.gif" alt="Inserir imagem" width="20" height="20" border="0" style="cursor:pointer" onclick="VisualizarConteudoBBCode(document.getElementById('TextAreaBBCode').value, 'Eventos','DivTituloVisualizacao','DivConteudoEvento','TabelaBBCodeConteudo');"></td>
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
                                     if (ValidarCamposNulos(FormCadastro.MesDoEvento)){
                                     if (ValidarCamposNulos(FormCadastro.AnoDoEvento)){
                                     if (ValidarCamposNulos(FormCadastro.TituloDoEvento)){
                                     if (ValidarCamposNulos(FormCadastro.LocalDoEvento)){
                                      EnviarFormularios('Ferramentas/Eventos/AcaoCadastrarNovoEvento.php','DivResultadosInternos','CampoTituloDoEvento='+encodeURIComponent(document.getElementById('TituloDoEvento').value)+'&CampoDiaDoEvento='+encodeURIComponent(document.getElementById('DiaDoEvento').value)+'&CampoMesDoEvento='+encodeURIComponent(document.getElementById('MesDoEvento').value)+'&CampoAnoDoEvento='+encodeURIComponent(document.getElementById('AnoDoEvento').value)+'&CampoDiaDoEventoFinal='+encodeURIComponent(document.getElementById('DiaDoEventoFinal').value)+'&CampoMesDoEventoFinal='+encodeURIComponent(document.getElementById('MesDoEventoFinal').value)+'&CampoAnoDoEventoFinal='+encodeURIComponent(document.getElementById('AnoDoEventoFinal').value)+'&CampoSeparadorEvento='+encodeURIComponent(document.getElementById('SeparadorEvento').value)+'&CampoLocalDoEvento='+encodeURIComponent(document.getElementById('LocalDoEvento').value)+'&CampoTextAreaBBCode='+encodeURIComponent(document.getElementById('TextAreaBBCode').value)+'&CampoCartazDoEvento='+encodeURIComponent(document.getElementById('CartazDoEvento').value)+'&CampoPastaDeConteudoDoEvento='+encodeURIComponent('<?php echo $PastaDeConteudo; ?>'));
                                    }}}}" value="Enviar"></td>
                      <td><input type="button" class="BotaoPadrao" 
                                    onclick="AlterarConteudo('Ferramentas/Eventos/ListarEvento.php','DivResultadosInternos','');" value="Cancelar" /></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td height="15" align="left"></td>
                </tr>
              </table>
            </form>
            <!--//-->          </td>
        </tr>
      </table>
    <!--/FIM FORM CADASTRO EVENTOS/--></td>
  </tr>
</table>
