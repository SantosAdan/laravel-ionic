<!-- Status Input -->
<div class="form-group @if($errors->has('status')) has-error @endif">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', $list_status, null, ['class' => 'form-control']) !!}
    @if ($errors->has('status')) <p class="help-block">{{ $errors->first('status') }}</p> @endif
</div>

<!-- Status Input -->
<div class="form-group @if($errors->has('user_deliveryman_id')) has-error @endif">
    {!! Form::label('user_deliveryman_id', 'Entregador:') !!}
    {!! Form::select('user_deliveryman_id', $deliverymen, null, ['class' => 'form-control']) !!}
    @if ($errors->has('user_deliveryman_id')) <p class="help-block">{{ $errors->first('user_deliveryman_id') }}</p> @endif
</div>

<div class="form-group">
    {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
</div>