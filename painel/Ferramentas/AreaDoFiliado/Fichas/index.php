<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

#####
/*
$SQLVerificaFiliacao = "SELECT cadastrofiliacao.ID,
							   cadastrofiliacao.AtivacaoFiliacao,
							   cadastrofiliacao.CadastroLido
						FROM ".BANCO.".cadastrofiliacao
						WHERE cadastrofiliacao.AtivacaoFiliacao = '1'
						AND cadastrofiliacao.CadastroLido = '0'
						ORDER BY ID desc";
$RSVerificaFiliacao = mysql_query($SQLVerificaFiliacao) or die (mysql_error());	
$Filiacao = mysql_num_rows($RSVerificaFiliacao);
mysql_Free_Result($RSVerificaFiliacao);
*/
#####
#####
$SQLVerificaCampeonatos = "SELECT cadastrofiliadosinscricaocampeonatos.ID,
							   cadastrofiliadosinscricaocampeonatos.AtivacaoFicha,
							   cadastrofiliadosinscricaocampeonatos.FichaLida
						FROM ".BANCO.".cadastrofiliadosinscricaocampeonatos
						WHERE cadastrofiliadosinscricaocampeonatos.AtivacaoFicha = '1'
						AND cadastrofiliadosinscricaocampeonatos.FichaLida = '0'
						ORDER BY ID desc";
$RSVerificaCampeonatos = mysql_query($SQLVerificaCampeonatos) or die (mysql_error());	
$Campeonatos = mysql_num_rows($RSVerificaCampeonatos);
mysql_Free_Result($RSVerificaCampeonatos);
#####
$SQLVerificaFiliacaoDeAtleta = "SELECT cadastrofiliadosfiliacaodeatleta.ID,
							   cadastrofiliadosfiliacaodeatleta.AtivacaoFicha,
							   cadastrofiliadosfiliacaodeatleta.FichaLida
						FROM ".BANCO.".cadastrofiliadosfiliacaodeatleta 
						WHERE cadastrofiliadosfiliacaodeatleta.AtivacaoFicha = '1'
						AND cadastrofiliadosfiliacaodeatleta.FichaLida = '0'
						ORDER BY ID desc";
$RSVerificaFiliacaoDeAtleta = mysql_query($SQLVerificaFiliacaoDeAtleta) or die (mysql_error());
$FiliacaoDeTotalAtleta = mysql_num_rows($RSVerificaFiliacaoDeAtleta);
mysql_Free_Result($RSVerificaFiliacaoDeAtleta);
#####
$SQLVerificaFiliacaoDeAssociacao = "SELECT cadastrofiliadosfiliacaodeassociacao.ID,
							   cadastrofiliadosfiliacaodeassociacao.AtivacaoFicha,
							   cadastrofiliadosfiliacaodeassociacao.FichaLida
						FROM ".BANCO.".cadastrofiliadosfiliacaodeassociacao 
						WHERE cadastrofiliadosfiliacaodeassociacao.AtivacaoFicha = '1'
						AND cadastrofiliadosfiliacaodeassociacao.FichaLida = '0'
						ORDER BY ID desc";
$RSVerificaFiliacaoDeAssociacao = mysql_query($SQLVerificaFiliacaoDeAssociacao) or die (mysql_error());
$FiliacaoDeAssociacao = mysql_num_rows($RSVerificaFiliacaoDeAssociacao);
mysql_Free_Result($RSVerificaFiliacaoDeAssociacao);
#####
$SQLVerificaRenovacaoDeAtleta = "SELECT cadastrofiliadosrenovacaodeatleta.ID,
							   cadastrofiliadosrenovacaodeatleta.AtivacaoFicha,
							   cadastrofiliadosrenovacaodeatleta.FichaLida
						FROM ".BANCO.".cadastrofiliadosrenovacaodeatleta 
						WHERE cadastrofiliadosrenovacaodeatleta.AtivacaoFicha = '1'
						AND cadastrofiliadosrenovacaodeatleta.FichaLida = '0'
						ORDER BY ID desc";
$RSVerificaRenovacaoDeAtleta = mysql_query($SQLVerificaRenovacaoDeAtleta) or die (mysql_error());
$RenovacaoDeAtleta = mysql_num_rows($RSVerificaRenovacaoDeAtleta);
mysql_Free_Result($RSVerificaRenovacaoDeAtleta);
#####
$SQLVerificaPromocaoDeKyu = "SELECT cadastrofiliadospromocaodekyu.ID,
							   cadastrofiliadospromocaodekyu.AtivacaoFicha,
							   cadastrofiliadospromocaodekyu.FichaLida
						FROM ".BANCO.".cadastrofiliadospromocaodekyu
						WHERE cadastrofiliadospromocaodekyu.AtivacaoFicha = '1'
						AND cadastrofiliadospromocaodekyu.FichaLida = '0'
						ORDER BY ID desc";
$RSVerificaPromocaoDeKyu = mysql_query($SQLVerificaPromocaoDeKyu) or die (mysql_error());
$PromocaoDeKyu = mysql_num_rows($RSVerificaPromocaoDeKyu);
mysql_Free_Result($RSVerificaPromocaoDeKyu);
#####


?>
<script language="javascript" type="text/javascript">window.scrollTo(0,0);</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="25" class="TextoArial20A">&Aacute;rea do filiado - Fichas de inscri&ccedil;&atilde;o</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td class="FundoLinhas">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center" class="TextoVerdana12A">Escolha uma das op&ccedil;&otilde;es abaixo</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><table width="470" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="TextoVerdana12A"><strong><?php echo $Campeonatos; if($Campeonatos != 1){echo ' Novas';}else{echo ' Nova';} ?></strong></td>
    <td>&nbsp;</td>
    <td align="center" class="TextoVerdana12A"><strong><?php echo $FiliacaoDeTotalAtleta; if($FiliacaoDeTotalAtleta != 1){echo" Novas";}else{echo" Nova";} ?></strong></td>
    <td>&nbsp;</td>
    <td align="center" class="TextoVerdana12A"><strong><?php echo $FiliacaoDeAssociacao; if($FiliacaoDeAssociacao != 1){echo ' Novas';}else{echo ' Nova';} ?></strong></td>
  </tr>
  <tr>
    <td width="150" height="109"><table width="149" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuGrande">
        <tr>
          <td width="149" height="105" onClick="AlterarConteudo('Ferramentas/AreaDoFiliado/Fichas/Campeonatos.php','ConteudoInterno','');">Inscri&ccedil;&atilde;o para<br />
            campeonatos</td>
        </tr>
      </table></td>
    <td width="10">&nbsp;</td>
    <td width="150" height="109"><table width="149" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuGrande">
      <tr>
        <td width="149" height="105" onclick="AlterarConteudo('Ferramentas/AreaDoFiliado/Fichas/FiliacaoDeAtleta.php','ConteudoInterno','');">Filia&ccedil;&atilde;o<br />
          de atleta</td>
      </tr>
    </table></td>
    <td width="10">&nbsp;</td>
    <td width="150" height="109"><table width="149" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuGrande">
        <tr>
          <td width="149" height="105" onClick="AlterarConteudo('Ferramentas/AreaDoFiliado/Fichas/FiliacaoDeAssociacao.php','ConteudoInterno','');">Filia&ccedil;&atilde;o<br />
            de associa&ccedil;&atilde;o</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="10">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="TextoVerdana12A"><strong><?php echo $RenovacaoDeAtleta; if($RenovacaoDeAtleta != 1){echo ' Novas';}else{echo ' Nova';} ?></strong></td>
    <td>&nbsp;</td>
    <td align="center" class="TextoVerdana12A"><strong><?php echo $PromocaoDeKyu; if($PromocaoDeKyu != 1){echo ' Novas';}else{echo ' Nova';} ?></strong></td>
    <td>&nbsp;</td>
    <td align="center" class="TextoVerdana12A">&nbsp;</td>
  </tr>
  <tr>
    <td height="109"><table width="149" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuGrande">
        <tr>
          <td width="149" height="105" onClick="AlterarConteudo('Ferramentas/AreaDoFiliado/Fichas/RenovacaoDeAtleta.php','ConteudoInterno','');">Renova&ccedil;&atilde;o de<br />
            atletas</td>
        </tr>
      </table></td>
    <td width="10">&nbsp;</td>
    <td height="109"><table width="149" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuGrande">
        <tr>
          <td width="149" height="105" onClick="AlterarConteudo('Ferramentas/AreaDoFiliado/Fichas/PromocaoDeKyu.php','ConteudoInterno','');">Promo&ccedil;&atilde;o de Kyu</td>
        </tr>
      </table></td>
    <td>&nbsp;</td>
    <td height="109">&nbsp;</td>
  </tr>
</table>
</td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" class="FundoLinhas">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><div id="DivResultadosInternos"/></td>
  </tr>
</table>
<?php mysql_Close($ConexaoBanco); ?>