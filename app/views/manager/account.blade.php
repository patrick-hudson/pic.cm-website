@extends('layouts.manager')
@section('title', 'Account Settings')
@section('pagetitle', '<h1>Account Settings</h1>')
@section('content')
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bell"></i>
                General Settings
            </div>
            <div class="panel-body">
                <form action="/m/account" method="post" role="form" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-field-username">
                            Username
                        </label>
                        <div class="col-sm-9">
                            <span class="input-icon">
                                <input type="text" id="form-field-username" class="form-control" readonly="readonly" value="{{ Auth::User()->username }}">
                                <i class="fa fa-user"></i> 
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="form-field-email">
                            Email Address
                        </label>
                        <div class="col-sm-9">
                            <span class="input-icon">
                                <input type="text" id="form-field-email" class="form-control" value="{{ Auth::User()->email }}">
                                <i class="fa fa-envelope"></i> 
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop