@extends('layouts.auth')
@section('title', 'Login')

@section('content')
<h3>Sign in to your account</h3>

<form class="form-login" action="{{ action('UserController@login') }}" method="post">
    <input type="hidden" name="action" value="login">
    <div class="errorHandler alert alert-danger no-display">
        <i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
    </div>
    <fieldset>
        <div class="form-group">
            <span class="input-icon">
                <input type="text" class="form-control" name="username" placeholder="Username">
                <i class="fa fa-user"></i> 
            </span>
        </div>
        <div class="form-group form-actions">
            <span class="input-icon">
                <input type="password" class="form-control password" name="password" placeholder="Password">
                <i class="fa fa-lock"></i>
            </span>
        </div>
        <div class="form-actions">
            <label for="remember" class="checkbox-inline">
                <input type="checkbox" class="grey remember" id="remember" name="remember"> Keep me signed in
            </label>
            <button type="submit" class="btn btn-bricky pull-right">
                Sign in <i class="fa fa-arrow-circle-right"></i>
            </button>
        </div>
        
        <div class="new-account">
            <ul>
                <li>Don't have an account yet? <a href="{{ action('UserController@create') }}">Create an account</a></li>
                <li>Forgot your password? <a href="{{ action('UserController@forgotPassword') }}">Reclaim it here</a></li>
            </ul>
        </div>
    </fieldset>
</form>
@stop

@section('scripts')
<script>
    jQuery(document).ready(function() {
        Main.init();
        Login.init();
    });
</script>
@stop