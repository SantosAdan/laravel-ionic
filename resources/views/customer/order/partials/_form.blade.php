<!-- Total Input -->
<div class="form-group">
    {!! Form::label('total', 'Total:') !!}
    <p id="total"></p>
    <a href="#" id="btnNewItem" class="btn btn-xs btn-primary"> <i class="glyphicon glyphicon-plus"></i> Novo Item</a><br><br>

    <table class="table table-bordered">
        <thead>
            <th>Produto</th>
            <th>Quantidade</th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <select class="form-control" name="items[0][product_id]">
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} --- R$ {{ $product->price}}</option>
                        @endforeach
                    </select>
                </td>
                <td>{!! Form::number('items[0][qtd]', 1, ['class' => 'form-control']) !!}</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="form-group">
    {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
</div>