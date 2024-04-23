<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

	$SelectDestaque = sprintf("SELECT cadastrodestaque.ID,
				cadastrodestaque.AtivacaoDoDestaque,
				cadastrodestaque.TituloDoDestaque,
				cadastrodestaque.LinkDoDestaque,
				cadastrodestaque.TextoConteudoDoDestaque,
				cadastrodestaque.PastaDeConteudoDoDestaque,
				cadastrodestaque.ImagemConteudoDoDestaque	
	FROM ".BANCO.".cadastrodestaque  
	WHERE cadastrodestaque.ID  = '%d'
	LIMIT 1",
	FiltrarCampos(mysql_real_escape_string(utf8_decode($IDDestaque)))
	);
	$ResultadoDestaque = mysql_query($SelectDestaque) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($ResultadoDestaque)){			
		$BuscaMostrarDestaques[$nCount]["ID"                       ] = trim($row[0]);
		$BuscaMostrarDestaques[$nCount]["AtivacaoDoDestaque"       ] = trim($row[1]);
		$BuscaMostrarDestaques[$nCount]["TituloDoDestaque"         ] = trim($row[2]);
		$BuscaMostrarDestaques[$nCount]["LinkDoDestaque"           ] = trim($row[3]);
		$BuscaMostrarDestaques[$nCount]["TextoConteudoDoDestaque"  ] = trim($row[4]);
		$BuscaMostrarDestaques[$nCount]["PastaDeConteudoDoDestaque"] = trim($row[5]);
		$BuscaMostrarDestaques[$nCount]["ImagemConteudoDoDestaque" ] = trim($row[6]);
	$nCount++;
	}
	mysql_Free_Result($ResultadoDestaque);

$PastaDeConteudoDoDestaque = $BuscaMostrarDestaques[1]["PastaDeConteudoDoDestaque"];
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="1" align="center" class="TextoVerdana12B"></td>
  </tr>
  <tr>
    <td height="20" class="TextoVerdana12B"> Aten&ccedil;&atilde;o, voc&ecirc; ir&aacute; alterar o conte&uacute;do do destaque: <?php echo utf8_encode($BuscaMostrarDestaques[1]["TituloDoDestaque"]); ?></td>
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
                  <?php $MsgBotao = utf8_encode("Clique aqui para cadastrar imagens para este destaque. Tamanho obrigatório de 320x255 pixels."); ?>
                  <script type="text/javascript">			
                    var swfu;		
                        var settings = {
                            flash_url : "Inc/SwfUploader/swfupload.swf",
                            upload_url: "Ferramentas/Destaques/UpLoadImagensDestaque.php?PastaDeConteudoDoDestaque=<?php echo $PastaDeConteudoDoDestaque ?>&Controle=<?php echo $ResultadoControleUsuario['ID']; ?>",
                            post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
                            file_size_limit : "10 MB",
                            file_types : "*.JPG",
                            file_types_description : "Arquivos de imagens",
                            file_upload_limit : 10000,
                            file_queue_limit : 1,
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
    <td><!--/INICIO FORM CADASTRO DESTAQUES/-->
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><!--//-->
            <form id="FormCadastrarNovoDestaque" name="FormCadastrarNovoDestaque" action="CadastrarNovoDestaque.php" method="post" enctype="multipart/form-data" class="FormsSemBordas" onsubmit="return false;">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td class="TextoVerdana12A">T&iacute;tulo do destaque:</td>
                      </tr>
                      <tr>
                        <td height="20"><input type="hidden" value="" id="ControleEnvioFotos" />
                          <input type="hidden" value="" id="ControleNomeEnvioFotos" />
                          <input name="TituloDoDestaque" type="text" class="TextFields" id="TituloDoDestaque" style="width:660px;" value="<?php echo utf8_encode($BuscaMostrarDestaques[1]["TituloDoDestaque"]); ?>" maxlength="47" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                  <td><table width="100%" border="0" cellpadding="0" cellspacing="3">
                      <tr>
                        <td class="TextoVerdana12A">Link do destaque:</td>
                      </tr>
                      <tr>
                        <td height="20"><input name="LinkDoDestaque" type="text" class="TextFields" id="LinkDoDestaque" value="<?php echo utf8_encode($BuscaMostrarDestaques[1]["LinkDoDestaque"]); ?>" style="width:660px;" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                  <td><table border="0" cellspacing="3" cellpadding="0">
                    <tr>
                      <td class="TextoVerdana12A">Resumo da destaque:</td>
                    </tr>
                    <tr>
                      <td height="20"><textarea name="ResumoDoDestaque" rows="7" class="TextFields" id="ResumoDoDestaque" style="width:660px;" onKeyUp="LimitarTextArea(ResumoDoDestaque,97);"><?php echo utf8_encode($BuscaMostrarDestaques[1]["TextoConteudoDoDestaque"]); ?></textarea></td>
                    </tr>
                </table></td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
              </table>
            </form>
            <!--//-->
          </td>
        </tr>
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="TextoVerdana11A" align="right">&raquo; <a href="javascript:MostrarDivInserirImagemDestaques('<?php echo $PastaDeConteudoDoDestaque; ?>');" class="TextoVerdana11A">Ativar imagem</a></td>
        </tr>
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td align="left" valign="top" height="50"><!--/INICIO DIV ESCOLHA IMAGENS/-->
            <div class="DivInserirImagem" id="DivInserirImagem" style="display:block"></div>
            <script>MostrarDivInserirImagemDestaques('<?php echo $PastaDeConteudoDoDestaque ?>');</script>
            <!--/FIM DIV ESCOLHA IMAGENS/-->
          </td>
        </tr>
        <tr>
          <td height="15" class="FundoLinhas"></td>
        </tr>
        <tr>
          <td align="right" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
              <tr>
                <td><input type="button" class="BotaoPadrao" 
                                    onClick="if (ValidarCamposNulos(FormCadastrarNovoDestaque.TituloDoDestaque)){
									 if (ValidarCamposNulos(FormCadastrarNovoDestaque.ResumoDoDestaque)){
                                     if (ValidarCamposNulosImagemDestaque(FormCadastrarNovoDestaque.ControleEnvioFotos)){
                                      EnviarFormularios('Ferramentas/Destaques/AcaoEditarDestaque.php','DivResultadosInternos','CampoTituloDoDestaque='+encodeURIComponent(document.getElementById('TituloDoDestaque').value)+'&CampoLinkDoDestaque='+encodeURIComponent(document.getElementById('LinkDoDestaque').value)+'&CampoResumoDoDestaque='+encodeURIComponent(document.getElementById('ResumoDoDestaque').value)+'&CampoControleNomeEnvioFotos='+encodeURIComponent(document.getElementById('ControleNomeEnvioFotos').value)+'&CampoPastaDeConteudoDoDestaque='+encodeURIComponent('<?php echo $PastaDeConteudoDoDestaque; ?>')+'&CampoIDEditarDestaque='+encodeURIComponent('<?php echo utf8_encode($BuscaMostrarDestaques[1]["ID"]); ?>'));
                                    }}}" value="Enviar"></td>
                <td><input type="button" class="BotaoPadrao" 
                                    onclick="AlterarConteudo('Ferramentas/Destaques/ListarDestaque.php','DivResultadosInternos','');" value="Cancelar" /></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
      <!--/FIM FORM CADASTRO DESTAQUES/--></td>
  </tr>
</table>
<?php mysql_Close($ConexaoBanco); ?>