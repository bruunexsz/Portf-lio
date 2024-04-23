<div class="form-group{{ $errors->has('competicao') ? 'has-error' : ''}}">
    {!! Form::label('competicao', 'Competicao', ['class' => 'control-label']) !!}
    {!! Form::number('competicao', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('competicao', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('categoria') ? 'has-error' : ''}}">
    {!! Form::label('categoria', 'Categoria', ['class' => 'control-label']) !!}
    {!! Form::number('categoria', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('categoria', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('atleta1') ? 'has-error' : ''}}">
    {!! Form::label('atleta1', 'Atleta1', ['class' => 'control-label']) !!}
    {!! Form::number('atleta1', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('atleta1', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('atleta2') ? 'has-error' : ''}}">
    {!! Form::label('atleta2', 'Atleta2', ['class' => 'control-label']) !!}
    {!! Form::number('atleta2', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('atleta2', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('vencedor') ? 'has-error' : ''}}">
    {!! Form::label('vencedor', 'Vencedor', ['class' => 'control-label']) !!}
    {!! Form::number('vencedor', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('vencedor', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('confronto_filho_vencedor') ? 'has-error' : ''}}">
    {!! Form::label('confronto_filho_vencedor', 'Confronto Filho Vencedor', ['class' => 'control-label']) !!}
    {!! Form::number('confronto_filho_vencedor', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('confronto_filho_vencedor', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('confronto_filho_perdedor') ? 'has-error' : ''}}">
    {!! Form::label('confronto_filho_perdedor', 'Confronto Filho Perdedor', ['class' => 'control-label']) !!}
    {!! Form::number('confronto_filho_perdedor', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('confronto_filho_perdedor', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
