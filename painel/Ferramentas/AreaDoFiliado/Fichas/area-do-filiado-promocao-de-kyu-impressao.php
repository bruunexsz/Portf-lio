<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

	$cSQL = sprintf("SELECT cadastrofiliadospromocaodekyu.ID,		
		cadastrofiliadospromocaodekyu.IDUsuarioFiliado,
		cadastrofiliadospromocaodekyu.AtivacaoFicha,
		cadastrofiliadospromocaodekyu.DataPreenchimento,
		cadastrofiliadospromocaodekyu.NomeDaAssociacao,
		cadastrofiliadospromocaodekyu.Professor,
		cadastrofiliadospromocaodekyu.DDDTelefone,
		cadastrofiliadospromocaodekyu.DtDoExame,
		cadastrofiliadospromocaodekyu.Examinador,
		cadastrofiliadospromocaodekyu.NomesAtletasInformacoes,
		cadastrofiliadospromocaodekyu.NPromocoes,
		cadastrofiliadospromocaodekyu.Valor,
		cadastrofiliadospromocaodekyu.FichaLida		
	FROM ".BANCO.".cadastrofiliadospromocaodekyu
	WHERE cadastrofiliadospromocaodekyu.AtivacaoFicha = 1
	AND cadastrofiliadospromocaodekyu.ID = '%d'
	ORDER BY ID desc",
	FiltrarCampos(mysql_real_escape_string(utf8_decode($IdPromocaoDeKyu)))
	);
	
	#echo $cSQL;
	$oRS = mysql_query($cSQL) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($oRS)){			
		$BuscaMostrarPromocaoDeKyu[$nCount]["ID"                      ] = trim($row[0]);
		$BuscaMostrarPromocaoDeKyu[$nCount]["IDUsuarioFiliado"        ] = trim($row[1]);
		$BuscaMostrarPromocaoDeKyu[$nCount]["AtivacaoFicha"           ] = trim($row[2]);
		$BuscaMostrarPromocaoDeKyu[$nCount]["DataPreenchimento"       ] = trim($row[3]);
		$BuscaMostrarPromocaoDeKyu[$nCount]["NomeDaAssociacao"        ] = trim($row[4]);
		$BuscaMostrarPromocaoDeKyu[$nCount]["Professor"               ] = trim($row[5]);
		$BuscaMostrarPromocaoDeKyu[$nCount]["DDDTelefone"             ] = trim($row[6]);
		$BuscaMostrarPromocaoDeKyu[$nCount]["DtDoExame"               ] = trim($row[7]);
		$BuscaMostrarPromocaoDeKyu[$nCount]["Examinador"              ] = trim($row[8]);
		$BuscaMostrarPromocaoDeKyu[$nCount]["NomesAtletasInformacoes" ] = trim($row[9]);
		$BuscaMostrarPromocaoDeKyu[$nCount]["NPromocoes"              ] = trim($row[10]);
		$BuscaMostrarPromocaoDeKyu[$nCount]["Valor"                   ] = trim($row[11]);
		$BuscaMostrarPromocaoDeKyu[$nCount]["FichaLida"               ] = trim($row[12]);
	$nCount++;
	}
	mysql_Free_Result($oRS);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Promo&ccedil;&atilde;o de kyu</title>
<style type="text/css">
.TextoImpressao {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	color: #000000;
	text-decoration: none;
}
.TextoFKPImpressao {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 48px;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	color: #000000;
	text-decoration: none;
}
.TextoTitulosComum {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 19px;
	font-style: normal;
	line-height: normal;
	font-weight: bold;
	font-variant: normal;
	text-transform: none;
	color: #000000;
	text-decoration: none;
	word-spacing: -1px;
	letter-spacing: -1px;
}
.TabelaVisualizarAtletas td {
	border-style: solid;
	border-bottom-width: 1px;
	border-bottom-color:#CCCCCC;
	border-top-width: 0px;
	border-right-width: 0px;
	border-left-width: 0px;
}
</style>
</head>
<body onload="window.print();">
<?php 
if (!isset($IdPromocaoDeKyu)) $IdPromocaoDeKyu = '';
if($IdPromocaoDeKyu != ''){ ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="TextoImpressao"><strong class="TextoFKPImpressao">FKP</strong></td>
  </tr>
  <tr>
    <td class="TextoImpressao">FEDERA&Ccedil;&Atilde;O DE KARAT&Ecirc; PAULISTA - CNPJ. 02.959.715/0001-00<br />
FILIADA A FBK<br />
www.fkp.com.br - karate@fkp.com.br - Fone: (17) 3353-2248 - Fax: (17) 3353-2249</td>
  </tr>
  <tr>
    <td height="10" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong class="TextoTitulosComum">Promo&ccedil;&atilde;o de kyu</strong></td>
  </tr>
  <tr>
    <td height="10" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong>Nome do associacao: </strong><?php echo $BuscaMostrarPromocaoDeKyu[1]["NomeDaAssociacao"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>
  
  <tr>
    <td class="TextoImpressao"><strong>Professor: </strong><?php echo $BuscaMostrarPromocaoDeKyu[1]["Professor"]; ?><strong> Telefone: </strong><?php echo $BuscaMostrarPromocaoDeKyu[1]["DDDTelefone"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td height="10" class="TextoImpressao"><strong>Data do exame: </strong><?php echo $BuscaMostrarPromocaoDeKyu[1]["DtDoExame"]; ?><strong> Examinador:</strong> <?php echo $BuscaMostrarPromocaoDeKyu[1]["Examinador"]; ?></td>
  </tr>
  <tr>
    <td height="10" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td height="10" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao">
    <!--/INICIO ATLETAS/-->
	<table width="100%" cellspacing="0" cellpadding="1" class="TabelaVisualizarAtletas">
    	<tr>
        	<td align="left" style="border-bottom-width:0px;"><strong>N&ordm;</strong></td>
            <td style="border-bottom-width:0px;"><strong>Nome do atleta</strong></td>
            <td align="center" style="border-bottom-width:0px;"><strong>N&ordm; FKP</strong></td>
            <td align="center" style="border-bottom-width:0px;"><strong>Kyu</strong></td>
            <td align="center" style="border-bottom-width:0px;"><strong>Dt. Nascimento</strong></td>
            <td align="center" style="border-bottom-width:0px;"><strong>N&ordm; RG</strong></td>
        </tr>
        <?php echo $BuscaMostrarPromocaoDeKyu[1]["NomesAtletasInformacoes"]; ?>
     </table>
    <!--/FIM ATLETAS/-->    </td>
  </tr>
  
  <tr>
    <td height="15" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong>N&ordm; de promo&ccedil;&otilde;es: </strong><?php echo $BuscaMostrarPromocaoDeKyu[1]["NPromocoes"]; ?><strong> Valor R$: </strong><?php echo $BuscaMostrarPromocaoDeKyu[1]["Valor"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>  

  <tr>
    <td class="TextoImpressao"><strong>Ficha preenchida em:</strong> <?php echo substr(FormataDataBanco($BuscaMostrarPromocaoDeKyu[1]["DataPreenchimento"]),0,10); ?><strong> às</strong> <?php echo substr(FormataDataBanco($BuscaMostrarPromocaoDeKyu[1]["DataPreenchimento"]),10,10); ?></td>
  </tr>
</table>
<?php }else{
echo "<script>alert('Acesso negado!');</script>";
exit(0);
}
mysql_Close($ConexaoBanco); ?>
</body>
</html>