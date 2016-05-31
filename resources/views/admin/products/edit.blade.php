@extends('app')

@section('content')
    <div class="container">
        <h3> {{ $product->name }} <small><i class="glyphicon glyphicon-chevron-right"></i> Editando Produto</small> </h3>

        {!! Form::model($product, ['method' => 'PUT', 'route' => ['admin.products.update', $product->id]]) !!}

            @include('admin.products.partials._form', ['submit_text' => 'Salvar'])

        {!! Form::close() !!}
    </div>
@endsection