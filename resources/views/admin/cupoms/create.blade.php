@extends('app')

@section('content')
    <div class="container">
        <h3>Novo Cupom de Desconto</h3>

        {!! Form::model(new \CodeDelivery\Models\Cupom(), ['route' => 'admin.cupoms.store']) !!}

            @include('admin.cupoms.partials._form', ['submit_text' => 'Cadastrar'])

        {!! Form::close() !!}
    </div>
@endsection