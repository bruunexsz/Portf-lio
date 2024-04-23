<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());
#INICIO RECUPERAR DADOS DO FILIADO

	$SelectFiliado = sprintf("SELECT cadastrousuariofiliado.ID,
				cadastrousuariofiliado.AtivacaoUsuario,
				cadastrousuariofiliado.LoginUsuario,
				cadastrousuariofiliado.SenhaUsuario,
				cadastrousuariofiliado.EmailUsuario,
				cadastrousuariofiliado.NomeUsuario
			FROM ".BANCO.".cadastrousuariofiliado
			WHERE cadastrousuariofiliado.ID  = '%d'
			ORDER BY ID desc",
				FiltrarCampos(mysql_real_escape_string(utf8_decode($IDFiliado)))
			);
			$ResultadoFiliado = mysql_query($SelectFiliado) or die (mysql_error());
			$nCount=1;
			while ($row = mysql_fetch_array($ResultadoFiliado)){			
				$BuscaMostrarFiliados[$nCount]["ID"             ] = trim($row[0]);
				$BuscaMostrarFiliados[$nCount]["AtivacaoUsuario"] = trim($row[1]);
				$BuscaMostrarFiliados[$nCount]["LoginUsuario"   ] = trim($row[2]);
				$BuscaMostrarFiliados[$nCount]["SenhaUsuario"   ] = trim($row[3]);
				$BuscaMostrarFiliados[$nCount]["EmailUsuario"   ] = trim($row[4]);
				$BuscaMostrarFiliados[$nCount]["NomeUsuario"    ] = trim($row[5]);			
			$nCount++;
			}
			mysql_Free_Result($ResultadoFiliado);

#FIM RECUPERAR DADOS DO FILIADO

 ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="20" class="TextoVerdana12B"> Aten&ccedil;&atilde;o, voc&ecirc; ir&aacute; alterar os dados de <?php echo utf8_encode($BuscaMostrarFiliados[1]["NomeUsuario"]); ?>.</td>
      </tr>
      <tr>
        <td class="FundoLinhas">&nbsp;</td>
      </tr>
      <tr>
        <td><form name="EditarFiliados" method="post" class="FormsSemBordas" onsubmit="return false;">
          <input type="hidden" name="IDEditarFiliados" id="IDEditarFiliados" value="<?php echo $BuscaMostrarFiliados[1]["ID"] ?>" />
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" class="TextoVerdana12A">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
                    <tr>
                      <td>Nome da associa&ccedil;&atilde;o:</td>
                      <td>Usu&aacute;rio:</td>
                      <td>Email:</td>
                    </tr>
                    <tr>
                      <td height="20"><input name="NomeEditarFiliados" type="text" class="TextFields" id="NomeEditarFiliados" value="<?php echo utf8_encode($BuscaMostrarFiliados[1]["NomeUsuario"]); ?>" style="width:240px;"/></td>
                      <td><input name="LoginEditarFiliados" type="text" class="TextFields" id="LoginEditarFiliados" value="<?php echo utf8_encode($BuscaMostrarFiliados[1]["LoginUsuario"]); ?>" style="width:160px;" /></td>
                      <td><input name="EmailEditarFiliados" type="text" class="TextFields" id="EmailEditarFiliados" value="<?php echo utf8_encode($BuscaMostrarFiliados[1]["EmailUsuario"]); ?>" style="width:240px;" /></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td height="10" align="left" class="FundoLinhas"></td>
              </tr>
              <tr>
                <td align="left" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
                    <tr>
                      <td>Senha atual:</td>
                      <td>Nova senha:</td>
                      <td>Redigite a nova senha:</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><input name="SenhaEditarUsuarios" type="text" disabled="disabled" class="TextFields" id="SenhaEditarUsuarios" onFocus="this.blur();" value="<?php echo $BuscaMostrarFiliados[1]["SenhaUsuario"]; ?>" style="width:160px;"/></td>
                      <td><input name="NovaSenhaEditarUsuarios" type="text" class="TextFields" id="NovaSenhaEditarUsuarios" style="width:160px;" /></td>
                      <td><input name="RedigitacaoNovaSenhaEditarUsuarios" type="text" class="TextFields" id="RedigitacaoNovaSenhaEditarUsuarios" style="width:160px;" /></td>
                      <td><a href="javascript: UtilizarMesmaSenhaEditarUsuarios();" class="TextoVerdana11A">Utilizar a senha atual.</a></td>
                    </tr>
                  </table></td>
              </tr>
          <tr>
            <td height="10" align="left" class="FundoLinhas"></td>
          </tr>
              <tr>
                <td align="right" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
                    <tr>
                      <td><input type="button" class="BotaoPadrao" 
                                    onClick="if (ValidarCamposNulos(EditarFiliados.NomeEditarFiliados)){
                                     if (ValidarCamposNulos(EditarFiliados.LoginEditarFiliados)){                                    
                                     if (ValidarCamposNulos(EditarFiliados.NovaSenhaEditarUsuarios)){
                                     if (ValidarCamposNulos(EditarFiliados.RedigitacaoNovaSenhaEditarUsuarios)){
                                     if (ValidarSenhas(EditarFiliados.NovaSenhaEditarUsuarios,EditarFiliados.RedigitacaoNovaSenhaEditarUsuarios)){
                                     
									EnviarFormularios('Ferramentas/AreaDoFiliado/Filiados/AcaoEditarFiliado.php','DivResultadosInternos','CampoIDEditarFiliados='+encodeURIComponent(document.getElementById('IDEditarFiliados').value)+'&CampoLoginEditarFiliados='+encodeURIComponent(document.getElementById('LoginEditarFiliados').value)+'&CampoEmailEditarFiliados='+encodeURIComponent(document.getElementById('EmailEditarFiliados').value)+'&CampoLoginInicialEditarFiliados='+encodeURIComponent('<?php echo utf8_encode($BuscaMostrarFiliados[1]["LoginUsuario"]); ?>')+'&CampoNovaSenhaEditarFiliados='+encodeURIComponent(document.getElementById('NovaSenhaEditarUsuarios').value)+'&CampoRedigitacaoNovaSenhaEditarFiliados='+encodeURIComponent(document.getElementById('RedigitacaoNovaSenhaEditarUsuarios').value)+'&CampoNomeEditarFiliados='+encodeURIComponent(document.getElementById('NomeEditarFiliados').value));
                                    }}}}}" value="Enviar"></td>
                      <td><input type="button" class="BotaoPadrao" 
                                        onclick="AlterarConteudo('Ferramentas/AreaDoFiliado/Filiados/ListarFiliado.php','DivResultadosInternos','');" value="Cancelar" /></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td align="left" class="TextoVerdana12A">&nbsp;</td>
              </tr>
              <tr>
                <td align="left"></td>
              </tr>
          </table>
          </form></td>
      </tr>
    </table>

<?php mysql_Close($ConexaoBanco); ?>