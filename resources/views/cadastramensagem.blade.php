@extends('layouts.app4')

@section('content')
<div class="col-10 d-flex justify-content-start align-items-center mb-5">
    <a class="btnVoltar" href="/publica-mensagem"><i class="fas fa-arrow-circle-left"></i> VOLTAR</a>
</div>
<div class="col-12 d-flex justify-content-center align-items-center">
    <h2>Cadastro de Mensagens</h2>
</div>
<div class="col-12 d-flex justify-content-center align-items-center">
    <div class="alert alert-info" role="alert">
        Preencha o formulário abaixo para <strong>Cadastrar</strong> novas <strong>Mensagens</strong> para os Filiados no Sistema.
    </div>
</div>

<div class="col-12 mt-5 mb-5 p-5" style="background-color: white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('cadastrar-mensagem') }}">
        @csrf
        <div class="row mb-3">
            <div class="col-md-12 mb-5">
                <label for="TituloDaMensagem" class="form-label">Título da Mensagem</label>
                <input placeholder="Insira o Título da Mensagem" type="text" class="form-control" id="TituloDaMensagem" name="TituloDaMensagem">
            </div>
            <hr>
            <div class="col-md-12">
                <!-- Place the first <script> tag in your HTML's <head> -->
                <script src="https://cdn.tiny.cloud/1/k6gnzdpxcexp4ud7lhhog4vc143t2xml03gtshd5ke11iifa/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

                <script>
                    tinymce.init({
                        selector: 'textarea',
                        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
                        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                        tinycomments_mode: 'embedded',
                        tinycomments_author: 'Author name',
                        mergetags_list: [{
                                value: 'First.Name',
                                title: 'First Name'
                            },
                            {
                                value: 'Email',
                                title: 'Email'
                            },
                        ],
                        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
                    });
                </script>
                <textarea name="TextoConteudoDaMensagem">
  Insira uma mensagem para filiados aqui.
</textarea>
            </div>

        </div>


        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-lg btn-primary w-100"><i class="fas fa-save"></i> Salvar</button>
            </div>
        </div>
    </form>
</div>


@endsection