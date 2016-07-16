@extends('app')

@section('content')
    <div class="container">
        <h3>Novo Pedido</h3>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container">
        {!! Form::open(['route' => 'customer.order.store', 'class' => 'form-horizontal']) !!}

            @include('customer.order.partials._form', ['submit_text' => 'Cadastrar'])

        {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('post-script')
<script>
    $(document).ready(function() {
        calculateTotal();
    });

    $('#btnNewItem').click(function() {
        var row =$('table tbody > tr:last');
        var newRow = row.clone();
        var length = $('table tbody tr').length;

        newRow.find('td').each(function() {
            var td = $(this);
            var input = td.find('input, select');
            var name = input.attr('name');

            input.attr('name', name.replace( (length -1) + "", length + "" ));
        });

        newRow.find('input').val(1);
        newRow.insertAfter(row);

        calculateTotal();
    });

    $(document.body).on('click', 'select', function() {
        calculateTotal();
    });

    $(document.body).on('blur', 'input[name*=qtd]', function() {
        calculateTotal();
    });

    // Calculate order total
    function calculateTotal() {
        var total = 0;
        var trLen =$('table tbody tr').length;
        var tr = null, price, qtd;

        for(var i = 0; i < trLen; i++) {
            tr = $('table tbody tr').eq(i);
            price = tr.find(':selected').data('price');
            qtd = tr.find('input').val();

            total += price * qtd;
        }

        $('#total').text('R$ ' + total.toFixed(2));
    }
</script>
@endsection