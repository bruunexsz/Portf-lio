<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

#INICIO SELECT CAMPOS PREENCHIDOS
$SelectPalavraDoPresidente = sprintf("SELECT cadastropresidentefkp.ID,
	cadastropresidentefkp.AtivacaoDoPresidente,
	cadastropresidentefkp.TextoConteudoDoPresidente,
	cadastropresidentefkp.PastaDeConteudoDoPresidente,
	cadastropresidentefkp.UrlAmigavel
FROM ".BANCO.".cadastropresidentefkp
WHERE cadastropresidentefkp.AtivacaoDoPresidente = 1
AND cadastropresidentefkp.ID = '%d'
LIMIT 1",
FiltrarCampos(mysql_real_escape_string(utf8_decode(1)))
);
$ResultadoPalavraDoPresidente = mysql_query($SelectPalavraDoPresidente) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoPalavraDoPresidente)){			
	$BuscaMostrarPalavraDoPresidente[$nCount]["ID"                         ] = trim($row[0]);
	$BuscaMostrarPalavraDoPresidente[$nCount]["AtivacaoDoPresidente"       ] = trim($row[1]);
	$BuscaMostrarPalavraDoPresidente[$nCount]["TextoConteudoDoPresidente"  ] = trim($row[2]);
	$BuscaMostrarPalavraDoPresidente[$nCount]["PastaDeConteudoDoPresidente"] = trim($row[3]);
	$BuscaMostrarPalavraDoPresidente[$nCount]["UrlAmigavel"                ] = trim($row[4]);
$nCount++;
}
mysql_Free_Result($ResultadoPalavraDoPresidente);
#FIM SELECT CAMPOS PREENCHIDOS

$PastaDeConteudo = $BuscaMostrarPalavraDoPresidente[1]["PastaDeConteudoDoPresidente"];
$CaminhoDaFerramenta = 'PalavraDoPresidente';
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="1"></td>
  </tr>
  <tr>
    <td height="20" class="TextoVerdana12B"> Aten&ccedil;&atilde;o, voc&ecirc; ir&aacute; editar o conte&uacute;do da p&aacute;gina: Palavra do Presidente da Federa&ccedil;&atilde;o de Karat&ecirc; Paulista</td>
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
                  <?php $MsgBotao = utf8_encode("Clique aqui para cadastrar imagens para a página. A Largura máxima da imagem é de 650px."); ?>
                  <script type="text/javascript">			
                    var swfu;		
                        var settings = {
                            flash_url : "Inc/SwfUploader/swfupload.swf",
                            upload_url: "Ferramentas/PalavraDoPresidente/UpLoadImagensPalavraDoPresidente.php?PastaDeConteudo=<?php echo $PastaDeConteudo; ?>&Controle=<?php echo $ResultadoControleUsuario['ID']; ?>",
                            post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
                            file_size_limit : "10 MB",
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
    <td class="TextoVerdana11A" align="right">&raquo; <a href="javascript:MostrarDivInserirImagem('<?php echo $PastaDeConteudo; ?>','<?php echo $CaminhoDaFerramenta; ?>');" class="TextoVerdana11A">Atualizar imagens</a>&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td align="left" valign="top"><!--/INICIO DIV ESCOLHA IMAGENS/-->
      
      <div class="DivInserirImagem" id="DivInserirImagem" style="display:block"></div>
      <script>MostrarDivInserirImagem('<?php echo $PastaDeConteudo; ?>','<?php echo $CaminhoDaFerramenta; ?>');</script> 
      <!--/FIM DIV ESCOLHA IMAGENS/--></td>
  </tr>
  <tr>
    <td height="10" class="FundoLinhas">&nbsp;</td>
  </tr>
  <tr>
    <td><!--/INICIO FORM CADASTRO DA PÁGINA/-->
      
      <table width="660" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><!--//-->
            
            <form id="FormCadastrarNovoConteudo" name="FormCadastrarNovoConteudo" action="CadastrarNovoConteudo.php" method="post" enctype="multipart/form-data" class="FormsSemBordas" onsubmit="return false;">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="15" align="left"><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><table cellspacing="0" cellpadding="0" id="TabelaBBCodeConteudo">
                            <tr>
                              <td><table border="0" cellspacing="3" cellpadding="0">
                                  <tr>
                                    <td class="TextoVerdana12A"><div id="DivTituloVisualizacao" style="display:none">Visualiza&ccedil;&atilde;o do conte&uacute;do da p&aacute;gina :</div></td>
                                  </tr>
                                  <tr>
                                    <td><div id="DivVisualizarConteudoBBCode" style="display:none; height:200px; overflow:auto; background-color:#FFFFFF; border: 1px solid #666666; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#333333; padding:5px; width:654px; line-height:20px;"></div></td>
                                  </tr>
                                  <tr>
                                    <td height="3"></td>
                                  </tr>
                                  <tr>
                                    <td class="TextoVerdana12A">Conte&uacute;do da p&aacute;gina:</td>
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
                                                  <td align="center" valign="top" class="BotoesBBCode"><img src="Img/BBCode/visualizar.gif" alt="Inserir imagem" width="20" height="20" border="0" style="cursor:pointer" onclick="VisualizarConteudoBBCode(document.getElementById('TextAreaBBCode').value, 'PalavraDoPresidente','DivTituloVisualizacao','DivVisualizarConteudoBBCode','TabelaBBCodeConteudo');"></td>
                                                </tr>
                                              </table></td>
                                          </tr>
                                          <tr>
                                            <td height="20"><textarea name="TextAreaBBCode" rows="20" cols="91" class="TextAreaBBCode" id="TextAreaBBCode"><?php echo utf8_encode($BuscaMostrarPalavraDoPresidente[1]["TextoConteudoDoPresidente"]); ?></textarea></td>
                                          </tr>
                                        </table>
                                      </div></td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
            </form>
            
            <!--//--></td>
        </tr>
        <tr>
          <td height="10" class="FundoLinhas">&nbsp;</td>
        </tr>
        <tr>
          <td align="right" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
              <tr>
                <td><input type="button" class="BotaoPadrao"
                                     onClick="if (ValidarCamposNulos(FormCadastrarNovoConteudo.TextAreaBBCode)){                                     
									  EnviarFormularios('Ferramentas/PalavraDoPresidente/AcaoEditarPalavraDoPresidente.php','DivResultadosInternos','CampoTextAreaBBCode='+encodeURIComponent(document.getElementById('TextAreaBBCode').value)+'&CampoIDDaPagina='+encodeURIComponent('<?php echo $BuscaMostrarPalavraDoPresidente[1]["ID"]; ?>'));
                                    }" value="Enviar"></td>
                <td><input type="button" class="BotaoPadrao" onclick="AlterarConteudo('Ferramentas/PalavraDoPresidente/ListarPalavraDoPresidente.php','DivResultadosInternos','');" value="Cancelar" /></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
      
      <!--/FIM FORM CADASTRO DA PÁGINA/--></td>
  </tr>
</table>
<?php mysql_Close($ConexaoBanco); ?>
