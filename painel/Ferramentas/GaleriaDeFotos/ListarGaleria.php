<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());
?>
<script language="javascript" type="text/javascript">window.scrollTo(0,0);</script>
<link href="../../Css/Estilos.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php
#DEFININDO O TANTO DE REGISTROS POR P핯INAS
$TamanhoPagina = 40;
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
		if (!isset($CampoBuscaTituloGaleria)) $CampoBuscaTituloGaleria = "";
	#FIM VALIDANDO VARIAVEIS VAZIAS
if ($CampoBuscaTituloGaleria == ''){

#SELECT PARA SABER O TOTAL DE REGISTROS
$SQLTotalPaginas = "SELECT * from cadastrogaleria
		 WHERE cadastrogaleria.AtivacaoDaGaleria = '1'
		 ORDER BY ID desc";
$RSTotalPaginas = mysql_query($SQLTotalPaginas) or die (mysql_error());
$NumeroTotalDeRegistros = mysql_num_rows($RSTotalPaginas); 
$TotalPaginas = ceil($NumeroTotalDeRegistros / $TamanhoPagina);
mysql_Free_Result($RSTotalPaginas);

#INICIO MOSTRAR GALERIAS SE O CAMPO BUSCA VIER VAZIO COM OS LIMITES DA PAGINA플O
$SelectGaleria = "SELECT cadastrogaleria.ID,
		cadastrogaleria.AtivacaoDaGaleria,
		cadastrogaleria.DataDeCadastroDaGaleria,
		cadastrogaleria.TituloDaGaleria,							
		cadastrogaleria.TextoConteudoDaGaleria,
		cadastrogaleria.PastaDeConteudoDaGaleria,
		cadastrogaleria.UrlAmigavelDaGaleria 
	FROM ".BANCO.".cadastrogaleria
	WHERE cadastrogaleria.AtivacaoDaGaleria = 1
	ORDER BY ID desc
	LIMIT ".$Inicio.",".$TamanhoPagina;

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
	#FIM MOSTRAR GALERIAS SE O CAMPO BUSCA VIR VAZIO
}else{
#INICIO MOSTRAR GALERIAS COM PESQUISA
	
#SELECT PARA SABER O TOTAL DE REGISTROS COM FILTRO
	$SQLTotalPaginas = sprintf("SELECT * from cadastrogaleria
		 WHERE cadastrogaleria.TituloDaGaleria RLIKE '%s'
		 AND cadastrogaleria.AtivacaoDaGaleria = 1
		 ORDER BY ID desc",
	FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaTituloGaleria)))
	);
$RSTotalPaginas = mysql_query($SQLTotalPaginas) or die (mysql_error());
$NumeroTotalDeRegistros = mysql_num_rows($RSTotalPaginas); 
$TotalPaginas = ceil($NumeroTotalDeRegistros / $TamanhoPagina);
mysql_Free_Result($RSTotalPaginas);
	
	$SelectGaleria = sprintf("SELECT cadastrogaleria.ID,
			cadastrogaleria.AtivacaoDaGaleria,
			cadastrogaleria.DataDeCadastroDaGaleria,
			cadastrogaleria.TituloDaGaleria,							
			cadastrogaleria.TextoConteudoDaGaleria,
			cadastrogaleria.PastaDeConteudoDaGaleria,
			cadastrogaleria.UrlAmigavelDaGaleria
	FROM ".BANCO.".cadastrogaleria
	WHERE cadastrogaleria.TituloDaGaleria RLIKE '%s'
	AND cadastrogaleria.AtivacaoDaGaleria = 1
	ORDER BY ID desc
	LIMIT ".$Inicio.",".$TamanhoPagina,
	FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaTituloGaleria)))
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
#FIM MOSTRAR GALERIAS COM PESQUISA
}?></td>
  </tr>
  <tr>
    <td height="1"></td>
  </tr>
  <tr>
    <td><?php 
	if (!isset($BuscaMostrarGalerias[1]["ID"])) $BuscaMostrarGalerias[1]["ID"] = '';
	if($BuscaMostrarGalerias[1]["ID"] != ""){ ?>
      <form id="FormListarGaleria">
        <table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td align="center"><input type="checkbox" name="CheckBoxMaster" id="CheckBoxMaster" class="TextoVerdana12A" onclick="SelecionarTodosCheckBox('FormListarGaleria','chave','CheckBoxMaster','ValoresCheckbox');" /></td>
            <td height="20" class="TextoVerdana12A"><strong>T&iacute;tulo</strong></td>
            <td height="20" align="center" class="TextoVerdana12A"><strong>Cadastro</strong></td>
            <td align="center" class="TextoVerdana12A"><strong>Fotos</strong></td>
            <td height="20"></td>
            <td height="20"></td>
            <td height="20"><strong>Fotos</strong></td>
          </tr>
          <tr>
            <td height="5" colspan="7" class="FundoLinhas"></td>
          </tr>
          <?php for($i=1;$i<=count($BuscaMostrarGalerias);$i++){
			#INICIO SELECT IMAGENS
				$SqlListarImagens = sprintf("SELECT cadastroimagensgalerias.ID,
					cadastroimagensgalerias.PastaDeConteudoDaGaleria
				FROM ".BANCO.".cadastroimagensgalerias
				WHERE cadastroimagensgalerias.PastaDeConteudoDaGaleria = '%s'",
				FiltrarCampos(mysql_real_escape_string($BuscaMostrarGalerias[$i]["PastaDeConteudoDaGaleria"]))
				);
				$ResultadoListarImagens = mysql_query($SqlListarImagens) or die (mysql_error());
				$nCount=1;
				while ($row = mysql_fetch_array($ResultadoListarImagens)){			
					$BuscaMostrarImagensThumbs[$nCount]["ID"                      ] = trim($row[0]);
					$BuscaMostrarImagensThumbs[$nCount]["PastaDeConteudoDaGaleria"] = trim($row[1]);
				$nCount++;
				}
			#FIM SELECT IMAGENS		
			?>
          <tr class="FundoListaConteudo">
            <td width="3%" style="padding-left:3px;padding-right:3px;"><input type="checkbox" name="chave[]" id="chave[]" class="TextoVerdana12A" value="<?php echo $BuscaMostrarGalerias[$i]["ID"]; ?>" onclick="SelecionarValoresPorCheckBox('FormListarGaleria','chave','ValoresCheckbox');" /></td>
            <td width="50%" style="padding-left:3px;padding-right:3px;"><?php echo utf8_encode($BuscaMostrarGalerias[$i]["TituloDaGaleria"]); ?></td>
            <td width="13%" style="padding-left:3px;padding-right:3px;"><?php echo substr(FormataDataBanco($BuscaMostrarGalerias[$i]["DataDeCadastroDaGaleria"]),0,10); ?></td>
            <td width="5%" align="center" style="padding-left:3px;padding-right:3px;"><?php echo mysql_num_rows($ResultadoListarImagens); ?></td>
            <td width="10%" style="padding-left:3px;padding-right:3px;"><a href="<?php echo CAMINHO_SITE_GERAL; ?>fotos/<?php echo $BuscaMostrarGalerias[$i]["ID"] ?>/<?php echo utf8_encode($BuscaMostrarGalerias[$i]["UrlAmigavelDaGaleria"]); ?>/" target="_blank" class="LinkBlock">Visualizar</a></td>
            <td width="10%" style="padding-left:3px;padding-right:3px;"><a href="javascript:void(0);" onclick="EnviarFormularios('Ferramentas/GaleriaDeFotos/EditarGaleria.php','DivResultadosInternos','IDGaleria=<?php echo $BuscaMostrarGalerias[$i]["ID"] ?>');" class="LinkBlock">Editar</a></td>
            <td width="10%" style="padding-left:3px;padding-right:3px;"><a href="javascript:void(0);" onclick="AlterarConteudo('Ferramentas/GaleriaDeFotos/EditarFotosGaleria.php','DivResultadosInternos','IDGaleria=<?php echo $BuscaMostrarGalerias[$i]["ID"] ?>');" class="LinkBlock">
              <?php if(mysql_num_rows($ResultadoListarImagens) == '0'){ echo "Enviar"; }else{ echo "Alterar";} ?>
              </a></td>
          </tr>
          <tr>
            <td colspan="7" class="FundoLinhas" height="5"></td>
          </tr>
          <?php } mysql_Free_Result($ResultadoListarImagens); ?>
          <tr>
            <td colspan="7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10" align="left" class="TextoVerdana12A"></td>
                </tr>
                <tr>
                  <td align="left" class="TextoVerdana12A"><table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="6">&nbsp;</td>
                        <td><input type="hidden" id="ValoresCheckbox" />
                          <img src="Img/SetaExcluirValoresSelecionados.gif" alt="" width="14" height="15" />
                          <input type="button" class="BotaoPadrao" value="Excluir galerias selecionadas" onClick="ConfirmacaoExclusaoPorCheckBox('Ferramentas/GaleriaDeFotos/AcaoExcluirGaleria.php','DivResultadosInternos','IDGaleria='+encodeURIComponent(document.getElementById('ValoresCheckbox').value),'ValoresCheckbox');"/></td>
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
                    
                    <select id="Paginacao" onchange="AlterarPaginaComPaginacao('Ferramentas/GaleriaDeFotos/ListarGaleria.php', this.value, '<?php echo $CampoBuscaTituloGaleria ?>');" class="TextFields">
                      <option value="" selected="selected">Selecione</option>
                      <?php for ($i=1;$i<=$TotalPaginas;$i++){ 
							echo '<option value='.$i.' id="NumeroDaPagina">'.$i.'</option>';
			   		} ?>
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
          <td class="TextoVerdana12B">Nenhuma galeria foi encontrada!</td>
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
