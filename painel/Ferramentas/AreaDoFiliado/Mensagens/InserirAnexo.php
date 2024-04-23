<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

	#INICIO SELECT ANEXOS	
	$cSQL = sprintf("SELECT cadastroanexomensagensfiliado.ID,
				cadastroanexomensagensfiliado.DataDeCadastroDoAnexo,
				cadastroanexomensagensfiliado.NomeDoAnexoDaMensagem,
				cadastroanexomensagensfiliado.PastaDeConteudoDaMensagem
			FROM ".BANCO.".cadastroanexomensagensfiliado
			WHERE cadastroanexomensagensfiliado.PastaDeConteudoDaMensagem  = '%s'
			ORDER BY ID asc",
			FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoPastaDeConteudo)))
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
	#INICIO MOSTRAR ANEXOS
	
if (!isset($BuscaMostrarAnexos[1]["ID"])) $BuscaMostrarAnexos[1]["ID"] = '';
if($BuscaMostrarAnexos[1]["ID"] == ''){
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="TextoVerdana12B">Nenhum anexo foi encontrado!</td>
  </tr>
  <tr>
    <td height="30"></td>
  </tr>
</table>
<?php 
}else{
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="TextoVerdana12A"><strong>Arquivos enviados para a mensagem:</strong></td>
  </tr>
  <tr>
    <td height="15"></td>
  </tr>
  <?php for($i=1;$i<=count($BuscaMostrarAnexos);$i++){ ?>
  <tr>
    <td valign="middle" class="TextoVerdana12A">&raquo; <?php echo $BuscaMostrarAnexos[$i]["NomeDoAnexoDaMensagem"] ?> <a href="javascript:void(0);" onclick="AlterarConteudo('Ferramentas/AreaDoFiliado/Mensagens/ExcluirAnexo.php','DivInserirAnexo','CampoPastaDeConteudo='+encodeURIComponent('<?php echo $CampoPastaDeConteudo; ?>')+'&IdDoArquivo='+encodeURIComponent('<?php echo $BuscaMostrarAnexos[$i]["ID"] ?>'));"><font class="TextoVerdana12B"><img src="Img/IcoExcluir.gif" alt="Excluir" width="15" height="15" hspace="4" border="0"  align="middle" style="padding-bottom:5px;"/></font></a></td>
  </tr>
  <tr>
    <td align="center" class="FundoLinhas">&nbsp;</td>
  </tr>
  <?php } ?>
  <tr>
    <td height="15"></td>
  </tr>
</table>
<?php
}
	#FIM MOSTRAR ANEXOS
	mysql_Close($ConexaoBanco);
?>
