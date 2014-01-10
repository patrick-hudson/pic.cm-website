@extends('layouts.auth')
@section('title', 'Register')

@section('content')
<h3>Sign Up</h3>
<p>Enter your account details below:</p>
<form class="form-register" action="/m/register" method="post">
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
                <input type="password" class="form-control" name="password_again" placeholder="Password Again">
                <i class="fa fa-lock"></i> 
            </span>
        </div>
        <div class="form-group">
            <div>
                <label for="agree" class="checkbox-inline">
                    <input type="checkbox" class="grey agree" id="agree" name="agree">I agree to the Terms of Service
                </label>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-bricky pull-right">
                Submit <i class="fa fa-arrow-circle-right"></i>
            </button>
        </div>
    </fieldset>
</form
@stop