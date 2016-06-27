@extends('app')

@section('content')
    <div class="container">
        <h3> {{ $client->user->name }} <small><i class="glyphicon glyphicon-chevron-right"></i> Editando Cliente</small> </h3>

        {!! Form::model($client, ['method' => 'PUT', 'route' => ['admin.clients.update', $client->id]]) !!}

            @include('admin.clients.partials._form', ['submit_text' => 'Salvar'])

        {!! Form::close() !!}
    </div>
@endsection