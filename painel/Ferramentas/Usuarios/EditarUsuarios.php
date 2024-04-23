<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());
#INICIO RECUPERAR DADOS DO USUARIO
$SQLUsuario = sprintf("SELECT usuariopainel.ID,
			usuariopainel.AtivacaoUsuario,
			usuariopainel.EmailUsuario,
			usuariopainel.SenhaUsuario,
			usuariopainel.NomeUsuario,
			usuariopainel.NivelDeAcesso
		FROM ".BANCO.".usuariopainel
		WHERE usuariopainel.ID = '%s'
		LIMIT 1",
			FiltrarCampos(mysql_real_escape_string(utf8_decode($IDUsuario)))
		);
$ResultadoUsuario = mysql_query($SQLUsuario) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoUsuario)){			
	$BuscaMostrarUsuarios[$nCount]["ID"             ] = trim($row[0]);
	$BuscaMostrarUsuarios[$nCount]["AtivacaoUsuario"] = trim($row[1]);
	$BuscaMostrarUsuarios[$nCount]["EmailUsuario"   ] = trim($row[2]);				
	$BuscaMostrarUsuarios[$nCount]["SenhaUsuario"   ] = trim($row[3]);
	$BuscaMostrarUsuarios[$nCount]["NomeUsuario"    ] = trim($row[4]);
	$BuscaMostrarUsuarios[$nCount]["NivelDeAcesso"  ] = trim($row[5]);			
$nCount++;
}
mysql_Free_Result($ResultadoUsuario);	
#FIM RECUPERAR DADOS DO USUARIO

if($BuscaMostrarUsuarios[1]["NivelDeAcesso"] > 0){ ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="20" class="TextoVerdana12B"> Aten&ccedil;&atilde;o, voc&ecirc; ir&aacute; alterar os dados de <?php echo utf8_encode($BuscaMostrarUsuarios[1]["NomeUsuario"]); ?>.</td>
      </tr>
      <tr>
        <td class="FundoLinhas">&nbsp;</td>
      </tr>
      <tr>
        <td><form name="EditarUsuarios" method="post" class="FormsSemBordas" onsubmit="return false;">
          <input type="hidden" name="IDEditarUsuarios" id="IDEditarUsuarios" value="<?php echo $BuscaMostrarUsuarios[1]["ID"] ?>" />
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="left" class="TextoVerdana12A">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
                    <tr>
                      <td>Nome:</td>
                      <td>Email:</td>
                    </tr>
                    <tr>
                      <td height="20"><input name="NomeEditarUsuarios" type="text" class="TextFields" id="NomeEditarUsuarios" value="<?php echo utf8_encode($BuscaMostrarUsuarios[1]["NomeUsuario"]); ?>" style="width:330px;"/></td>
                      <td><input name="EmailEditarUsuarios" type="text" class="TextFields" id="EmailEditarUsuarios" value="<?php echo utf8_encode($BuscaMostrarUsuarios[1]["EmailUsuario"]); ?>" style="width:320px;" /></td>
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
                      <td><input name="SenhaEditarUsuarios" type="text" disabled="disabled" class="TextFields" id="SenhaEditarUsuarios" onFocus="this.blur();" value="<?php echo $BuscaMostrarUsuarios[1]["SenhaUsuario"]; ?>" style="width:160px;"/></td>
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
                                        onClick="if (ValidarCamposNulos(EditarUsuarios.NomeEditarUsuarios)){
                                         if (ValidarCamposNulos(EditarUsuarios.EmailEditarUsuarios)){
                                         if (ValidarEmail(EditarUsuarios.EmailEditarUsuarios)){
                                         if (ValidarCamposNulos(EditarUsuarios.SenhaEditarUsuarios)){
                                         if (ValidarCamposNulos(EditarUsuarios.NovaSenhaEditarUsuarios)){
                                         if (ValidarCamposNulos(EditarUsuarios.RedigitacaoNovaSenhaEditarUsuarios)){
                                         if (ValidarSenhas(EditarUsuarios.NovaSenhaEditarUsuarios, EditarUsuarios.RedigitacaoNovaSenhaEditarUsuarios)){
                                         
                                        EnviarFormularios('Ferramentas/Usuarios/AcaoEditarUsuarios.php','DivResultadosInternos','CampoIDEditarUsuarios='+encodeURIComponent(document.getElementById('IDEditarUsuarios').value)+'&CampoEmailEditarUsuarios='+encodeURIComponent(document.getElementById('EmailEditarUsuarios').value)+'&CampoEmailInicialEditarUsuarios='+encodeURIComponent('<?php echo utf8_encode($BuscaMostrarUsuarios[1]["EmailUsuario"]); ?>')+'&CampoNovaSenhaEditarUsuarios='+encodeURIComponent(document.getElementById('NovaSenhaEditarUsuarios').value)+'&CampoRedigitacaoNovaSenhaEditarUsuarios='+encodeURIComponent(document.getElementById('RedigitacaoNovaSenhaEditarUsuarios').value)+'&CampoNomeEditarUsuarios='+encodeURIComponent(document.getElementById('NomeEditarUsuarios').value));
                                        }}}}}}}" value="Enviar"></td>
                      <td><input type="button" class="BotaoPadrao" 
                                        onclick="AlterarConteudo('Ferramentas/Usuarios/ListarUsuarios.php','DivResultadosInternos','');" value="Cancelar" /></td>
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
<?php }else{ ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="5" height="5"></td>
  </tr>
  <tr>
    <td class="TextoVerdana12B"> Este usu&aacute;rio est&aacute; desativado, para edit&aacute;-lo &eacute; necess&aacute;rio primerio ativar seu cadastro.</td>
  </tr>
  <tr>
    <td colspan="5" height="10"></td>
  </tr>
  <tr>
    <td colspan="5" class="FundoLinhas" height="5"></td>
  </tr>
</table>
<?php } mysql_Close($ConexaoBanco); ?>