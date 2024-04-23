<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

if($CampoUrlDoVideo != ''){

$UrlDoVideo = explode('v=',$CampoUrlDoVideo);

if (!isset($UrlDoVideo[1])) $UrlDoVideo[1] = '';
$UrlDoVideo = explode('&',$UrlDoVideo[1]);
$CodigoVideo = $UrlDoVideo[0];

echo '<object width="660" height="443"><param name="movie" value="http://www.youtube.com/v/'.$CodigoVideo.'?fs=1&amp;hl=pt_BR&amp;rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$CodigoVideo.'?fs=1&amp;hl=pt_BR&amp;rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="660" height="443"></embed></object>';

} ?>