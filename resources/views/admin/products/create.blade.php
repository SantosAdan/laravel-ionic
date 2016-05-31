@extends('app')

@section('content')
    <div class="container">
        <h3>Novo Produto</h3>

        {!! Form::model(new \CodeDelivery\Models\Product(), ['route' => 'admin.products.store']) !!}

            @include('admin.products.partials._form', ['submit_text' => 'Cadastrar'])

        {!! Form::close() !!}
    </div>
@endsection