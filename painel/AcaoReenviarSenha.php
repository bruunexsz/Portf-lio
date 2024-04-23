<?php
if(file_exists('Inc/Init.php')){ require_once 'Inc/Init.php'; }else{ die(''); }
if (file_exists('Inc/Config.php')){ require_once 'Inc/Config.php'; } else { die(''); }
require_once 'Inc/Funcoes.php';

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

#INICIO SELECT DADOS DE CONFIGURACAO
$SQLConfiguracao = sprintf("SELECT configuracao.ID,
			configuracao.HostEmailContato,
			configuracao.NomeEmailContato,
			configuracao.EmailContato,
			configuracao.SenhaEmailContato
		FROM ".BANCO.".configuracao
		WHERE configuracao.ID = '%d'
		LIMIT 1",
			FiltrarCampos(mysql_real_escape_string(1))
		);
$ResultadoConfiguracao = mysql_query($SQLConfiguracao) or die (mysql_error());
$nCount=1;
while ($row = mysql_fetch_array($ResultadoConfiguracao)){			
	$BuscaMostrarConfiguracao[$nCount]["ID"               ] = trim($row[0]);
	$BuscaMostrarConfiguracao[$nCount]["HostEmailContato" ] = trim($row[1]);
	$BuscaMostrarConfiguracao[$nCount]["NomeEmailContato" ] = trim($row[2]);				
	$BuscaMostrarConfiguracao[$nCount]["EmailContato"     ] = trim($row[3]);
	$BuscaMostrarConfiguracao[$nCount]["SenhaEmailContato"] = trim($row[4]);
$nCount++;
}
mysql_Free_Result($ResultadoConfiguracao);	
#FIM SELECT DADOS DE CONFIGURACAO

$EmailEsqueciSenha = isset($_POST['EmailEsqueciSenha']) ? FiltrarCampos($_POST['EmailEsqueciSenha']) : '';

#INICIO RECUPERAR DADOS DO USUARIO
$SQLUsuario = sprintf("SELECT usuariopainel.ID,
			usuariopainel.AtivacaoUsuario,
			usuariopainel.EmailUsuario,
			usuariopainel.SenhaUsuario,
			usuariopainel.NomeUsuario,
			usuariopainel.NivelDeAcesso
		FROM ".BANCO.".usuariopainel
		WHERE usuariopainel.EmailUsuario = '%s'
		AND usuariopainel.AtivacaoUsuario = '1'
		AND usuariopainel.NivelDeAcesso > '0'
		LIMIT 1",
			FiltrarCampos(mysql_real_escape_string($EmailEsqueciSenha))
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

if (!isset($BuscaMostrarUsuarios[1]["NomeUsuario"])) $BuscaMostrarUsuarios[1]["NomeUsuario"] = '';
if($BuscaMostrarUsuarios[1]["NomeUsuario"] != ''){

$DataDoEnvio = strftime( "%d/%m/%Y" );
$HoraDoEnvio = strftime( "%H:%M:%S" );

#INICIO ENVIO DOS EMAILS
include("Inc/ClassesEnvioEmail/class.phpmailer.php");
//instancia a objetos
$mail = new PHPMailer();
// mandar via SMTP
$mail->IsSMTP(); 
// Seu servidor smtp
$mail->Host = $BuscaMostrarConfiguracao[1]["HostEmailContato" ];
// habilita smtp autenticado
$mail->SMTPAuth = true; 
// usuário deste servidor smtp
$mail->Username = $BuscaMostrarConfiguracao[1]["EmailContato"];
$mail->Password = $BuscaMostrarConfiguracao[1]["SenhaEmailContato"]; // senha
//email utilizado para o envio 
//pode ser o mesmo de username
$mail->From = $BuscaMostrarConfiguracao[1]["EmailContato"];
$mail->FromName = $BuscaMostrarConfiguracao[1]["NomeEmailContato"];

//Enderecos que devem ser enviadas as mensagens
$mail->AddAddress($BuscaMostrarUsuarios[1]["EmailUsuario"],$BuscaMostrarUsuarios[1]["NomeUsuario"]);

//wrap seta o tamanhdo do texto por linha
$mail->WordWrap = 500; 
$mail->IsHTML(true); //enviar em HTML

// recebendo os dados od formulario
if(isset($BuscaMostrarUsuarios[1]["EmailUsuario"])){
    // informando a quem devemos responder 
	$mail->AddReplyTo($BuscaMostrarConfiguracao[1]["EmailContato"],$BuscaMostrarConfiguracao[1]["NomeEmailContato"]);
	//criando o codigo html para enviar no email
	
$ConteudoHtmlEmail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
$ConteudoHtmlEmail .= '<html xmlns="http://www.w3.org/1999/xhtml">';
$ConteudoHtmlEmail .= '<head>';
$ConteudoHtmlEmail .= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />';
$ConteudoHtmlEmail .= '<title>Solicita&ccedil;&atilde;o da senha do painel administrativo</title>';
$ConteudoHtmlEmail .= '</head>';
$ConteudoHtmlEmail .= '<body>';
$ConteudoHtmlEmail .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
$ConteudoHtmlEmail .= '<tr>';
  $ConteudoHtmlEmail .= '<td style="font-family: Arial, Verdana, Helvetica, sans-serif;	font-size: 13px;font-style: normal;	line-height: normal;font-weight: normal;font-variant: normal;text-transform: none;color: #666666;text-decoration: none;">Conforme sua solicita&ccedil;&atilde;o registrada em '.$DataDoEnvio.' &agrave;s '.$HoraDoEnvio.' estamos enviando sua senha de acesso ao painel administrativo.</td>';
$ConteudoHtmlEmail .= '</tr>';
$ConteudoHtmlEmail .= '<tr>';
  $ConteudoHtmlEmail .= '<td>&nbsp;</td>';
$ConteudoHtmlEmail .= '</tr>';
$ConteudoHtmlEmail .= '<tr>';
  $ConteudoHtmlEmail .= '<td style="font-family: Arial, Verdana, Helvetica, sans-serif;	font-size: 13px;font-style: normal;	line-height: normal;font-weight: normal;font-variant: normal;text-transform: none;color: #666666;text-decoration: none;"><strong>Seu e-mail de login  &eacute;: </strong>'.$BuscaMostrarUsuarios[1]["EmailUsuario"].'</td>';
$ConteudoHtmlEmail .= '</tr>';
$ConteudoHtmlEmail .= '<tr>';
  $ConteudoHtmlEmail .= '<td height="5"></td>';
$ConteudoHtmlEmail .= '</tr>';
$ConteudoHtmlEmail .= '<tr>';
  $ConteudoHtmlEmail .= '<td style="font-family: Arial, Verdana, Helvetica, sans-serif;	font-size: 13px;font-style: normal;	line-height: normal;font-weight: normal;font-variant: normal;text-transform: none;color: #666666;text-decoration: none;"><strong>Sua senha &eacute;: </strong>'.$BuscaMostrarUsuarios[1]["SenhaUsuario"].'</td>';
$ConteudoHtmlEmail .= '</tr>';
$ConteudoHtmlEmail .= '<tr>';
  $ConteudoHtmlEmail .= '<td>&nbsp;</td>';
$ConteudoHtmlEmail .= '</tr>';
$ConteudoHtmlEmail .= '<tr>';
  $ConteudoHtmlEmail .= '<td style="font-family: Arial, Verdana, Helvetica, sans-serif;	font-size: 13px;font-style: normal;	line-height: normal;font-weight: normal;font-variant: normal;text-transform: none;color: #666666;text-decoration: none;"><strong>Obrigado!</strong></td>';
$ConteudoHtmlEmail .= '</tr>';
$ConteudoHtmlEmail .= '</table>';
$ConteudoHtmlEmail .= '</body>';
$ConteudoHtmlEmail .= '</html>';	
} 
$mail->Subject = 'Reenvio da senha do painel administrativo.';
//adicionando o html no corpo do email
$mail->Body = $ConteudoHtmlEmail;
//enviando e retornando o status de envio
if(!$mail->Send())
{
//Informa caso não consiga enviar
	    echo "<script>alert('Desculpe, mas o e-mail não pode ser enviado no momento.');</script>";
		echo "<script>location.href='index.php';</script>";
		exit(0);
}
//Informa que foi enviado com sucesso
	    echo "<script>alert('Sua senha foi reenviada com sucesso para o e-mail informado.');</script>";
		echo "<script>location.href='index.php';</script>";
		exit(0);
#FIM ENVIO DOS EMAILS

}else{
	echo "<script>location.href='index.php';</script>";       
	exit(0);
}
	mysql_Close($ConexaoBanco);
?>