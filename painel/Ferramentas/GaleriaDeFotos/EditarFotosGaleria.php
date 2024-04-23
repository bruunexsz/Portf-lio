<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

	$SelectGaleria = sprintf("SELECT cadastrogaleria.ID,
		cadastrogaleria.AtivacaoDaGaleria,
		cadastrogaleria.DataDeCadastroDaGaleria,
		cadastrogaleria.TituloDaGaleria,
		cadastrogaleria.TextoConteudoDaGaleria,
		cadastrogaleria.PastaDeConteudoDaGaleria,
		cadastrogaleria.UrlAmigavelDaGaleria	
	FROM ".BANCO.".cadastrogaleria
	WHERE cadastrogaleria.ID  = '%d'
	LIMIT 1",
	FiltrarCampos(mysql_real_escape_string(utf8_decode($IDGaleria)))
	);
	$ResultadoGaleria = mysql_query($SelectGaleria) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($ResultadoGaleria)){			
		$BuscaMostrarGalerias[$nCount]["ID"                      ] = trim($row[0]);
		$BuscaMostrarGalerias[$nCount]["AtivacaoDaGaleria"       ] = trim($row[1]);
		$BuscaMostrarGalerias[$nCount]["DataDeCadastroDaGaleria" ] = trim($row[2]);				
		$BuscaMostrarGalerias[$nCount]["TituloDaGaleria"         ] = trim($row[3]);
		$BuscaMostrarGalerias[$nCount]["TextoConteudoDaGaleria"  ] = trim($row[4]);
		$BuscaMostrarGalerias[$nCount]["PastaDeConteudoDaGaleria"] = trim($row[5]);
		$BuscaMostrarGalerias[$nCount]["UrlAmigavelDaGaleria"    ] = trim($row[6]);		
	$nCount++;
	}
	mysql_Free_Result($ResultadoGaleria);
	
#INICIO SELECT IMAGENS
	$SqlListarImagens = sprintf("SELECT cadastroimagensgalerias.ID,
		cadastroimagensgalerias.PastaDeConteudoDaGaleria
	FROM ".BANCO.".cadastroimagensgalerias
	WHERE cadastroimagensgalerias.PastaDeConteudoDaGaleria = '%s'",
	FiltrarCampos(mysql_real_escape_string(utf8_decode($BuscaMostrarGalerias[1]["PastaDeConteudoDaGaleria"])))
	);
	$ResultadoListarImagens = mysql_query($SqlListarImagens) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($ResultadoListarImagens)){			
		$BuscaMostrarImagensThumbs[$nCount]["ID"                      ] = trim($row[0]);
		$BuscaMostrarImagensThumbs[$nCount]["PastaDeConteudoDaGaleria"] = trim($row[1]);
	$nCount++;
	}
#FIM SELECT IMAGENS
$PastaDeConteudoDaGaleria = $BuscaMostrarGalerias[1]["PastaDeConteudoDaGaleria"];
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><!--/INICIO FORM UPLOAD IMAGENS/-->
            
            <table border="0" width="100%" cellspacing="3" cellpadding="0">
              <tr>
                <td><link href="Css/SwfUploader.css" rel="stylesheet" type="text/css" />
                  <?php $MsgBotao = utf8_encode("Clique aqui para cadastrar imagens. Tamanhos: 800x600 pixels, ou proporcionais a este tamanho."); ?>
                  <script type="text/javascript">			
                    var swfu;		
                        var settings = {
                            flash_url : "Inc/SwfUploader/swfupload.swf",
                            upload_url: "Ferramentas/GaleriaDeFotos/UpLoadImagensGaleria.php?PastaDeConteudoDaGaleria=<?php echo $PastaDeConteudoDaGaleria; ?>&Controle=<?php echo $ResultadoControleUsuario['ID']; ?>",
                            post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
                            file_size_limit : "10 MB",
                            file_types : "*.JPG",
                            file_types_description : "Arquivos de imagens",
                            file_upload_limit : 10000,
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
                    <div><span id="spanButtonPlaceHolder"></span><span id="btnCancel"></span></div>
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
    <td><!--/INICIO FORM CADASTRO GALERIAS/-->
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><!--//-->
            
            <form id="FormCadastrarNovaGaleria" name="FormCadastrarNovaGaleria" action="CadastrarNovaGaleria.php" method="post" enctype="multipart/form-data" class="FormsSemBordas">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%" border="0" cellpadding="0" cellspacing="3">
                      <tr>
                        <td height="25" class="TextoVerdana12A"><strong>T&iacute;tulo da galeria</strong>: <?php echo utf8_encode($BuscaMostrarGalerias[1]["TituloDaGaleria"]); ?>
                          <input type="hidden" value="" id="ControleEnvioFotos" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                  <td><table width="100%" border="0" cellpadding="0" cellspacing="3">
                      <tr>
                        <td height="25" class="TextoVerdana12A"><strong>Resumo da galeria</strong>: <?php echo utf8_encode(nl2br($BuscaMostrarGalerias[1]["TextoConteudoDaGaleria"])); ?></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"><a name="001"></a></td>
                </tr>
              </table>
            </form>
            
            <!--//--></td>
        </tr>
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td class="TextoVerdana12A"><div id="DivControleTamanhoLinha">
              <div id="DivLegendasFotos">&raquo; Clique sobre as fotos para adicionar legendas.</div>
            </div></td>
        </tr>
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td height="10" align="left" class="FundoLinhas"></td>
        </tr>
        <tr>
          <td class="TextoVerdana12A" align="right">&raquo; <a href="javascript:MostrarDivInserirImagemGalerias('<?php echo $PastaDeConteudoDaGaleria ?>');" class="TextoVerdana11A">Atualizar imagens</a>&nbsp;&nbsp;</td>
        </tr>
        <tr>
          <td height="25"></td>
        </tr>
        <tr>
          <td align="left" valign="top" height="50"><!--/INICIO DIV ESCOLHA IMAGENS/-->
            
            <div class="DivInserirImagem" id="DivInserirImagem" style="display:block"></div>
            <script>MostrarDivInserirImagemGalerias('<?php echo $PastaDeConteudoDaGaleria; ?>');</script> 
            <!--/FIM DIV ESCOLHA IMAGENS/--></td>
        </tr>
        <tr>
          <td height="15" class="FundoLinhas"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><table border="0" cellspacing="3" cellpadding="0">
              <tr>
                <td><input type="button" class="BotaoPadrao" onclick="AlterarConteudo('Ferramentas/GaleriaDeFotos/ListarGaleria.php','DivResultadosInternos','');" value="Clique aqui para voltar" /></td>
              </tr>
            </table></td>
        </tr>
      </table>
      
      <!--/FIM FORM CADASTRO GALERIAS/--></td>
  </tr>
</table>
<?php mysql_Close($ConexaoBanco); ?>
