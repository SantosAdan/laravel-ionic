@extends('app')

@section('content')
    <div class="container">
        <h3>Produtos</h3>

        <a href="{{ route('admin.products.create') }}" class="btn btn-xs btn-info">Novo Produto</a>
        <br/><br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Categoria</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>R$ {{ $product->price }}</td>
                <td>{{ $product->category->name }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product->id) }}"><i class="glyphicon glyphicon-edit pull-left"></i></a>
                    <a href="{{ route('admin.products.destroy', $product->id) }}"><i class="glyphicon glyphicon-trash pull-right"></i></a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        <div class="col-sm-5 col-sm-offset-5">
            {!! $products->render() !!}
        </div>
    </div>
@endsection