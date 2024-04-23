/* **********************
   Event Handlers
   These are my custom event handlers to make my
   web application behave the way I went when SWFUpload
   completes different tasks.  These aren't part of the SWFUpload
   package.  They are part of my application.  Without these none
   of the actions SWFUpload makes will show up in my application.
   ********************** */
/*
===========================================================
Alterado em 2009 por Mídia Clean - Soluções para internet
http://www.midiaclean.com.br
===========================================================
*/
function fileQueued(file) {
	try {
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setStatus("Aguardando...");
		progress.toggleCancel(true, this);

	} catch (ex) {
		this.debug(ex);
	}

}

function fileQueueError(file, errorCode, message) {
	try {
		if (errorCode === SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED) {
			alert("Por favor envie somente" + (message === 0 ? "Limite de transferencia alcançado" : " " + (message > 1 ? "" + message + " arquivos por vez." : "um arquivo por vez.")));
			return;
		}

		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setError();
		progress.toggleCancel(false);

		switch (errorCode) {
		case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
			progress.setStatus("Arquivo muito grande.");
			this.debug("Arquivo muito grande: " + file.name + ", Tamanho: " + file.size + ", Mensagem: " + message);
			break;
		case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
			progress.setStatus("Desculpe, mas arquivo muito pequeno");
			this.debug("Arquivo muito pequeno: " + file.name + ", Tamanho: " + file.size + ", Mensagem: " + message);
			break;
		case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
			progress.setStatus("Tipo de arquivo inválido.");
			this.debug("Tipo de arquivo incorreto: " + file.name + ", Tamanho: " + file.size + ", Mensagem: " + message);
			break;
		default:
			if (file !== null) {
				progress.setStatus("Erro");
			}
			this.debug("Erro: " + errorCode + ", Tamanho: " + file.name + ", Tamanho: " + file.size + ", Mensagem: " + message);
			break;
		}
	} catch (ex) {
        this.debug(ex);
    }
}

function fileDialogComplete(numFilesSelected, numFilesQueued) {
	try {
		if (numFilesSelected > 0) {
			document.getElementById(this.customSettings.cancelButtonId).disabled = false;
		}
		
		/* I want auto start the upload and I can do that here */
		this.startUpload();
	} catch (ex)  {
        this.debug(ex);
	}
}

function uploadStart(file) {
	try {
		/* I don't want to do any file validation or anything,  I'll just update the UI and
		return true to indicate that the upload should start.
		It's important to update the UI here because in Linux no uploadProgress events are called. The best
		we can do is say we are uploading.
		 */
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setStatus("Enviando...");
		progress.toggleCancel(true, this);
	}
	catch (ex) {}
	
	return true;
}

function uploadProgress(file, bytesLoaded, bytesTotal) {
	try {
		var percent = Math.ceil((bytesLoaded / bytesTotal) * 100);

		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setProgress(percent);
		progress.setStatus("Enviando...");
	} catch (ex) {
		this.debug(ex);
	}
}

function uploadSuccess(file, serverData) {
	try {
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setComplete();
		progress.setStatus("Arquivo enviado com sucesso!");
		progress.toggleCancel(false);

	} catch (ex) {
		this.debug(ex);
	}
}

function uploadError(file, errorCode, message) {
	try {
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setError();
		progress.toggleCancel(false);

		switch (errorCode) {
		case SWFUpload.UPLOAD_ERROR.HTTP_ERROR:
			//progress.setStatus("Erro ao enviar o arquivo: " + message);
			progress.setStatus("Desculpe mas por algum motivo aconteceu um erro, por favor, tente novamente.");
			//this.debug("Erro ao enviar o arquivo: " + file.name + ", Mensagem: " + message);
			this.debug("Desculpe mas por algum motivo aconteceu um erro, por favor, tente novamente.");
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_FAILED:
			//progress.setStatus("O envio falhou.");
			progress.setStatus("Desculpe mas por algum motivo aconteceu um erro, por favor, tente novamente.");
			//this.debug("Envio de arquvo falhou: " + file.name + ", Tamanho: " + file.size + ", Mensagem: " + message);
			this.debug("Desculpe mas por algum motivo aconteceu um erro, por favor, tente novamente.");
			break;
		case SWFUpload.UPLOAD_ERROR.IO_ERROR:
			progress.setStatus("Erro de entrada no servidor");
			//this.debug("Erro de entrada no servidor: " + file.name + ", Mensagem: " + message);
			this.debug("Desculpe mas por algum motivo aconteceu um erro, por favor, tente novamente.");
			break;
		case SWFUpload.UPLOAD_ERROR.SECURITY_ERROR:
			progress.setStatus("Erro de segurança");
			//this.debug("Erro: " + file.name + ", Mensagem: " + message);
			this.debug("Desculpe mas por algum motivo aconteceu um erro, por favor, tente novamente.");
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
			progress.setStatus("Limite de arquivos enviados excedidos.");
			//this.debug("Limite de arquivos enviados excedidos: " + file.name + ", Tamanho: " + file.size + ", Mensagem: " + message);
			this.debug("Desculpe mas por algum motivo aconteceu um erro, por favor, tente novamente.");
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_VALIDATION_FAILED:
			progress.setStatus("Falha de validação, envio cancelado.");
			//this.debug("Falha de validação, envio cancelado: " + file.name + ", Tamanho: " + file.size + ", Mensagem: " + message);
			this.debug("Desculpe mas por algum motivo aconteceu um erro, por favor, tente novamente.");
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
			// If there aren't any files left (they were all cancelled) disable the cancel button
			if (this.getStats().files_queued === 0) {
				document.getElementById(this.customSettings.cancelButtonId).disabled = true;
			}
			progress.setStatus("Cancelado");
			progress.setCancelled();
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
			progress.setStatus("Parado");
			break;
		default:
			progress.setStatus("Erro: " + errorCode);
			//this.debug("Erro: " + errorCode + ", Arquivo: " + file.name + ", Tamanho: " + file.size + ", Mensagem: " + message);
			this.debug("Desculpe mas por algum motivo aconteceu um erro, por favor, tente novamente.");
			break;
		}
	} catch (ex) {
        this.debug(ex);
    }
}

function uploadComplete(file) {
	if (this.getStats().files_queued === 0) {
		document.getElementById(this.customSettings.cancelButtonId).disabled = true;
	}
}

// This event comes from the Queue Plugin
function queueComplete(numFilesUploaded) {
	var status = document.getElementById("divStatus");
	//status.innerHTML = numFilesUploaded + " arquivo" + (numFilesUploaded === 1 ? "" : "s") + " enviado"+ (numFilesUploaded === 1 ? "" : "s");
}
///////
//Desabilitando bugs do browser
/*
function handleError(){ 
	return true; 
}
window.onerror = handleError; 
*/