@extends('layouts.auth')
@section('title', 'Register')

@section('content')
<h3>Sign Up</h3>
<p>Enter your account details below:</p>
<form class="form-register" action="/user/create" method="post">
    <fieldset>
        <div class="form-group">
            <span class="input-icon">
                <input type="text" class="form-control" name="username" placeholder="Username">
                <i class="fa fa-user"></i> 
            </span>
        </div>
        <div class="form-group">
            <span class="input-icon">
                <input type="email" class="form-control" name="email" placeholder="Email">
                <i class="fa fa-envelope"></i>
            </span>
        </div>
        <div class="form-group">
            <span class="input-icon">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <i class="fa fa-lock"></i> 
            </span>
        </div>
        <div class="form-group">
            <span class="input-icon">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Password Again">
                <i class="fa fa-lock"></i> 
            </span>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-bricky pull-right">
                Register <i class="fa fa-arrow-circle-right"></i>
            </button>
        </div>
        <div class="new-account">
            Already have an account?
            <a href="{{ action('UserController@login') }}">
                Sign in
            </a>
        </div>
    </fieldset>
</form>
@stop