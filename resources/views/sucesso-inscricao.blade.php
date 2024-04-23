@extends('layouts.app2')


@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@else
    <?php header("Location: /"); exit; ?>
@endif

@endsection