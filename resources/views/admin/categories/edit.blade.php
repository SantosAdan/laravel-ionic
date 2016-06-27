@extends('app')

@section('content')
    <div class="container">
        <h3> {{ $category->name }} <small><i class="glyphicon glyphicon-chevron-right"></i> Editando Categoria</small> </h3>

        {!! Form::model($category, ['method' => 'PUT', 'route' => ['admin.categories.update', $category->id]]) !!}

            @include('admin.categories.partials._form', ['submit_text' => 'Salvar'])

        {!! Form::close() !!}
    </div>
@endsection