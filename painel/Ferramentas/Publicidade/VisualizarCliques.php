<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

#INICIO SELECT CAMPOS PREENCHIDOS

$SelectPublicidade = sprintf("SELECT publicidade.ID,
	publicidade.Ativacao,
	publicidade.Titulo,
	publicidade.Site,
	publicidade.PastaDeConteudo,
	publicidade.ControleVisualizacao
FROM ".BANCO.".publicidade
WHERE publicidade.Ativacao = 1
AND publicidade.ID = '%d'
LIMIT 1",
FiltrarCampos(mysql_real_escape_string(utf8_decode($IDPublicidade)))
);
$ResultadoPublicidade = mysql_query($SelectPublicidade) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoPublicidade)){			
	$BuscaMostrarPublicidade[$nCount]["ID"             ] = trim($row[0]);
	$BuscaMostrarPublicidade[$nCount]["Ativacao"       ] = trim($row[1]);
	$BuscaMostrarPublicidade[$nCount]["Titulo"         ] = trim($row[2]);
	$BuscaMostrarPublicidade[$nCount]["Site"           ] = trim($row[3]);
	$BuscaMostrarPublicidade[$nCount]["PastaDeConteudo"] = trim($row[4]);
	$BuscaMostrarPublicidade[$nCount]["ControleVisualizacao"] = trim($row[5]);
$nCount++;
}
mysql_Free_Result($ResultadoPublicidade);


$ConsultaCliquesPorAno = sprintf("SELECT DISTINCT EXTRACT(YEAR FROM DataDoClique),
    cliquespublicidade.IDPublicidade
FROM ".BANCO.".cliquespublicidade
WHERE cliquespublicidade.IDPublicidade = '%d'
GROUP BY DataDoClique
ORDER BY DataDoClique DESC",
	FiltrarCampos(mysql_real_escape_string(utf8_decode($IDPublicidade)))
);
$ResultadoCliquesPorAno = mysql_query($ConsultaCliquesPorAno) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoCliquesPorAno)){
    $BuscaMostrarCliquesPorAno[$nCount]["DataDoClique" ] = trim($row[0]);
    $BuscaMostrarCliquesPorAno[$nCount]["IDPublicidade"] = trim($row[1]);
$nCount++;
}
mysql_Free_Result($ResultadoCliquesPorAno);
#FIM SELECT CAMPOS PREENCHIDOS

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="1"></td>
  </tr>
  <tr>
    <td height="20" class="TextoVerdana12B">Segue a lista de cliques do an&uacute;ncio: <?php echo utf8_encode($BuscaMostrarPublicidade[1]["Titulo"]); ?></td>
  </tr>
  <tr>
    <td class="FundoLinhas">&nbsp;</td>
  </tr>
  <tr>
    <td><!--/INICIO FORM CADASTRO PUBLICIDADE/-->
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><!--//-->
            
            <form id="FormCadastro" name="FormCadastro" method="post" enctype="multipart/form-data" class="FormsSemBordas" onsubmit="return false;">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                	<td><div id="DivAcompanhamento">
                          <table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td class="TextoVerdana12A">Link de acompanhamento:</td>
                        <td class="TextoVerdana12A">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="20"><input name="TituloPrincipal" type="text" class="TextFields" id="TituloPrincipal" maxlength="150" onclick="this.select();" style="width:575px;" value="<?php echo CAMINHO_SITE_GERAL.'ACP.php?A='.$BuscaMostrarPublicidade[1]["ID"].'&C='.$BuscaMostrarPublicidade[1]["ControleVisualizacao"]; ?>" /></td>
                        <td><input type="button" class="BotaoPadrao" 
                                    onclick="EnviarFormularios('Ferramentas/Publicidade/AlterarLinkAcompanhamento.php','DivAcompanhamento','IDPublicidade=<?php echo $BuscaMostrarPublicidade[1]["ID"] ?>');" value="Alterar link" /></td>
                      </tr>
                    </table></div>
                    </td>
                </tr>
                <tr>
                  <td height="10" align="left"></td>
                </tr>
                <tr>
                  <td height="10" align="left" class="FundoLinhas"></td>
                </tr>
                <tr>
                  <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="TextoVerdana12A">
                        <?php 
						if (!isset($BuscaMostrarCliquesPorAno[1]["DataDoClique"])) $BuscaMostrarCliquesPorAno[1]["DataDoClique"] = '';
						if($BuscaMostrarCliquesPorAno[1]["DataDoClique"] != ''){
						?>
                        <table width="100%" border="0" cellpadding="0" cellspacing="2">
                            <tr>
                              <td width="33%" height="20" align="center" class="TextoVerdana12A"><strong>M&ecirc;s</strong></td>
	                          <td width="33%" height="20" align="center" class="TextoVerdana12A"><strong>Ano</strong></td>
    	                      <td width="33%" height="20" align="center" class="TextoVerdana12A"><strong>Total de cliques</strong></td>
                            </tr>
                            <?php for($a=1;$a<=count($BuscaMostrarCliquesPorAno);$a++){
						
								$ConsultaCliquesPorMes = sprintf("SELECT DISTINCT EXTRACT(MONTH FROM DataDoClique),
									cliquespublicidade.IDPublicidade
								FROM ".BANCO.".cliquespublicidade
								WHERE YEAR(DataDoClique) = '%s'
								AND cliquespublicidade.IDPublicidade = '%d'
								GROUP BY DataDoClique
								ORDER BY DataDoClique DESC",
								FiltrarCampos(mysql_real_escape_string($BuscaMostrarCliquesPorAno[$a]["DataDoClique"])),
								FiltrarCampos(mysql_real_escape_string($IDPublicidade))
								);
								$ResultadoCliquesPorMes = mysql_query($ConsultaCliquesPorMes) or die (mysql_error());
								$nCount=1;
								while ($row = mysql_fetch_array($ResultadoCliquesPorMes)){
									$BuscaMostrarCliquesPorMes[$nCount]["DataDoClique" ] = trim($row[0]);
									$BuscaMostrarCliquesPorMes[$nCount]["IDPublicidade"] = trim($row[1]);
								$nCount++;
								}
								#mysql_Free_Result($ResultadoCliquesPorMes);
								
								if (!isset($BuscaMostrarCliquesPorMes)) $BuscaMostrarCliquesPorMes = '';
								
								$Meses = mysql_num_rows($ResultadoCliquesPorMes);
								
								#ENTRA NO LOOP
								$Sub = 1;
								while ($Sub <= $Meses):
								#INICIO CONTEUDO DO LOOP
								$NumeroMes = $BuscaMostrarCliquesPorMes[$Sub]["DataDoClique"];
								
								if($NumeroMes == '1'){ $Mes = 'Janeiro';
								}else if($NumeroMes == '2'){ $Mes = 'Fevereiro';
								}else if($NumeroMes == '3'){ $Mes = 'Mar&ccedil;o';
								}else if($NumeroMes == '4'){ $Mes = 'Abril';
								}else if($NumeroMes == '5'){ $Mes = 'Maio';
								}else if($NumeroMes == '6'){ $Mes = 'Junho';
								}else if($NumeroMes == '7'){ $Mes = 'Julho';
								}else if($NumeroMes == '8'){ $Mes = 'Agosto';
								}else if($NumeroMes == '9'){ $Mes = 'Setembro';
								}else if($NumeroMes == '10'){ $Mes = 'Outubro';
								}else if($NumeroMes == '11'){ $Mes = 'Novembro';
								}else if($NumeroMes == '12'){ $Mes = 'Dezembro';
								}
								
								$ContarQtdDeCliques = sprintf("SELECT COUNT(*) FROM ".BANCO.".cliquespublicidade 
									WHERE cliquespublicidade.IDPublicidade  = '%d' 
									AND YEAR(cliquespublicidade.DataDoClique) = '%d'
									AND MONTH(cliquespublicidade.DataDoClique) = '%d'", 
									FiltrarCampos(mysql_real_escape_string($IDPublicidade)),
									FiltrarCampos(mysql_real_escape_string($BuscaMostrarCliquesPorAno[$a]["DataDoClique"])),
									FiltrarCampos(mysql_real_escape_string($NumeroMes))
									);
								list($TotalDeRegistrosPosts) = mysql_fetch_array(mysql_query($ContarQtdDeCliques));								
								?>
                            <tr class="FundoListaConteudo">
                              <td width="33%" height="25" align="center" style="padding-left:3px;padding-right:3px;"><?php echo $Mes; ?></td>
	                          <td width="33%" height="25" align="center" style="padding-left:3px;padding-right:3px;"><?php echo $BuscaMostrarCliquesPorAno[$a]["DataDoClique"]; ?></td>
    	                      <td width="33%" height="25" align="center" style="padding-left:3px;padding-right:3px;"><strong><?php echo $TotalDeRegistrosPosts; ?></strong></td>
                            </tr>
                            <tr>
                            	<td colspan="3" class="FundoLinhas" height="3"></td>
                             </tr>
                            <?php
								#FIM CONTEUDO DO LOOP
								$TotalDeRegistrosPosts = '';
								$Sub++;
								endwhile;
								#SAI NO LOOP
								mysql_Free_Result($ResultadoCliquesPorMes);			
						
							 }
						?>
                        </table>
                        <?php }else{ ?>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td valign="middle" class="TextoVerdana12B"><br />Ainda n&atilde;o foi registrado nenhum clique para este an&uacute;ncio!<br /><br /></td>
                            </tr>
                            <tr>
                              <td align="left" height="10"></td>
                            </tr>
                            <tr>
                              <td height="5" align="left" valign="middle" class="FundoLinhas"></td>
                            </tr>
                          </table>
                        <?php } ?>
                        </td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="10" align="left" ></td>
                </tr>
                <tr>
                  <td height="15" align="right"><table border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><input type="button" class="BotaoPadrao" 
                                    onclick="AlterarConteudo('Ferramentas/Publicidade/ListarPublicidade.php','DivResultadosInternos','');" value="Voltar" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td height="15" align="left"></td>
                </tr>
              </table>
            </form>
            
            <!--//--></td>
        </tr>
      </table>
      
      <!--/FIM FORM CADASTRO PUBLICIDADE/--></td>
  </tr>
</table>
<?php mysql_Close($ConexaoBanco); ?>
