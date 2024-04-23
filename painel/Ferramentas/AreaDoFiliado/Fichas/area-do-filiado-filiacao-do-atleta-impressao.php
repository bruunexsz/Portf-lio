<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

	$cSQL = sprintf("SELECT cadastrofiliadosfiliacaodeatleta.ID,		
		cadastrofiliadosfiliacaodeatleta.IDUsuarioFiliado,
		cadastrofiliadosfiliacaodeatleta.AtivacaoFicha,
		cadastrofiliadosfiliacaodeatleta.DataPreenchimento,
		cadastrofiliadosfiliacaodeatleta.NRegistroFKP,
		cadastrofiliadosfiliacaodeatleta.NomeDoAtleta,
		cadastrofiliadosfiliacaodeatleta.Endereco,
		cadastrofiliadosfiliacaodeatleta.NEndereco,
		cadastrofiliadosfiliacaodeatleta.Bairro,
		cadastrofiliadosfiliacaodeatleta.Telefone,
		cadastrofiliadosfiliacaodeatleta.Cidade,
		cadastrofiliadosfiliacaodeatleta.Estado,
		cadastrofiliadosfiliacaodeatleta.CEP,
		cadastrofiliadosfiliacaodeatleta.NomeDoPai,
		cadastrofiliadosfiliacaodeatleta.NomeDaMae,
		cadastrofiliadosfiliacaodeatleta.DtNascimento,
		cadastrofiliadosfiliacaodeatleta.RG,
		cadastrofiliadosfiliacaodeatleta.GraduacaoAtual,
		cadastrofiliadosfiliacaodeatleta.DtGraduacaoAtual,
		cadastrofiliadosfiliacaodeatleta.AssosiacaoFiliada,
		cadastrofiliadosfiliacaodeatleta.ProfessorResponsavel,
		cadastrofiliadosfiliacaodeatleta.FichaLida		
	FROM ".BANCO.".cadastrofiliadosfiliacaodeatleta
	WHERE cadastrofiliadosfiliacaodeatleta.AtivacaoFicha = 1
	AND cadastrofiliadosfiliacaodeatleta.ID = '%d'
	ORDER BY ID desc",
	FiltrarCampos(mysql_real_escape_string(utf8_decode($IdAtletas)))
	);
	
	#echo $cSQL;
	$oRS = mysql_query($cSQL) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($oRS)){			
		$BuscaMostrarAtletas[$nCount]["ID"                  ] = trim($row[0]);
		$BuscaMostrarAtletas[$nCount]["IDUsuarioFiliado"    ] = trim($row[1]);
		$BuscaMostrarAtletas[$nCount]["AtivacaoFicha"       ] = trim($row[2]);
		$BuscaMostrarAtletas[$nCount]["DataPreenchimento"   ] = trim($row[3]);
		$BuscaMostrarAtletas[$nCount]["NRegistroFKP"        ] = trim($row[4]);
		$BuscaMostrarAtletas[$nCount]["NomeDoAtleta"        ] = trim($row[5]);
		$BuscaMostrarAtletas[$nCount]["Endereco"            ] = trim($row[6]);
		$BuscaMostrarAtletas[$nCount]["NEndereco"           ] = trim($row[7]);
		$BuscaMostrarAtletas[$nCount]["Bairro"              ] = trim($row[8]);
		$BuscaMostrarAtletas[$nCount]["Telefone"            ] = trim($row[9]);
		$BuscaMostrarAtletas[$nCount]["Cidade"              ] = trim($row[10]);
		$BuscaMostrarAtletas[$nCount]["Estado"              ] = trim($row[11]);
		$BuscaMostrarAtletas[$nCount]["CEP"                 ] = trim($row[12]);
		$BuscaMostrarAtletas[$nCount]["NomeDoPai"           ] = trim($row[13]);
		$BuscaMostrarAtletas[$nCount]["NomeDaMae"           ] = trim($row[14]);
		$BuscaMostrarAtletas[$nCount]["DtNascimento"        ] = trim($row[15]);
		$BuscaMostrarAtletas[$nCount]["RG"                  ] = trim($row[16]);
		$BuscaMostrarAtletas[$nCount]["GraduacaoAtual"      ] = trim($row[17]);
		$BuscaMostrarAtletas[$nCount]["DtGraduacaoAtual"    ] = trim($row[18]);
		$BuscaMostrarAtletas[$nCount]["AssosiacaoFiliada"   ] = trim($row[19]);
		$BuscaMostrarAtletas[$nCount]["ProfessorResponsavel"] = trim($row[20]);
		$BuscaMostrarAtletas[$nCount]["FichaLida"           ] = trim($row[21]);
	$nCount++;
	}
	mysql_Free_Result($oRS);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ficha de filia&ccedil;&atilde;o de atleta</title>
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
</style>
</head>
<body onload="window.print();">
<?php if($IdAtletas != ""){ ?>

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
    <td class="TextoTitulosComum">Ficha de filia&ccedil;&atilde;o de atleta</td>
  </tr>
  <tr>
    <td height="10" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong>N&ordm; Reg. FKP: </strong><?php echo $BuscaMostrarAtletas[1]["NRegistroFKP"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>
  
  <tr>
    <td class="TextoImpressao"><strong>Nome: </strong><?php echo $BuscaMostrarAtletas[1]["NomeDoAtleta"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>
  
  <tr>
    <td class="TextoImpressao"><strong>Endere&ccedil;o:</strong> <?php echo $BuscaMostrarAtletas[1]["Endereco"]; ?> <strong>- </strong><?php echo $BuscaMostrarAtletas[1]["NEndereco"]; ?><strong> Bairro: </strong><?php echo $BuscaMostrarAtletas[1]["Bairro"]; ?><strong> Telefone: </strong><?php echo $BuscaMostrarAtletas[1]["Telefone"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong>Cidade:</strong> <?php echo $BuscaMostrarAtletas[1]["Cidade"]; ?>/<?php echo $BuscaMostrarAtletas[1]["Estado"]; ?><strong> CEP: </strong><?php echo $BuscaMostrarAtletas[1]["CEP"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong>Nome do Pai:</strong> <?php echo $BuscaMostrarAtletas[1]["NomeDoPai"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong>Nome da m&atilde;e:</strong> <?php echo $BuscaMostrarAtletas[1]["NomeDaMae"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong>Data de nascimento:</strong> <?php echo $BuscaMostrarAtletas[1]["DtNascimento"]; ?><strong> RG:</strong> <?php echo $BuscaMostrarAtletas[1]["RG"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong>Gradua&ccedil;&atilde;o atual:</strong> <?php echo $BuscaMostrarAtletas[1]["GraduacaoAtual"]; ?><strong> Data: </strong><?php echo $BuscaMostrarAtletas[1]["DtGraduacaoAtual"]; ?></td>
  </tr>
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong>Associa&ccedil;&atilde;o filiada: </strong><?php echo $BuscaMostrarAtletas[1]["AssosiacaoFiliada"]; ?><strong> Professor respons&aacute;vel: </strong><?php echo $BuscaMostrarAtletas[1]["ProfessorResponsavel"]; ?></td>
  </tr>
  
  <tr>
    <td height="5" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong>Ficha preenchida em:</strong> <?php echo substr(FormataDataBanco($BuscaMostrarAtletas[1]["DataPreenchimento"]),0,10); ?> <strong>&agrave;s</strong> <?php echo substr(FormataDataBanco($BuscaMostrarAtletas[1]["DataPreenchimento"]),10,10); ?></td>
  </tr>
</table>
<?php }else{
echo "<script>alert('Acesso negado!');</script>";
exit(0);
}
 mysql_Close($ConexaoBanco); ?>
</body>
</html>