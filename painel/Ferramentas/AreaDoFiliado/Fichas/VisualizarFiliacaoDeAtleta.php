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
		FiltrarCampos(mysql_real_escape_string(utf8_decode($IDAtleta)))
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
	###
	$cSQLUsuarioFiliado = sprintf("SELECT cadastrousuariofiliado.ID,		
		cadastrousuariofiliado.LoginUsuario 
	FROM ".BANCO.".cadastrousuariofiliado
	WHERE cadastrousuariofiliado.ID = '%d'	
	ORDER BY ID desc",
		FiltrarCampos(mysql_real_escape_string(utf8_decode($BuscaMostrarAtletas[1]["IDUsuarioFiliado"])))
	 );
	#echo $cSQL;
	$oRSUsuarioFiliado = mysql_query($cSQLUsuarioFiliado) or die (mysql_error());
	$nCount=1;
	while ($row = mysql_fetch_array($oRSUsuarioFiliado)){			
		$BuscaMostrarUsuariosFiliados[$nCount]["ID"          ] = trim($row[0]);
		$BuscaMostrarUsuariosFiliados[$nCount]["LoginUsuario"  ] = trim($row[1]);
	$nCount++;
	}
	mysql_Free_Result($oRSUsuarioFiliado);
	##
if (!isset($BuscaMostrarAtletas[1]["FichaLida"])) $BuscaMostrarAtletas[1]["FichaLida"] = '';
if($BuscaMostrarAtletas[1]["FichaLida"] == 0){
		$cSQLUP = sprintf("UPDATE ".BANCO.".cadastrofiliadosfiliacaodeatleta
					SET cadastrofiliadosfiliacaodeatleta.FichaLida = '1'							
				  WHERE cadastrofiliadosfiliacaodeatleta.ID = '%d'				  
				  ",
			FiltrarCampos(mysql_real_escape_string(utf8_decode($BuscaMostrarAtletas[1]["ID"])))
		 );
		$oRSUP = mysql_query($cSQLUP) or die (mysql_error());
}

?>

<form id="FormListarAtletas" name="FormListarAtletas" action="Ferramentas/AreaDoFiliado/Fichas/area-do-filiado-filiacao-do-atleta-impressao.php" method="post" target="_blank" enctype="multipart/form-data" class="FormsSemBordas">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="1" align="center" class="TextoVerdana12AVermelho"></td>
    </tr>
    <tr>
      <td height="20" class="TextoVerdana12B">Segue abaixo a ficha preenchida pelo usu&aacute;rio: <?php echo $BuscaMostrarUsuariosFiliados[1]["LoginUsuario"]; ?></td>
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
            <td height="25" class="TextoVerdana12A"><strong>
              <input type="hidden" name="IdAtletas" id="IdAtletas" value="<?php echo utf8_encode($BuscaMostrarAtletas[1]["ID"]); ?>" />
              N&ordm; Reg. FKP:</strong> <?php echo utf8_encode($BuscaMostrarAtletas[1]["NRegistroFKP"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>Nome: </strong><?php echo utf8_encode($BuscaMostrarAtletas[1]["NomeDoAtleta"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>Endere&ccedil;o: </strong><?php echo utf8_encode($BuscaMostrarAtletas[1]["Endereco"]); ?> - <?php echo utf8_encode($BuscaMostrarAtletas[1]["NEndereco"]); ?><strong> Bairro:</strong> <?php echo utf8_encode($BuscaMostrarAtletas[1]["Bairro"]); ?><strong> Telefone: </strong><?php echo utf8_encode($BuscaMostrarAtletas[1]["Telefone"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>Cidade:</strong> <?php echo utf8_encode($BuscaMostrarAtletas[1]["Cidade"]); ?>/<?php echo utf8_encode($BuscaMostrarAtletas[1]["Estado"]); ?><strong> CEP: </strong><?php echo utf8_encode($BuscaMostrarAtletas[1]["CEP"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>Nome do Pai:</strong> <?php echo utf8_encode($BuscaMostrarAtletas[1]["NomeDoPai"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>Nome da m&atilde;e:</strong> <?php echo utf8_encode($BuscaMostrarAtletas[1]["NomeDaMae"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>Data de nascimento: </strong><?php echo utf8_encode($BuscaMostrarAtletas[1]["DtNascimento"]); ?><strong> RG: </strong><?php echo utf8_encode($BuscaMostrarAtletas[1]["RG"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>Gradua&ccedil;&atilde;o atual: </strong><?php echo utf8_encode($BuscaMostrarAtletas[1]["GraduacaoAtual"]); ?><strong> Data: </strong><?php echo utf8_encode($BuscaMostrarAtletas[1]["DtGraduacaoAtual"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>Associa&ccedil;&atilde;o filiada: </strong><?php echo utf8_encode($BuscaMostrarAtletas[1]["AssosiacaoFiliada"]); ?><strong> Professor respons&aacute;vel: </strong><?php echo utf8_encode($BuscaMostrarAtletas[1]["ProfessorResponsavel"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>Ficha preenchida em:</strong> <?php echo substr(FormataDataBanco($BuscaMostrarAtletas[1]["DataPreenchimento"]),0,10); ?> <strong>&agrave;s</strong> <?php echo substr(FormataDataBanco($BuscaMostrarAtletas[1]["DataPreenchimento"]),10,10); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td align="right" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td><input name="Submit" type="submit" class="BotaoPadrao" value="Imprimir"></td>
                  <td><input type="button" class="BotaoPadrao" onClick="AlterarConteudo('Ferramentas/AreaDoFiliado/Fichas/ListarFiliacaoDeAtleta.php','DivResultadosInternos','');" value="   Voltar   " /></td>
                </tr>
              </table></td>
          </tr>
        </table>
        
        <!--/FIM VISUALIZAÇÃO/--></td>
    </tr>
  </table>
</form>
<?php mysql_Close($ConexaoBanco); ?>
