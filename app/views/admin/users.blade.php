@extends('layouts.user')
@section('title', 'User List')
@section('pagetitle', '<h1>User List</h1>')
@section('content')
@if(Session::has('error'))
<div class="alert alert-danger">
    <b>{{ Session::get('error') }}</b><br />
</div>
@endif
@if(Session::has('notice'))
<div class="alert alert-info">
    <b>{{ Session::get('notice') }}</b><br />
</div>
@endif
<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered table-hover">
            <tr>
                <th>User Name</th>
                <th>Email</th>
                <th>Date Registered</th>
                <th style="width: 128px;"></th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td class="text-center">
                    <div class="btn-group btn-group-sm">
                        <a href="/user/admin/user_edit?userid={{ $user->id }}" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                        <a href="/user/admin/user?userid={{ $user->id }}" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></a>
                        <a href="/user/admin/user_edit?userid={{ $user->id }}&action=suspend" class="btn btn-danger"><i class="glyphicon glyphicon-ban-circle"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $users->links() }}
    </div>
</div>
@stop