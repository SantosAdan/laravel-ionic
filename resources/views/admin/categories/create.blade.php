@extends('app')

@section('content')
    <div class="container">
        <h3>Nova Categoria</h3>

        {!! Form::model(new \CodeDelivery\Models\Category(), ['route' => 'admin.categories.store']) !!}

            @include('admin.categories.partials._form', ['submit_text' => 'Cadastrar'])

        {!! Form::close() !!}
    </div>
@endsection