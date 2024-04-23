<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

$cSQL = sprintf("SELECT cadastrofiliadosfiliacaodeassociacao.ID,
		cadastrofiliadosfiliacaodeassociacao.IDUsuarioFiliado,
		cadastrofiliadosfiliacaodeassociacao.AtivacaoFicha,
		cadastrofiliadosfiliacaodeassociacao.DataPreenchimento,
		cadastrofiliadosfiliacaodeassociacao.NomeDoRepresentante,
		cadastrofiliadosfiliacaodeassociacao.RG,
		cadastrofiliadosfiliacaodeassociacao.CPF,
		cadastrofiliadosfiliacaodeassociacao.DtNascimento,
		cadastrofiliadosfiliacaodeassociacao.CidadeDeNascimento,
		cadastrofiliadosfiliacaodeassociacao.EstadoDeNascimento,
		cadastrofiliadosfiliacaodeassociacao.NomeDaAssociacao,
		cadastrofiliadosfiliacaodeassociacao.EnderecoDaAssociacao,
		cadastrofiliadosfiliacaodeassociacao.BairroDaAssociacao,
		cadastrofiliadosfiliacaodeassociacao.TelefoneDaAssociacao,
		cadastrofiliadosfiliacaodeassociacao.CepDaAssociacao,
		cadastrofiliadosfiliacaodeassociacao.CidadeDaAssociacao,
		cadastrofiliadosfiliacaodeassociacao.EstadoDaAssociacao,
		cadastrofiliadosfiliacaodeassociacao.CnpjDaAssociacao,
		cadastrofiliadosfiliacaodeassociacao.ProfessorInstrutor,
		cadastrofiliadosfiliacaodeassociacao.GraduacaoProfessorInstrutor,
		cadastrofiliadosfiliacaodeassociacao.ProfessorDirecaoTecnica,
		cadastrofiliadosfiliacaodeassociacao.GraduacaoProfessorDirecaoTecnica,
		cadastrofiliadosfiliacaodeassociacao.NomeDaAssociacaoPlaca,
		cadastrofiliadosfiliacaodeassociacao.FichaLida
	FROM ".BANCO.".cadastrofiliadosfiliacaodeassociacao
	WHERE cadastrofiliadosfiliacaodeassociacao.AtivacaoFicha = 1
	AND cadastrofiliadosfiliacaodeassociacao.ID = '%d'
	ORDER BY ID desc",
	FiltrarCampos(mysql_real_escape_string(utf8_decode($IdAssociacao)))
	);
	
	#echo $cSQL;
	$oRS = mysql_query($cSQL) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($oRS)){			
		$BuscaMostrarAssociacao[$nCount]["ID"                               ] = trim($row[0]);
		$BuscaMostrarAssociacao[$nCount]["IDUsuarioFiliado"                 ] = trim($row[1]);
		$BuscaMostrarAssociacao[$nCount]["AtivacaoFicha"                    ] = trim($row[2]);
		$BuscaMostrarAssociacao[$nCount]["DataPreenchimento"                ] = trim($row[3]);
		$BuscaMostrarAssociacao[$nCount]["NomeDoRepresentante"              ] = trim($row[4]);
		$BuscaMostrarAssociacao[$nCount]["RG"                               ] = trim($row[5]);
		$BuscaMostrarAssociacao[$nCount]["CPF"                              ] = trim($row[6]);
		$BuscaMostrarAssociacao[$nCount]["DtNascimento"                     ] = trim($row[7]);
		$BuscaMostrarAssociacao[$nCount]["CidadeDeNascimento"               ] = trim($row[8]);
		$BuscaMostrarAssociacao[$nCount]["EstadoDeNascimento"               ] = trim($row[9]);
		$BuscaMostrarAssociacao[$nCount]["NomeDaAssociacao"                 ] = trim($row[10]);
		$BuscaMostrarAssociacao[$nCount]["EnderecoDaAssociacao"             ] = trim($row[11]);
		$BuscaMostrarAssociacao[$nCount]["BairroDaAssociacao"               ] = trim($row[12]);
		$BuscaMostrarAssociacao[$nCount]["TelefoneDaAssociacao"             ] = trim($row[13]);
		$BuscaMostrarAssociacao[$nCount]["CepDaAssociacao"                  ] = trim($row[14]);
		$BuscaMostrarAssociacao[$nCount]["CidadeDaAssociacao"               ] = trim($row[15]);
		$BuscaMostrarAssociacao[$nCount]["EstadoDaAssociacao"               ] = trim($row[16]);
		$BuscaMostrarAssociacao[$nCount]["CnpjDaAssociacao"                 ] = trim($row[17]);
		$BuscaMostrarAssociacao[$nCount]["ProfessorInstrutor"               ] = trim($row[18]);
		$BuscaMostrarAssociacao[$nCount]["GraduacaoProfessorInstrutor"      ] = trim($row[19]);
		$BuscaMostrarAssociacao[$nCount]["ProfessorDirecaoTecnica"          ] = trim($row[20]);
		$BuscaMostrarAssociacao[$nCount]["GraduacaoProfessorDirecaoTecnica" ] = trim($row[21]);
		$BuscaMostrarAssociacao[$nCount]["NomeDaAssociacaoPlaca"            ] = trim($row[22]);
		$BuscaMostrarAssociacao[$nCount]["FichaLida"                        ] = trim($row[23]);		
	$nCount++;
	}
	mysql_Free_Result($oRS);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ficha de filia&ccedil;&atilde;o de associa&ccedil;&atilde;o</title>
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
<?php
if (!isset($IdAssociacao)) $IdAssociacao = '';
 if($IdAssociacao != ''){ ?>

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
    <td class="TextoImpressao"><strong class="TextoTitulosComum">Ficha de filiação de associação</strong></td>
  </tr>
  <tr>
    <td height="10" class="TextoImpressao"></td>
  </tr>
  <tr>
    <td class="TextoImpressao">Excelent&iacute;ssimo Sr. Presidente da FKP</td>
  </tr>
  <tr>
    <td class="TextoImpressao">&nbsp;</td>
  </tr>
  <tr>
    <td class="TextoImpressao">Eu <strong><?php echo $BuscaMostrarAssociacao[1]["NomeDoRepresentante"]; ?></strong>, portador da c&eacute;dula de identidade RG <strong><?php echo $BuscaMostrarAssociacao[1]["RG"]; ?></strong>, inscrito no CPF <strong><?php echo $BuscaMostrarAssociacao[1]["CPF"]; ?></strong>, nascido em <strong><?php echo $BuscaMostrarAssociacao[1]["DtNascimento"]; ?></strong>, na cidade de <strong><?php echo $BuscaMostrarAssociacao[1]["CidadeDeNascimento"]; ?></strong>/<strong><?php echo $BuscaMostrarAssociacao[1]["EstadoDeNascimento"]; ?></strong>, desejo solicitar a filia&ccedil;&atilde;o da associa&ccedil;&atilde;o <strong><?php echo $BuscaMostrarAssociacao[1]["NomeDaAssociacao"]; ?></strong>, situada &agrave; <strong><?php echo $BuscaMostrarAssociacao[1]["EnderecoDaAssociacao"]; ?></strong> no bairro <strong><?php echo $BuscaMostrarAssociacao[1]["BairroDaAssociacao"]; ?></strong>, CEP <strong><?php echo $BuscaMostrarAssociacao[1]["CepDaAssociacao"]; ?></strong>, na cidade de <strong><?php echo $BuscaMostrarAssociacao[1]["CidadeDaAssociacao"]; ?></strong>/<strong><?php echo $BuscaMostrarAssociacao[1]["EstadoDaAssociacao"]; ?></strong>, com o telefone <strong><?php echo $BuscaMostrarAssociacao[1]["TelefoneDaAssociacao"]; ?></strong>, e CNPJ <strong><?php echo $BuscaMostrarAssociacao[1]["CnpjDaAssociacao"]; ?></strong>, tendo como instrutor o professor <strong><?php echo $BuscaMostrarAssociacao[1]["ProfessorInstrutor"]; ?></strong> portador da gradua&ccedil;&atilde;o <strong><?php echo $BuscaMostrarAssociacao[1]["GraduacaoProfessorInstrutor"]; ?></strong>, com a dire&ccedil;&atilde;o t&eacute;cnica do professor <strong><?php echo $BuscaMostrarAssociacao[1]["ProfessorDirecaoTecnica"]; ?></strong> portador da gradua&ccedil;&atilde;o <strong><?php echo $BuscaMostrarAssociacao[1]["GraduacaoProfessorDirecaoTecnica"]; ?></strong>.</td>
  </tr>  
  <tr>
    <td class="TextoImpressao">&nbsp;</td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong>Ficha preenchida em: </strong><?php echo substr(FormataDataBanco($BuscaMostrarAssociacao[1]["DataPreenchimento"]),0,10); ?> <strong>às</strong> <?php echo substr(FormataDataBanco($BuscaMostrarAssociacao[1]["DataPreenchimento"]),10,10); ?> </td>
  </tr>
  <tr>
    <td class="TextoImpressao">&nbsp;</td>
  </tr>
  <tr>
    <td class="TextoImpressao"><strong>Nome da associa&ccedil;&atilde;o(Placa):</strong> <?php echo $BuscaMostrarAssociacao[1]["NomeDaAssociacaoPlaca"]; ?></td>
  </tr>
</table>
<?php }else{
echo "<script>alert('Acesso negado!');</script>";
exit(0);
}
 mysql_Close($ConexaoBanco); ?>
</body>
</html>