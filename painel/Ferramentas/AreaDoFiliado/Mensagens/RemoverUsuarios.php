<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

   $cSQL = sprintf("SELECT cadastromensagemfiliado.ID,
		cadastromensagemfiliado.AtivacaoDaMensagem,
		cadastromensagemfiliado.DataDeCadastroDaMensagem,
		cadastromensagemfiliado.TituloDaMensagem,
		cadastromensagemfiliado.TextoConteudoDaMensagem,
		cadastromensagemfiliado.PastaDeConteudoDaMensagem
	FROM ".BANCO.".cadastromensagemfiliado
	WHERE cadastromensagemfiliado.ID  = '%d'
	ORDER BY ID desc",
	FiltrarCampos(mysql_real_escape_string(utf8_decode($IDMensagem)))
	);	
	#echo $cSQL;
	$oRS = mysql_query($cSQL) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($oRS)){			
		$BuscaMostrarMensagens[$nCount]["ID"                        ] = trim($row[0]);
		$BuscaMostrarMensagens[$nCount]["AtivacaoDaMensagem"        ] = trim($row[1]);
		$BuscaMostrarMensagens[$nCount]["DataDeCadastroDaMensagem"  ] = trim($row[2]);	
		$BuscaMostrarMensagens[$nCount]["TituloDaMensagem"          ] = trim($row[3]);				
		$BuscaMostrarMensagens[$nCount]["TextoConteudoDaMensagem"   ] = trim($row[4]);
		$BuscaMostrarMensagens[$nCount]["PastaDeConteudoDaMensagem" ] = trim($row[5]);		
	$nCount++;
	}
	mysql_Free_Result($oRS);

	
	$cSQL = "SELECT cadastrousuariofiliado.ID,
				cadastrousuariofiliado.AtivacaoUsuario,
				cadastrousuariofiliado.LoginUsuario,
				cadastrousuariofiliado.SenhaUsuario,
				cadastrousuariofiliado.EmailUsuario,
				cadastrousuariofiliado.NomeUsuario
			FROM ".BANCO.".cadastrousuariofiliado
			WHERE cadastrousuariofiliado.AtivacaoUsuario  = '1'
			ORDER BY ID desc";
			
			#echo $cSQL;
			$oRS = mysql_query($cSQL) or die (mysql_error());
			$nCount=1;
			while ($row = mysql_fetch_array($oRS)){			
				$BuscaMostrarFiliados[$nCount]["ID"              ] = trim($row[0]);
				$BuscaMostrarFiliados[$nCount]["AtivacaoUsuario" ] = trim($row[1]);
				$BuscaMostrarFiliados[$nCount]["LoginUsuario"    ] = trim($row[2]);
				$BuscaMostrarFiliados[$nCount]["SenhaUsuario"    ] = trim($row[3]);
				$BuscaMostrarFiliados[$nCount]["EmailUsuario"    ] = trim($row[4]);
				$BuscaMostrarFiliados[$nCount]["NomeUsuario"     ] = trim($row[5]);			
			$nCount++;
			}
			mysql_Free_Result($oRS);
			
	#INICIO SELECT ANEXOS	
	$cSQL = sprintf("SELECT cadastroanexomensagensfiliado.ID,
				cadastroanexomensagensfiliado.DataDeCadastroDoAnexo,
				cadastroanexomensagensfiliado.NomeDoAnexoDaMensagem,
				cadastroanexomensagensfiliado.PastaDeConteudoDaMensagem
			FROM ".BANCO.".cadastroanexomensagensfiliado
			WHERE cadastroanexomensagensfiliado.PastaDeConteudoDaMensagem  = '%s'
			ORDER BY ID asc",
			FiltrarCampos(mysql_real_escape_string(utf8_decode($BuscaMostrarMensagens[1]["PastaDeConteudoDaMensagem"])))
			);
			#echo $cSQL;
			$oRS = mysql_query($cSQL) or die (mysql_error());
			$nCount=1;
			while ($row = mysql_fetch_array($oRS)){			
				$BuscaMostrarAnexos[$nCount]["ID"                       ] = trim($row[0]);
				$BuscaMostrarAnexos[$nCount]["DataDeCadastroDoAnexo"    ] = trim($row[1]);
				$BuscaMostrarAnexos[$nCount]["NomeDoAnexoDaMensagem"    ] = trim($row[2]);				
				$BuscaMostrarAnexos[$nCount]["PastaDeConteudoDaMensagem"] = trim($row[3]);
		
			$nCount++;
			}
			mysql_Free_Result($oRS);	
	#FIM SELECT ANEXOS
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="1"></td>
  </tr>
  <tr>
    <td height="20" class="TextoVerdana12B">Aten&ccedil;&atilde;o, voc&ecirc; ir&aacute; remover usu&aacute;rios para a mensagem: <?php echo utf8_encode($BuscaMostrarMensagens[1]["TituloDaMensagem"]); ?></td>
  </tr>
  <tr>
    <td class="FundoLinhas">&nbsp;</td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td><!--/INICIO FORM CADASTRO MENSAGENS/-->
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><!--//-->
            
            <form id="FormEscolherUsuarios" name="FormEscolherUsuarios" method="post" enctype="multipart/form-data" class="FormsSemBordas" onsubmit="return false;">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%" border="0" cellpadding="0" cellspacing="3">
                      <tr>
                        <td class="TextoVerdana12A">
                        <select name="ListaUsuarios[]" size="10" multiple="multiple" style="width:665px;" class="TextoListBox" id="ListaUsuarios">            
            <?php for($i=1;$i<=count($BuscaMostrarFiliados);$i++){
			
                    $cSQL = sprintf("SELECT controlemensagemfiliado.ID,
                        controlemensagemfiliado.IDUsuarioFiliado,
                        controlemensagemfiliado.IDMensagensFiliado
                    FROM ".BANCO.".controlemensagemfiliado
                    WHERE controlemensagemfiliado.IDMensagensFiliado = '%d'
					AND controlemensagemfiliado.IDUsuarioFiliado = '%d'",
					FiltrarCampos(mysql_real_escape_string(utf8_decode($IDMensagem))),
					FiltrarCampos(mysql_real_escape_string(utf8_decode($BuscaMostrarFiliados[$i]["ID"])))
					);
                    
                    #echo $cSQL;
                    $oRS = mysql_query($cSQL) or die (mysql_error());
                    $nCount=1;
                    while ($row = mysql_fetch_array($oRS)){			
                        $BuscaMostrarUsuariosSelecionados[$nCount]["ID"                ] = trim($row[0]);
                        $BuscaMostrarUsuariosSelecionados[$nCount]["IDUsuarioFiliado"  ] = trim($row[1]);
                        $BuscaMostrarUsuariosSelecionados[$nCount]["IDMensagensFiliado"] = trim($row[2]);			
                    $nCount++;
                    }
                    mysql_Free_Result($oRS);
                    ?>
                    
                    <?php 
					if (!isset($BuscaMostrarFiliados[$i]["ID"])) $BuscaMostrarFiliados[$i]["ID"] = '';
					if($BuscaMostrarFiliados[$i]["ID"] == $BuscaMostrarUsuariosSelecionados[1]["IDUsuarioFiliado"]){?> 
                    
						<option value="<?php echo $BuscaMostrarFiliados[$i]["ID"]; ?>"><?php echo utf8_encode($BuscaMostrarFiliados[$i]["NomeUsuario"]); ?></option>
					
					<?php } ?>                    
                
            <?php } ?>
        </select>
                          <input name="ValoresListBox" type="hidden" id="ValoresListBox" value="" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                  <td align="right"><table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><input type="button" class="BotaoPadrao" 
                                            onClick="PegarValoresSelect('ListaUsuarios')
                                              if (ValidarCamposNulosUsuariosFiliados(FormEscolherUsuarios.ValoresListBox)){
                                              EnviarFormularios('Ferramentas/AreaDoFiliado/Mensagens/AcaoRemoverUsuarios.php','DivResultadosInternos','CampoValoresListBox='+encodeURIComponent(document.getElementById('ValoresListBox').value)+'&CampoIDMensagem='+encodeURIComponent('<?php echo $BuscaMostrarMensagens[1]["ID"]; ?>'));                                  
                                            }" value="Remover usu&aacute;rios"></td>
                        <td><input type="button" class="BotaoPadrao" 
                                            onclick="AlterarConteudo('Ferramentas/AreaDoFiliado/Mensagens/ListarMensagem.php','DivResultadosInternos','');" value="Cancelar" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                  <td height="15" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="3">
                      <tr>
                        <td class="TextoVerdana12A"><strong>T&iacute;tulo da mensagem</strong>: <?php echo utf8_encode($BuscaMostrarMensagens[1]["TituloDaMensagem"]); ?></td>
                      </tr>
                      <tr>
                        <td height="10" align="left" class="FundoLinhas"></td>
                      </tr>
                      <tr>
                        <td height="20" class="TextoVerdana12A"><strong>Conte&uacute;do da mensagem</strong>:</td>
                      </tr>
                      <tr>
                        <td height="20" class="TextoVerdana12A"><?php echo utf8_encode(bbcode($BuscaMostrarMensagens[1]["TextoConteudoDaMensagem"])); ?></td>
                      </tr>
                      <tr>
                        <td height="10" align="left" class="FundoLinhas"></td>
                      </tr>
                      <tr>
                        <td height="20" class="TextoVerdana12A"><!--/INICIO DIV VER ANEXOS/-->
                          
                          <div class="DivInserirImagem" id="DivInserirAnexo" style="display:block"></div>
                          <script>MostrarDivInserirAnexoFiliados('<?php echo $BuscaMostrarMensagens[1]["PastaDeConteudoDaMensagem" ]; ?>','AreaDoFiliado/Mensagens');</script> 
                          <!--/FIM DIV VER ANEXOS/--></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
            </form>
            
            <!--//--></td>
        </tr>
      </table>
      
      <!--/FIM FORM CADASTRO MENSAGENS/--></td>
  </tr>
</table>
<?php mysql_Close($ConexaoBanco); ?>
