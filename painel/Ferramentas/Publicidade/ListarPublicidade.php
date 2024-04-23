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
$SQLTotalPaginas = "SELECT * from publicidade
		 WHERE publicidade.Ativacao = '1'		 
		 ORDER BY ID desc";
$RSTotalPaginas = mysql_query($SQLTotalPaginas) or die (mysql_error());
$NumeroTotalDeRegistros = mysql_num_rows($RSTotalPaginas); 
$TotalPaginas = ceil($NumeroTotalDeRegistros / $TamanhoPagina);
mysql_Free_Result($RSTotalPaginas);

#INICIO MOSTRAR PUBLICIDADE SE O CAMPO BUSCA VIER VAZIO COM OS LIMITES DA PAGINA플O
$SelectPublicidade = "SELECT publicidade.ID,
	publicidade.Ativacao,
	publicidade.DataDeCadastro,
	publicidade.Titulo,
	publicidade.UrlAmigavel
FROM ".BANCO.".publicidade
WHERE publicidade.Ativacao = 1
ORDER BY ID desc
LIMIT ".$Inicio.",".$TamanhoPagina;	
$ResultadoPublicidade = mysql_query($SelectPublicidade) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoPublicidade)){			
	$BuscaMostrarPublicidade[$nCount]["ID"            ] = trim($row[0]);
	$BuscaMostrarPublicidade[$nCount]["Ativacao"      ] = trim($row[1]);
	$BuscaMostrarPublicidade[$nCount]["DataDeCadastro"] = trim($row[2]);
	$BuscaMostrarPublicidade[$nCount]["Titulo"        ] = trim($row[3]);
	$BuscaMostrarPublicidade[$nCount]["UrlAmigavel"   ] = trim($row[4]);
$nCount++;
}
mysql_Free_Result($ResultadoPublicidade);	
#FIM MOSTRAR PUBLICIDADE SE O CAMPO BUSCA VIR VAZIO
}else{
	#INICIO PUBLICIDADE COM PESQUISA
	
#SELECT PARA SABER O TOTAL DE REGISTROS COM FILTRO
$SQLTotalPaginas = sprintf("SELECT * from publicidade
		 WHERE publicidade.Titulo RLIKE '%s'
		 AND publicidade.Ativacao = 1
		 ORDER BY ID desc",
			FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaTitulo)))
		 );
$RSTotalPaginas = mysql_query($SQLTotalPaginas) or die (mysql_error());
$NumeroTotalDeRegistros = mysql_num_rows($RSTotalPaginas); 
$TotalPaginas = ceil($NumeroTotalDeRegistros / $TamanhoPagina);
mysql_Free_Result($RSTotalPaginas);
	
$SelectPublicidade = sprintf("SELECT publicidade.ID,
	publicidade.Ativacao,
	publicidade.DataDeCadastro,
	publicidade.Titulo,
	publicidade.UrlAmigavel
FROM ".BANCO.".publicidade
WHERE publicidade.Titulo RLIKE '%s'
AND publicidade.Ativacao = 1
ORDER BY ID desc
LIMIT ".$Inicio.",".$TamanhoPagina,
FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaTitulo)))
);
$ResultadoPublicidade = mysql_query($SelectPublicidade) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoPublicidade)){			
	$BuscaMostrarPublicidade[$nCount]["ID"            ] = trim($row[0]);
	$BuscaMostrarPublicidade[$nCount]["Ativacao"      ] = trim($row[1]);
	$BuscaMostrarPublicidade[$nCount]["DataDeCadastro"] = trim($row[2]);
	$BuscaMostrarPublicidade[$nCount]["Titulo"        ] = trim($row[3]);
	$BuscaMostrarPublicidade[$nCount]["UrlAmigavel"   ] = trim($row[4]);
$nCount++;
}
mysql_Free_Result($ResultadoPublicidade);
#FIM MOSTRAR PUBLICIDADE COM PESQUISA
}
?>
<script language="javascript" type="text/javascript">window.scrollTo(0,0);</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php 
	if (!isset($BuscaMostrarPublicidade[1]["ID"])) $BuscaMostrarPublicidade[1]["ID"] = '';
	if($BuscaMostrarPublicidade[1]["ID"] != ''){ ?>
      <form id="FormPrincipal">
        <table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td width="3%" align="center"><input type="checkbox" name="CheckBoxMaster" id="CheckBoxMaster" class="TextoVerdana12A" onclick="SelecionarTodosCheckBox('FormPrincipal','chave','CheckBoxMaster','ValoresCheckbox');" /></td>
            <td width="77%" height="20" class="TextoVerdana12A"><strong>T&iacute;tulo do an&uacute;ncio</strong></td>
            <td width="10%" align="center" class="TextoVerdana12A"><strong>Cliques</strong></td>
            <td width="10%" align="center" class="TextoVerdana12A"><strong>Op&ccedil;&otilde;es</strong></td>
          </tr>
          <tr>
            <td height="5" colspan="4" class="FundoLinhas"></td>
          </tr>
          <?php	for($i=1;$i<=count($BuscaMostrarPublicidade);$i++){ ?>
          <tr class="FundoListaConteudo">
            <td width="3%" align="center" style="padding-left:3px;padding-right:3px;"><input type="checkbox" name="chave[]" id="chave[]" class="TextoVerdana12A" value="<?php echo $BuscaMostrarPublicidade[$i]["ID"]; ?>" onclick="SelecionarValoresPorCheckBox('FormPrincipal','chave','ValoresCheckbox');" /></td>
            <td height="25" style="padding-left:3px;padding-right:3px;"><?php echo utf8_encode($BuscaMostrarPublicidade[$i]["Titulo"]); ?></td>
            <td width="10%" align="center" style="padding-left:3px;padding-right:3px;"><a href="javascript:void(0);" onclick="EnviarFormularios('Ferramentas/Publicidade/VisualizarCliques.php','DivResultadosInternos','IDPublicidade=<?php echo $BuscaMostrarPublicidade[$i]["ID"] ?>');" class="LinkBlock">Visualizar</a></td>
            <td width="10%" align="center" style="padding-left:3px;padding-right:3px;"><a href="javascript:void(0);" onclick="EnviarFormularios('Ferramentas/Publicidade/EditarPublicidade.php','DivResultadosInternos','IDPublicidade=<?php echo $BuscaMostrarPublicidade[$i]["ID"] ?>');" class="LinkBlock">Editar</a></td>
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
                          <input type="button" class="BotaoPadrao" value="Excluir an&uacute;ncios selecionados" onClick="ConfirmacaoExclusaoPorCheckBox('Ferramentas/Publicidade/AcaoExcluirPublicidade.php','DivResultadosInternos','IDPublicidade='+encodeURIComponent(document.getElementById('ValoresCheckbox').value),'ValoresCheckbox');"/></td>
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
                    <select id="Paginacao" onchange="AlterarPaginaComPaginacao('Ferramentas/Publicidade/ListarPublicidade.php', this.value, '<?php echo $CampoBuscaTitulo ?>');" class="TextFields">
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
          <td valign="middle" class="TextoVerdana12B">Nenhum an&uacute;ncio foi encontrado!</td>
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
