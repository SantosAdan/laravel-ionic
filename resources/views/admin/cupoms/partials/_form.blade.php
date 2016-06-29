<!-- Code Input -->
<div class="form-group @if($errors->has('code')) has-error @endif">
    {!! Form::label('code', 'Código:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
    @if ($errors->has('code')) <p class="help-block">{{ $errors->first('code') }}</p> @endif
</div>

<!-- Value Input -->
<div class="form-group @if($errors->has('value')) has-error @endif">
    {!! Form::label('value', 'Valor:') !!}
    {!! Form::text('value', null, ['class' => 'form-control']) !!}
    @if ($errors->has('value')) <p class="help-block">{{ $errors->first('value') }}</p> @endif
</div>

<div class="form-group">
    {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
</div>