<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }
$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

# DEFINIDO O TEMPO DE EXECUÇÃO DO SCRIPT PARA 7 HORAS
set_time_limit( ((60 * 60) * 7) );

$NomeDoArquivo = "../../../Emails/emails.txt";
$Arquivo = fopen("$NomeDoArquivo","w+");

fputs($Arquivo, "");
fclose($Arquivo);

$ConsultaEmailsExportados = "SELECT exportarusuariosnewsletter.ID,
	exportarusuariosnewsletter.IDUltimoUsuario,
	exportarusuariosnewsletter.QuantidadeExportado
FROM ".BANCO.".exportarusuariosnewsletter";
$ResultadoEmailsExportados = mysql_query($ConsultaEmailsExportados, $ConexaoBanco) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoEmailsExportados)){			
	$BuscaMostrarEmailsExportados[$nCount]["ID"                 ] = trim($row[0]);
	$BuscaMostrarEmailsExportados[$nCount]["IDUltimoUsuario"    ] = trim($row[1]);
	$BuscaMostrarEmailsExportados[$nCount]["QuantidadeExportado"] = trim($row[2]);
$nCount++;
}
mysql_Free_Result($ResultadoEmailsExportados);
if (!isset($BuscaMostrarEmailsExportados[1]["ID"])) $BuscaMostrarEmailsExportados[1]["ID"] = '';
if($BuscaMostrarEmailsExportados[1]["ID"] == ''){
	$TotalEmailExportados = 0;
	$UltimoIDUsuario = 0;	
}else{
	$TotalEmailExportados = $BuscaMostrarEmailsExportados[1]["QuantidadeExportado"];
	$UltimoIDUsuario = FiltrarCampos($BuscaMostrarEmailsExportados[1]["IDUltimoUsuario"]);
}

$NomeDoArquivo = "../../../Emails/emails.txt";
$Arquivo = fopen("$NomeDoArquivo","w+");

$SelectUsuariosNewsletter = mysql_query("
select usuarionewsletter.ID,
	   usuarionewsletter.AtivacaoDosDestinatarios, 
	   usuarionewsletter.NomesDosDestinatarios,
	   usuarionewsletter.EmailsDosDestinatarios, 
	   usuarionewsletter.CodigoDesativacaoDosDestinatarios 
	   from usuarionewsletter 
	   WHERE usuarionewsletter.AtivacaoDosDestinatarios = '1' 
	   AND usuarionewsletter.ID > '".$UltimoIDUsuario."' 
	   ORDER BY ID ASC 
	   LIMIT 2950
	   ");
fputs($Arquivo, "nomes; e-mails; codigoremover \n");
$Contador = 0;
while ($Dados = mysql_fetch_array($SelectUsuariosNewsletter)) {
	$Emails = $Dados["NomesDosDestinatarios"]."; ".$Dados["EmailsDosDestinatarios"]."; ".$Dados["CodigoDesativacaoDosDestinatarios"].";";
	$UltimoID = $Dados["ID"];
	$Gravar = $Emails;
	fputs($Arquivo, "$Gravar");
	$Contador = $Contador+1;
}
fclose($Arquivo);

if($Contador != 0){
	$TotalExportadoAtualizado = $TotalEmailExportados + $Contador;
	$UpdateQtdUsuariosExportados = sprintf("UPDATE ".BANCO.".exportarusuariosnewsletter 
				SET exportarusuariosnewsletter.IDUltimoUsuario = '%d',
					exportarusuariosnewsletter.QuantidadeExportado = '%d'
			  WHERE exportarusuariosnewsletter.ID = 1",
			  FiltrarCampos(mysql_real_escape_string(utf8_decode($UltimoID))),
			  FiltrarCampos(mysql_real_escape_string(utf8_decode($TotalExportadoAtualizado)))
			  );
	$ResultadoQtdUsuariosExportados = mysql_query($UpdateQtdUsuariosExportados) or die (mysql_error());
}

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="TextoVerdana12B">&nbsp;</td>
  </tr>
  <tr>
    <td class="TextoVerdana12B"> Foram exportados <strong><?php echo number_format($Contador, 0, ",", "."); ?></strong> e-mails para o arquivo.</td>
  </tr>
  <tr>
    <td class="TextoVerdana12B">&nbsp;</td>
  </tr>
  <tr>
    <td class="TextoVerdana12A">Clique abaixo para fazer o download do arquivo atualizado. Ap&oacute;s o download n&atilde;o esque&ccedil;a de clicar em &quot;<em>Limpar arquivo exportado</em>&quot;.</td>
  </tr>
  <tr>
    <td class="TextoVerdana12B">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" align="center" class="FundoLinhas"></td>
  </tr>
  <tr>
    <td height="35" align="center" class="TextoVerdana12B"><a href="../Emails/DownloadEmails.php" class="TextoVerdana11A">Clique aqui e fa&ccedil;a o download da lista de e-mails atualizada!</a></td>
  </tr>
  <tr>
    <td height="25" align="center" class="FundoLinhas"></td>
  </tr>
  <tr>
    <td align="center"><a href="javascript:void(0);" onclick="AlterarConteudo('Ferramentas/Informativos/AcaoLimparEmail.php','DivResultadosInternos','');">
      <input type="button" value="Limpar arquivo exportado" class="BotaoPadrao"/>
      </a></td>
  </tr>
  <tr>
    <td height="25" class="FundoLinhas">&nbsp;</td>
  </tr>
</table>
<?php mysql_Close($ConexaoBanco); ?>
