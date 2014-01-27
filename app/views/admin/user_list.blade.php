@extends('layouts.user')
@section('title', 'User List')
@section('pagetitle', '<h1>User List</h1>')
@section('content')
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
                        <a href="{{ action('AdminController@editUser', array('userid' => $user->id)) }}" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                        <a href="{{ action('AdminController@listUserImages', array('userid' => $user->id)) }}" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></a>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $users->links() }}
    </div>
</div>
@stop

@section('breadcrumb')
<li class="search-box">
    <form class="sidebar-search" action="{{ action('AdminController@listUsers') }}" method="post">
        <div class="form-group">
            {{ Form::text('username', Input::get('username'), array('placeholder' => 'Search Usernames')) }}
            <button class="submit">
                <i class="clip-search-3"></i>
            </button>
        </div>
    </form>
</li>
@stop