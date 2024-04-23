@extends('layouts.print')
@section('content')
<div style="font-weight: bold; width: 100%; text-align: center;">{{ $confrontos->first()->confronto_competicao->nome . ' - ' . $confrontos->first()->confronto_categoria->nome . ' - ' . $confrontos->first()->confronto_categoria->tipo_desc . ' - ' . $confrontos->first()->confronto_categoria->sexo_desc }}</div>
@php
$fase = $confrontos->first()->fase;
$countConfronto = $fase / 2;
$index = 1;
$margins = [32 => 0, 16 => 30, 8 => 90, 4 => 210, 2 => 450, 1 => 0];
@endphp
<div class="m-grid m-grid-demo">
	@foreach ($confrontos as $confronto)
		@if ($countConfronto == $fase / 2)
			<div style="width: 180px; float: left; margin-right: 20px;">
		@endif
				<div class="chave" style="border: solid #000 1px; margin-bottom: 10px; margin-top: {{ ($index == 1 ? $margins[$fase] : ($margins[$fase] * 2) + 10) }}px;">
					<div style="height: 24px; display: grid; font-size: 8px;">
						{{ ($confronto->atleta1 == 0 ? '' : $confronto->atleta1 . ' ' . substr(strtoupper($confronto->primeiro_atleta->nome), 0, 30)) }}
						<br />
						{{ ($confronto->atleta1 == 0 ? '' : strtoupper($confronto->primeiro_atleta->atleta_instituicao->responsavel)) }}
					</div>
					<div style="height: 24px; display: grid; font-size: 8px;">
						{{ ($confronto->atleta2 == 0 ? '' : $confronto->atleta2 . ' ' . substr(strtoupper($confronto->segundo_atleta->nome), 0, 30)) }}
						<br />
						{{ ($confronto->atleta2 == 0 ? '' : strtoupper($confronto->segundo_atleta->atleta_instituicao->responsavel)) }}
					</div>
				</div>
		@php 
			$countConfronto--;
			$index++;
		@endphp
		@if ($countConfronto == 0)
			</div>
			@php 
				$fase = $fase / 2;
				$countConfronto = $fase / 2;
				$index = 1;
			@endphp
		@endif
	@endforeach
</div>
@endsection

@section('page_scripts')

<script>
	$('.chave').each(function (e, v) {
		$('[data-vencedor=' + $(this).data('vencedor') + ']').each(function (el, vl) {
			
		});
	});
</script>

@endsection