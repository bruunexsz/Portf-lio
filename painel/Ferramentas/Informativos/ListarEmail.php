<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }
$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());
?>
<script language="javascript" type="text/javascript">window.scrollTo(0,0);</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><?php
#DEFININDO O TANTO DE REGISTROS POR P핯INAS
$TamanhoPagina = 100;
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
		if (!isset($CampoBuscaTituloDoEmail)) $CampoBuscaTituloDoEmail = '';
	#FIM VALIDANDO VARIAVEIS VAZIAS
if ($CampoBuscaTituloDoEmail == ''){

#SELECT PARA SABER O TOTAL DE REGISTROS
$SQLTotalPaginas = "SELECT * from usuarionewsletter
		 WHERE usuarionewsletter.AtivacaoDosDestinatarios = '1'		 
		 ORDER BY ID desc";
$RSTotalPaginas = mysql_query($SQLTotalPaginas) or die (mysql_error());
$NumeroTotalDeRegistros = mysql_num_rows($RSTotalPaginas); 
$TotalPaginas = ceil($NumeroTotalDeRegistros / $TamanhoPagina);
mysql_Free_Result($RSTotalPaginas);

#INICIO MOSTRAR USUARIOS SE O CAMPO BUSCA VIER VAZIO COM OS LIMITES DA PAGINA플O
$SelectUsuariosNewsletter = "SELECT usuarionewsletter.ID,
	usuarionewsletter.AtivacaoDosDestinatarios,
	usuarionewsletter.NomesDosDestinatarios,
	usuarionewsletter.EmailsDosDestinatarios,
	usuarionewsletter.DataDeCadastroDosDestinatarios
FROM ".BANCO.".usuarionewsletter
WHERE usuarionewsletter.AtivacaoDosDestinatarios = 1
ORDER BY EmailsDosDestinatarios asc
LIMIT ".$Inicio.",".$TamanhoPagina;
$ResultadoUsuariosNewsletter = mysql_query($SelectUsuariosNewsletter) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoUsuariosNewsletter)){			
	$BuscaMostrarEmails[$nCount]["ID"                            ] = trim($row[0]);
	$BuscaMostrarEmails[$nCount]["AtivacaoDosDestinatarios"      ] = trim($row[1]);
	$BuscaMostrarEmails[$nCount]["NomesDosDestinatarios"         ] = trim($row[2]);
	$BuscaMostrarEmails[$nCount]["EmailsDosDestinatarios"        ] = trim($row[3]);
	$BuscaMostrarEmails[$nCount]["DataDeCadastroDosDestinatarios"] = trim($row[4]);
$nCount++;
}
mysql_Free_Result($ResultadoUsuariosNewsletter);	
#FIM MOSTRAR USUARIOS SE O CAMPO BUSCA VIR VAZIO
}else{
#INICIO MOSTRAR USUARIOS COM PESQUISA
	
#SELECT PARA SABER O TOTAL DE REGISTROS COM FILTRO
$SQLTotalPaginas = sprintf("SELECT * from usuarionewsletter
		 WHERE usuarionewsletter.EmailsDosDestinatarios RLIKE '%s'
		 AND usuarionewsletter.AtivacaoDosDestinatarios = 1
		 ORDER BY ID desc",
		 FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaTituloDoEmail)))
		 );
$RSTotalPaginas = mysql_query($SQLTotalPaginas) or die (mysql_error());
$NumeroTotalDeRegistros = mysql_num_rows($RSTotalPaginas); 
$TotalPaginas = ceil($NumeroTotalDeRegistros / $TamanhoPagina);
mysql_Free_Result($RSTotalPaginas);
	
	$SelectUsuariosNewsletter = sprintf("SELECT usuarionewsletter.ID,
		usuarionewsletter.AtivacaoDosDestinatarios,
		usuarionewsletter.NomesDosDestinatarios,
		usuarionewsletter.EmailsDosDestinatarios,
		usuarionewsletter.DataDeCadastroDosDestinatarios
	FROM ".BANCO.".usuarionewsletter
	WHERE usuarionewsletter.EmailsDosDestinatarios RLIKE '%s'
	AND usuarionewsletter.AtivacaoDosDestinatarios = 1
	ORDER BY EmailsDosDestinatarios asc
	LIMIT ".$Inicio.",".$TamanhoPagina,
	FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaTituloDoEmail)))
	);
	$ResultadoUsuariosNewsletter = mysql_query($SelectUsuariosNewsletter) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($ResultadoUsuariosNewsletter)){			
		$BuscaMostrarEmails[$nCount]["ID"                            ] = trim($row[0]);
		$BuscaMostrarEmails[$nCount]["AtivacaoDosDestinatarios"      ] = trim($row[1]);
		$BuscaMostrarEmails[$nCount]["NomesDosDestinatarios"         ] = trim($row[2]);
		$BuscaMostrarEmails[$nCount]["EmailsDosDestinatarios"        ] = trim($row[3]);
		$BuscaMostrarEmails[$nCount]["DataDeCadastroDosDestinatarios"] = trim($row[4]);
	$nCount++;
	}
	mysql_Free_Result($ResultadoUsuariosNewsletter);
	#FIM MOSTRAR USUARIOS COM PESQUISA
}
	
#INICIO CONTAGEM
	$ContarQtdDeRegistros = "SELECT COUNT(*) FROM ".BANCO.".usuarionewsletter WHERE usuarionewsletter.AtivacaoDosDestinatarios = 1";
	list($TotalDeRegistros) = mysql_fetch_array(mysql_query($ContarQtdDeRegistros));
#FIM CONTAGEM
	
#INICIO CONTROLE DOS 2950 EMAIL
$ContarQtdDeRegistrosTotal = "SELECT COUNT(*) FROM ".BANCO.".usuarionewsletter WHERE usuarionewsletter.AtivacaoDosDestinatarios = '1'";
list($TotalDeRegistrosTotal) = mysql_fetch_array(mysql_query($ContarQtdDeRegistrosTotal, $ConexaoBanco));

$ConsultaEmailsExportados = "SELECT exportarusuariosnewsletter.ID,
	exportarusuariosnewsletter.IDUltimoUsuario,
	exportarusuariosnewsletter.QuantidadeExportado
FROM ".BANCO.".exportarusuariosnewsletter";

$ResultadoEmailsExportados = mysql_query($ConsultaEmailsExportados, $ConexaoBanco) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoEmailsExportados)){			
	$BuscaMostrarEmailsExportados[$nCount]["ID"] = trim($row[0]);
	$BuscaMostrarEmailsExportados[$nCount]["IDUltimoUsuario"    ] = trim($row[1]);
	$BuscaMostrarEmailsExportados[$nCount]["QuantidadeExportado"] = trim($row[2]);
$nCount++;
}
mysql_Free_Result($ResultadoEmailsExportados);

if (!isset($BuscaMostrarEmailsExportados[1]["ID"])) $BuscaMostrarEmailsExportados[1]["ID"] = '';

if($BuscaMostrarEmailsExportados[1]["ID"] == ''){
	$TotalEmailExportados = 0;
}else{
	$TotalEmailExportados = $BuscaMostrarEmailsExportados[1]["QuantidadeExportado"];
}
#FIM CONTROLE DOS 2950 EMAILS	
	?>
    </td>
  </tr>
  <tr>
    <td height="1"></td>
  </tr>
  <tr>
    <td><?php 
	if (!isset($BuscaMostrarEmails[1]["ID"])) $BuscaMostrarEmails[1]["ID"] = '';
	if($BuscaMostrarEmails[1]["ID"] != ''){ ?>
      <form id="FormListarUsuarios">
        <table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td height="20" colspan="3" align="center" class="TextoVerdana12B">Existem <strong><?php echo number_format($TotalDeRegistros, 0, ",", "."); ?></strong> e-mails &uacute;nicos no sistema<br />
              <br />              
              <input type="button" value="Limpar arquivo exportado" class="BotaoPadrao" onclick="AlterarConteudo('Ferramentas/Informativos/AcaoLimparEmail.php','DivResultadosInternos','');"/>
              &nbsp;&nbsp;
              <input type="button" value="Zerar contador e limpar arquivo" class="BotaoPadrao" onclick="AlterarConteudo('Ferramentas/Informativos/AcaoLimparExportacao.php','DivResultadosInternos','');"/>
              &nbsp;&nbsp;
              <input type="button" value="Download da &uacute;ltima lista exportada" class="BotaoPadrao" onclick="location.href='../Emails/DownloadEmails.php'"/>
              <br />
              <br />
              At&eacute; o momento voc&ecirc; exportou <strong><?php echo number_format($TotalEmailExportados, 0, ",", "."); ?></strong> de <strong><?php echo number_format($TotalDeRegistros, 0, ",", "."); ?></strong> e-mails, para continuar clique no bot&atilde;o exportar.</td>
          </tr>
          <tr>
            <td height="20" colspan="3" align="center" class="FundoLinhas">&nbsp;</td>
          </tr>
          <tr>
            <td height="5"></td>
            <td height="3"></td>
            <td height="5"></td>
          </tr>
          <tr>
            <td align="center"><input type="checkbox" name="CheckBoxMaster" id="CheckBoxMaster" class="TextoVerdana12A" onclick="SelecionarTodosCheckBox('FormListarUsuarios','chave','CheckBoxMaster','ValoresCheckbox');" /></td>
            <td class="TextoVerdana12A"><strong>E-mails dos destinat&aacute;rios</strong></td>
            <td align="center" class="TextoVerdana12A"><strong>Cadastro</strong></td>
          </tr>
          <tr>
            <td height="3" colspan="3" class="FundoLinhas"></td>
          </tr>
          <?php for($i=1;$i<=count($BuscaMostrarEmails);$i++){ ?>
          <tr class="FundoListaConteudo" id="LinhaTitulo<?php echo $i; ?>" onmouseover="document.getElementById('LinhaSubTitulo<?php echo $i; ?>').className='FundoListaConteudoDuasLinhasHover';" onmouseout="document.getElementById('LinhaSubTitulo<?php echo $i; ?>').className='FundoListaConteudo';">
            <td width="3%" align="center"><input type="checkbox" name="chave[]" id="chave[]" class="TextoVerdana12A" value="<?php echo $BuscaMostrarEmails[$i]["ID"]; ?>" onclick="SelecionarValoresPorCheckBox('FormListarUsuarios','chave','ValoresCheckbox');" /></td>
            <td width="82%" style="padding-left:3px;padding-right:3px;"><?php if($BuscaMostrarEmails[$i]["NomesDosDestinatarios"] != utf8_encode($BuscaMostrarEmails[$i]["EmailsDosDestinatarios"])){ echo utf8_encode($BuscaMostrarEmails[$i]["NomesDosDestinatarios"]); }else{ echo '-'; } ?></td>
            <td width="15%" align="center" style="padding-left:2px;padding-right:2px;"><?php echo substr(FormataDataBanco($BuscaMostrarEmails[$i]["DataDeCadastroDosDestinatarios"]),0,10); ?></td>
          </tr>
          <tr class="FundoListaConteudo" id="LinhaSubTitulo<?php echo $i; ?>" onmouseover="document.getElementById('LinhaTitulo<?php echo $i; ?>').className='FundoListaConteudoDuasLinhasHover';" onmouseout="document.getElementById('LinhaTitulo<?php echo $i; ?>').className='FundoListaConteudo';">
            <td align="center">&nbsp;</td>
            <td style="padding-left:3px;padding-right:3px;"><?php echo utf8_encode($BuscaMostrarEmails[$i]["EmailsDosDestinatarios"]); ?></td>
            <td align="center" style="padding-left:2px;padding-right:2px;">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" class="FundoLinhas" height="3"></td>
          </tr>
          <?php } ?>
          <tr>
            <td colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10" align="left"></td>
                </tr>
                <tr>
                  <td align="left" class="TextoVerdana12A"><table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="6">&nbsp;</td>
                        <td><input type="hidden" id="ValoresCheckbox" />
                          <img src="Img/SetaExcluirValoresSelecionados.gif" alt="" width="14" height="15" />
                          <input type="button" class="BotaoPadrao" value="Excluir e-mails selecionados" onClick="ConfirmacaoExclusaoPorCheckBox('Ferramentas/Informativos/AcaoExcluirEmail.php','DivResultadosInternos','IDUsuario='+encodeURIComponent(document.getElementById('ValoresCheckbox').value),'ValoresCheckbox');"/></td>
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
                    <select id="Paginacao" onchange="AlterarPaginaComPaginacaoNewsletter('Ferramentas/Informativos/ListarEmail.php', this.value, '<?php echo $CampoBuscaTituloDoEmail ?>');" class="TextFields">
                      <option value="" selected="selected">Selecione</option>
                      <?php			 
					   for ($i=1;$i<=$TotalPaginas;$i++){ 
							echo '<option value='.$i.' id="NumeroDaPagina">'.$i.'</option>';
					   }
					 ?>
                    </select>                  </td>
                </tr>
              </table>
              <?php } ?></td>
          </tr>
        </table>
      </form>
      <?php }else{ ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" class="TextoVerdana12B">Nenhum e-mail foi encontrado!</td>
        </tr>
        <tr>
          <td height="10"></td>
        </tr>
        <tr>
          <td height="3" class="FundoLinhas"></td>
        </tr>
      </table>
      <?php } ?>
    </td>
  </tr>
</table>
<?php mysql_Close($ConexaoBanco); ?>