@extends('app')

@section('content')
    <div class="container">
        <h3>Clientes</h3>

        <a href="{{ route('admin.clients.create') }}" class="btn btn-xs btn-info">Novo Cliente</a>
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
            @foreach($clients as $client)
            <tr>
                <td>{{ $client->user->id }}</td>
                <td>{{ $client->user->name }}</td>
                <td>
                    <a href="{{ route('admin.clients.edit', $client->id) }}"><i class="glyphicon glyphicon-edit pull-left"></i></a>
                    <a href=""><i class="glyphicon glyphicon-trash pull-right"></i></a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        <div class="col-sm-5 col-sm-offset-5">
            {!! $clients->render() !!}
        </div>
    </div>
@endsection