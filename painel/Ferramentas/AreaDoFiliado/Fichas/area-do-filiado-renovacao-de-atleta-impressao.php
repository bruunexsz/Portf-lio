<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$cSQL = sprintf("SELECT cadastrofiliadosrenovacaodeatleta.ID,
		cadastrofiliadosrenovacaodeatleta.IDUsuarioFiliado,
		cadastrofiliadosrenovacaodeatleta.AtivacaoFicha,
		cadastrofiliadosrenovacaodeatleta.DataPreenchimento,
		cadastrofiliadosrenovacaodeatleta.NomeDaAssociacao,
		cadastrofiliadosrenovacaodeatleta.Professor,
		cadastrofiliadosrenovacaodeatleta.DDDTelefone,
		cadastrofiliadosrenovacaodeatleta.NomesAtletasInformacoes,
		cadastrofiliadosrenovacaodeatleta.NRenovacoes,
		cadastrofiliadosrenovacaodeatleta.Valor,
		cadastrofiliadosrenovacaodeatleta.FichaLida
	FROM ".BANCO.".cadastrofiliadosrenovacaodeatleta
	WHERE cadastrofiliadosrenovacaodeatleta.AtivacaoFicha = 1
	AND cadastrofiliadosrenovacaodeatleta.ID = '%d'
	ORDER BY ID desc",
	FiltrarCampos(mysql_real_escape_string(utf8_decode($IdRenovacao)))
	);
	$oRS = mysql_query($cSQL) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($oRS)){			
		$BuscaMostrarRenovacao[$nCount]["ID"                      ] = trim($row[0]);
		$BuscaMostrarRenovacao[$nCount]["IDUsuarioFiliado"        ] = trim($row[1]);
		$BuscaMostrarRenovacao[$nCount]["AtivacaoFicha"           ] = trim($row[2]);
		$BuscaMostrarRenovacao[$nCount]["DataPreenchimento"       ] = trim($row[3]);
		$BuscaMostrarRenovacao[$nCount]["NomeDaAssociacao"        ] = trim($row[4]);
		$BuscaMostrarRenovacao[$nCount]["Professor"               ] = trim($row[5]);
		$BuscaMostrarRenovacao[$nCount]["DDDTelefone"             ] = trim($row[6]);
		$BuscaMostrarRenovacao[$nCount]["NomesAtletasInformacoes" ] = trim($row[7]);
		$BuscaMostrarRenovacao[$nCount]["NRenovacoes"             ] = trim($row[8]);
		$BuscaMostrarRenovacao[$nCount]["Valor"                   ] = trim($row[9]);
		$BuscaMostrarRenovacao[$nCount]["FichaLida"               ] = trim($row[10]);
	$nCount++;
	}
	mysql_Free_Result($oRS);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ficha de renova&ccedil;&atilde;o de atleta</title>
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
if (!isset($IdRenovacao)) $IdRenovacao = '';
if($IdRenovacao != ''){ ?>

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
    <td class="TextoImpressao"><strong class="TextoTitulosComum">Ficha de renovação de atleta</strong></td>
  </tr>
  <tr>
    <td height="10" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong>Nome do associacao: </strong><?php echo $BuscaMostrarRenovacao[1]["NomeDaAssociacao"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>
  
  <tr>
    <td class="TextoImpressao"><strong>Professor: </strong><?php echo $BuscaMostrarRenovacao[1]["Professor"]; ?><strong> Telefone:</strong> <?php echo $BuscaMostrarRenovacao[1]["DDDTelefone"]; ?></td>
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
        <?php echo $BuscaMostrarRenovacao[1]["NomesAtletasInformacoes"]; ?>
     </table>
    <!--/FIM ATLETAS/-->    </td>
  </tr>
  
  <tr>
    <td height="15" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong>N&ordm; de renovações: </strong><?php echo $BuscaMostrarRenovacao[1]["NRenovacoes"]; ?><strong> Valor R$:</strong><?php echo $BuscaMostrarRenovacao[1]["Valor"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>  

  <tr>
    <td class="TextoImpressao"><strong>Ficha preenchida em: </strong><?php echo substr(FormataDataBanco($BuscaMostrarRenovacao[1]["DataPreenchimento"]),0,10); ?> <strong>às</strong> <?php echo substr(FormataDataBanco($BuscaMostrarRenovacao[1]["DataPreenchimento"]),10,10); ?></td>
  </tr>
</table>
<?php }else{
echo "<script>alert('Acesso negado!');</script>";
exit(0);
}
 mysql_Close($ConexaoBanco); ?>
</body>
</html>