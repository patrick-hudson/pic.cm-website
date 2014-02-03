@extends('layouts.auth')
@section('title', 'Login')

@section('content')
{{ Form::open(array('action' => 'UserController@doLogin', 'class' => 'login-form')) }}
<fieldset>
    <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="Username">
    </div>
    <div class="form-group">
        <input type="password" class="form-control password" name="password" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-red">Login</button>
    <div class="login-links">
        <ul>
            <li>Don't have an account yet? <a href="{{ action('UserController@create') }}">Sign up</a></li>
            <li>Forgot your password? <a href="{{ action('UserController@forgotPassword') }}">Recover it</a></li>
        </ul>
    </div>
</fieldset>
{{ Form::close() }}
@stop