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
	FiltrarCampos(mysql_real_escape_string(utf8_decode($IDCampeonato)))
	);
	
	#echo $cSQL;
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
	###
	$cSQLUsuarioFiliado = sprintf("SELECT cadastrousuariofiliado.ID,		
		cadastrousuariofiliado.LoginUsuario 
	FROM ".BANCO.".cadastrousuariofiliado
	WHERE cadastrousuariofiliado.ID = '%d'	
	ORDER BY ID desc",
		FiltrarCampos(mysql_real_escape_string(utf8_decode($BuscaMostrarCampeonatos[1]["IDUsuarioFiliado"])))
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
	if (!isset($BuscaMostrarCampeonatos[1]["FichaLida"])) $BuscaMostrarCampeonatos[1]["FichaLida"] = '';
	if($BuscaMostrarCampeonatos[1]["FichaLida"] == 0){
	$cSQLUP = sprintf("UPDATE ".BANCO.".cadastrofiliadosinscricaocampeonatos
				SET cadastrofiliadosinscricaocampeonatos.FichaLida = '1'
			  WHERE cadastrofiliadosinscricaocampeonatos.ID = '%d'",
	FiltrarCampos(mysql_real_escape_string(utf8_decode($BuscaMostrarCampeonatos[1]["ID"])))
	);
	$oRSUP = mysql_query($cSQLUP) or die (mysql_error());
}
?>

<form id="FormListarCampeonatos" name="FormListarCampeonatos" action="Ferramentas/AreaDoFiliado/Fichas/area-do-filiado-inscricao-para-campeonatos-impressao.php" method="post" target="_blank" enctype="multipart/form-data" class="FormsSemBordas">
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
              <input type="hidden" name="IdCampeonato" id="IdCampeonato" value="<?php echo utf8_encode($BuscaMostrarCampeonatos[1]["ID"]); ?>" />
              Nome do campeonato:</strong> <?php echo utf8_encode($BuscaMostrarCampeonatos[1]["NomeCampeonato"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>Nome da associa&ccedil;&atilde;o:</strong> <?php echo utf8_encode($BuscaMostrarCampeonatos[1]["NomeAssociacao"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>Professor:</strong> <?php echo utf8_encode($BuscaMostrarCampeonatos[1]["Professor"]); ?> <strong>Telefone:</strong> <?php echo utf8_encode($BuscaMostrarCampeonatos[1]["DDDTelefone"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="5" class="TextoVerdana12A"></td>
          </tr>
          <tr>
            <td class="TextoVerdana12A"><!--/INICIO ATLETAS/-->
              
              <table width="100%" cellspacing="1" cellpadding="3" class="TabelaVisualizarAtletas">
                <tr>
                  <td width="2%"><strong>N&ordm;</strong></td>
                  <td width="58%"><strong>Atleta</strong></td>
                  <td align="center" width="20%"><strong>N&ordm; da<br />
                    categoria Kata</strong></td>
                  <td align="center" width="20%"><strong>N&ordm; da<br />
                    categoria Kumite</strong></td>
                </tr>
                <?php echo utf8_encode($BuscaMostrarCampeonatos[1]["NAtletaKataKumite"]); ?>
              </table>
              
              <!--/FIM ATLETAS/--></td>
          </tr>
          <tr>
            <td height="15" class="TextoVerdana12A"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>N&uacute;mero de atletas:</strong> <?php echo utf8_encode($BuscaMostrarCampeonatos[1]["NAtletas"]); ?> <strong>Total Kata:</strong> <?php echo utf8_encode($BuscaMostrarCampeonatos[1]["TotalKata"]); ?> <strong>Valor R$:</strong> <?php echo utf8_encode($BuscaMostrarCampeonatos[1]["Valor"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>&Aacute;rbitro:</strong> <?php echo utf8_encode($BuscaMostrarCampeonatos[1]["Arbitro"]); ?> <strong>Mes&aacute;rio:</strong> <?php echo utf8_encode($BuscaMostrarCampeonatos[1]["Mesario"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>Professor ou respons&aacute;vel:</strong> <?php echo utf8_encode($BuscaMostrarCampeonatos[1]["ProfessorResponsavel"]); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="25" class="TextoVerdana12A"><strong>Ficha preenchida em:</strong> <?php echo substr(FormataDataBanco($BuscaMostrarCampeonatos[1]["DataPreenchimento"]),0,10); ?> <strong>&agrave;s</strong> <?php echo substr(FormataDataBanco($BuscaMostrarCampeonatos[1]["DataPreenchimento"]),10,10); ?></td>
          </tr>
          <tr>
            <td height="30" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td height="30" align="right"><table border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td><input name="Submit" type="submit" class="BotaoPadrao" value="Imprimir"></td>
                  <td><input type="button" class="BotaoPadrao" onClick="AlterarConteudo('Ferramentas/AreaDoFiliado/Fichas/ListarCampeonatos.php','DivResultadosInternos','');" value="   Voltar   " /></td>
                </tr>
              </table></td>
          </tr>
        </table>
        
        <!--/FIM VISUALIZAÇÃO/--></td>
    </tr>
  </table>
</form>
<?php mysql_Close($ConexaoBanco); ?>
