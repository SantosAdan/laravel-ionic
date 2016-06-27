<!-- Name Input -->
<div class="form-group @if($errors->has('name')) has-error @endif">
    {!! Form::label('name', 'Nome:') !!}
    {!! Form::text('user[name]', null, ['class' => 'form-control']) !!}
    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
</div>

<!-- Email Input -->
<div class="form-group @if($errors->has('email')) has-error @endif">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('user[email]', null, ['class' => 'form-control']) !!}
    @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
</div>

<!-- Phone Input -->
<div class="form-group @if($errors->has('phone')) has-error @endif">
    {!! Form::label('phone', 'Telefone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
    @if ($errors->has('phone')) <p class="help-block">{{ $errors->first('phone') }}</p> @endif
</div>

<!-- Address Input -->
<div class="form-group @if($errors->has('address')) has-error @endif">
    {!! Form::label('address', 'Endereço:') !!}
    {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
    @if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
</div>

<!-- City Input -->
<div class="form-group @if($errors->has('city')) has-error @endif">
    {!! Form::label('city', 'Cidade:') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
    @if ($errors->has('city')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
</div>

<!-- State Input -->
<div class="form-group @if($errors->has('state')) has-error @endif">
    {!! Form::label('state', 'Estado:') !!}
    {!! Form::text('state', null, ['class' => 'form-control']) !!}
    @if ($errors->has('state')) <p class="help-block">{{ $errors->first('state') }}</p> @endif
</div>

<!-- Zipcode Input -->
<div class="form-group @if($errors->has('zipcode')) has-error @endif">
    {!! Form::label('zipcode', 'CEP:') !!}
    {!! Form::text('zipcode', null, ['class' => 'form-control']) !!}
    @if ($errors->has('zipcode')) <p class="help-block">{{ $errors->first('zipcode') }}</p> @endif
</div>

<div class="form-group">
    {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
</div>