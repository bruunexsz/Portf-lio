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
	FiltrarCampos(mysql_real_escape_string(utf8_decode($IDRenovacao)))
	);	
	#echo $cSQL;
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
	###
	$cSQLUsuarioFiliado = sprintf("SELECT cadastrousuariofiliado.ID,		
		cadastrousuariofiliado.LoginUsuario 
	FROM ".BANCO.".cadastrousuariofiliado
	WHERE cadastrousuariofiliado.ID = '%d'	
	ORDER BY ID desc",
	FiltrarCampos(mysql_real_escape_string(utf8_decode($BuscaMostrarRenovacao[1]["IDUsuarioFiliado"])))
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
if (!isset($BuscaMostrarRenovacao[1]["FichaLida"])) $BuscaMostrarRenovacao[1]["FichaLida"] = '';
if($BuscaMostrarRenovacao[1]["FichaLida"] == 0){
		$cSQLUP = sprintf("UPDATE ".BANCO.".cadastrofiliadosrenovacaodeatleta
					SET cadastrofiliadosrenovacaodeatleta.FichaLida = '1'							
				  WHERE cadastrofiliadosrenovacaodeatleta.ID = '%d'",
		FiltrarCampos(mysql_real_escape_string(utf8_decode($BuscaMostrarRenovacao[1]["ID"])))
		);	
		$oRSUP = mysql_query($cSQLUP) or die (mysql_error());
}
?>

<form id="FormListarRenovacao" name="FormListarRenovacao" action="Ferramentas/AreaDoFiliado/Fichas/area-do-filiado-renovacao-de-atleta-impressao.php" method="post" target="_blank" enctype="multipart/form-data" class="FormsSemBordas">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="1" align="center" class="TextoVerdana12B"></td>
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
              <input type="hidden" name="IdRenovacao" id="IdRenovacao" value="<?php echo utf8_encode($BuscaMostrarRenovacao[1]["ID"]); ?>" />
              Nome da associa&ccedil;&atilde;o:</strong> <?php echo utf8_encode($BuscaMostrarRenovacao[1]["NomeDaAssociacao"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>Professor: </strong><?php echo utf8_encode($BuscaMostrarRenovacao[1]["Professor"]); ?><strong> Telefone: </strong><?php echo utf8_encode($BuscaMostrarRenovacao[1]["DDDTelefone"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td class="TextoVerdana12A"><!--/INICIO ATLETAS/-->
              
              <table width="100%" cellspacing="1" cellpadding="3" class="TabelaVisualizarAtletas">
                <tr>
                  <td align="left" width="2%"><strong>N&ordm;</strong></td>
                  <td><strong>Nome do atleta</strong></td>
                  <td align="center"><strong>N&ordm; FKP</strong></td>
                  <td align="center"><strong>Kyu</strong></td>
                  <td align="center"><strong>Dt. Nascimento</strong></td>
                  <td align="center"><strong>N&ordm; RG</strong></td>
                </tr>
                <?php echo utf8_encode($BuscaMostrarRenovacao[1]["NomesAtletasInformacoes"]); ?>
              </table>
              
              <!--/FIM ATLETAS/--></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>N&ordm; de renova&ccedil;&otilde;es: </strong><?php echo utf8_encode($BuscaMostrarRenovacao[1]["NRenovacoes"]); ?><strong> Valor R$: </strong><?php echo utf8_encode($BuscaMostrarRenovacao[1]["Valor"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>Ficha preenchida em:</strong> <?php echo substr(FormataDataBanco($BuscaMostrarRenovacao[1]["DataPreenchimento"]),0,10); ?> <strong>&agrave;s</strong> <?php echo substr(FormataDataBanco($BuscaMostrarRenovacao[1]["DataPreenchimento"]),10,10); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" align="right" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td><input name="Submit" type="submit" class="BotaoPadrao" value="Imprimir"></td>
                  <td><input type="button" class="BotaoPadrao" onClick="AlterarConteudo('Ferramentas/AreaDoFiliado/Fichas/ListarRenovacaoDeAtleta.php','DivResultadosInternos','');" value="   Voltar   " /></td>
                </tr>
              </table></td>
          </tr>
        </table>
        
        <!--/FIM VISUALIZAÇÃO/--></td>
    </tr>
  </table>
</form>
<?php mysql_Close($ConexaoBanco); ?>