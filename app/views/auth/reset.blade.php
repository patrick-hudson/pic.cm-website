@extends('layouts.auth')
@section('title', 'Reset Password')

@section('content')
{{ Form::open(array('action' => 'UserController@doForgotPassword', 'class' => 'login-form')) }}
<fieldset>
    <input type="hidden" name="token" value="{{{ $token }}}">
    <div class="form-group">
        <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password">
    </div>
    <div class="form-group">
        <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation">
    </div>
    <button type="submit" class="btn btn-red">
        Reset
    </button>
</fieldset>
{{ Form::close() }}
@stop