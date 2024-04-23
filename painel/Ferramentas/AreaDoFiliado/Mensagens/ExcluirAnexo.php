<?php
if(file_exists('../../../Inc/Init.php')){ require_once '../../../Inc/Init.php'; }else{ die(''); }
if(file_exists('../../../Inc/Config.php')){ require_once '../../../Inc/Config.php'; }else{ die(''); }
if(file_exists('../../../Inc/Seguranca.php')){ require_once '../../../Inc/Seguranca.php'; }else{ die(''); }
if(file_exists('../../../Inc/Funcoes.php')){ require_once '../../../Inc/Funcoes.php'; }else{ die(''); }

$ConexaoBanco = mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());
mysql_select_db(BANCO, $ConexaoBanco) or die(mysql_error());

	$cSQL = sprintf("SELECT cadastroanexomensagensfiliado.ID,
				cadastroanexomensagensfiliado.NomeDoAnexoDaMensagem,
				cadastroanexomensagensfiliado.PastaDeConteudoDaMensagem
			FROM ".BANCO.".cadastroanexomensagensfiliado
			WHERE cadastroanexomensagensfiliado.ID  = '%d'",
			FiltrarCampos(mysql_real_escape_string(utf8_decode($IdDoArquivo)))
			);			
			$oRS = mysql_query($cSQL) or die (mysql_error());
			$nCount=1;
			while ($row = mysql_fetch_array($oRS)){
				$BuscaMostrarAnexoParaExclusao[$nCount]["ID"                       ] = trim($row[0]);
				$BuscaMostrarAnexoParaExclusao[$nCount]["NomeDoAnexoDaMensagem"    ] = trim($row[1]);				
				$BuscaMostrarAnexoParaExclusao[$nCount]["PastaDeConteudoDaMensagem"] = trim($row[2]);		
			$nCount++;
			}
			mysql_Free_Result($oRS);

	$PastaDoArquivo = CAMINHO_RELATIVO_ANEXOS_MENSAGENS.$CampoPastaDeConteudo;
	$ArquivoASerApagado = CAMINHO_RELATIVO_ANEXOS_MENSAGENS."".$CampoPastaDeConteudo."/".$BuscaMostrarAnexoParaExclusao[1]["NomeDoAnexoDaMensagem"];
	
	#echo $ArquivoASerApagado;
		if(file_exists($ArquivoASerApagado)){
			#echo "PASTA EXISTE";
			#chmod ($PastaDoArquivo, 0777);
			unlink($ArquivoASerApagado);
		}
		$cSQL = sprintf("DELETE FROM ".BANCO.".cadastroanexomensagensfiliado 							
				  WHERE cadastroanexomensagensfiliado.ID = '%d'",
				FiltrarCampos(mysql_real_escape_string(utf8_decode($IdDoArquivo)))
				);

		#echo $cSQL;
		$oRS = mysql_query($cSQL) or die (mysql_error());
					
		#chmod ($PastaDoArquivo, 0755);
		$MsgExclusaoSucesso = utf8_encode("Exclusão realizada com sucesso!");
		echo "<script>alert('".$MsgExclusaoSucesso."');</script>";			
		echo "<script>AlterarConteudo('Ferramentas/AreaDoFiliado/Mensagens/InserirAnexo.php','DivInserirAnexo','CampoPastaDeConteudo=".$CampoPastaDeConteudo."');</script>";
mysql_Close($ConexaoBanco); ?>