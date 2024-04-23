<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

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
		if (!isset($CampoBuscaTitulo)) $CampoBuscaTitulo = '';
	#FIM VALIDANDO VARIAVEIS VAZIAS
if ($CampoBuscaTitulo == ''){

#SELECT PARA SABER O TOTAL DE REGISTROS
$SQLTotalPaginas = "SELECT * from cadastroevento
		 WHERE cadastroevento.AtivacaoDoEvento = '1'		 
		 ORDER BY DataInicial asc";
$RSTotalPaginas = mysql_query($SQLTotalPaginas) or die (mysql_error());
$NumeroTotalDeRegistros = mysql_num_rows($RSTotalPaginas); 
$TotalPaginas = ceil($NumeroTotalDeRegistros / $TamanhoPagina);
mysql_Free_Result($RSTotalPaginas);

#INICIO MOSTRAR EVENTOS SE O CAMPO BUSCA VIER VAZIO COM OS LIMITES DA PAGINA플O

$SelectEvento = "SELECT cadastroevento.ID,
		cadastroevento.AtivacaoDoEvento,
		cadastroevento.DataDeCadastroDoEvento,
		cadastroevento.DataInicial,
		cadastroevento.DataFinal,
		cadastroevento.SeparadorData,
		cadastroevento.TituloDoEvento,
		cadastroevento.LocalDoEvento,
		cadastroevento.TextoConteudoDoEvento,
		cadastroevento.PastaDeConteudoDoEvento,
		cadastroevento.UrlAmigavel
	FROM ".BANCO.".cadastroevento
	WHERE cadastroevento.AtivacaoDoEvento = 1
	ORDER BY DataInicial asc
	LIMIT ".$Inicio.",".$TamanhoPagina;	
$ResultadoEvento = mysql_query($SelectEvento) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoEvento)){			
	$BuscaMostrarEventos[$nCount]["ID"                      ] = trim($row[0]);
	$BuscaMostrarEventos[$nCount]["AtivacaoDoEvento"        ] = trim($row[1]);
	$BuscaMostrarEventos[$nCount]["DataDeCadastroDoEvento"  ] = trim($row[2]);
	$BuscaMostrarEventos[$nCount]["DataInicial"             ] = trim($row[3]);
	$BuscaMostrarEventos[$nCount]["DataFinal"               ] = trim($row[4]);
	$BuscaMostrarEventos[$nCount]["SeparadorData"           ] = trim($row[5]);
	$BuscaMostrarEventos[$nCount]["TituloDoEvento"          ] = trim($row[6]);
	$BuscaMostrarEventos[$nCount]["LocalDoEvento"           ] = trim($row[7]);
	$BuscaMostrarEventos[$nCount]["TextoConteudoDoEvento"   ] = trim($row[8]);
	$BuscaMostrarEventos[$nCount]["PastaDeConteudoDoEvento" ] = trim($row[9]);
	$BuscaMostrarEventos[$nCount]["UrlAmigavel"             ] = trim($row[10]);
$nCount++;
}
mysql_Free_Result($ResultadoEvento);

#FIM MOSTRAR EVENTOS SE O CAMPO BUSCA VIR VAZIO
}else{
#INICIO EVENTOS COM PESQUISA
	
#SELECT PARA SABER O TOTAL DE REGISTROS COM FILTRO
$SQLTotalPaginas = sprintf("SELECT * from cadastroevento
		 WHERE cadastroevento.TituloDoEvento RLIKE '%s'
		 AND cadastroevento.AtivacaoDoEvento = 1
		 ORDER BY DataInicial asc",
			FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaTitulo)))
		 );
$RSTotalPaginas = mysql_query($SQLTotalPaginas) or die (mysql_error());
$NumeroTotalDeRegistros = mysql_num_rows($RSTotalPaginas); 
$TotalPaginas = ceil($NumeroTotalDeRegistros / $TamanhoPagina);
mysql_Free_Result($RSTotalPaginas);	

	$SelectEvento = sprintf("SELECT cadastroevento.ID,
		cadastroevento.AtivacaoDoEvento,
		cadastroevento.DataDeCadastroDoEvento,
		cadastroevento.DataInicial,
		cadastroevento.DataFinal,
		cadastroevento.SeparadorData,
		cadastroevento.TituloDoEvento,
		cadastroevento.LocalDoEvento,
		cadastroevento.TextoConteudoDoEvento,
		cadastroevento.PastaDeConteudoDoEvento,
		cadastroevento.UrlAmigavel
	FROM ".BANCO.".cadastroevento
	WHERE cadastroevento.TituloDoEvento RLIKE '%s'
	AND cadastroevento.AtivacaoDoEvento = 1			
	ORDER BY DataInicial asc
	LIMIT ".$Inicio.",".$TamanhoPagina,
	FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaTitulo)))
	);
	$ResultadoEvento = mysql_query($SelectEvento) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($ResultadoEvento)){			
		$BuscaMostrarEventos[$nCount]["ID"                      ] = trim($row[0]);
		$BuscaMostrarEventos[$nCount]["AtivacaoDoEvento"        ] = trim($row[1]);
		$BuscaMostrarEventos[$nCount]["DataDeCadastroDoEvento"  ] = trim($row[2]);
		$BuscaMostrarEventos[$nCount]["DataInicial"             ] = trim($row[3]);
		$BuscaMostrarEventos[$nCount]["DataFinal"               ] = trim($row[4]);
		$BuscaMostrarEventos[$nCount]["SeparadorData"           ] = trim($row[5]);
		$BuscaMostrarEventos[$nCount]["TituloDoEvento"          ] = trim($row[6]);
		$BuscaMostrarEventos[$nCount]["LocalDoEvento"           ] = trim($row[7]);
		$BuscaMostrarEventos[$nCount]["TextoConteudoDoEvento"   ] = trim($row[8]);
		$BuscaMostrarEventos[$nCount]["PastaDeConteudoDoEvento" ] = trim($row[9]);
		$BuscaMostrarEventos[$nCount]["UrlAmigavel"             ] = trim($row[10]);
	$nCount++;
	}
	mysql_Free_Result($ResultadoEvento);


#FIM MOSTRAR EVENTOS COM PESQUISA
}
?>
<script language="javascript" type="text/javascript">window.scrollTo(0,0);</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php 
	if (!isset($BuscaMostrarEventos[1]["ID"])) $BuscaMostrarEventos[1]["ID"] = '';
	if($BuscaMostrarEventos[1]["ID"] != ''){ ?>
      <form id="FormPrincipal">
        <table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td width="3%" height="20" align="center"><input type="checkbox" name="CheckBoxMaster" id="CheckBoxMaster" class="TextoVerdana12A" onclick="SelecionarTodosCheckBox('FormPrincipal','chave','CheckBoxMaster','ValoresCheckbox');" /></td>
            <td width="78%" class="TextoVerdana12A"><strong>T&iacute;tulo - Local</strong></td>
            <td width="10%" align="center" class="TextoVerdana12A">&nbsp;</td>
            <td width="10%" align="center" class="TextoVerdana12A"><strong>Op&ccedil;&otilde;es</strong></td>
          </tr>
          <tr>
            <td height="5" colspan="4" class="FundoLinhas"></td>
          </tr>
          <?php	for($i=1;$i<=count($BuscaMostrarEventos);$i++){ ?>
          <tr class="FundoListaConteudo" id="LinhaTitulo<?php echo $i; ?>" onmouseover="document.getElementById('LinhaSubTitulo<?php echo $i; ?>').className='FundoListaConteudoDuasLinhasHover';" onmouseout="document.getElementById('LinhaSubTitulo<?php echo $i; ?>').className='FundoListaConteudo';">
            <td width="3%" height="25" align="center" style="padding-left:3px;padding-right:3px;"><input type="checkbox" name="chave[]" id="chave[]" class="TextoVerdana12A" value="<?php echo $BuscaMostrarEventos[$i]["ID"]; ?>" onclick="SelecionarValoresPorCheckBox('FormPrincipal','chave','ValoresCheckbox');" /></td>
            <td width="78%" style="padding-left:3px;padding-right:3px;"><?php echo utf8_encode($BuscaMostrarEventos[$i]["TituloDoEvento"]); ?> - <?php echo utf8_encode($BuscaMostrarEventos[$i]["LocalDoEvento"]); ?></td>
            <td width="10%" align="center" style="padding-left:3px;padding-right:3px;">
            <?php if(utf8_encode($BuscaMostrarEventos[$i]["TextoConteudoDoEvento"]) != ''){ ?><a href="<?php echo CAMINHO_SITE_GERAL.'eventos/'.utf8_encode($BuscaMostrarEventos[$i]["ID"]).'/'.utf8_encode($BuscaMostrarEventos[$i]["UrlAmigavel"]); ?>/" target="_blank" class="LinkBlock">Visualizar</a><?php }else{ echo '-'; } ?></td>
            <td width="10%" align="center" style="padding-left:3px;padding-right:3px;"><a href="javascript:void(0);" onclick="EnviarFormularios('Ferramentas/Eventos/EditarEvento.php','DivResultadosInternos','IDEvento=<?php echo $BuscaMostrarEventos[$i]["ID"] ?>');" class="LinkBlock">Editar</a></td>
          </tr>
          <tr class="FundoListaConteudo" id="LinhaSubTitulo<?php echo $i; ?>" onmouseover="document.getElementById('LinhaTitulo<?php echo $i; ?>').className='FundoListaConteudoDuasLinhasHover';" onmouseout="document.getElementById('LinhaTitulo<?php echo $i; ?>').className='FundoListaConteudo';">
            <td height="25" align="center" style="padding-left:3px;padding-right:3px;">&nbsp;</td>
            <td width="78%" style="padding-left:3px;padding-right:3px;"><strong>Data</strong>: 
              
  <?php
			if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),0,2) == '00'){
				echo "A definir";
			}else{                    
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),3,2) == '01'){ $MesInicio = 'janeiro'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),3,2) == '02'){ $MesInicio = 'fevereiro'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),3,2) == '03'){ $MesInicio = 'mar&ccedil;o'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),3,2) == '04'){ $MesInicio = 'abril'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),3,2) == '05'){ $MesInicio = 'maio'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),3,2) == '06'){ $MesInicio = 'junho'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),3,2) == '07'){ $MesInicio = 'julho'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),3,2) == '08'){ $MesInicio = 'agosto'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),3,2) == '09'){ $MesInicio = 'setembro'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),3,2) == '10'){ $MesInicio = 'outubro'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),3,2) == '11'){ $MesInicio = 'novembro'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),3,2) == '12'){ $MesInicio = 'dezembro'; }
				
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataFinal"]),3,2) == '01'){ $MesFinal = 'janeiro'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataFinal"]),3,2) == '02'){ $MesFinal = 'fevereiro'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataFinal"]),3,2) == '03'){ $MesFinal = 'mar&ccedil;o'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataFinal"]),3,2) == '04'){ $MesFinal = 'abril'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataFinal"]),3,2) == '05'){ $MesFinal = 'maio'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataFinal"]),3,2) == '06'){ $MesFinal = 'junho'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataFinal"]),3,2) == '07'){ $MesFinal = 'julho'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataFinal"]),3,2) == '08'){ $MesFinal = 'agosto'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataFinal"]),3,2) == '09'){ $MesFinal = 'setembro'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataFinal"]),3,2) == '10'){ $MesFinal = 'outubro'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataFinal"]),3,2) == '11'){ $MesFinal = 'novembro'; }
				if(substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataFinal"]),3,2) == '12'){ $MesFinal = 'dezembro'; }
				
			
				if(FormataDataBanco($BuscaMostrarEventos[$i]["DataFinal"]) == FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"])){
					echo substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),0,2).' de '.$MesInicio.' de '.substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),6,4);
				}else{
					if($MesInicio == $MesFinal){
						if($BuscaMostrarEventos[$i]["SeparadorData"] == 'a'){ echo 'De '; }
						echo substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),0,2).' '.$BuscaMostrarEventos[$i]["SeparadorData"].' '.substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataFinal"]),0,2).' de '.$MesFinal.' de '.substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),6,4);	
					}else{
						echo 'De '.substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),0,2).' de '.$MesInicio.' '.$BuscaMostrarEventos[$i]["SeparadorData"].' '.substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataFinal"]),0,2).' de '.$MesFinal.' de '.substr(FormataDataBanco($BuscaMostrarEventos[$i]["DataInicial"]),6,4);
					}
				}
			}
			?>
              
            </td>
            <td align="center" style="padding-left:3px;padding-right:3px;">&nbsp;</td>
            <td align="center" style="padding-left:3px;padding-right:3px;">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" class="FundoLinhas" height="3"></td>
          </tr>
          <?php } ?>
          <tr>
            <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td align="left" class="TextoVerdana12A"><table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="6">&nbsp;</td>
                        <td><input type="hidden" id="ValoresCheckbox" />
                          <img src="Img/SetaExcluirValoresSelecionados.gif" alt="" width="14" height="15" />
                          <input type="button" class="BotaoPadrao" value="Excluir eventos selecionados" onClick="ConfirmacaoExclusaoPorCheckBox('Ferramentas/Eventos/AcaoExcluirEvento.php','DivResultadosInternos','IDEvento='+encodeURIComponent(document.getElementById('ValoresCheckbox').value),'ValoresCheckbox');"/></td>
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
                    <select id="Paginacao" onchange="AlterarPaginaComPaginacao('Ferramentas/Eventos/ListarEvento.php', this.value, '<?php echo $CampoBuscaTitulo; ?>');" class="TextFields">
                      <option value="" selected="selected">Selecione</option>
                      <?php			 
			   for ($i=1;$i<=$TotalPaginas;$i++){ 
					echo '<option value='.$i.' id="NumeroDaPagina">'.$i.'</option>';
			   }
			 ?>
                    </select>
                  </td>
                </tr>
              </table>
              <?php } ?></td>
          </tr>
        </table>
      </form>
      <?php }else{ ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="middle" class="TextoVerdana12B">Nenhum evento foi encontrado!</td>
        </tr>
        <tr>
          <td align="left" height="10"></td>
        </tr>
        <tr>
          <td height="5" align="left" valign="middle" class="FundoLinhas"></td>
        </tr>
      </table>
      <?php } ?>
    </td>
  </tr>
</table>
<?php mysql_Close($ConexaoBanco); ?>
