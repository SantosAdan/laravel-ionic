@extends('app')

@section('content')
    <div class="container">
        <h3> Cupom  <span class="label label-primary">{{ $cupom->code }}</span> <small><i class="glyphicon glyphicon-chevron-right"></i> Editando Cupom de desconto</small> </h3>

        {!! Form::model($cupom, ['method' => 'PUT', 'route' => ['admin.cupoms.update', $cupom->id]]) !!}

            @include('admin.cupoms.partials._form', ['submit_text' => 'Salvar'])

        {!! Form::close() !!}
    </div>
@endsection