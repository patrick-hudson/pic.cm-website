@extends('layouts.user')
@section('title', 'Edit user')
@section('pagetitle', '<h1>Edit User <small>'.$user->username.'</small></h1>')

@section('content')
<div class="container">
    {{ Form::open(array('url' => '/user/admin/user_edit?userid='.$user->id, 'class' => 'form-horizontal')) }}
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="clip-cog"></i>
                    General Settings
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            Username
                        </label>
                        <div class="col-sm-9">
                            <span class="input-icon">
                                {{ Form::text('username', $user->username, array('class' => 'form-control')) }}
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
                                {{ Form::email('email', $user->email, array('class' => 'form-control')) }}
                                <i class="fa fa-envelope"></i> 
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Email Confirmed</label>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <label>{{ Form::checkbox('confirmed', 'emailConfirmed', $user->confirmed, array('class' => 'green', ($user->confirmed ? 'checked' : ''))) }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="clip-cog"></i>
                    Permissions
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            Primary Group
                        </label>
                        <div class="col-sm-9">
                            <select name="roles" id="roles" class="form-control">
                                @foreach($roles as $role)
                                <option value="{{ $role['id'] }}" {{ ($role['assigned'] ? 'selected' : '') }}>{{ $role['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3 pull-right">
            <div class="form-group"><div class="col-sm-12">{{ Form::button('Update', array('class' => 'btn btn-success pull-right', 'type' => 'submit')) }}</div></div>
        </div>
    </div>
    {{ Form::close() }}
</div>
@stop

@section('scripts')

@stop