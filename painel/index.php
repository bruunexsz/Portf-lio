<?php
session_start();
if(file_exists('Inc/Init.php')){ require_once 'Inc/Init.php'; }else{ die(''); }
if (file_exists('Inc/Config.php')){ require_once 'Inc/Config.php'; } else { die(''); }

$_SESSION["DadosParaSessao"] = null;
session_destroy();
session_regenerate_id();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Painel Administrativo - <?php echo NOME_DO_CLIENTE; ?></title>
<link href="Css/<?php echo CSS_TEMA; ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="Inc/FuncoesLogin.js"></script>
<script type="text/javascript" language="javascript">
	LoadImagens('cadeado-interno.gif,botao-sair.gif,fundo-botoes-menu-principal.png,fundo-botoes-menu-grandes.png,fundo-conteudo-interno.gif,fundo-conteudo-principal.png,fundo-linhas.gif,fundo-menu-principal.png,botao-upload-imagens.png','<?php echo CAMINHO_IMAGENS_TEMA; ?>');
</script>
</head>
<body>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="100%" align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" class="FundoLogin"><table width="751" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="75">&nbsp;</td>
            <td width="675" height="33" align="left" valign="top" class="TextoArial20A">&nbsp;Painel administrativo - <?php echo NOME_DO_CLIENTE; ?></td>
          </tr>
          <tr>
            <td width="75">&nbsp;</td>
            <td width="675" height="60" align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="16"></td>
                <td width="5" height="16"></td>
                <td height="16"></td>
              </tr>
              <tr>
                <td>
                <form name="FormLogin" method="post" action="AcaoLogar.php" class="FormsSemBordas">
                <table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                  	<td width="15"></td>
                    <td><img src="<?php echo CAMINHO_IMAGENS_TEMA; ?>titulo-email-login.gif" alt="E-mail:" width="56" height="18" border="0" /></td>
                    <td><input name="EmailUsuario" style="width:200px;" type="text" class="TextFields" id="EmailUsuario" size="25" /></td>
                    <td width="10">&nbsp;</td>
                    <td><img src="<?php echo CAMINHO_IMAGENS_TEMA; ?>titulo-senha-login.gif" alt="Senha:" width="58" height="18" border="0" /></td>
                    <td><input name="SenhaUsuario" style="width:130px;" type="password" class="TextFields" id="SenhaUsuario" size="25" /></td>
                    <td>&nbsp;</td>
                    <td><input type="button" class="BotaoPadrao" style="width:55px;" value="Entrar" 
                                                                        onclick="if (ValidarCamposNulos(FormLogin.EmailUsuario)){
                                                                        if (ValidarCamposNulos(FormLogin.SenhaUsuario)){
                                                                        if (ValidarEmail(FormLogin.EmailUsuario)){
                                                                        document.FormLogin.submit()
                                                                        }}}" /></td>
                    </tr>
                </table>
                </form>                </td>
                <td width="5">&nbsp;</td>
                <td><form name="FormReenviarSenha" method="post" action="AcaoReenviarSenha.php" class="FormsSemBordas">
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                      	  <td>
							<input type="hidden" name="EmailEsqueciSenha" id="EmailEsqueciSenha" value=""><input type="button" style="width:120px;" class="BotaoPadrao" value="Reenviar senha"
                														onClick="if (ValidarCamposReenviarSenha(FormLogin.EmailUsuario)){
                                                                        if (ValidarEmail(FormLogin.EmailUsuario)){
                                                                        ReenviarSenha();
                                                                        }}"></td>
                        </tr>
                    </table>
                  </form></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td width="75">&nbsp;</td>
            <td width="675" height="65">&nbsp;</td>
          </tr>
          
        </table></td>
      </tr>
      <tr>
        <td align="center" valign="top" class="TextoVerdana11A"><a href="http://www.midiaclean.com.br" target="_blank" class="TextoVerdana11A">Design e Desenvolvimento M&iacute;dia Clean - Solu&ccedil;&otilde;es para a internet</a></td>
      </tr>

    </table></td>
  </tr>
</table>
</body>
</html>
