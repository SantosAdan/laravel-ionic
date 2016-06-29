@extends('app')

@section('content')
    <div class="container">
        <h3>Meus Pedidos</h3>

        <a href="{{ route('customer.order.create') }}" class="btn btn-xs btn-info">Novo Pedido</a>
        <br/><br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>R$ {{ $order->total }}</td>
                <td>{{ $order->status }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>

        <div class="col-sm-5 col-sm-offset-5">
            {!! $orders->render() !!}
        </div>
    </div>
@endsection