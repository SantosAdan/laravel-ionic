@extends('app')

@section('content')
    <div class="container">
        <h3>Novo Cliente</h3>

        {!! Form::model(new \CodeDelivery\Models\Client(), ['route' => 'admin.clients.store']) !!}

            @include('admin.clients.partials._form', ['submit_text' => 'Cadastrar'])

        {!! Form::close() !!}
    </div>
@endsection