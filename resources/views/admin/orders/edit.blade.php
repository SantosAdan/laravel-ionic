@extends('app')

@section('content')
    <div class="container">
        <h2>
            Pedido #{{ $order->id }} - R$ {{ $order->total }}
            <small><i class="glyphicon glyphicon-chevron-right"></i> Editando</small>
        </h2>
        <h3>Cliente: {{ $order->client->user->name }}</h3>
        <h4>Pedido feito em: {{ $order->created_at->format('d/m/Y') }} às {{ $order->created_at->format('H:m:s') }}</h4>

        <p>
            <b>Entregar em: </b>{{ $order->client->address }} - {{ $order->client->city }}, {{ $order->client->state }}
        </p>
        <br>

        {!! Form::model($order, ['method' => 'PUT', 'route' => ['admin.orders.update', $order->id]]) !!}
            @include('admin.orders.partials._form', ['submit_text' => 'Salvar'])
        {!! Form::close() !!}

    </div>
@endsection