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
    <td height="20" class="TextoVerdana12B">Aten&ccedil;&atilde;o, voc&ecirc; ir&aacute; cadastrar um novo an&uacute;ncio, preencha os campos abaixo e clique em enviar.</td>
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
                  <?php $MsgBotao = utf8_encode("Clique aqui para cadastrar as imagens. Tamanho obrigatório de 139x116 pixels."); ?>
                  <script type="text/javascript">			
                    var swfu;		
                        var settings = {
                            flash_url : "Inc/SwfUploader/swfupload.swf",
                            upload_url: "Ferramentas/Publicidade/UpLoadImagensPublicidade.php?PastaDeConteudo=<?php echo $PastaDeConteudo; ?>&Controle=<?php echo $ResultadoControleUsuario['ID']; ?>",
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
    <td class="TextoVerdana12A" align="right">&raquo; <a href="javascript:MostrarDivInserirImagem('<?php echo $PastaDeConteudo; ?>','Publicidade');" class="TextoVerdana11A">Atualizar imagens</a>&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td align="left" valign="top"><!--/INICIO DIV ESCOLHA IMAGENS/-->
      <div class="DivInserirImagem" id="DivInserirImagem" style="display:block"></div>
      <script>MostrarDivInserirImagem('<?php echo $PastaDeConteudo; ?>','Publicidade');</script>
      <!--/FIM DIV ESCOLHA IMAGENS/-->
    </td>
  </tr>
  <tr>
    <td height="10" class="FundoLinhas">&nbsp;</td>
  </tr>
  <tr>
    <td><!--/INICIO FORM CADASTRO PUBLICIDADE/-->
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><!--//-->
            <form id="FormCadastro" name="FormCadastro" method="post" enctype="multipart/form-data" class="FormsSemBordas" onsubmit="return false;">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td class="TextoVerdana12A">T&iacute;tulo do an&uacute;ncio: 
                          <input type="hidden" id="ControleAnunciante" name="ControleAnunciante" /></td>
                      </tr>
                      <tr>
                        <td height="20"><input name="TituloPrincipal" type="text" class="TextFields" id="TituloPrincipal" maxlength="150" style="width:660px;" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                  <td height="10" align="left"><table border="0" cellspacing="3" cellpadding="0">
                    <tr>
                      <td class="TextoVerdana12A">Site do an&uacute;ncio:</td>
                    </tr>
                    <tr>
                      <td height="20"><input name="SiteAnunciante" type="text" class="TextFields" id="SiteAnunciante" style="width:660px;" value="http://" maxlength="150" /></td>
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
                                     onclick="
                                      if (ValidarCamposNulosImagensPublicidade(FormCadastro.ControleAnunciante)){
                                     if (ValidarCamposNulos(FormCadastro.TituloPrincipal)){
									  EnviarFormularios('Ferramentas/Publicidade/AcaoCadastrarNovaPublicidade.php','DivResultadosInternos','CampoTituloPrincipal='+encodeURIComponent(document.getElementById('TituloPrincipal').value)+'&amp;CampoSiteAnunciante='+encodeURIComponent(document.getElementById('SiteAnunciante').value)+'&amp;CampoPastaDeConteudo='+encodeURIComponent('<?php echo $PastaDeConteudo; ?>'));
                                    }}" value="Enviar" /></td>
                      <td><input type="button" class="BotaoPadrao" 
                                    onclick="AlterarConteudo('Ferramentas/Publicidade/ListarPublicidade.php','DivResultadosInternos','');" value="Cancelar" /></td>
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
    <!--/FIM FORM CADASTRO PUBLICIDADE/--></td>
  </tr>
</table>
