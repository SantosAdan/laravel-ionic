@extends('app')

@section('content')
    <div class="container">
        <h3>Categorias</h3>

        <a href="{{ route('admin.categories.create') }}" class="btn btn-xs btn-info">Nova Categoria</a>
        <br/><br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href=""><i class="glyphicon glyphicon-edit pull-left"></i></a>
                    <a href=""><i class="glyphicon glyphicon-trash pull-right"></i></a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        <div class="col-sm-5 col-sm-offset-5">
            {!! $categories->render() !!}
        </div>
    </div>
@endsection