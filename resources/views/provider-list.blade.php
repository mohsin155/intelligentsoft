@extends('layouts.default')
@section('content')
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <span>service Provider List</span>
                    <span>
                        <a href="{{url('users/create-user')}}">
                            <button type="button" class="btn btn-primary" style="float:right;">Add service Provider</button>
                        </a>
                    </span>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                @if(!empty($errors) && count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors as $messages)
                        <li> {{$messages}} </li>
                        @endforeach
                    </ul>
                </div>
                @elseif(session('success'))
                <div class="alert alert-success">
                    <ul>
                        <li> {{session('success')}} </li>
                    </ul>
                </div>
                @endif
                <div class="table-responsive">
                    <table id="list-table" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>User Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($users)>0)
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->user_id}}</td>
                                <td>{{$user->first_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->user_type==3?'Provider':'Client'}}</td>
                                <td>{{$user->status==0?'Inactive':'Active'}}</td>
                                <td><a href="{{url('users/update-user')}}/{{$user->user_id}}" class="glyphicon glyphicon-edit"></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                    <a href="{{url('users/delete')}}/{{$user->user_id}}" class="glyphicon glyphicon-trash"></a></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
