<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }					
#recebendo a url da imagem
$filename = $_GET["Imagem"];

#Cabeçalho que ira definir a saida da pagina
header('Content-type: image/jpeg');

#pegando as dimensoes reais da imagem, largura e altura
list($width, $height) = getimagesize($filename);

	$new_width = 106;
	$new_height = 86;

#setando a largura da miniatura

#setando a altura da miniatura


#gerando a a miniatura da imagem
$image_p = imagecreatetruecolor($new_width, $new_height);
$image = imagecreatefromjpeg($filename);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

#o 3º argumento é a qualidade da miniatura de 0 a 100
imagejpeg($image_p, null, 70);									
imagedestroy($image_p);
?>