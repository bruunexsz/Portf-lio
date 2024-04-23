<?php
	session_start();
	$_SESSION["DadosParaSessao"] = null;
	session_destroy();
	session_regenerate_id();
	header("Location: index.php");
	header("Content-Length: 0");
	exit(0);
?>