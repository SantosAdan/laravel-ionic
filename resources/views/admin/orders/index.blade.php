@extends('app')

@section('content')
    <div class="container">
        <h3>Pedidos</h3>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Total</th>
                <th>Data</th>
                <th>Itens</th>
                <th>Entregador</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>R$ {{ $order->total }}</td>
                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                <td>
                    <ul>
                    @foreach($order->items as $item)
                        <li>{{ $item->product->name }}</li>
                    @endforeach
                    </ul>
                </td>
                <td>{{ $order->deliveryman->name or '--' }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    <a href="{{ route('admin.orders.edit', $order->id) }}"><i class="glyphicon glyphicon-edit pull-left"></i></a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        <div class="col-sm-5 col-sm-offset-5">
            {!! $orders->render() !!}
        </div>
    </div>
@endsection