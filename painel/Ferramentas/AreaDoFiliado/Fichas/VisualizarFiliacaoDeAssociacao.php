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
	FiltrarCampos(mysql_real_escape_string(utf8_decode($IDAssociacao)))
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
	###
	$cSQLUsuarioFiliado = sprintf("SELECT cadastrousuariofiliado.ID,		
		cadastrousuariofiliado.LoginUsuario 
	FROM ".BANCO.".cadastrousuariofiliado
	WHERE cadastrousuariofiliado.ID = '%d'	
	ORDER BY ID desc",
	FiltrarCampos(mysql_real_escape_string(utf8_decode($BuscaMostrarAssociacao[1]["IDUsuarioFiliado"])))
	);
	
	#echo $cSQL;
	$oRSUsuarioFiliado = mysql_query($cSQLUsuarioFiliado) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($oRSUsuarioFiliado)){			
		$BuscaMostrarUsuariosFiliados[$nCount]["ID"          ] = trim($row[0]);
		$BuscaMostrarUsuariosFiliados[$nCount]["LoginUsuario"] = trim($row[1]);
	$nCount++;
	}
	mysql_Free_Result($oRSUsuarioFiliado);
	##
if (!isset($BuscaMostrarAssociacao[1]["FichaLida"])) $BuscaMostrarAssociacao[1]["FichaLida"] = '';
if($BuscaMostrarAssociacao[1]["FichaLida"] == 0){
		$cSQLUP = sprintf("UPDATE ".BANCO.".cadastrofiliadosfiliacaodeassociacao
					SET cadastrofiliadosfiliacaodeassociacao.FichaLida = '1'							
				  WHERE cadastrofiliadosfiliacaodeassociacao.ID = '%d'",
				FiltrarCampos(mysql_real_escape_string(utf8_decode($BuscaMostrarAssociacao[1]["ID"])))
				);
		$oRSUP = mysql_query($cSQLUP) or die (mysql_error());
}
?>

<form id="FormListarAssociacao" name="FormListarAssociacao" action="Ferramentas/AreaDoFiliado/Fichas/area-do-filiado-filiacao-de-associacao-impressao.php" method="post" target="_blank" enctype="multipart/form-data" class="FormsSemBordas">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="1" align="center" class="TextoVerdana12B"></td>
    </tr>
    <tr>
      <td height="20" align="left" class="TextoVerdana12B">Segue abaixo a ficha preenchida pelo usu&aacute;rio: <?php echo $BuscaMostrarUsuariosFiliados[1]["LoginUsuario"]; ?></td>
    </tr>
    <tr>
      <td class="FundoLinhas">&nbsp;</td>
    </tr>
    <tr>
      <td><!--/INICIO VISUALIZAÇÃO/-->
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="10" class="TextoVerdana12A"></td>
          </tr>
          <tr>
            <td class="TextoVerdana12A"><strong>
              <input type="hidden" name="IdAssociacao" id="IdAssociacao" value="<?php echo utf8_encode($BuscaMostrarAssociacao[1]["ID"]); ?>" />
              </strong>Excelent&iacute;ssimo Sr. Presidente da FKP</td>
          </tr>
          <tr>
            <td class="TextoVerdana12A">&nbsp;</td>
          </tr>
          <tr>
            <td class="TextoVerdana12A">Eu <strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["NomeDoRepresentante"]); ?></strong>, portador da c&eacute;dula de identidade RG <strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["RG"]); ?></strong>, inscrito no CPF <strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["CPF"]); ?></strong>, nascido em <strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["DtNascimento"]); ?></strong>, na cidade de <strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["CidadeDeNascimento"]); ?></strong>/<strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["EstadoDeNascimento"]); ?></strong>, presidente da associa&ccedil;&atilde;o <strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["NomeDaAssociacao"]); ?></strong>, situada &agrave; <strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["EnderecoDaAssociacao"]); ?></strong> no bairro <strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["BairroDaAssociacao"]); ?></strong>, CEP <strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["CepDaAssociacao"]); ?></strong>, na cidade de <strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["CidadeDaAssociacao"]); ?></strong>/<strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["EstadoDaAssociacao"]); ?></strong>, com o telefone <strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["TelefoneDaAssociacao"]); ?></strong>, e CNPJ <strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["CnpjDaAssociacao"]); ?></strong>,  tendo como instrutor o professor <strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["ProfessorInstrutor"]); ?></strong> portador da gradua&ccedil;&atilde;o <strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["GraduacaoProfessorInstrutor"]); ?></strong>, com a dire&ccedil;&atilde;o t&eacute;cnica do professor <strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["ProfessorDirecaoTecnica"]); ?></strong> portador da gradua&ccedil;&atilde;o <strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["GraduacaoProfessorDirecaoTecnica"]); ?></strong>.</td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>Ficha preenchida em:</strong> <?php echo substr(FormataDataBanco($BuscaMostrarAssociacao[1]["DataPreenchimento"]),0,10); ?> <strong>&agrave;s</strong> <?php echo substr(FormataDataBanco($BuscaMostrarAssociacao[1]["DataPreenchimento"]),10,10); ?></td>
          </tr>
          <tr>
            <td height="10" class="FundoLinhas" >&nbsp;</td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>Nome da associa&ccedil;&atilde;o(Placa): </strong><?php echo utf8_encode($BuscaMostrarAssociacao[1]["NomeDaAssociacaoPlaca"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="30" align="right"><table border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td><input name="Submit" type="submit" class="BotaoPadrao" value="Imprimir"></td>
                  <td><input type="button" class="BotaoPadrao" onClick="AlterarConteudo('Ferramentas/AreaDoFiliado/Fichas/ListarFiliacaoDeAssociacao.php','DivResultadosInternos','');" value="   Voltar   " /></td>
                </tr>
              </table></td>
          </tr>
        </table>
        
        <!--/FIM VISUALIZAÇÃO/--></td>
    </tr>
  </table>
</form>
<?php mysql_Close($ConexaoBanco); ?>