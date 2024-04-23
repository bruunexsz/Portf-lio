<?php
##########################################################
##Função para tratamento de SQL Injection
function FiltrarCampos($ValoresTrocados){
	$ValoresTrocados = preg_replace("/(from|select|insert|delete|where|drop table|drop|show tables|update|#|\*|--|;|<|>|:|'|(|)&amp|&quot|&lt|&gt|\\\\)/i","",$ValoresTrocados);
	$ValoresTrocados = trim($ValoresTrocados);//limpa espaços vazio
	$ValoresTrocados = strip_tags($ValoresTrocados);//tira tags html e php
	$ValoresTrocados = addslashes($ValoresTrocados);//Adiciona barras invertidas a uma string
	return $ValoresTrocados;
}
##########################################################
#Função para proteger contra PHP Injection
$page = "http://www.fkp.com.br";

$cracktrack = $_SERVER['QUERY_STRING'];
$wormprotector = array('chr(', 'chr=', 'chr%20', '%20chr', 'wget%20', '%20wget', 'wget(',
			   'cmd=', '%20cmd', 'cmd%20', 'rush=', '%20rush', 'rush%20',
			   'union%20', '%20union', 'union(', 'union=', 'echr(', '%20echr', 'echr%20', 'echr=',
			   'esystem(', 'esystem%20', 'cp%20', '%20cp', 'cp(', 'mdir%20', '%20mdir', 'mdir(',
			   'mcd%20', 'mrd%20', 'rm%20', '%20mcd', '%20mrd', '%20rm',
			   'mcd(', 'mrd(', 'rm(', 'mcd=', 'mrd=', 'mv%20', 'rmdir%20', 'mv(', 'rmdir(',
			   'chmod(', 'chmod%20', '%20chmod', 'chmod(', 'chmod=', 'chown%20', 'chgrp%20', 'chown(', 'chgrp(',
			   'locate%20', 'grep%20', 'locate(', 'grep(', 'diff%20', 'kill%20', 'kill(', 'killall',
			   'passwd%20', '%20passwd', 'passwd(', 'telnet%20', 'vi(', 'vi%20',
			   'insert%20into', 'select%20', 'nigga(', '%20nigga', 'nigga%20', 'fopen', 'fwrite', '%20like', 'like%20',
			   '$_request', '$_get', '$request', '$get', '.system', 'HTTP_PHP', '&aim', '%20getenv', 'getenv%20',
			   'new_password', '&icq','/etc/password','/etc/shadow', '/etc/groups', '/etc/gshadow',
			   'HTTP_USER_AGENT', 'HTTP_HOST', '/bin/ps', 'wget%20', 'uname\x20-a', '/usr/bin/id',
			   '/bin/echo', '/bin/kill', '/bin/', '/chgrp', '/chown', '/usr/bin', 'g\+\+', 'bin/python',
			   'bin/tclsh', 'bin/nasm', 'perl%20', 'traceroute%20', 'ping%20', '.pl', '/usr/X11R6/bin/xterm', 'lsof%20',
			   '/bin/mail', '.conf', 'motd%20', 'HTTP/1.', '.inc.php', 'config.php', 'cgi-', '.eml',
			   'file\://', 'window.open', '<SCRIPT>', 'javascript\://','img src', 'img%20src','.jsp','ftp.exe',
			   'xp_enumdsn', 'xp_availablemedia', 'xp_filelist', 'xp_cmdshell', 'nc.exe', '.htpasswd',
			   'servlet', '/etc/passwd', 'wwwacl', '~root', '~ftp', '.js', '.jsp', 'admin_', '.history',
			   'bash_history', '.bash_history', '~nobody', 'server-info', 'server-status', 'reboot%20', 'halt%20',
			   'powerdown%20', '/home/ftp', '/home/www', 'secure_site, ok', 'chunked', 'org.apache', '/servlet/con',
			   '<script', '/robot.txt' ,'/perl' ,'mod_gzip_status', 'db_mysql.inc', '.inc', 'select%20from',
			   'select from', 'drop%20', '.system', 'getenv', 'http_', '_php', 'php_', 'phpinfo()', '<?php', '?>', 'sql=');

$checkworm = str_replace($wormprotector, '*', $cracktrack);

if ($cracktrack != $checkworm)
{
  $cremotead = $_SERVER['REMOTE_ADDR'];
  $cuseragent = $_SERVER['HTTP_USER_AGENT'];

  header("location:$page");
  die();
}
##########################################################
##Função para converter data do banco para o padrão
function FormataDataBanco($dDate){
	$newdate = substr($dDate,8,2)."/".substr($dDate,5,2)."/".substr($dDate,0,4)." ".substr($dDate,11);
	return $newdate;
}
##########################################################
#Função para remover diretorios, aquivos e subdiretorios
function removeDirectory($dir) {
         $abreDir = opendir($dir);

         while (false !== ($file = readdir($abreDir))) {
               if ($file==".." || $file ==".") continue;
               if (is_dir($cFile=($dir."/".$file))) removeDirectory($cFile);
               elseif (is_file($cFile)) unlink($cFile);
         }
         
         closedir($abreDir);
         //rmdir($dir);
}
##########################################################
#Função para gerar um texto limpo para virar URL amigavel
function GerarUrlAmigavel($texto){
    $texto = html_entity_decode($texto);
	$texto = preg_replace("/[aáàãâä]/i","a",$texto);
    $texto = preg_replace("/[eéèêë]/i","e",$texto);
    $texto = preg_replace("/[iíìîï]/i","i",$texto);
    $texto = preg_replace("/[oóòõôö]/i","o",$texto);
    $texto = preg_replace("/[uúùûü]/i","u",$texto);
    $texto = preg_replace("/[ç]/i","c",$texto);
    $texto = preg_replace("/[ñ]/i","n",$texto);
    $texto = preg_replace("/-/i","( )",$texto);
	$texto = preg_replace("/( )/i","-",$texto);
	$texto = preg_replace("/(  )/i","-",$texto);
	$texto = preg_replace("/(   )/i","-",$texto);
    $texto = preg_replace("/[^a-z0-9\-]/i","",$texto);
    $texto = preg_replace("/--/","-",$texto);
	$texto = preg_replace("/--/","-",$texto);
	$texto = preg_replace("/-- /","-",$texto);
	$texto = preg_replace("/--- /","-",$texto);
	$texto = preg_replace("/---- /","-",$texto);
	$texto = preg_replace("/----- /","-",$texto);
    return strtolower($texto);
}
##########################################################
#Função para converter o texto BBCode para visualização
function bbcode($Texto) {
$tags = array(
	//Básicos
	"/(?<!\\\\)\[color(?::\w+)?=(.*?)\](.*?)\[\/color(?::\w+)?\]/si" => "<span style=\"color:\\1;\">\\2</span>",
	'/(?<!\\\\)\[size(?::\w+)?=(.*?)\](.*?)\[\/size(?::\w+)?\]/si'   => "<span style=\"font-size:\\1;\">\\2</span>",
	'/(?<!\\\\)\[b(?::\w+)?\](.*?)\[\/b(?::\w+)?\]/si'               => "<span style=\"font-weight:bold;\">\\1</span>",
	'/(?<!\\\\)\[youtube-videos(?::\w+)?\](.*?)\[\/youtube(?::\w+)?\]/si'   => "<object width=\"660\" height=\"477\"><param name=\"movie\" value=\"http://www.youtube.com/v/\\1?fs=1&amp;hl=pt_BR&amp;rel=0&amp;autoplay=1\"></param><param name=\"allowFullScreen\" value=\"true\"></param><param name=\"allowscriptaccess\" value=\"always\"></param><embed src=\"http://www.youtube.com/v/\\1?fs=1&amp;hl=pt_BR&amp;rel=0&amp;autoplay=1\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"660\" height=\"477\"></embed></object>",
	'/(?<!\\\\)\[youtube(?::\w+)?\](.*?)\[\/youtube(?::\w+)?\]/si'   => "<object width=\"610\" height=\"443\"><param name=\"movie\" value=\"http://www.youtube.com/v/\\1?fs=1&amp;hl=pt_BR&amp;rel=0\"></param><param name=\"allowFullScreen\" value=\"true\"></param><param name=\"allowscriptaccess\" value=\"always\"></param><embed src=\"http://www.youtube.com/v/\\1?fs=1&amp;hl=pt_BR&amp;rel=0\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"610\" height=\"443\"></embed></object>",
	'/(?<!\\\\)\[code(?::\w+)?\](.*?)\[\/code(?::\w+)?\]/si'         => "<span class=\"barra-code\">CÓDIGO</span><code class=\"code\">\\1</code>",
	'/(?<!\\\\)\[i(?::\w+)?\](.*?)\[\/i(?::\w+)?\]/si'               => "<span style=\"font-style:italic;\">\\1</span>",
	'/(?<!\\\\)\[u(?::\w+)?\](.*?)\[\/u(?::\w+)?\]/si'               => "<span style=\"text-decoration: underline;\">\\1</span>",
	'/(?<!\\\\)\[align(?::\w+)?=(.*?)\](.*?)\[\/align(?::\w+)?\]/si' => "<span style=\"display:block;text-align:\\1\">\\2</span>",
	// BBCode [url]
	'/(?<!\\\\)\[url(?::\w+)?\]www\.(.*?)\[\/url(?::\w+)?\]/si'      => "<a href=\"http://www.\\1\">\\1</a>",
	'/(?<!\\\\)\[url(?::\w+)?\](.*?)\[\/url(?::\w+)?\]/si'           => "<a href=\"\\1\">\\1</a>",
	'/(?<!\\\\)\[url(?::\w+)?=(.*?)?\](.*?)\[\/url(?::\w+)?\]/si'    => "<a href=\"\\1\">\\2</a>",
	'/(?<!\\\\)\[url-blank(?::\w+)?=(.*?)?\](.*?)\[\/url(?::\w+)?\]/si' => "<a href=\"\\1\" target=\"blank\">\\2</a>",
	// BBCode Imagem
	'/(?<!\\\\)\[img(?::\w+)?\](.*?)\[\/img(?::\w+)?\]/si'           => "<img src=\"http://\\1\" alt=\"\\1\"  class=\"BordaGrandeImagens EspRight10px EspBotom10PX\" />",
	'/(?<!\\\\)\[img-left(?::\w+)?\](.*?)\[\/img(?::\w+)?\]/si'      => "<img src=\"http://\\1\" alt=\"\\1\" align=\"left\" class=\"BordaGrandeImagens EspRight10px EspBotom10PX ImagemLeft\" />",
	'/(?<!\\\\)\[img-right(?::\w+)?\](.*?)\[\/img(?::\w+)?\]/si'     => "<img src=\"http://\\1\" alt=\"\\1\" align=\"right\" class=\"BordaGrandeImagens EspLeft10px EspBotom10PX ImagemRight\" />",
	// ITENS ADICIONAIS
	'/(?<!\\\\)\[topo]/si'        => "<div style=\"text-align:right; width:630px;\"><img src=\"Img/separador-bbcode.gif\" style=\"padding-bottom:4px;\" width=\"630\" height=\"1\" alt=\"\" border=\"0\" /><br>&raquo; <a href=\"javascript:MoverScroll(0);\">Subir ao topo</a></div>",
	'/(?<!\\\\)\[m-ouro]/si'      => "<img src=\"Img/BBCode/MedalhaDeOuro.gif\" alt=\"Medalha de ouro\" width=\"20\" height=\"20\" class=\"EspBotom5PX EspRight3px\" align=\"absmiddle\">",
	'/(?<!\\\\)\[m-prata]/si'     => "<img src=\"Img/BBCode/MedalhaDePrata.gif\" alt=\"Medalha de prata\" width=\"20\" height=\"20\" class=\"EspBotom5PX EspRight3px\" align=\"absmiddle\">",
	'/(?<!\\\\)\[m-bronze]/si'    => "<img src=\"Img/BBCode/MedalhaDeBronze.gif\" alt=\"Medalha de bronze\" width=\"20\" height=\"20\" class=\"EspBotom5PX EspRight3px\" align=\"absmiddle\">",
	// escaped tags like \[b], \[color], \[url], ...
	'/\\\\(\[\/?\w+(?::\w+)*\])/'                                    => "\\1"
	);
	$Texto = preg_replace(array_keys($tags), array_values($tags), $Texto);
	return nl2br($Texto);
}
##########################################################
#PEGAR IMAGEM DO YOUTUBE
function PegarImagemDoYouTube($Url){
   $Url = explode('v=',$Url);
   $Url = explode('&',$Url[1]);
   $Url = 'http://i1.ytimg.com/vi/'.$Url[0].'/0.jpg'; // 1.jpg para fotos pequenas
   return $Url;
   //Para Usar
   //PegarImagemDoYouTube('URL COMPLETA DO VIDEO');
}
?>