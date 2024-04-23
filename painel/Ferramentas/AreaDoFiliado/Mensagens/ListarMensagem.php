<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

#DEFININDO O TANTO DE REGISTROS POR P핯INAS
$TamanhoPagina = 41;
#P핯INA A MOSTRAR E O INICIO DO REGISTO A MOSTRAR 
	#INICIO VALIDANDO VARIAVEIS VAZIAS
		if (!isset($_POST["Pagina"])) $_POST["Pagina"] = '';
	#FIM VALIDANDO VARIAVEIS VAZIAS
		$Pagina = $_POST["Pagina"]; 
		if (!$Pagina) { 
		   $Inicio = 0; 
		   $Pagina=1; 
		} 
		else {
		   $Inicio = ($Pagina - 1) * $TamanhoPagina; 
		} 
	#INICIO VALIDANDO VARIAVEIS VAZIAS
		if (!isset($CampoBuscaTituloMensagem)) $CampoBuscaTituloMensagem = '';
	#FIM VALIDANDO VARIAVEIS VAZIAS
if ($CampoBuscaTituloMensagem == ''){

#SELECT PARA SABER O TOTAL DE REGISTROS
$SQLTotalPaginas = "SELECT * from cadastromensagemfiliado 
		 WHERE cadastromensagemfiliado.AtivacaoDaMensagem  = '1'
		 ORDER BY ID desc";
$RSTotalPaginas = mysql_query($SQLTotalPaginas) or die (mysql_error());
$NumeroTotalDeRegistros = mysql_num_rows($RSTotalPaginas); 
$TotalPaginas = ceil($NumeroTotalDeRegistros / $TamanhoPagina);
mysql_Free_Result($RSTotalPaginas);

#INICIO MOSTRAR MENSAGENS SE O CAMPO BUSCA VIER VAZIO COM OS LIMITES DA PAGINA플O
$cSQL = "SELECT cadastromensagemfiliado.ID,
		cadastromensagemfiliado.AtivacaoDaMensagem,
		cadastromensagemfiliado.DataDeCadastroDaMensagem,
		cadastromensagemfiliado.TituloDaMensagem,
		cadastromensagemfiliado.TextoConteudoDaMensagem,
		cadastromensagemfiliado.PastaDeConteudoDaMensagem
	FROM ".BANCO.".cadastromensagemfiliado
	WHERE cadastromensagemfiliado.AtivacaoDaMensagem = 1
	ORDER BY ID desc
	LIMIT ".$Inicio.",".$TamanhoPagina;
	
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
	#FIM MOSTRAR MENSAGENS SE O CAMPO BUSCA VIR VAZIO
	}else{
	#INICIO MOSTRAR MENSAGENS COM PESQUISA
	
#SELECT PARA SABER O TOTAL DE REGISTROS COM FILTRO
$SQLTotalPaginas = sprintf("SELECT * from cadastromensagemfiliado
		 WHERE cadastromensagemfiliado.TituloDaMensagem RLIKE '%s'
		 AND cadastromensagemfiliado.AtivacaoDaMensagem = 1
		 ORDER BY ID desc",
			FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaTituloMensagem)))
			);

$RSTotalPaginas = mysql_query($SQLTotalPaginas) or die (mysql_error());
$NumeroTotalDeRegistros = mysql_num_rows($RSTotalPaginas); 
$TotalPaginas = ceil($NumeroTotalDeRegistros / $TamanhoPagina);
mysql_Free_Result($RSTotalPaginas);
	
		   $cSQL = sprintf("SELECT cadastromensagemfiliado.ID,
				cadastromensagemfiliado.AtivacaoDaMensagem,
				cadastromensagemfiliado.DataDeCadastroDaMensagem,
				cadastromensagemfiliado.TituloDaMensagem,
				cadastromensagemfiliado.TextoConteudoDaMensagem,
				cadastromensagemfiliado.PastaDeConteudoDaMensagem
			FROM ".BANCO.".cadastromensagemfiliado
			WHERE cadastromensagemfiliado.TituloDaMensagem RLIKE '%s'
			AND cadastromensagemfiliado.AtivacaoDaMensagem = 1			
			ORDER BY ID desc
			LIMIT ".$Inicio.",".$TamanhoPagina,
			FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaTituloMensagem)))
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
			#FIM MOSTRAR MENSAGENS COM PESQUISA
	}
?>
<script language="javascript" type="text/javascript">window.scrollTo(0,0);</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php 
	if (!isset($BuscaMostrarMensagens[1]["ID"])) $BuscaMostrarMensagens[1]["ID"] = '';
	if($BuscaMostrarMensagens[1]["ID"] != ''){ ?>
      <form id="FormListarMensagem">
        <table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td width="3%" align="center"><input type="checkbox" name="CheckBoxMaster" id="CheckBoxMaster" class="TextoVerdana12A" onclick="SelecionarTodosCheckBox('FormListarMensagem','chave','CheckBoxMaster','ValoresCheckbox');" /></td>
            <td width="52%" height="20" class="TextoVerdana12A"><strong>T&iacute;tulo</strong></td>
            <td width="15%" align="center" class="TextoVerdana12A"><strong>Cadastro</strong></td>
            <td width="10%" align="center" class="TextoVerdana12A">&nbsp;</td>
            <td colspan="2" align="center" class="TextoVerdana12A"><strong>Usu&aacute;rios</strong></td>
          </tr>
          <tr>
            <td height="5" colspan="6" class="FundoLinhas"></td>
          </tr>
          <?php	for($i=1;$i<=count($BuscaMostrarMensagens);$i++){ ?>
          <tr class="FundoListaConteudo">
            <td width="3%" align="center" style="padding-left:3px;padding-right:3px;"><input type="checkbox" name="chave[]" id="chave[]" class="TextoVerdana12A" value="<?php echo $BuscaMostrarMensagens[$i]["ID"]; ?>" onclick="SelecionarValoresPorCheckBox('FormListarMensagem','chave','ValoresCheckbox');" /></td>
            <td width="52%" height="25" style="padding-left:3px;padding-right:3px;"><?php echo utf8_encode($BuscaMostrarMensagens[$i]["TituloDaMensagem"]); ?></td>
            <td width="15%" align="center" style="padding-left:3px;padding-right:3px;"><?php echo substr(FormataDataBanco($BuscaMostrarMensagens[$i]["DataDeCadastroDaMensagem"]),0,10); ?></td>
            <td width="10%" align="center" style="padding-left:3px;padding-right:3px;"><a href="javascript:void(0);" onclick="EnviarFormularios('Ferramentas/AreaDoFiliado/Mensagens/EditarMensagem.php','DivResultadosInternos','IDMensagem=<?php echo $BuscaMostrarMensagens[$i]["ID"] ?>');" class="LinkBlock">Editar</a></td>
            <td width="10%" align="center" style="padding-left:3px;padding-right:3px;"><a href="javascript:void(0);" onclick="AlterarConteudo('Ferramentas/AreaDoFiliado/Mensagens/EscolherUsuarios.php','DivResultadosInternos','IDMensagem=<?php echo $BuscaMostrarMensagens[$i]["ID"] ?>');" class="LinkBlock">Adicionar</a></td>
            <td width="10%" align="center" style="padding-left:3px;padding-right:3px;"><a href="javascript:void(0);" onclick="AlterarConteudo('Ferramentas/AreaDoFiliado/Mensagens/RemoverUsuarios.php','DivResultadosInternos','IDMensagem=<?php echo $BuscaMostrarMensagens[$i]["ID"] ?>');" class="LinkBlock">Remover</a></td>
          </tr>
          <tr>
            <td colspan="6" class="FundoLinhas" height="3"></td>
          </tr>
          <?php } ?>
          <tr>
            <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td align="left" class="TextoVerdana12A"><table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="6">&nbsp;</td>
                        <td><input type="hidden" id="ValoresCheckbox" />
                          <img src="Img/SetaExcluirValoresSelecionados.gif" alt="" width="14" height="15" />
                          <input type="button" class="BotaoPadrao" value="Excluir mensagens selecionadas" onClick="ConfirmacaoExclusaoPorCheckBox('Ferramentas/AreaDoFiliado/Mensagens/AcaoExcluirMensagem.php','DivResultadosInternos','IDMensagem='+encodeURIComponent(document.getElementById('ValoresCheckbox').value),'ValoresCheckbox');"/></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <?php 
				if ($TotalPaginas > 1){
			   ?>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="2" height="20"></td>
                </tr>
                <tr>
                  <td align="left" class="TextoVerdana12A"><?php echo "Voc&ecirc; est&aacute; na p&aacute;gina<strong> ".$Pagina."</strong> de <strong>".$TotalPaginas."</strong>";?></td>
                  <td align="right" class="TextoVerdana12A">Ir para a p&aacute;gina: 
                    <!--/INICIO DOS LINKS COM PAGINA플O/-->
                    
                    <select id="Paginacao" onchange="AlterarPaginaComPaginacao('Ferramentas/AreaDoFiliado/Mensagens/ListarMensagem.php', this.value, '<?php echo $CampoBuscaTituloMensagem; ?>');" class="TextFields">
                      <option value="" selected="selected">Selecione</option>
                      <?php			 
			   for ($i=1;$i<=$TotalPaginas;$i++){ 
					echo '<option value='.$i.' id="NumeroDaPagina">'.$i.'</option>';
			   }
			 ?>
                    </select></td>
                </tr>
              </table>
              <?php } ?></td>
          </tr>
        </table>
      </form>
      <?php }else{ ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="middle" class="TextoVerdana12B">Nenhuma mensagem foi encontrada!</td>
        </tr>
        <tr>
          <td align="left" height="10"></td>
        </tr>
        <tr>
          <td height="5" align="left" valign="middle" class="FundoLinhas"></td>
        </tr>
      </table>
      <?php } ?></td>
  </tr>
</table>
<?php mysql_Close($ConexaoBanco); ?>
