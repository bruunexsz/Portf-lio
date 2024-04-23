<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$cSQL = sprintf("SELECT cadastrofiliadosinscricaocampeonatos.ID,		
	cadastrofiliadosinscricaocampeonatos.IDUsuarioFiliado,
	cadastrofiliadosinscricaocampeonatos.AtivacaoFicha,
	cadastrofiliadosinscricaocampeonatos.DataPreenchimento,
	cadastrofiliadosinscricaocampeonatos.NomeCampeonato,
	cadastrofiliadosinscricaocampeonatos.NomeAssociacao,
	cadastrofiliadosinscricaocampeonatos.Professor,
	cadastrofiliadosinscricaocampeonatos.DDDTelefone,
	cadastrofiliadosinscricaocampeonatos.NAtletaKataKumite,
	cadastrofiliadosinscricaocampeonatos.NAtletas,
	cadastrofiliadosinscricaocampeonatos.TotalKata,
	cadastrofiliadosinscricaocampeonatos.Valor,
	cadastrofiliadosinscricaocampeonatos.Arbitro,
	cadastrofiliadosinscricaocampeonatos.Mesario,
	cadastrofiliadosinscricaocampeonatos.ProfessorResponsavel,
	cadastrofiliadosinscricaocampeonatos.FichaLida
FROM ".BANCO.".cadastrofiliadosinscricaocampeonatos
WHERE cadastrofiliadosinscricaocampeonatos.AtivacaoFicha = 1
AND cadastrofiliadosinscricaocampeonatos.ID = '%d'
ORDER BY ID desc",
	FiltrarCampos(mysql_real_escape_string(utf8_decode($IdCampeonato)))
	);
$oRS = mysql_query($cSQL) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($oRS)){			
	$BuscaMostrarCampeonatos[$nCount]["ID"                   ] = trim($row[0]);
	$BuscaMostrarCampeonatos[$nCount]["IDUsuarioFiliado"     ] = trim($row[1]);
	$BuscaMostrarCampeonatos[$nCount]["AtivacaoFicha"        ] = trim($row[2]);
	$BuscaMostrarCampeonatos[$nCount]["DataPreenchimento"    ] = trim($row[3]);
	$BuscaMostrarCampeonatos[$nCount]["NomeCampeonato"       ] = trim($row[4]);
	$BuscaMostrarCampeonatos[$nCount]["NomeAssociacao"       ] = trim($row[5]);
	$BuscaMostrarCampeonatos[$nCount]["Professor"            ] = trim($row[6]);
	$BuscaMostrarCampeonatos[$nCount]["DDDTelefone"          ] = trim($row[7]);
	$BuscaMostrarCampeonatos[$nCount]["NAtletaKataKumite"    ] = trim($row[8]);
	$BuscaMostrarCampeonatos[$nCount]["NAtletas"             ] = trim($row[9]);
	$BuscaMostrarCampeonatos[$nCount]["TotalKata"            ] = trim($row[10]);
	$BuscaMostrarCampeonatos[$nCount]["Valor"                ] = trim($row[11]);
	$BuscaMostrarCampeonatos[$nCount]["Arbitro"              ] = trim($row[12]);
	$BuscaMostrarCampeonatos[$nCount]["Mesario"              ] = trim($row[13]);
	$BuscaMostrarCampeonatos[$nCount]["ProfessorResponsavel" ] = trim($row[14]);
	$BuscaMostrarCampeonatos[$nCount]["FichaLida"            ] = trim($row[15]);
$nCount++;
}
mysql_Free_Result($oRS);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ficha de inscri&ccedil;&atilde;o para campeonatos</title>
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
if (!isset($IdCampeonato)) $IdCampeonato = '';
if(FiltrarCampos($IdCampeonato) != ''){ ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="TextoImpressao"><strong class="TextoFKPImpressao">FKP</strong></td>
  </tr>
  <tr>
    <td class="TextoImpressao">FEDERA&Ccedil;&Atilde;O DE KARAT&Ecirc; PAULISTA - CNPJ. 02.959.715/0001-00<br />
FILIADA A FBK<br />
www.fkp.com.br - karate@fkp.com.br - Fone: (17) 3353-2248 - Fax: (17) 3353-2249<br /></td>
  </tr>
  <tr>
    <td height="10" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong class="TextoTitulosComum">Ficha de inscrição para campeonatos</strong></td>
  </tr>
  <tr>
    <td height="10" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong>Nome do campeonato:</strong> <?php echo $BuscaMostrarCampeonatos[1]["NomeCampeonato"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>
  
  <tr>
    <td class="TextoImpressao"><strong>Nome da associa&ccedil;&atilde;o:</strong> <?php echo $BuscaMostrarCampeonatos[1]["NomeAssociacao"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>
  
  <tr>
    <td class="TextoImpressao"><strong>Professor:</strong> <?php echo $BuscaMostrarCampeonatos[1]["Professor"]; ?><strong> Telefone: </strong><?php echo $BuscaMostrarCampeonatos[1]["DDDTelefone"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao">
    <!--/INICIO ATLETAS/-->						
			<table width="100%" border="0" cellspacing="0" cellpadding="1" class="TabelaVisualizarAtletas">
            	<tr>
                	<td width="2%" style="border-bottom-width:0px;"><strong>Nº</strong></td>
                    <td width="58%" style="border-bottom-width:0px;"><strong>Nome do atleta</strong></td>
                    <td align="center" width="20%" style="border-bottom-width:0px;"><strong>N&ordm; da <br />categoria Kata</strong></td>
                    <td align="center" width="20%" style="border-bottom-width:0px;"><strong>N&ordm; da <br />categoria Kumite</strong></td>
                </tr>
				<?php echo $BuscaMostrarCampeonatos[1]["NAtletaKataKumite"]; ?>
              </table>
    <!--/FIM ATLETAS/-->    </td>
  </tr>
  
  <tr>
    <td height="15" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong>N&ordm; de atletas: </strong><?php echo $BuscaMostrarCampeonatos[1]["NAtletas"]; ?><strong> Total Kata:</strong> <?php echo $BuscaMostrarCampeonatos[1]["TotalKata"]; ?><strong> Valor R$: </strong><?php echo $BuscaMostrarCampeonatos[1]["Valor"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>
  
  <tr>
    <td class="TextoImpressao"><strong>&Aacute;rbitro:</strong> <?php echo $BuscaMostrarCampeonatos[1]["Arbitro"]; ?><strong> Mes&aacute;rio: </strong><?php echo $BuscaMostrarCampeonatos[1]["Mesario"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>
  
  <tr>
    <td class="TextoImpressao"><strong>Professor respons&aacute;vel:</strong> <?php echo $BuscaMostrarCampeonatos[1]["ProfessorResponsavel"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong>Ficha preenchida em: </strong><?php echo substr(FormataDataBanco($BuscaMostrarCampeonatos[1]["DataPreenchimento"]),0,10); ?><strong> às </strong><?php echo substr(FormataDataBanco($BuscaMostrarCampeonatos[1]["DataPreenchimento"]),10,10); ?></td>
  </tr>
</table>
<?php }else{
echo "<script>alert('Acesso negado!');</script>";
exit(0);
}
mysql_Close($ConexaoBanco); ?>
</body>
</html>