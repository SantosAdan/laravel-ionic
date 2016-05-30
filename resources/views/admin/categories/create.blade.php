@extends('app')

@section('content')
    <div class="container">
        <h3>Nova Categoria</h3>

        {!! Form::model(new \CodeDelivery\Models\Category(), ['route' => 'admin.categories.store']) !!}

            <!-- Name Input -->
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>
@endsection