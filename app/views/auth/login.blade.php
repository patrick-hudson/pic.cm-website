@extends('layouts.auth')
@section('title', 'Register')

@section('content')
<h3>Sign in to your account</h3>
<p>Please enter your name and password to log in.</p>
<form class="form-login" action="/m/login" method="post">
    <input type="hidden" name="action" value="login">
    <div class="errorHandler alert alert-danger no-display">
        <i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
    </div>
    @if(Session::has('message'))
    <div class="alert alert-info">
        <b>{{ Session::get('message') }}</b>
    </div>
    @endif
    <fieldset>
        <div class="form-group">
            <span class="input-icon">
                <input type="email" class="form-control" name="email" placeholder="Email">
                <i class="fa fa-user"></i> </span>
            <!-- To mark the incorrectly filled input, you must add the class "error" to the input -->
            <!-- example: <input type="text" class="login error" name="login" value="Username" /> -->
        </div>
        <div class="form-group form-actions">
            <span class="input-icon">
                <input type="password" class="form-control password" name="password" placeholder="Password">
                <i class="fa fa-lock"></i>
                <a href="/m/forgot">
                    I forgot my password
                </a></span>
        </div>
        <div class="form-actions">
            <label for="remember" class="checkbox-inline">
                <input type="checkbox" class="grey remember" id="remember" name="remember">
                Keep me signed in
            </label>
            <button type="submit" class="btn btn-bricky pull-right">
                Login <i class="fa fa-arrow-circle-right"></i>
            </button>
        </div>
        <div class="new-account">
            Don't have an account yet?
            <a href="/m/register">
                Create an account
            </a>
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