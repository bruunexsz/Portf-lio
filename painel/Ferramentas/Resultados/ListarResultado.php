<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

#DEFININDO O TANTO DE REGISTROS POR P�GINAS
$TamanhoPagina = 41;
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
		if (!isset($CampoBuscaTitulo)) $CampoBuscaTitulo = '';
	#FIM VALIDANDO VARIAVEIS VAZIAS
if ($CampoBuscaTitulo == ''){

#SELECT PARA SABER O TOTAL DE REGISTROS
$SQLTotalPaginas = "SELECT * from cadastroresultado
		 WHERE cadastroresultado.AtivacaoDoResultado = '1'		 
		 ORDER BY ID desc";
$RSTotalPaginas = mysql_query($SQLTotalPaginas) or die (mysql_error());
$NumeroTotalDeRegistros = mysql_num_rows($RSTotalPaginas); 
$TotalPaginas = ceil($NumeroTotalDeRegistros / $TamanhoPagina);
mysql_Free_Result($RSTotalPaginas);

#INICIO MOSTRAR RESULTADO SE O CAMPO BUSCA VIER VAZIO COM OS LIMITES DA PAGINA��O

$SelectResultado = "SELECT cadastroresultado.ID,
		cadastroresultado.AtivacaoDoResultado,
		cadastroresultado.DataDoResultado,
		cadastroresultado.TituloDoResultado,
		cadastroresultado.UrlAmigavel
FROM ".BANCO.".cadastroresultado
WHERE cadastroresultado.AtivacaoDoResultado = 1
ORDER BY DataDoResultado desc
LIMIT ".$Inicio.",".$TamanhoPagina;
$ResultadoResultado = mysql_query($SelectResultado) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoResultado)){			
	$BuscaMostrarResultados[$nCount]["ID"                       ] = trim($row[0]);
	$BuscaMostrarResultados[$nCount]["AtivacaoDoResultado"      ] = trim($row[1]);
	$BuscaMostrarResultados[$nCount]["DataDoResultado"          ] = trim($row[2]);	
	$BuscaMostrarResultados[$nCount]["TituloDoResultado"        ] = trim($row[3]);
	$BuscaMostrarResultados[$nCount]["UrlAmigavel"              ] = trim($row[4]);
$nCount++;
}
mysql_Free_Result($ResultadoResultado);	
#FIM MOSTRAR RESULTADO SE O CAMPO BUSCA VIR VAZIO
}else{
	#INICIO RESULTADO COM PESQUISA
	
#SELECT PARA SABER O TOTAL DE REGISTROS COM FILTRO
$SQLTotalPaginas = sprintf("SELECT * from cadastroresultado
		 WHERE cadastroresultado.TituloDoResultado RLIKE '%s'
		 AND cadastroresultado.AtivacaoDoResultado = 1
		 ORDER BY ID desc",
			FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaTitulo)))
		 );
$RSTotalPaginas = mysql_query($SQLTotalPaginas) or die (mysql_error());
$NumeroTotalDeRegistros = mysql_num_rows($RSTotalPaginas); 
$TotalPaginas = ceil($NumeroTotalDeRegistros / $TamanhoPagina);
mysql_Free_Result($RSTotalPaginas);

	$SelectResultado = sprintf("SELECT cadastroresultado.ID,
		cadastroresultado.AtivacaoDoResultado,
		cadastroresultado.DataDoResultado,
		cadastroresultado.TituloDoResultado,
		cadastroresultado.UrlAmigavel	
	FROM ".BANCO.".cadastroresultado
	WHERE cadastroresultado.TituloDoResultado RLIKE '%s'
	AND cadastroresultado.AtivacaoDoResultado = 1			
	ORDER BY DataDoResultado desc
	LIMIT ".$Inicio.",".$TamanhoPagina,
	FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaTitulo)))
	);
	$ResultadoResultado = mysql_query($SelectResultado) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($ResultadoResultado)){			
		$BuscaMostrarResultados[$nCount]["ID"                       ] = trim($row[0]);
		$BuscaMostrarResultados[$nCount]["AtivacaoDoResultado"      ] = trim($row[1]);
		$BuscaMostrarResultados[$nCount]["DataDoResultado"          ] = trim($row[2]);	
		$BuscaMostrarResultados[$nCount]["TituloDoResultado"        ] = trim($row[3]);
		$BuscaMostrarResultados[$nCount]["UrlAmigavel"              ] = trim($row[4]);
	$nCount++;
	}
	mysql_Free_Result($ResultadoResultado);
#FIM MOSTRAR RESULTADO COM PESQUISA
}
?>
<script language="javascript" type="text/javascript">window.scrollTo(0,0);</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php 
	if (!isset($BuscaMostrarResultados[1]["ID"])) $BuscaMostrarResultados[1]["ID"] = '';
	if($BuscaMostrarResultados[1]["ID"] != ''){ ?>
      <form id="FormPrincipal">
        <table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td width="3%" align="center"><input type="checkbox" name="CheckBoxMaster" id="CheckBoxMaster" class="TextoVerdana12A" onclick="SelecionarTodosCheckBox('FormPrincipal','chave','CheckBoxMaster','ValoresCheckbox');" /></td>
            <td width="15%" height="20" align="left" class="TextoVerdana12A"><strong>Data</strong></td>
            <td width="63%" class="TextoVerdana12A"><strong>T&iacute;tulo</strong></td>
            <td width="10%" align="center" class="TextoVerdana12A">&nbsp;</td>
            <td width="10%" align="center" class="TextoVerdana12A"><strong>Op&ccedil;&otilde;es</strong></td>
          </tr>
          <tr>
            <td height="5" colspan="5" class="FundoLinhas"></td>
          </tr>
          <?php	for($i=1;$i<=count($BuscaMostrarResultados);$i++){ ?>
          <tr class="FundoListaConteudo">
            <td width="3%" align="center" style="padding-left:3px;padding-right:3px;"><input type="checkbox" name="chave[]" id="chave[]" class="TextoVerdana12A" value="<?php echo $BuscaMostrarResultados[$i]["ID"]; ?>" onclick="SelecionarValoresPorCheckBox('FormPrincipal','chave','ValoresCheckbox');" /></td>
            <td width="15%" height="25" style="padding-left:3px;padding-right:3px;"><?php echo substr(FormataDataBanco($BuscaMostrarResultados[$i]["DataDoResultado"]),0,10); ?></td>
            <td width="63%" style="padding-left:3px;padding-right:3px;"><?php echo utf8_encode($BuscaMostrarResultados[$i]["TituloDoResultado"]); ?></td>
            <td width="10%" align="center" style="padding-left:3px;padding-right:3px;"><a href="<?php echo CAMINHO_SITE_GERAL.'resultados/'.utf8_encode($BuscaMostrarResultados[$i]["ID"]).'/'.utf8_encode($BuscaMostrarResultados[$i]["UrlAmigavel"]); ?>/" target="_blank" class="LinkBlock">Visualizar</a></td>
            <td width="10%" align="center" style="padding-left:3px;padding-right:3px;"><a href="javascript:void(0);" onclick="EnviarFormularios('Ferramentas/Resultados/EditarResultado.php','DivResultadosInternos','IDResultado=<?php echo $BuscaMostrarResultados[$i]["ID"] ?>');" class="LinkBlock">Editar</a></td>
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
                          <input type="button" class="BotaoPadrao" value="Excluir resultados selecionados" onClick="ConfirmacaoExclusaoPorCheckBox('Ferramentas/Resultados/AcaoExcluirResultado.php','DivResultadosInternos','IDResultado='+encodeURIComponent(document.getElementById('ValoresCheckbox').value),'ValoresCheckbox');"/></td>
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
                    
                    <select id="Paginacao" onchange="AlterarPaginaComPaginacao('Ferramentas/Resultados/ListarResultado.php', this.value, '<?php echo $CampoBuscaTitulo ?>');" class="TextFields">
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
          <td valign="middle" class="TextoVerdana12B">Nenhum resultado foi encontrado!</td>
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
