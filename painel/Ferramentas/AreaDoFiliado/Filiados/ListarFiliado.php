<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());


	#INICIO VALIDANDO VARIAVEIS VAZIAS
	if (!isset($CampoBuscaLoginFiliados)) $CampoBuscaLoginFiliados = '';
	#FIM VALIDANDO VARIAVEIS VAZIAS
	
	if ($CampoBuscaLoginFiliados == ''){
	#INICIO MOSTRAR FILIADOS SE O CAMPO BUSCA VIR VAZIO
	
	$SelectFiliados = sprintf("SELECT cadastrousuariofiliado.ID,
		cadastrousuariofiliado.AtivacaoUsuario,							
		cadastrousuariofiliado.LoginUsuario,
		cadastrousuariofiliado.SenhaUsuario,
		cadastrousuariofiliado.NomeUsuario			
	FROM ".BANCO.".cadastrousuariofiliado
	WHERE cadastrousuariofiliado.AtivacaoUsuario = '%d'
	ORDER BY ID desc",
		FiltrarCampos(mysql_real_escape_string(utf8_decode(1)))
	);

	$ResultadoFiliados = mysql_query($SelectFiliados) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($ResultadoFiliados)){			
		$BuscaMostrarFiliados[$nCount]["ID"              ] = trim($row[0]);
		$BuscaMostrarFiliados[$nCount]["AtivacaoUsuario" ] = trim($row[1]);
		$BuscaMostrarFiliados[$nCount]["LoginUsuario"    ] = trim($row[2]);
		$BuscaMostrarFiliados[$nCount]["SenhaUsuario"    ] = trim($row[3]);
		$BuscaMostrarFiliados[$nCount]["NomeUsuario"     ] = trim($row[4]);			
	$nCount++;
	}
	mysql_Free_Result($ResultadoFiliados);	
	#FIM MOSTRAR USUARIOS SE O CAMPO BUSCA VIR VAZIO
	}else{
	#INICIO MOSTRAR USUARIOS COM PESQUISA
	$SelectFiliados = sprintf("SELECT cadastrousuariofiliado.ID,
		cadastrousuariofiliado.AtivacaoUsuario,							
		cadastrousuariofiliado.LoginUsuario,
		cadastrousuariofiliado.SenhaUsuario,
		cadastrousuariofiliado.NomeUsuario			
	FROM ".BANCO.".cadastrousuariofiliado
	WHERE cadastrousuariofiliado.LoginUsuario RLIKE '%s'
	AND cadastrousuariofiliado.AtivacaoUsuario = '1' 
	OR	cadastrousuariofiliado.NomeUsuario RLIKE '%s'		
	AND cadastrousuariofiliado.AtivacaoUsuario = '1'
	ORDER BY ID desc",
		FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaLoginFiliados))),
		FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaLoginFiliados)))
	);
	$ResultadoFiliados = mysql_query($SelectFiliados) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($ResultadoFiliados)){			
		$BuscaMostrarFiliados[$nCount]["ID"              ] = trim($row[0]);
		$BuscaMostrarFiliados[$nCount]["AtivacaoUsuario" ] = trim($row[1]);
		$BuscaMostrarFiliados[$nCount]["LoginUsuario"    ] = trim($row[2]);
		$BuscaMostrarFiliados[$nCount]["SenhaUsuario"    ] = trim($row[3]);
		$BuscaMostrarFiliados[$nCount]["NomeUsuario"     ] = trim($row[4]);				
	$nCount++;
	}
	mysql_Free_Result($ResultadoFiliados);
	#FIM MOSTRAR USUARIOS COM PESQUISA
	}

	#INICIO VALIDANDO VARIAVEIS VAZIAS
		if (!isset($BuscaMostrarFiliados)) $BuscaMostrarFiliados = '';
	#FIM VALIDANDO VARIAVEIS VAZIAS

if($BuscaMostrarFiliados != ''){

?>
<script language="javascript" type="text/javascript">window.scrollTo(0,0);</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td width="35%" class="TextoVerdana12A"><strong>Nome da associa&ccedil;&atilde;o</strong></td>
          <td width="30%" class="TextoVerdana12A"><strong>Usu&aacute;rio</strong></td>
          <td colspan="2" align="center" class="TextoVerdana12A">&nbsp;</td>
        </tr>
        <tr>
          <td height="1" colspan="4" class="FundoLinhas"></td>
        </tr>
        <?php for($i=1;$i<=count($BuscaMostrarFiliados);$i++){ ?>
        <tr class="FundoListaConteudo">
          <td width="35%" style="padding-left:3px;padding-right:3px;"><?php echo utf8_encode($BuscaMostrarFiliados[$i]["NomeUsuario"]); ?></td>
          <td width="30%" style="padding-left:3px;padding-right:3px;"><?php echo utf8_encode($BuscaMostrarFiliados[$i]["LoginUsuario"]); ?></td>
          <td width="10%" align="center" style="padding-left:2px;padding-right:2px;"><a href="javascript:void(0);" onClick="EnviarFormularios('Ferramentas/AreaDoFiliado/Filiados/EditarFiliado.php','DivResultadosInternos','IDFiliado=<?php echo $BuscaMostrarFiliados[$i]["ID"] ?>');" class="LinkBlock">Editar</a></td>
          <td width="15%" align="center" style="padding-left:2px;padding-right:2px;"><a href="javascript:void(0);" onClick="ConfirmacoesEdicaoExclusao('Ferramentas/AreaDoFiliado/Filiados/AcaoExcluirFiliado.php','DivResultadosInternos','IDFiliado=<?php echo $BuscaMostrarFiliados[$i]["ID"] ?>','<?php $FiltroParaEvitarErroJavascript = array('"', "'", "=", ";", ",", ".", ":", "[", "]", "{", "}", "(", ")"); $TextoFiltradoParaEvitarErroJavascript = str_replace($FiltroParaEvitarErroJavascript, "", utf8_encode($BuscaMostrarFiliados[$i]["NomeUsuario"])); echo $TextoFiltradoParaEvitarErroJavascript; ?>','excluir o filiado');" class="LinkBlock">Excluir</a></td>
        </tr>
        <tr>
          <td colspan="4" class="FundoLinhas" height="3"></td>
        </tr>
        <?php } ?>
        <tr>
          <td height="5" colspan="4"></td>
        </tr>
      </table></td>
  </tr>
</table>
<?php }else{?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="5" height="5"></td>
  </tr>
  <tr>
    <td class="TextoVerdana12B"> Sua busca n&atilde;o encontrou nenhum filiado.</td>
  </tr>
  <tr>
    <td colspan="5" height="10"></td>
  </tr>
  <tr>
    <td colspan="5" class="FundoLinhas" height="5"></td>
  </tr>
</table>
<?php } mysql_Close($ConexaoBanco); ?>
