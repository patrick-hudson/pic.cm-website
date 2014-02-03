@extends('layouts.auth')
@section('title', 'Forgot Password')

@section('content')
{{ Form::open(array('action' => 'UserController@doForgotPassword', 'class' => 'login-form')) }}
<fieldset>
    <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Email Address">
    </div>
    <button type="submit" class="btn btn-red">
        Send Reset
    </button>
    <div class="login-links">
        <ul>
            <li>Already have an account? <a href="{{ action('UserController@login') }}">Sign in</a></li>
        </ul>
    </div>
</fieldset>
{{ Form::close() }}
@stop