@extends('layouts.auth')
@section('title', 'Register')

@section('content')
{{ Form::open(array('action' => 'UserController@doCreate', 'class' => 'login-form')) }}
<fieldset>
    <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="Username">
    </div>
    <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Email">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="password_confirmation" placeholder="Password Again">
    </div>
    <button type="submit" class="btn btn-red">
        Register
    </button>
    <div class="login-links">
        <ul>
            <li>
                Already have an account? <a href="{{ action('UserController@login') }}">Sign in</a>
            </li>
        </ul>
    </div>
</fieldset>
{{ Form::close() }}
@stop