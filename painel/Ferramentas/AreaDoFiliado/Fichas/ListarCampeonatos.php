<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

#DEFININDO O TANTO DE REGISTROS POR P�GINAS
$TamanhoPagina = 30;
#P�GINA A MOSTRAR E O INICIO DO REGISTO A MOSTRAR 
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
		if (!isset($CampoBuscaNomeCampeonato)) $CampoBuscaNomeCampeonato = '';
	#FIM VALIDANDO VARIAVEIS VAZIAS
if ($CampoBuscaNomeCampeonato == ''){

#SELECT PARA SABER O TOTAL DE REGISTROS
$SQLTotalPaginas = "SELECT * from cadastrofiliadosinscricaocampeonatos 
		 WHERE cadastrofiliadosinscricaocampeonatos.AtivacaoFicha  = '1'
		 ORDER BY ID desc";
$RSTotalPaginas = mysql_query($SQLTotalPaginas) or die (mysql_error());
$NumeroTotalDeRegistros = mysql_num_rows($RSTotalPaginas); 
$TotalPaginas = ceil($NumeroTotalDeRegistros / $TamanhoPagina);
mysql_Free_Result($RSTotalPaginas);

#INICIO MOSTRAR MENSAGENS SE O CAMPO BUSCA VIER VAZIO COM OS LIMITES DA PAGINA��O
$cSQL = "SELECT cadastrofiliadosinscricaocampeonatos.ID,		
		cadastrofiliadosinscricaocampeonatos.AtivacaoFicha,
		cadastrofiliadosinscricaocampeonatos.DataPreenchimento,
		cadastrofiliadosinscricaocampeonatos.NomeCampeonato,
		cadastrofiliadosinscricaocampeonatos.NomeAssociacao,
		cadastrofiliadosinscricaocampeonatos.FichaLida
	FROM ".BANCO.".cadastrofiliadosinscricaocampeonatos
	WHERE cadastrofiliadosinscricaocampeonatos.AtivacaoFicha = 1
	ORDER BY ID desc
	LIMIT ".$Inicio.",".$TamanhoPagina;
	
	#echo $cSQL;
	$oRS = mysql_query($cSQL) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($oRS)){			
		$BuscaMostrarCampeonatos[$nCount]["ID"               ] = trim($row[0]);
		$BuscaMostrarCampeonatos[$nCount]["AtivacaoFicha"    ] = trim($row[1]);
		$BuscaMostrarCampeonatos[$nCount]["DataPreenchimento"] = trim($row[2]);
		$BuscaMostrarCampeonatos[$nCount]["NomeCampeonato"   ] = trim($row[3]);
		$BuscaMostrarCampeonatos[$nCount]["NomeAssociacao"   ] = trim($row[4]);
		$BuscaMostrarCampeonatos[$nCount]["FichaLida"        ] = trim($row[5]);
	$nCount++;
	}
	mysql_Free_Result($oRS);	
	#FIM MOSTRAR MENSAGENS SE O CAMPO BUSCA VIR VAZIO
	}else{
	#INICIO MOSTRAR MENSAGENS COM PESQUISA
	
#SELECT PARA SABER O TOTAL DE REGISTROS COM FILTRO
$SQLTotalPaginas = sprintf("SELECT * from cadastrofiliadosinscricaocampeonatos
		 WHERE cadastrofiliadosinscricaocampeonatos.NomeCampeonato RLIKE '%s'
		 AND cadastrofiliadosinscricaocampeonatos.AtivacaoFicha = 1
		 ORDER BY ID desc",
			FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaNomeCampeonato)))
		 );
$RSTotalPaginas = mysql_query($SQLTotalPaginas) or die (mysql_error());
$NumeroTotalDeRegistros = mysql_num_rows($RSTotalPaginas); 
$TotalPaginas = ceil($NumeroTotalDeRegistros / $TamanhoPagina);
mysql_Free_Result($RSTotalPaginas);
	
		$cSQL = sprintf("SELECT cadastrofiliadosinscricaocampeonatos.ID,		
				cadastrofiliadosinscricaocampeonatos.AtivacaoFicha,
				cadastrofiliadosinscricaocampeonatos.DataPreenchimento,
				cadastrofiliadosinscricaocampeonatos.NomeCampeonato,
				cadastrofiliadosinscricaocampeonatos.NomeAssociacao,
				cadastrofiliadosinscricaocampeonatos.FichaLida
			FROM ".BANCO.".cadastrofiliadosinscricaocampeonatos
			WHERE cadastrofiliadosinscricaocampeonatos.NomeCampeonato RLIKE '%s'
			AND cadastrofiliadosinscricaocampeonatos.AtivacaoFicha = 1			
			ORDER BY ID desc
			LIMIT ".$Inicio.",".$TamanhoPagina,
				FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaNomeCampeonato)))
			 );
			
			#echo $cSQL;
			$oRS = mysql_query($cSQL) or die (mysql_error());
			$nCount=1;
			while ($row = mysql_fetch_array($oRS)){			
				$BuscaMostrarCampeonatos[$nCount]["ID"               ] = trim($row[0]);
				$BuscaMostrarCampeonatos[$nCount]["AtivacaoFicha"    ] = trim($row[1]);
				$BuscaMostrarCampeonatos[$nCount]["DataPreenchimento"] = trim($row[2]);	
				$BuscaMostrarCampeonatos[$nCount]["NomeCampeonato"   ] = trim($row[3]);				
				$BuscaMostrarCampeonatos[$nCount]["NomeAssociacao"   ] = trim($row[4]);
				$BuscaMostrarCampeonatos[$nCount]["FichaLida"        ] = trim($row[5]);	
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
	if (!isset($BuscaMostrarCampeonatos[1]["ID"])) $BuscaMostrarCampeonatos[1]["ID"] = '';
	if($BuscaMostrarCampeonatos[1]["ID"] != ''){ ?>
      <form id="FormListarCampeonatos">
        <table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td width="3%" align="center"><input type="checkbox" name="CheckBoxMaster" id="CheckBoxMaster" class="TextoVerdana12A" onclick="SelecionarTodosCheckBox('FormListarCampeonatos','chave','CheckBoxMaster','ValoresCheckbox');" /></td>
            <td width="40%" height="20" class="TextoVerdana12A"><strong>Campeonato</strong></td>
            <td width="33%" align="center" class="TextoVerdana12A"><strong>Associa&ccedil;&atilde;o</strong></td>
            <td width="15%" align="center" class="TextoVerdana12A"><strong>Preenchimento</strong></td>
            <td width="10%" align="center" class="TextoVerdana12A">&nbsp;</td>
          </tr>
          <tr>
            <td height="5" colspan="5" class="FundoLinhas"></td>
          </tr>
          <?php	for($i=1;$i<=count($BuscaMostrarCampeonatos);$i++){ ?>
          <tr class="FundoListaConteudo">
            <td width="3%" align="center" style="padding-left:3px;padding-right:3px;" <?php if($BuscaMostrarCampeonatos[$i]["FichaLida"] == 0){ echo 'bgcolor="#FF8C8C"'; } ?>><input type="checkbox" name="chave[]" id="chave[]" class="TextoVerdana12A" value="<?php echo $BuscaMostrarCampeonatos[$i]["ID"]; ?>" onclick="SelecionarValoresPorCheckBox('FormListarCampeonatos','chave','ValoresCheckbox');" /></td>
            <td width="40%" height="25" style="padding-left:3px;padding-right:3px;" <?php if($BuscaMostrarCampeonatos[$i]["FichaLida"] == 0){ echo 'bgcolor="#FF8C8C"'; } ?>><?php echo utf8_encode($BuscaMostrarCampeonatos[$i]["NomeCampeonato"]); ?></td>
            <td width="33%" align="center" style="padding-left:3px;padding-right:3px;" <?php if($BuscaMostrarCampeonatos[$i]["FichaLida"] == 0){ echo 'bgcolor="#FF8C8C"'; } ?>><?php echo utf8_encode($BuscaMostrarCampeonatos[$i]["NomeAssociacao"]); ?></td>
            <td width="15%" align="center" style="padding-left:3px;padding-right:3px;" <?php if($BuscaMostrarCampeonatos[$i]["FichaLida"] == 0){ echo 'bgcolor="#FF8C8C"'; } ?>><?php echo substr(FormataDataBanco($BuscaMostrarCampeonatos[$i]["DataPreenchimento"]),0,10); ?></td>
            <td width="10%" align="center" style="padding-left:3px;padding-right:3px;" <?php if($BuscaMostrarCampeonatos[$i]["FichaLida"] == 0){ echo 'bgcolor="#FF8C8C"'; } ?>><a href="javascript:void(0);" onclick="EnviarFormularios('Ferramentas/AreaDoFiliado/Fichas/VisualizarCampeonatos.php','DivResultadosInternos','IDCampeonato=<?php echo $BuscaMostrarCampeonatos[$i]["ID"] ?>');" class="LinkBlock">Visualizar</a></td>
          </tr>
          <tr>
            <td colspan="5" class="FundoLinhas" height="3"></td>
          </tr>
          <?php } ?>
          <tr>
            <td colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td align="left" class="TextoVerdana12A"><table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="6">&nbsp;</td>
                        <td><input type="hidden" id="ValoresCheckbox" />
                          <img src="Img/SetaExcluirValoresSelecionados.gif" alt="" width="14" height="15" />
                          <input type="button" class="BotaoPadrao" value="Excluir fichas selecionadas" onClick="ConfirmacaoExclusaoPorCheckBox('Ferramentas/AreaDoFiliado/Fichas/AcaoExcluirCampeonatos.php','DivResultadosInternos','IDCampeonato='+encodeURIComponent(document.getElementById('ValoresCheckbox').value),'ValoresCheckbox');"/></td>
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
                    <!--/INICIO DOS LINKS COM PAGINA��O/-->
                    
                    <select id="Paginacao" onchange="AlterarPaginaComPaginacao('Ferramentas/AreaDoFiliado/Fichas/ListarCampeonatos.php', this.value, '<?php echo $CampoBuscaNomeCampeonato; ?>');" class="TextFields">
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
          <td valign="middle" class="TextoVerdana12B">Nenhum cadastro foi encontrado!</td>
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
