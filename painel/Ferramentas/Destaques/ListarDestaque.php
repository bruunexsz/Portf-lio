<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

#DEFININDO O TANTO DE REGISTROS POR P핯INAS
$TamanhoPagina = 15;
#P핯INA A MOSTRAR E O INICIO DO REGISTO A MOSTRAR 
#INICIO VALIDANDO VARIAVEIS VAZIAS
	if (!isset($_POST["Pagina"])) $_POST["Pagina"] = '';
#FIM VALIDANDO VARIAVEIS VAZIAS
$Pagina = $_POST["Pagina"]; 
if (!$Pagina) { 
   $Inicio = 0; 
   $Pagina=1; 
} else {
   $Inicio = ($Pagina - 1) * $TamanhoPagina; 
}
#INICIO VALIDANDO VARIAVEIS VAZIAS
	if (!isset($CampoBuscaTituloDestaque)) $CampoBuscaTituloDestaque = '';
#FIM VALIDANDO VARIAVEIS VAZIAS

if ($CampoBuscaTituloDestaque == ''){

#SELECT PARA SABER O TOTAL DE REGISTROS
$SQLTotalPaginas = "SELECT * from cadastrodestaque
		 WHERE cadastrodestaque.AtivacaoDoDestaque = '1'
		 ORDER BY ID desc";
$RSTotalPaginas = mysql_query($SQLTotalPaginas) or die (mysql_error());
$NumeroTotalDeRegistros = mysql_num_rows($RSTotalPaginas); 
$TotalPaginas = ceil($NumeroTotalDeRegistros / $TamanhoPagina);
mysql_Free_Result($RSTotalPaginas);

#INICIO MOSTRAR DESTAQUES SE O CAMPO BUSCA VIER VAZIO COM OS LIMITES DA PAGINA플O
	$SQLDestaque = "SELECT cadastrodestaque.ID,
		cadastrodestaque.AtivacaoDoDestaque,
		cadastrodestaque.DataDeCadastroDoDestaque,
		cadastrodestaque.TituloDoDestaque,
		cadastrodestaque.PastaDeConteudoDoDestaque
	FROM ".BANCO.".cadastrodestaque
	WHERE cadastrodestaque.AtivacaoDoDestaque = '1'
	ORDER BY ID desc
	LIMIT ".$Inicio.",".$TamanhoPagina;
	$ResultadoDestaque = mysql_query($SQLDestaque) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($ResultadoDestaque)){			
		$BuscaMostrarDestaques[$nCount]["ID"                        ] = trim($row[0]);
		$BuscaMostrarDestaques[$nCount]["AtivacaoDoDestaque"        ] = trim($row[1]);
		$BuscaMostrarDestaques[$nCount]["DataDeCadastroDoDestaque"  ] = trim($row[2]);
		$BuscaMostrarDestaques[$nCount]["TituloDoDestaque"          ] = trim($row[3]);
		$BuscaMostrarDestaques[$nCount]["PastaDeConteudoDoDestaque" ] = trim($row[4]);			
	$nCount++;
	}
	mysql_Free_Result($ResultadoDestaque);	
#FIM MOSTRAR DESTAQUES SE O CAMPO BUSCA VIR VAZIO
}else{
#INICIO MOSTRAR DESTAQUES COM PESQUISA
	
#SELECT PARA SABER O TOTAL DE REGISTROS COM FILTRO
$SQLTotalPaginas = sprintf("SELECT * from cadastrodestaque
		 WHERE cadastrodestaque.TituloDoDestaque RLIKE '%s'
		 AND cadastrodestaque.AtivacaoDoDestaque = 1
		 ORDER BY ID desc",
			FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaTituloDestaque)))
		 );
$RSTotalPaginas = mysql_query($SQLTotalPaginas) or die (mysql_error());
$NumeroTotalDeRegistros = mysql_num_rows($RSTotalPaginas); 
$TotalPaginas = ceil($NumeroTotalDeRegistros / $TamanhoPagina);
mysql_Free_Result($RSTotalPaginas);
	
	$SQLDestaque = sprintf("SELECT cadastrodestaque.ID,
					cadastrodestaque.AtivacaoDoDestaque,
					cadastrodestaque.DataDeCadastroDoDestaque,
					cadastrodestaque.TituloDoDestaque,
					cadastrodestaque.PastaDeConteudoDoDestaque
	FROM ".BANCO.".cadastrodestaque
	WHERE cadastrodestaque.TituloDoDestaque RLIKE '%s'
	AND cadastrodestaque.AtivacaoDoDestaque = 1			
	ORDER BY ID desc
	LIMIT ".$Inicio.",".$TamanhoPagina,
	FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaTituloDestaque)))
	);
	$ResultadoDestaque = mysql_query($SQLDestaque) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($ResultadoDestaque)){			
		$BuscaMostrarDestaques[$nCount]["ID"                       ] = trim($row[0]);
		$BuscaMostrarDestaques[$nCount]["AtivacaoDoDestaque"       ] = trim($row[1]);
		$BuscaMostrarDestaques[$nCount]["DataDeCadastroDoDestaque" ] = trim($row[2]);
		$BuscaMostrarDestaques[$nCount]["TituloDoDestaque"         ] = trim($row[3]);
		$BuscaMostrarDestaques[$nCount]["PastaDeConteudoDoDestaque"] = trim($row[4]);	
	$nCount++;
	}
	mysql_Free_Result($ResultadoDestaque);
#FIM MOSTRAR DESTAQUES COM PESQUISA			
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php 
	if (!isset($BuscaMostrarDestaques[1]["ID"])) $BuscaMostrarDestaques[1]["ID"] = '';
	if($BuscaMostrarDestaques[1]["ID"] != ''){ ?>
      <form id="FormListarDestaque">
        <table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td align="center"><input type="checkbox" name="CheckBoxMaster" id="CheckBoxMaster" class="TextoVerdana12A" onclick="SelecionarTodosCheckBox('FormListarDestaque','chave','CheckBoxMaster','ValoresCheckbox');" /></td>
            <td class="TextoVerdana12A"><strong>T&iacute;tulo</strong></td>
            <td align="center" class="TextoVerdana12A"><strong>Cadastro</strong></td>
            <td colspan="2" align="center" class="TextoVerdana12A"></td>
          </tr>
          <tr>
            <td height="1" colspan="5" class="FundoLinhas"></td>
          </tr>
          <?php for($i=1;$i<=count($BuscaMostrarDestaques);$i++){ ?>
          <tr class="FundoListaConteudo">
            <td width="3%" align="center"><input type="checkbox" name="chave[]" id="chave[]" class="TextoVerdana12A" value="<?php echo $BuscaMostrarDestaques[$i]["ID"]; ?>" onclick="SelecionarValoresPorCheckBox('FormListarDestaque','chave','ValoresCheckbox');" /></td>
            <td width="62%" style="padding-left:3px;padding-right:3px;"><?php echo utf8_encode($BuscaMostrarDestaques[$i]["TituloDoDestaque"]); ?></td>
            <td width="15%" align="center" style="padding-left:3px;padding-right:3px;"><?php echo substr(FormataDataBanco($BuscaMostrarDestaques[$i]["DataDeCadastroDoDestaque"]),0,10); ?></td>
            <td width="10%" align="center" style="padding-left:2px;padding-right:2px;"><a href="<?php echo CAMINHO_SITE_GERAL; ?>" target="_blank" class="LinkBlock">Visualizar</a></td>
            <td width="10%" align="center" style="padding-left:2px;padding-right:2px;"><a href="javascript:void(0);" onclick="EnviarFormularios('Ferramentas/Destaques/EditarDestaque.php','DivResultadosInternos','IDDestaque=<?php echo $BuscaMostrarDestaques[$i]["ID"] ?>');" class="LinkBlock">Editar</a></td>
          </tr>
          <tr>
            <td colspan="5" class="FundoLinhas" height="3"></td>
          </tr>
          <?php } ?>
          <tr>
            <td colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10" align="left"></td>
                </tr>
                <tr>
                  <td align="left" class="TextoVerdana12A"><table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="6">&nbsp;</td>
                        <td><input type="hidden" id="ValoresCheckbox" />
                          <img src="Img/SetaExcluirValoresSelecionados.gif" alt="" width="14" height="15" />
                          <input type="button" class="BotaoPadrao" value="Excluir destaques selecionados" onClick="ConfirmacaoExclusaoPorCheckBox('Ferramentas/Destaques/AcaoExcluirDestaque.php','DivResultadosInternos','IDDestaque='+encodeURIComponent(document.getElementById('ValoresCheckbox').value),'ValoresCheckbox');"/></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
              <?php if ($TotalPaginas > 1){ ?>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="2" height="20"></td>
                </tr>
                <tr>
                  <td align="left" class="TextoVerdana12A"><?php echo "Voc&ecirc; est&aacute; na p&aacute;gina<strong> ".$Pagina."</strong> de <strong>".$TotalPaginas."</strong>";?></td>
                  <td align="right" class="TextoVerdana12A">Ir para a p&aacute;gina:
                    <!--/INICIO DOS LINKS COM PAGINA플O/-->
                    <select id="Paginacao" onchange="AlterarPaginaComPaginacao('Ferramentas/Destaques/ListarDestaque.php', this.value, '<?php echo $CampoBuscaTituloDestaque ?>');" class="TextFields">
                      <option value="" selected="selected">Selecione</option>
                      <?php for ($i=1;$i<=$TotalPaginas;$i++){ 
					  	echo '<option value='.$i.' id="NumeroDaPagina">'.$i.'</option>';
					  }?>
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
          <td align="left" valign="middle" class="TextoVerdana12B">Nenhum destaque foi encontrado!</td>
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
