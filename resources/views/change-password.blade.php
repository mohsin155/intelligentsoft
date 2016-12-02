@extends('layouts.default')
@section('content')
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Change password
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8">
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
                <form role="form" method="post" action="{{url('users/change-password').'/'.Auth::user()->user_id}}">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-group">
                        <label>Old Password</label>
                        <input class="form-control" type="password" name="old_password" value="">
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input class="form-control" type="password" name="password" value="">
                    </div>
                    <div class="form-group">
                        <label>Confirm password</label>
                        <input class="form-control" type="password" name="password_confirmation" value="">
                    </div>
                    <button type="submit" class="btn btn-default">Update Password</button>
                </form>
            </div></div>
    </div></div>
@endsection