@extends('layouts.auth')
@section('title', 'Forgot Password')

@section('content')
<h3>Forgot password</h3>
<p>Please enter your accounts email address.</p>

{{ Form::open(array('action' => 'UserController@doForgotPassword', 'class' => 'form-login')) }}
    <div class="errorHandler alert alert-danger no-display">
        <i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
    </div>
    <fieldset>
        <div class="form-group">
            <span class="input-icon">
                <input type="email" class="form-control" name="email" placeholder="Email Address">
                <i class="fa fa-envelope"></i> 
            </span>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-bricky pull-right">
                Reset Password <i class="fa fa-arrow-circle-right"></i>
            </button>
        </div>
        <div class="new-account">
            Don't have an account yet?
            <a href="{{ action('UserController@create') }}">
                Create an account
            </a>
        </div>
    </fieldset>
{{ Form::close() }}
@stop