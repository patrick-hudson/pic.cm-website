@extends('layouts.auth')
@section('title', 'Reset Password')

@section('content')
<h3>Reset Password</h3>
<p>Please enter your new password.</p>

{{ Form::open(array('action' => 'UserController@doForgotPassword', 'class' => 'form-login')) }}
<div class="errorHandler alert alert-danger no-display">
    <i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
</div>
<fieldset>
    <input type="hidden" name="token" value="{{{ $token }}}">
    <div class="form-group">
        <span class="input-icon">
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password">
            <i class="fa fa-lock"></i> 
        </span>
    </div>
    <div class="form-group">
        <span class="input-icon">
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation">
            <i class="fa fa-key"></i> 
        </span>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-bricky pull-right">
            Reset Password <i class="fa fa-arrow-circle-right"></i>
        </button>
    </div>
</fieldset>
{{ Form::close() }}
@stop