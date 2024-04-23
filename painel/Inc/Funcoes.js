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
///
function ValidarCamposNulos(cCampo){
	if (cCampo.value.replace(' ','') == ""){
		alert("Por favor, preencha o campo obrigatório!");
		cCampo.focus();
		return false;
	}else{
		return true;
	}
}

///
function PularCampo(fields) {
	if (fields.value.length == fields.maxLength) {
		for (var i = 0; i < fields.form.length; i++) {
			if (fields.form[i] == fields && fields.form[(i + 1)] && fields.form[(i + 1)].type != "hidden") {
			fields.form[(i + 1)].focus();
			break
			}
		}
	}
}
///
function MostrarDivInserirImagem(PastaDeConteudo, PastaDaFerramenta){				
			AlterarConteudo('Ferramentas/'+PastaDaFerramenta+'/InserirImagens.php','DivInserirImagem','CampoPastaDeConteudo=' + PastaDeConteudo + '');
}
///
function MostrarDivInserirAnexoFiliados(PastaDeConteudo, PastaDaFerramenta){				
			AlterarConteudo('Ferramentas/'+PastaDaFerramenta+'/InserirAnexo.php','DivInserirAnexo','CampoPastaDeConteudo=' + PastaDeConteudo + '');
}
///
function MostrarDivTestarVideo(PastaDaFerramenta, UrlDoVideo){				
			AlterarConteudo('Ferramentas/'+PastaDaFerramenta+'/TestarVideo.php','DivTestarVideo','CampoUrlDoVideo=' + encodeURIComponent(UrlDoVideo) + '');
}
///
function MostrarDivInserirArquivo(PastaDeConteudo, PastaDaFerramenta){				
			AlterarConteudo('Ferramentas/'+PastaDaFerramenta+'/InserirArquivos.php','DivInserirArquivo','CampoPastaDeConteudo=' + PastaDeConteudo + '');
}
///
function MostrarDivs(IdDaDiv){
		if( document.getElementById(IdDaDiv).style.display == "none" ) {
			document.getElementById(IdDaDiv).style.display = "block";
		}
		else {
			document.getElementById(IdDaDiv).style.display = "block";
			document.getElementById(IdDaDiv).style.display = "none";
		}	
}
///
function BBCode(InicioCode,FinalCode,TextAreaBBCode) {
var Alvo = document.getElementById(TextAreaBBCode);
	//Internet Explorer
	if (document.selection) {
		var Alvo = document.getElementById(TextAreaBBCode);
		var str = document.selection.createRange().text;
		var range = Alvo.createTextRange();
		Alvo.focus();
		var sel = document.selection.createRange();
		sel.text = InicioCode + str + FinalCode;
		//Alvo.focus();
		//range.move('textedit');
		//range.select();
	}
	//Firefox
	else if (Alvo.selectionStart || Alvo.selectionStart == "0") {
		var startPos = Alvo.selectionStart;
		var endPos = Alvo.selectionEnd;
		var chaine = Alvo.value;
		var str = chaine.substring( Alvo.selectionStart, Alvo.selectionEnd );
		Alvo.value = chaine.substring(0, startPos) + InicioCode + str + FinalCode + chaine.substring(endPos, chaine.length);
		
		//Alvo.selectionStart = startPos + instext.length;
		//Alvo.selectionEnd = endPos + instext.length;
		Alvo.focus();
	} else {
		Alvo.value += instext;
		Alvo.focus();
	}
}
///
function SelecionarImagensBBCode(NomeDaImagem, IdTabela){
			if(document.getElementById("IdTabelaCampoAnterior").value != ''){
				IdTabelaAnterior = document.getElementById("IdTabelaCampoAnterior").value;
				document.getElementById(IdTabelaAnterior).style.borderColor = "#FFFFFF";	
			}
			document.getElementById(IdTabela).style.borderColor = "#CC0000";
			document.getElementById("IdTabelaCampoAnterior").value = IdTabela;			
			document.getElementById("CaminhoDaImagem").value = NomeDaImagem;	
			//document.getElementById("ControleImagemPrincipal").value = NomeDaImagemProduto;	
}
function VisualizarConteudoBBCode(TextoConteudoBBCode, PastaDaFerramenta, DivTitulo, DivConteudo, IDTabelaBorda){	
	//alert(TextoConteudoBBCode);
	document.getElementById(DivTitulo).style.display = 'block';
	document.getElementById(DivConteudo).style.display = 'block';
	document.getElementById(IDTabelaBorda).style.border = '2px solid #990000';
	MoverScroll(getPosicaoElemento(IDTabelaBorda).top - 10);
	AlterarConteudo('Ferramentas/'+PastaDaFerramenta+'/VisualizarConteudoBBCode.php',''+ DivConteudo +'','TextoConteudoBBCode='+encodeURIComponent(TextoConteudoBBCode)+'');	
}
///
function ValidarCamposNulosImagemDestaque(cCampo){
	if (cCampo.value.replace(' ','') == ""){
		alert("Por favor, cadastre alguma imagem como destaque!");		
		return false;
	}else if (cCampo.value.replace(' ','') != "1"){
		alert("Por favor, exclua outras imagens dos destaques, mantenha somente uma!");		
		return false;
	}else{
		return true;
	}
}

function MostrarDivInserirImagemDestaques(PastaDeConteudoDoDestaque){				
			AlterarConteudo('Ferramentas/Destaques/InserirImagens.php','DivInserirImagem','CampoPastaDeConteudoDoDestaque=' + PastaDeConteudoDoDestaque + '');
}

function ValidarControleImagensDestaque(ValorControle){	
	document.getElementById("ControleEnvioFotos").value = ValorControle;		
}

function ValidarControleNomeImagensDestaque(ValorControle){	
	document.getElementById("ControleNomeEnvioFotos").value = ValorControle;		
}
///
function ValidarSenhas(CampoSenha1,CampoSenha2){
		if( ((CampoSenha1.value.length < 5) || (CampoSenha1.value.length > 15)) ||
			((CampoSenha2.value.length < 5) || (CampoSenha2.value.length > 15)) ){
			alert('As senhas devem ter o mínimo de 5 e o máximo de 15 caracteres!');
			CampoSenha2.value='';
			CampoSenha1.select();
			return false;
		}else if(CampoSenha1.value !=  CampoSenha2.value){
					alert('As senhas digitadas são diferentes, por favor redigite-as!');
					CampoSenha2.value='';
					CampoSenha1.select();
					return false;
				}else{
					return true;
		}
}
///
function MostrarDivInserirImagemGalerias(PastaDeConteudoDaGaleria){				
			AlterarConteudo('Ferramentas/GaleriaDeFotos/InserirImagens.php','DivInserirImagem','CampoPastaDeConteudoDaGaleria=' + PastaDeConteudoDaGaleria + '');
}

function ValidarControleImagensGaleria(ValorControle){	
	document.getElementById("ControleEnvioFotos").value = ValorControle;		
}

function ValidarCamposNulosImagemGaleria(cCampo){
	if (cCampo.value.replace(' ','') == ""){
		alert("Por favor, cadastre alguma imagem na galeria!");		
		return false;
	}else{
		return true;
	}
}
//////////////////////////////////////////////////////////////////////////
function ValidarCamposReenviarSenha(cCampo){
	if (cCampo.value.replace(' ','') == ""){
		alert("Para solicitar o reenvio da senha, preencha o campo Email e clique em Reenviar senha!");
		cCampo.focus();
		return false;
	}else{
		return true;
	}
}
///
function ReenviarSenha(){	
	document.getElementById('EmailEsqueciSenha').value = document.getElementById('EmailUsuario').value
	if(confirm('Deseja realmente solicitar o reenvio da senha?')){		
		document.FormReenviarSenha.submit()
	}else{
		return false;	
	}
}
///
//ALTERAR STATUS PÁGINA(AJAX)
///
function AlterarConteudo(Pagina, DivAlterada, Parametro){
	$(DivAlterada).innerHTML = '<font class="TextoComum">Carregando...</font>';
	new Ajax.Updater(DivAlterada, Pagina, {asynchronous:true, method:'post', parameters:Parametro, evalScripts:true});
}
///
function EnviarFormularios(Pagina, DivAlterada, CamposEnviados){
	//alert(CamposEnviados);	
	AlterarConteudo(Pagina, DivAlterada, CamposEnviados);
}
///
function ConfirmacoesEdicaoExclusao(Pagina, DivAlterada, ValorID, ValorNome, Opcao){
	if(confirm('Deseja realmente '+ Opcao + ' ' + ValorNome + '?')){
		AlterarConteudo(Pagina, DivAlterada, ValorID);
		return false;
	}else{
		return false;
	}	
}
///
function ConfirmacaoFecharOrcamento(Pagina, DivAlterada, ValorID){
	if(confirm('Este orçamento foi realmente vendido?')){
		AlterarConteudo(Pagina, DivAlterada, ValorID);
		return false;
	}else{
		return false;
	}	
}
///
function ConfirmacaoEnviarEmail(Pagina, DivAlterada, ValorID){
	if(confirm('Deseja realmente enviar este e-mail?')){
		AlterarConteudo(Pagina, DivAlterada, ValorID);
		return false;
	}else{
		return false;
	}	
}
///
function SelecionarTodosCheckBox(IdFormulario, NomeDosElementos, IdCheckBoxMaster, IdCampoHidden){
	//alert("Funcionou");
	var marcados = ' '; 
	var chk = document.getElementById(IdFormulario);
	for(i=0;i<chk.length;i++){ 
	// Aqui voce checa o nome do elemento e se ele esta checado, 
	
	if(document.getElementById(IdCheckBoxMaster).checked==true){
		marcados += chk.elements[i].value + " "; // se estiver checado pega o valor
		document.getElementById(IdCampoHidden).value = marcados;
		document.getElementById(IdFormulario).elements[i].checked=1
	}else{		
		document.getElementById(IdCampoHidden).value ='';
		document.getElementById(IdFormulario).elements[i].checked=0
	}
	}
}
///
function SelecionarValoresPorCheckBox(IdFormulario, NomeDosElementos, IdCampoHidden){
	//alert("Funcionou");
	var marcados = ' '; 
	var chk = document.getElementById(IdFormulario);
	for(i=0;i<chk.length;i++){ 
	// Aqui voce checa o nome do elemento e se ele esta checado, 
	if(chk.elements[i].name=='' + NomeDosElementos + '[]' && chk.elements[i].checked==true) 
	marcados += chk.elements[i].value + " "; // se estiver checado pega o valor	
	document.getElementById(IdCampoHidden).value = marcados;
	}
}
///
function LimitarTextArea(NomeDoCampo, LimiteDeCaracteres){
	if (NomeDoCampo.value.length > LimiteDeCaracteres){
		NomeDoCampo.value = NomeDoCampo.value.substring(0, LimiteDeCaracteres);
	}
}
///
function ConfirmacaoExclusaoPorCheckBox(Pagina, DivAlterada, ValorID, IdCampoHidden){	
		if(document.getElementById(IdCampoHidden).value != " " && document.getElementById(IdCampoHidden).value != ""){			
			if(confirm('Deseja realmente excluir os itens selecionados ?')){
				AlterarConteudo(Pagina, DivAlterada, ValorID);
				return false;
			}else{
				return false;
			}
		}else{
			alert("Por favor, escolha uma opção acima!");
			return false;
		}	
	}
///
function UtilizarMesmaSenhaEditarUsuarios(){
	document.getElementById('NovaSenhaEditarUsuarios').value = document.getElementById('SenhaEditarUsuarios').value;
	document.getElementById('RedigitacaoNovaSenhaEditarUsuarios').value = document.getElementById('SenhaEditarUsuarios').value;
}
///
function AlterarPaginaComPaginacao(Pagina, NumeroDaPagina, ValorDaBusca){
	AlterarConteudo(Pagina,'DivResultadosInternos','Pagina='+NumeroDaPagina+'&CampoBuscaTituloOrcamento='+ValorDaBusca+'');
}
///
function AvisoCadastroDeEmails(ValorSelecionado){
	if(ValorSelecionado == '0'){
			document.getElementById('DivComNomes').style.display = 'block';
			document.getElementById('SomenteEmails').style.display = 'none';
	}else if(ValorSelecionado == '1'){
			document.getElementById('DivComNomes').style.display = 'none';
			document.getElementById('SomenteEmails').style.display = 'block';
	}else if(ValorSelecionado == ''){
			document.getElementById('DivComNomes').style.display = 'none';
			document.getElementById('SomenteEmails').style.display = 'none';
	}
}
///
///
function getPosicaoElemento(elemID){
    var offsetTrail = document.getElementById(elemID);
    var offsetLeft = 0;
    var offsetTop = 0;
    while (offsetTrail) {
        offsetLeft += offsetTrail.offsetLeft;
        offsetTop += offsetTrail.offsetTop;
        offsetTrail = offsetTrail.offsetParent;
    }
    if (navigator.userAgent.indexOf("Mac") != -1 && 
        typeof document.body.leftMargin != "undefined") {
        offsetLeft += document.body.leftMargin;
        offsetTop += document.body.topMargin;
    }
    return {left:offsetLeft, top:offsetTop};
}
//EXEMPLO
//alert("esquerda:" + getPosicaoElemento("ELEMENTO").left);
//alert("topo:" + getPosicaoElemento("ELEMENTO").top);
///
function MoverScroll(Altura){
	window.scrollTo(0,Altura);
}
function ValidarControleImagensPublicidade(ValorControle){	
	document.getElementById("ControleAnunciante").value = ValorControle;
}
function ValidarCamposNulosImagensPublicidade(cCampo){
	if (cCampo.value.replace(' ','') == ""){
		alert("Por favor, cadastre algum logo para o anúncio!");		
		return false;
	}else if (cCampo.value.replace(' ','') != "1"){
		alert("Por favor, exclua outras imagens, mantenha somente uma!");		
		return false;
	}else{
		return true;
	}
}
///
function PegarValoresSelect(idSelect){ 
	Valor = document.getElementById(idSelect);
	retorno = "";
	for(i = 0; i < Valor.options.length; i++){
			if(Valor.options[i].selected)
					retorno += Valor.options[i].value + " ";
	}
	retorno = retorno.substring(0,retorno.length - 1);
		// return retorno;
		//alert(retorno);
	document.getElementById('ValoresListBox').value = retorno;
}
///
function ValidarCamposNulosUsuariosFiliados(cCampo){
	if (cCampo.value.replace(' ','') == ""){
		alert("Por favor, selecione um usuário!");		
		return false;
	}else{
		return true;
	}
}