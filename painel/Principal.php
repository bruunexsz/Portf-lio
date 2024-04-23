<?php
header("Content-Type: text/html; charset=utf-8",true);
if(file_exists('Inc/Init.php')){ require_once 'Inc/Init.php'; }else{ die(''); }
if (file_exists('Inc/Config.php')){ require_once 'Inc/Config.php'; } else { die(''); }
if (file_exists('Inc/Seguranca.php')){ require_once 'Inc/Seguranca.php'; } else { die(''); }
if (file_exists('Inc/Funcoes.php')){ require_once 'Inc/Funcoes.php'; } else { die(''); }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Painel Administrativo - <?php echo utf8_encode(NOME_DO_CLIENTE); ?></title>
<link href="Css/<?php echo CSS_TEMA; ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="Inc/Funcoes.js"></script>
<script type="text/javascript" src="Inc/Prototype.js"></script>
<script type="text/javascript" src="Inc/SwfUploader/swfupload.js"></script>
<script type="text/javascript" src="Inc/SwfUploader/swfupload.queue.js"></script>
<script type="text/javascript" src="Inc/SwfUploader/fileprogress.js"></script>
<script type="text/javascript" src="Inc/SwfUploader/handlers.js"></script>
</head>
<body class="FundoConteudoInterno">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><table width="1000" border="0" cellspacing="0" cellpadding="30">
        <tr>
          <td align="center"><table width="940" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="65%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="51" rowspan="2" class="TextoArial20A"><img src="<?php echo CAMINHO_IMAGENS_TEMA; ?>cadeado-interno.gif" width="51" height="65" /></td>
                          <td width="10">&nbsp;</td>
                          <td class="TextoArial20A">Painel administrativo - <?php echo utf8_encode(NOME_DO_CLIENTE); ?></td>
                        </tr>
                        <tr>
                          <td width="10">&nbsp;</td>
                          <td valign="top" class="TextoVerdana11A">&nbsp;Seja bem-vindo <?php echo utf8_encode($ResultadoControleUsuario["NomeUsuario"]); ?></td>
                        </tr>
                    </table></td>
                    <td width="35%" align="right"><table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td class="TextoVerdana11A"><div id="DivAlterarTemaPainel" style="display:block">&nbsp;Cores dispon&iacute;veis:</div></td>
                            <td width="5">&nbsp;</td>
                            <td width="20" height="20" style="cursor:pointer; border: 2px solid #FFFFFF; background-color:#A2C611" onclick="EnviarFormularios('AcaoAlterarTema.php','DivAlterarTemaPainel','CampoTemaPainel='+encodeURIComponent('Verde'));">&nbsp;</td>
                            <td width="5">&nbsp;</td>
                            <td width="20" height="20" style="cursor:pointer; border: 2px solid #FFFFFF; background-color:#8B221F" onclick="EnviarFormularios('AcaoAlterarTema.php','DivAlterarTemaPainel','CampoTemaPainel='+encodeURIComponent('Vermelho'));">&nbsp;</td>
                            </tr>
                        </table></td>
                        <td width="35" align="right">&nbsp;</td>
                        <td><a href="LogOff.php"><img src="<?php echo CAMINHO_IMAGENS_TEMA; ?>botao-sair.gif" alt="Sair do painel" width="25" height="25" border="0" align="absmiddle" /></a></td>
                      </tr>
                    </table></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td height="10"></td>
            </tr>
            <tr>
              <td><div id="ConteudoPrincipal">
                  <table width="940" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="212" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="1" class="FundoTabelaConteudo">
                          <tr>
                            <td align="center" valign="top" class="FundoMenuPrincipal"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="10"></td>
                                </tr>
                                <tr>
                                  <td align="center" class="TextoArial20A">Menu principal</td>
                                </tr>
                                <tr>
                                  <td height="10"></td>
                                </tr>
                                <tr>
                                  <td height="44" align="center"><table width="184" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuPrincipal">
                                      <tr>
                                        <td height="40" onclick="AlterarConteudo('Ferramentas/Usuarios/index.php','ConteudoInterno','');">Usu&aacute;rios</td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="5"></td>
                                </tr>
                                <tr>
                                  <td height="44" align="center"><table width="184" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuPrincipal">
                                      <tr>
                                        <td height="40" onclick="AlterarConteudo('Ferramentas/Noticias/index.php','ConteudoInterno','');">Not&iacute;cias</td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="5"></td>
                                </tr>
                                <tr>
                                  <td height="44" align="center"><table width="184" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuPrincipal">
                                    <tr>
                                      <td height="40" onclick="AlterarConteudo('Ferramentas/Eventos/index.php','ConteudoInterno','');">Eventos</td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="5"></td>
                                </tr>
                                <tr>
                                  <td height="44" align="center"><table width="184" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuPrincipal">
                                    <tr>
                                      <td height="40" onclick="AlterarConteudo('Ferramentas/Resultados/index.php','ConteudoInterno','');">Resultados</td>
                                    </tr>
                                  </table></td>
                                </tr>
<tr>
  <td height="5"></td>
</tr>
                                <tr>
                                  <td height="44" align="center"><table width="184" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuPrincipal">
                                      <tr>
                                        <td height="40" onclick="AlterarConteudo('Ferramentas/GaleriaDeFotos/index.php','ConteudoInterno','');">Galeria de fotos</td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="5"></td>
                                </tr>
                                <tr>
                                  <td height="44" align="center"><table width="184" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuPrincipal">
                                    <tr>
                                      <td height="40" onclick="AlterarConteudo('Ferramentas/GaleriaDeVideos/index.php','ConteudoInterno','');">Galeria de v&iacute;deos</td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="5"></td>
                                </tr>
                                <tr>
                                  <td height="44" align="center"><table width="184" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuPrincipal">
                                    <tr>
                                      <td height="40" onclick="AlterarConteudo('Ferramentas/Destaques/index.php','ConteudoInterno','');">Destaques</td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="5"></td>
                                </tr>
                                <tr>
                                  <td height="44" align="center"><table width="184" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuPrincipal">
                                    <tr>
                                      <td height="40" onclick="AlterarConteudo('Ferramentas/AreaDoFiliado/index.php','ConteudoInterno','');">&Aacute;rea do filiado</td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="5"></td>
                                </tr>
                                <tr>
                                  <td height="44" align="center"><table width="184" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuPrincipal">
                                    <tr>
                                      <td height="40" onclick="AlterarConteudo('Ferramentas/DescricaoFKP/index.php','ConteudoInterno','');">Descri&ccedil;&atilde;o FKP</td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="5"></td>
                                </tr>
                                <tr>
                                  <td height="44" align="center"><table width="184" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuPrincipal">
                                    <tr>
                                      <td height="40" onclick="AlterarConteudo('Ferramentas/PalavraDoPresidente/index.php','ConteudoInterno','');">Palavra do presidente</td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="5"></td>
                                </tr>
                                <tr>
                                  <td height="44" align="center"><table width="184" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuPrincipal">
                                    <tr>
                                      <td height="40" onclick="AlterarConteudo('Ferramentas/Publicidade/index.php','ConteudoInterno','');">Cadastro de publicidade</td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="5"></td>
                                </tr>
                                <tr>
                                  <td height="44" align="center"><table width="184" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuPrincipal">
                                    <tr>
                                      <td height="40" onclick="AlterarConteudo('Ferramentas/Informativos/index.php','ConteudoInterno','');">Informativos</td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr>
                                  <td height="5"></td>
                                </tr>
                                <?php if ($ResultadoControleUsuario["NivelDeAcesso"] == 1){ ?>
                                <tr>
                                  <td height="44" align="center"><table width="184" border="0" cellpadding="0" cellspacing="0" class="FundoBotoesMenuPrincipal">
                                      <tr>
                                        <td height="40" onclick="AlterarConteudo('Ferramentas/Configuracao/index.php','ConteudoInterno','');">Configura&ccedil;&atilde;o do site</td>
                                      </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td height="5"></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                  <td height="15"></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                      <td width="28">&nbsp;</td>
                      <td width="700" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="1" class="FundoTabelaConteudo">
                          <tr>
                            <td height="274" align="left" valign="top" class="FundoConteudoPrincipal"><table width="100%" border="0" cellspacing="0" cellpadding="10">
                                <tr>
                                  <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td height="335" valign="top" class="TextoVerdana11A"><div id="ConteudoInterno" style="width:677px;">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td height="335" align="center" valign="middle" class="TextoArial20A">Utilize o menu principal ao lado para acessar o conte&uacute;do desejado.</td>
                                              </tr>
                                            </table>
                                        </div></td>
                                      </tr>
                                  </table></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td valign="top">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td valign="top">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3" align="center"><a href="http://www.midiaclean.com.br" target="_blank" class="TextoVerdana11A">Design e Desenvolvimento  M&iacute;dia Clean - Solu&ccedil;&otilde;es para a internet</a></td>
                    </tr>
                  </table>
              </div></td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>