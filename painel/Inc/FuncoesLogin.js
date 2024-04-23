/////
function ValidarEmail(cEmail){
	var str=cEmail.value
	var cFiltro=/^.+@.+\..{1,3}$/
	if ((!cFiltro.test(str)) && (cEmail.value.replace(' ','') != "")){
		alert("Por favor, insira um e-mail válido!")
		cEmail.focus();
		return false;
	}else{
		return true;
	}
}
/////
function ValidarCamposNulos(cCampo){
	if (cCampo.value.replace(' ','') == ""){
		alert("Por favor, preencha o campo obrigatório!");
		cCampo.focus();
		return false;
	}else{
		return true;
	}
}
/////
function ValidarCamposReenviarSenha(cCampo){
	if (cCampo.value.replace(' ','') == ""){
		alert("Para solicitar o reenvio da senha, preencha o campo E-mail e clique em Reenviar senha!");
		cCampo.focus();
		return false;
	}else{
		return true;
	}
}
/////
function ReenviarSenha(){	
	document.getElementById('EmailEsqueciSenha').value = document.getElementById('EmailUsuario').value
	if(confirm('Deseja realmente solicitar o reenvio da senha?')){		
		document.FormReenviarSenha.submit()
	}else{
		return false;	
	}
}
/////
function LoadImagens(Images, Caminho) {
	var i = 0;
	var imageArray = new Array();
	imageArray = Images.split(',');
	var imageObj = new Image();
	for(i=0; i<=imageArray.length-1; i++) {
		//document.write('<img src="' + Caminho + '/' + imageArray[i] + '" />');// Write to page (uncomment to check images)
		imageObj.src=Caminho + '' + Images[i];
	}
}
/////