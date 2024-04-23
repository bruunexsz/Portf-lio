@extends('layouts.app2')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <form action="{{ route('inscricoes.store', ['competicao' => $competicao->id]) }}" method="POST" class="w-100">
                @csrf

                <div class="form-group">
                    <label for="atleta">Atleta</label>
                    <select name="atleta" id="atleta" class="form-control">
                        @foreach($atletas as $atletaId => $atletaNome)
                        <option value="{{ $atletaId }}">{{ $atletaNome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="equipe">Equipe</label>
                    <select name="equipe" id="equipe" class="form-control">
                        @foreach($equipes as $equipeId => $equipeNome)
                        <option value="{{ $equipeId }}">{{ $equipeNome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group{{ $errors->has('competicao') ? ' has-error' : '' }}">
    <label for="competicao" class="control-label">Competicao</label>
    @if (!isset($competicao))
        <select name="competicao" class="form-control" required>
            @foreach ($competicoes as $competicao)
                <option value="{{ $competicao->id }}">{{ $competicao->nome }}</option>
            @endforeach
        </select>
    @else
        <input type="hidden" name="competicao" value="{{ $competicao->id }}">
    @endif
    {!! $errors->first('competicao', '<p class="help-block">:message</p>') !!}
</div>


                <input type="hidden" name="status" value="1">

                <div class="form-group">
                    <label for="categoria">Categoria (segure o CTRL para selecionar mais de uma categoria)</label>
                    <select name="categoria[]" id="categoria" multiple class="form-control" required>
                        <!-- Opções de categoria serão preenchidas dinamicamente via AJAX -->
                    </select>
                </div>

                <div class="form-group mt-5">
                    <button type="submit" class="btn btn-success btn-lg w-100">Enviar</button>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#atleta, #equipe').change(function() {
                            if ($('#atleta').val() > 0 && $('#equipe').val() > 0) {
                                alert("Você deve selecionar apenas um atleta ou equipe.");
                                $('#atleta').val('');
                                $('#equipe').val('');
                            }
                        });

                        $('#atleta, #competicao, #equipe').change(function() {
                            $('#categoria option').remove();
                            if ($('#atleta').val() || $('#equipe').val()) {
                                $.ajax({
                                    url: '{{ route("inscricoes.busca-categorias") }}',
                                    method: 'POST', // Garanta que seja POST para corresponder à definição da rota
                                    data: $('form').serialize(),
                                    dataType: 'json',
                                    success: function(data) {
                                        $.each(data, function(i, e) {
                                            var tipo = '';
                                            if (e.tipo == 1) {
                                                tipo = 'Kata Básico';
                                            } else if (e.tipo == 2) {
                                                tipo = 'Kata Tokuy';
                                            } else if (e.tipo == 3) {
                                                tipo = 'Kumite';
                                            }
                                            $('#categoria').append('<option value="' + e.id + '">' + e.nome + ' - ' + tipo + '</option>');
                                        });
                                    }
                                });
                            } else {
                                $('#categoria').append('<option value="0">Selecione o atleta</option>');
                            }
                        });
                    });
                </script>


            </form>
        </div>
    </div>
</div>

@endsection