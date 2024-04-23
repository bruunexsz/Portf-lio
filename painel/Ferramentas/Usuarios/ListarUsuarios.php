<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

	#INICIO SE FOR ADMINISTRADOR
	if ($ResultadoControleUsuario["NivelDeAcesso"] == 1){
	#INICIO VALIDANDO VARIAVEIS VAZIAS
		if (!isset($CampoBuscaEmailUsuarios)) $CampoBuscaEmailUsuarios = '';
	#FIM VALIDANDO VARIAVEIS VAZIAS
		if ($CampoBuscaEmailUsuarios == ''){
		#INICIO MOSTRAR USUARIOS SE O CAMPO BUSCA VIR VAZIO
				$SelectAdministrador = "SELECT usuariopainel.ID,
						usuariopainel.AtivacaoUsuario,
						usuariopainel.EmailUsuario,
						usuariopainel.NomeUsuario,
						usuariopainel.NivelDeAcesso
				FROM ".BANCO.".usuariopainel
				WHERE usuariopainel.AtivacaoUsuario = '1'
				ORDER BY ID desc";
				$ResultadoAdministrador = mysql_query($SelectAdministrador) or die (mysql_error());
				$nCount=1;
				while ($row = mysql_fetch_array($ResultadoAdministrador)){			
					$BuscaMostrarUsuarios[$nCount]["ID"             ] = trim($row[0]);
					$BuscaMostrarUsuarios[$nCount]["AtivacaoUsuario"] = trim($row[1]);
					$BuscaMostrarUsuarios[$nCount]["EmailUsuario"   ] = trim($row[2]);
					$BuscaMostrarUsuarios[$nCount]["NomeUsuario"    ] = trim($row[3]);
					$BuscaMostrarUsuarios[$nCount]["NivelDeAcesso"  ] = trim($row[4]);
				$nCount++;
				}
				mysql_Free_Result($ResultadoAdministrador);	
		#FIM MOSTRAR USUARIOS SE O CAMPO BUSCA VIR VAZIO
		}else{
		#INICIO MOSTRAR USUARIOS COM PESQUISA
				$SelectAdministrador = sprintf("SELECT usuariopainel.ID,
						usuariopainel.AtivacaoUsuario,
						usuariopainel.EmailUsuario,
						usuariopainel.NomeUsuario,
						usuariopainel.NivelDeAcesso
				FROM ".BANCO.".usuariopainel
				WHERE usuariopainel.EmailUsuario RLIKE '%s'
				AND usuariopainel.AtivacaoUsuario = '1'
				OR	usuariopainel.NomeUsuario RLIKE '%s'
				AND usuariopainel.AtivacaoUsuario = '1'
				ORDER BY ID desc", 
				FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaEmailUsuarios))),
				FiltrarCampos(mysql_real_escape_string(utf8_decode($CampoBuscaEmailUsuarios)))
				);
				#echo $cSQL;
				$ResultadoAdministrador = mysql_query($SelectAdministrador) or die (mysql_error());
				$nCount=1;
				while ($row = mysql_fetch_array($ResultadoAdministrador)){			
					$BuscaMostrarUsuarios[$nCount]["ID"             ] = trim($row[0]);
					$BuscaMostrarUsuarios[$nCount]["AtivacaoUsuario"] = trim($row[1]);
					$BuscaMostrarUsuarios[$nCount]["EmailUsuario"   ] = trim($row[2]);
					$BuscaMostrarUsuarios[$nCount]["NomeUsuario"    ] = trim($row[3]);
					$BuscaMostrarUsuarios[$nCount]["NivelDeAcesso"  ] = trim($row[4]);		
				$nCount++;
				}
				mysql_Free_Result($ResultadoAdministrador);
				#FIM MOSTRAR USUARIOS COM PESQUISA
		}
	#FIM SE FOR ADMINISTRADOR
	#INICIO SE FOR USUARIO
	}else if ($ResultadoControleUsuario["NivelDeAcesso"] == 2){
			$SelectUsuario = sprintf("SELECT usuariopainel.ID,
					usuariopainel.AtivacaoUsuario,
					usuariopainel.EmailUsuario,
					usuariopainel.NomeUsuario,
					usuariopainel.NivelDeAcesso
			FROM ".BANCO.".usuariopainel
			WHERE usuariopainel.ID = '%d'
			AND usuariopainel.AtivacaoUsuario = '1'
			LIMIT 1",
			FiltrarCampos(mysql_real_escape_string(utf8_decode($ResultadoControleUsuario["ID"])))
			);
			$ResultadoUsuario = mysql_query($SelectUsuario) or die (mysql_error());
			$nCount=1;
			while ($row = mysql_fetch_array($ResultadoUsuario)){			
					$BuscaMostrarUsuarios[$nCount]["ID"             ] = trim($row[0]);
					$BuscaMostrarUsuarios[$nCount]["AtivacaoUsuario"] = trim($row[1]);
					$BuscaMostrarUsuarios[$nCount]["EmailUsuario"   ] = trim($row[2]);
					$BuscaMostrarUsuarios[$nCount]["NomeUsuario"    ] = trim($row[3]);
					$BuscaMostrarUsuarios[$nCount]["NivelDeAcesso"  ] = trim($row[4]);				
			$nCount++;
			}
			mysql_Free_Result($ResultadoUsuario);
	}
	#FIM SE FOR USUARIO
	#INICIO VALIDANDO VARIAVEIS VAZIAS
		if (!isset($BuscaMostrarUsuarios)) $BuscaMostrarUsuarios = '';
	#FIM VALIDANDO VARIAVEIS VAZIAS

if($BuscaMostrarUsuarios != ''){

?>
<script language="javascript" type="text/javascript">window.scrollTo(0,0);</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td width="35%" class="TextoVerdana12A"><strong>Nome</strong></td>
          <td width="30%" class="TextoVerdana12A"><strong>E-mail</strong></td>
          <td colspan="3" align="center" class="TextoVerdana12A">&nbsp;</td>
        </tr>
        <tr>
          <td height="1" colspan="5" class="FundoLinhas"></td>
        </tr>
        <?php for($i=1;$i<=count($BuscaMostrarUsuarios);$i++){ ?>
        <tr class="FundoListaConteudo">
          <td width="35%" style="padding-left:3px;padding-right:3px;"><?php echo utf8_encode($BuscaMostrarUsuarios[$i]["NomeUsuario"]); ?></td>
          <td width="30%" style="padding-left:3px;padding-right:3px;"><?php echo utf8_encode($BuscaMostrarUsuarios[$i]["EmailUsuario"]); ?></td>
          <td width="10%" align="center" style="padding-left:2px;padding-right:2px;"><a href="javascript:void(0);" onClick="EnviarFormularios('Ferramentas/Usuarios/EditarUsuarios.php','DivResultadosInternos','IDUsuario=<?php echo $BuscaMostrarUsuarios[$i]["ID"] ?>');" class="LinkBlock">Editar</a></td>
          <td width="10%" align="center" style="padding-left:2px;padding-right:2px;"><?php if ($ResultadoControleUsuario["NivelDeAcesso"] == 1){ if($BuscaMostrarUsuarios[$i]["NivelDeAcesso"] == 1){echo "-";}else{ ?><a href="javascript:void(0);" onclick="EnviarFormularios('Ferramentas/Usuarios/AcaoAtivarUsuarios.php','DivResultadosInternos','IDUsuario=<?php echo $BuscaMostrarUsuarios[$i]["ID"] ?>');" class="LinkBlock"><?php if($BuscaMostrarUsuarios[$i]["NivelDeAcesso"] == 0){ echo 'Desativado'; }else{ echo 'Ativado';}?></a><?php }} ?></td>
          <td width="15%" align="center" style="padding-left:2px;padding-right:2px;"><?php if ($ResultadoControleUsuario["NivelDeAcesso"] == 1){ if($BuscaMostrarUsuarios[$i]["NivelDeAcesso"] == 1){?>
            Administrador
            <?php }else{ ?>
            <a href="javascript:void(0);" onClick="ConfirmacoesEdicaoExclusao('Ferramentas/Usuarios/AcaoExcluirUsuario.php','DivResultadosInternos','IDUsuario=<?php echo $BuscaMostrarUsuarios[$i]["ID"] ?>','<?php $FiltroParaEvitarErroJavascript = array('"', "'", "=", ";", ",", ".", ":", "[", "]", "{", "}", "(", ")"); $TextoFiltradoParaEvitarErroJavascript = str_replace($FiltroParaEvitarErroJavascript, "", utf8_encode($BuscaMostrarUsuarios[$i]["NomeUsuario"])); echo $TextoFiltradoParaEvitarErroJavascript; ?>','excluir o usu&aacute;rio');" class="LinkBlock">Excluir</a>
            <?php }}?></td>
        </tr>
        <tr>
          <td colspan="5" class="FundoLinhas" height="3"></td>
        </tr>
        <?php } ?>
        <tr>
          <td height="5" colspan="5"></td>
        </tr>
    </table></td>
  </tr>
</table>
<?php }else{?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="5" height="5"></td>
  </tr>
  <tr>
    <td class="TextoVerdana12B"> Sua busca n&atilde;o encontrou nenhum usu&aacute;rio.</td>
  </tr>
  <tr>
    <td colspan="5" height="10"></td>
  </tr>
  <tr>
    <td colspan="5" class="FundoLinhas" height="5"></td>
  </tr>
</table>
<?php } mysql_Close($ConexaoBanco); ?>