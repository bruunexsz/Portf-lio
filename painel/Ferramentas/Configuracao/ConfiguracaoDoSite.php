<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

if ($ResultadoControleUsuario["NivelDeAcesso"] == 1){

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());
#INICIO SELECT DADOS DE CONFIGURACAO
$SQLConfiguracao = sprintf("SELECT configuracao.ID,
			configuracao.HostEmailContato,
			configuracao.NomeEmailContato,
			configuracao.EmailContato,
			configuracao.SenhaEmailContato,
			configuracao.AssuntoEmailContato,
			configuracao.HostEmailIndicacao,
			configuracao.NomeEmailIndicacao,
			configuracao.EmailIndicacao,
			configuracao.SenhaEmailIndicacao,
			configuracao.AssuntoEmailIndicacao,
			configuracao.DescricaoPrincipalDoSite,
			configuracao.PalavrasChaveDoSite
		FROM ".BANCO.".configuracao
		WHERE configuracao.ID = '%d'
		LIMIT 1",
			FiltrarCampos(mysql_real_escape_string(utf8_decode(1)))
		);
$ResultadoConfiguracao = mysql_query($SQLConfiguracao) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoConfiguracao)){			
	$BuscaMostrarConfiguracao[$nCount]["ID"                   ] = trim($row[0]);
	$BuscaMostrarConfiguracao[$nCount]["HostEmailContato"     ] = trim($row[1]);
	$BuscaMostrarConfiguracao[$nCount]["NomeEmailContato"     ] = trim($row[2]);				
	$BuscaMostrarConfiguracao[$nCount]["EmailContato"         ] = trim($row[3]);
	$BuscaMostrarConfiguracao[$nCount]["SenhaEmailContato"    ] = trim($row[4]);
	$BuscaMostrarConfiguracao[$nCount]["AssuntoEmailContato"  ] = trim($row[5]);
	$BuscaMostrarConfiguracao[$nCount]["HostEmailIndicacao"   ] = trim($row[6]);
	$BuscaMostrarConfiguracao[$nCount]["NomeEmailIndicacao"   ] = trim($row[7]);
	$BuscaMostrarConfiguracao[$nCount]["EmailIndicacao"       ] = trim($row[8]);
	$BuscaMostrarConfiguracao[$nCount]["SenhaEmailIndicacao"  ] = trim($row[9]);
	$BuscaMostrarConfiguracao[$nCount]["AssuntoEmailIndicacao"] = trim($row[10]);
	$BuscaMostrarConfiguracao[$nCount]["DescricaoPrincipalDoSite"] = trim($row[11]);
	$BuscaMostrarConfiguracao[$nCount]["PalavrasChaveDoSite"  ] = trim($row[12]);
$nCount++;
}
mysql_Free_Result($ResultadoConfiguracao);	
#FIM SELECT DADOS DE CONFIGURACAO

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="1" align="center" class="TextoVerdana12B"></td>
  </tr>
  <tr>
    <td height="13" class="TextoVerdana12A">&nbsp;</td>
  </tr>
  <tr>
    <td height="13" class="TextoVerdana12A"><strong>Dados do e-mail de contato:</strong></td>
  </tr>
  <tr>
    <td height="13"></td>
  </tr>
  <tr>
    <td><form  name="FormAlterarConfiguracoes" id="FormAlterarConfiguracoes" method="post" class="FormsSemBordas" onsubmit="return false;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td>Host e-mail de contato:</td>
                  <td>E-mail de contato:</td>
                  <td>Senha do e-mail de contato:</td>
                </tr>
                <tr>
                  <td height="20"><input name="HostEmailContato" type="text" class="TextFields" id="HostEmailContato" value="<?php echo utf8_encode($BuscaMostrarConfiguracao[1]["HostEmailContato"]); ?>" style="width:220px;" /></td>
                  <td><input name="EmailContato" type="text" class="TextFields" id="EmailContato" value="<?php echo utf8_encode($BuscaMostrarConfiguracao[1]["EmailContato"]); ?>" style="width:210px;" /></td>
                  <td><input name="SenhaEmailContato" type="text" class="TextFields" id="SenhaEmailContato" value="<?php echo utf8_encode($BuscaMostrarConfiguracao[1]["SenhaEmailContato"]); ?>" style="width:210px;" /></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td height="10" align="left" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td align="left" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td>Nome de exibi&ccedil;&atilde;o do e-mail de contato:</td>
                  <td>Assunto do e-mail de contato:</td>
                </tr>
                <tr>
                  <td><input name="NomeEmailContato" type="text" class="TextFields" id="NomeEmailContato" value="<?php echo utf8_encode($BuscaMostrarConfiguracao[1]["NomeEmailContato"]); ?>" style="width:330px;" /></td>
                  <td><input name="AssuntoEmailContato" type="text" class="TextFields" id="AssuntoEmailContato" value="<?php echo utf8_encode($BuscaMostrarConfiguracao[1]["AssuntoEmailContato"]); ?>" style="width:320px;" /></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td align="left" class="TextoVerdana12A">&nbsp;</td>
          </tr>
          <tr>
            <td height="10" align="left" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td align="left" class="TextoVerdana12A">&nbsp;</td>
          </tr>
          <tr>
            <td height="13" class="TextoVerdana12A"><strong>Dados do e-mail do formul&aacute;rio de indica&ccedil;&atilde;o &agrave; um amigo:</strong></td>
          </tr>
          <tr>
            <td height="13"></td>
          </tr>
          <tr>
            <td align="left" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td>Host e-mail de indica&ccedil;&atilde;o:</td>
                  <td>E-mail de indica&ccedil;&atilde;o:</td>
                  <td>Senha do e-mail de indica&ccedil;&atilde;o:</td>
                </tr>
                <tr>
                  <td height="20"><input name="HostEmailIndicacao" type="text" class="TextFields" id="HostEmailIndicacao" value="<?php echo utf8_encode($BuscaMostrarConfiguracao[1]["HostEmailIndicacao"]); ?>" style="width:220px;" /></td>
                  <td><input name="EmailIndicacao" type="text" class="TextFields" id="EmailIndicacao" value="<?php echo utf8_encode($BuscaMostrarConfiguracao[1]["EmailIndicacao"]); ?>" style="width:210px;" /></td>
                  <td><input name="SenhaEmailIndicacao" type="text" class="TextFields" id="SenhaEmailIndicacao" value="<?php echo utf8_encode($BuscaMostrarConfiguracao[1]["SenhaEmailIndicacao"]); ?>" style="width:210px;" /></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td height="10" align="left" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td align="left" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td>Nome de exibi&ccedil;&atilde;o do e-mail de contato:</td>
                  <td>Assunto do e-mail de contato:</td>
                </tr>
                <tr>
                  <td><input name="NomeEmailIndicacao" type="text" class="TextFields" id="NomeEmailIndicacao" value="<?php echo utf8_encode($BuscaMostrarConfiguracao[1]["NomeEmailIndicacao"]); ?>" style="width:330px;" /></td>
                  <td><input name="AssuntoEmailIndicacao" type="text" class="TextFields" id="AssuntoEmailIndicacao" value="<?php echo utf8_encode($BuscaMostrarConfiguracao[1]["AssuntoEmailIndicacao"]); ?>" style="width:320px;" /></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td height="10" align="left" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td align="left" class="TextoVerdana12A"><table width="100%" border="0" cellpadding="0" cellspacing="3">
                    <tr>
                      <td class="TextoVerdana12A">Texto principal (Texto que aparecer&aacute; no Google ap&oacute;s o site ser indexado):</td>
                    </tr>
                    <tr>
                      <td height="20"><textarea name="TextoPrincipal" rows="4" class="TextFields" id="TextoPrincipal" style="width:660px;" onKeyUp="LimitarTextArea(TextoPrincipal,148);"><?php echo utf8_encode($BuscaMostrarConfiguracao[1]["DescricaoPrincipalDoSite"]); ?></textarea></td>
                    </tr>
                </table></td>
          </tr>
          <tr>
            <td height="10" align="left" class="FundoLinhas"></td>
          </tr>
          <tr>
            <td align="left" class="TextoVerdana12A"><table width="100%" border="0" cellpadding="0" cellspacing="3">
                    <tr>
                      <td class="TextoVerdana12A">Palavras chave (Utilize-as separadas por v&iacute;rgula):</td>
                    </tr>
                    <tr>
                      <td height="20"><textarea name="PalavrasChave" rows="4" class="TextFields" id="PalavrasChave" style="width:660px;" onKeyUp="LimitarTextArea(PalavrasChave,148);"><?php echo utf8_encode($BuscaMostrarConfiguracao[1]["PalavrasChaveDoSite"]); ?></textarea></td>
                    </tr>
                </table></td>
          </tr>
          <tr>
            <td align="right" class="TextoVerdana12A"><table border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td><input type="button" class="BotaoPadrao" 
                                   onClick="if (ValidarCamposNulos(FormAlterarConfiguracoes.HostEmailContato)){
                                            if (ValidarCamposNulos(FormAlterarConfiguracoes.EmailContato)){
                                            if (ValidarEmail(FormAlterarConfiguracoes.EmailContato)){
                                            if (ValidarCamposNulos(FormAlterarConfiguracoes.SenhaEmailContato)){
                                            if (ValidarCamposNulos(FormAlterarConfiguracoes.NomeEmailContato)){
                                            if (ValidarCamposNulos(FormAlterarConfiguracoes.AssuntoEmailContato)){
                                            if (ValidarCamposNulos(FormAlterarConfiguracoes.HostEmailIndicacao)){
                                            if (ValidarCamposNulos(FormAlterarConfiguracoes.EmailIndicacao)){
                                            if (ValidarEmail(FormAlterarConfiguracoes.EmailIndicacao)){
                                            if (ValidarCamposNulos(FormAlterarConfiguracoes.SenhaEmailIndicacao)){
                                            if (ValidarCamposNulos(FormAlterarConfiguracoes.NomeEmailIndicacao)){
                                            if (ValidarCamposNulos(FormAlterarConfiguracoes.AssuntoEmailIndicacao)){
                                            if (ValidarCamposNulos(FormAlterarConfiguracoes.TextoPrincipal)){
                                            if (ValidarCamposNulos(FormAlterarConfiguracoes.PalavrasChave)){

EnviarFormularios('Ferramentas/Configuracao/AcaoConfiguracaoSite.php','DivResultadosInternos','CampoHostEmailContato='+encodeURIComponent(document.getElementById('HostEmailContato').value)+'&CampoEmailContato='+encodeURIComponent(document.getElementById('EmailContato').value)+'&CampoSenhaEmailContato='+encodeURIComponent(document.getElementById('SenhaEmailContato').value)+'&CampoNomeEmailContato='+encodeURIComponent(document.getElementById('NomeEmailContato').value)+'&CampoAssuntoEmailContato='+encodeURIComponent(document.getElementById('AssuntoEmailContato').value)+'&CampoHostEmailIndicacao='+encodeURIComponent(document.getElementById('HostEmailIndicacao').value)+'&CampoEmailIndicacao='+encodeURIComponent(document.getElementById('EmailIndicacao').value)+'&CampoSenhaEmailIndicacao='+encodeURIComponent(document.getElementById('SenhaEmailIndicacao').value)+'&CampoNomeEmailIndicacao='+encodeURIComponent(document.getElementById('NomeEmailIndicacao').value)+'&CampoTextoPrincipal='+encodeURIComponent(document.getElementById('TextoPrincipal').value)+'&CampoPalavrasChave='+encodeURIComponent(document.getElementById('PalavrasChave').value)+'&CampoAssuntoEmailIndicacao='+encodeURIComponent(document.getElementById('AssuntoEmailIndicacao').value));
                                    }}}}}}}}}}}}}}" value="Enviar"></td>
                  <td><input name="Reset" type="reset" class="BotaoPadrao" value="Restaurar" /></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td align="left"></td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
<?php mysql_Close($ConexaoBanco); ?>
<?php }else{
	$MsgExclusaoSucesso = utf8_encode("Somente o administrador pode alterar a configuração do site!");
	echo "<script>alert('".$MsgExclusaoSucesso."');</script>";
	exit(0);
} ?>
