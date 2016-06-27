<!-- Categoria Input -->
<div class="form-group @if($errors->has('category_id')) has-error @endif">
    {!! Form::label('category_id', 'Categoria:') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
    @if ($errors->has('category_id')) <p class="help-block">{{ $errors->first('category_id') }}</p> @endif
</div>

<!-- Name Input -->
<div class="form-group @if($errors->has('name')) has-error @endif">
    {!! Form::label('name', 'Nome:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>

<!-- Price Input -->
<div class="form-group @if($errors->has('price')) has-error @endif">
    {!! Form::label('price', 'Preço:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
    @if ($errors->has('price')) <p class="help-block">{{ $errors->first('price') }}</p> @endif
</div>

<!-- Description Input -->
<div class="form-group @if($errors->has('description')) has-error @endif">
    {!! Form::label('description', 'Descrição:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
</div>

<div class="form-group">
    {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
</div>