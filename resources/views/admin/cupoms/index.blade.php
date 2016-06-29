@extends('app')

@section('content')
    <div class="container">
        <h3>Cupoms de Desconto</h3>

        <a href="{{ route('admin.cupoms.create') }}" class="btn btn-xs btn-info">Novo Cupom</a>
        <br/><br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Valor</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cupoms as $cupom)
            <tr>
                <td>{{ $cupom->id }}</td>
                <td>{{ $cupom->code }}</td>
                <td>{{ $cupom->value }}</td>
                <td>
                    <a href="{{ route('admin.cupoms.edit', $cupom->id) }}"><i class="glyphicon glyphicon-edit pull-left"></i></a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        <div class="col-sm-5 col-sm-offset-5">
            {!! $cupoms->render() !!}
        </div>
    </div>
@endsection