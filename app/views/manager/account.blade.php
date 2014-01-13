@extends('layouts.manager')
@section('title', 'Account Settings')
@section('pagetitle', '<h1>Account Settings</h1>')
@section('content')
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="clip-cog"></i>
                General Settings
            </div>
            <div class="panel-body">
                {{ Form::open(array('url' => '/m/account', 'class' => 'form-horizontal')) }}
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        Username
                    </label>
                    <div class="col-sm-9">
                        <span class="input-icon">
                            {{ Form::text('username', Auth::User()->username, array('class' => 'form-control', 'readonly' => 'readonly')) }}
                            <i class="fa fa-user"></i> 
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">
                        Email Address
                    </label>
                    <div class="col-sm-9">
                        <span class="input-icon">
                            {{ Form::email('email', Auth::User()->email, array('class' => 'form-control')) }}
                            <i class="fa fa-envelope"></i> 
                        </span>
                    </div>
                </div>
                <div class="form-group"><div class="col-sm-12">{{ Form::button('Update', array('class' => 'btn btn-success pull-right')) }}</div></div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="clip-key"></i>
                Password
            </div>
            <div class="panel-body">
                {{ Form::open(array('url' => '/m/account', 'class' => 'form-horizontal')) }}
                <div class="form-group"><div class="col-md-12">{{ Form::password('newpass', array('class' => 'form-control', 'placeholder' => 'New Password')) }}</div></div>
                <div class="form-group"><div class="col-sm-12">{{ Form::password('confirmpass', array('class' => 'form-control', 'placeholder' => 'Confirm Password')) }}</div></div>
                <div class="form-group"><div class="col-sm-12">{{ Form::password('currentpass', array('class' => 'form-control', 'placeholder' => 'Current Password')) }}</div></div>
                <div class="form-group"><div class="col-sm-12">{{ Form::button('Change', array('class' => 'btn btn-success pull-right')) }}</div></div>
                {{ Form::hidden('action', 'general') }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="clip-arrow-up-3"></i>
                Client Settings
            </div>
            <div class="panel-body">
                @if($apikey = Api::getUserApiKey())
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            Upload Key
                        </label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                {{ Form::text('uploadkey', $apikey, array('class' => 'form-control', 'readonly' => 'readonly')) }}
                                <a class="btn input-group-addon"><i class="clip-refresh"></i></a>
                            </div>
                            <span class="help-block"><i class="fa fa-info-circle"></i> This is a unique key used to upload your images.</span>
                        </div>
                    </div>
                </div>
                @else
                <div class="alert alert-warning text-center">
                    <p><strong>You don't have an upload key</strong><br /> <a href="/m/api/key_generate">Create</a> your upload key to get started!</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@stop