<?php
if(file_exists('../../Inc/Init.php')){ require_once '../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../Inc/Config.php')){ require_once '../../Inc/Config.php'; }else{ die(''); }
#if(file_exists('../../Inc/Seguranca.php')){ require_once '../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../Inc/Funcoes.php')){ require_once '../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

#NO AR
$PastaACriar = CAMINHO_RELATIVO_IMAGENS_GALERIA_DE_FOTOS."/".$PastaDeConteudoDaGaleria."/";

function HandleError($message) {
	header("HTTP/1.1 500 Internal Server Error");
	echo $message;
	chmod ($PastaACriar, 0755);
}

#VERIFICA SE A PASTA EXISTE
if(file_exists($PastaACriar)){ 
	#echo "PASTA EXISTE";
	chmod ($PastaACriar, 0777);
}else{
	if($Controle != ""){
		if(mkdir($PastaACriar, 1777)){	
			chmod ($PastaACriar, 0777);
		}else{
			HandleError("Arquivo não foi salvo");
		}
	}else{
	exit(0);
	}
}

// Code for Session Cookie workaround
	if (isset($_POST["PHPSESSID"])) {
		session_id($_POST["PHPSESSID"]);
	} else if (isset($_GET["PHPSESSID"])) {
		session_id($_GET["PHPSESSID"]);
	}

$POST_MAX_SIZE = ini_get('post_max_size');
$unit = strtoupper(substr($POST_MAX_SIZE, -1));
$multiplier = ($unit == 'M' ? 1048576 : ($unit == 'K' ? 1024 : ($unit == 'G' ? 1073741824 : 1)));

if ((int)$_SERVER['CONTENT_LENGTH'] > $multiplier*(int)$POST_MAX_SIZE && $POST_MAX_SIZE) {
	header("HTTP/1.1 500 Internal Server Error"); // This will trigger an uploadError event in SWFUpload
	echo "Envio maior que a capacidade permitida";
	exit(0);
}

// Settings
	$save_path = $PastaACriar; // The path were we will save the file (getcwd() may not be reliable and should be tested in your environment)
	$upload_name = "Filedata";
	$max_file_size_in_bytes = 2147483647; // 2GB in bytes
	$extension_whitelist = array("jpg");	// Allowed file extensions
	$valid_chars_regex = '.A-Z0-9_ !@#$%^&()+={}\[\]\',~`-'; // Characters allowed in the file name (in a Regular Expression format)
	
// Other variables	
	$MAX_FILENAME_LENGTH = 260;
	$file_name = "";
	$file_extension = "";
	$uploadErrors = array(
        0=>"Arquivo enviado com sucesso",
        1=>"Envio maior que a capacidade permitida",
        2=>"Envio maior que a capacidade permitida",
        3=>"Arquivo parcialmente enviado",
        4=>"Arqvuivo não enviado",
        6=>"Desculpe, mas aconteceu um erro"
	);
			
// Validate the upload
	if (!isset($_FILES[$upload_name])) {
		HandleError("Arquivo não encontrado em \$_FILES for " . $upload_name);
		exit(0);
	} else if (isset($_FILES[$upload_name]["error"]) && $_FILES[$upload_name]["error"] != 0) {
		HandleError($uploadErrors[$_FILES[$upload_name]["error"]]);
		exit(0);
	} else if (!isset($_FILES[$upload_name]["tmp_name"]) || !@is_uploaded_file($_FILES[$upload_name]["tmp_name"])) {
		HandleError("Desculpe, mas aconteceu um erro");
		exit(0);
	} else if (!isset($_FILES[$upload_name]['name'])) {
		HandleError("Desculpe, mas aconteceu um erro");
		exit(0);
	}
	
// Validate the file size (Warning: the largest files supported by this code is 2GB)
	$file_size = @filesize($_FILES[$upload_name]["tmp_name"]);
	if (!$file_size || $file_size > $max_file_size_in_bytes) {
		HandleError("Envio maior que a capacidade permitida");
		exit(0);
	}
	
	if ($file_size <= 0) {
		HandleError("Desculpe, mas aconteceu um erro");
		exit(0);
	}


// Validate file name (for our purposes we'll just remove invalid characters)
	$file_name = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', "", basename($_FILES[$upload_name]['name']));
	if (strlen($file_name) == 0 || strlen($file_name) > $MAX_FILENAME_LENGTH) {
		HandleError("Nome de arquivo inválido");
		exit(0);
	}

// Validate that we won't over-write an existing file
	if (file_exists($save_path . $file_name)) {
		HandleError("Nome de arquivo existente");
		exit(0);
	}

// Validate file extension
	$path_info = pathinfo($_FILES[$upload_name]['name']);
	$file_extension = $path_info["extension"];
	$is_valid_extension = false;
	foreach ($extension_whitelist as $extension) {
		if (strcasecmp($file_extension, $extension) == 0) {
			$is_valid_extension = true;
			break;
		}
	}
	if (!$is_valid_extension) {
		HandleError("Extensão inválida");
		exit(0);
	}

	if (!@move_uploaded_file($_FILES[$upload_name]["tmp_name"], $save_path.$file_name)) {
		HandleError("Arquivo não foi salvo");
		exit(0);
	}
	$SqlInserirImagens = sprintf("INSERT INTO cadastroimagensgalerias(
							ID,
							DataDeCadastroDaImagem,
							ImagemConteudoDaGaleria,
							PastaDeConteudoDaGaleria,
							LegendaImagemGaleria
							)
							VALUES(
							'',									
							'".strftime("%Y-%m-%d %H:%M:%S")."',
							'%s',
							'%s',
							''
							)",
	FiltrarCampos(mysql_real_escape_string(utf8_decode($file_name))),
	FiltrarCampos(mysql_real_escape_string(utf8_decode($PastaDeConteudoDaGaleria)))
	);
	$ResultadoInserirImagens = mysql_query($SqlInserirImagens) or die (mysql_error());			
	chmod ($PastaACriar, 0755);						
	exit(0);
mysql_Close($ConexaoBanco);	?>