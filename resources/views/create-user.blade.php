@extends('layouts.default')
@section('content')
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    {{isset($user)?'Update user':'Create user'}}
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
                <form role="form" method="post" action="{{isset($user)?url('users/update-user').'/'.Auth::user()->user_id:url('users/create-user')}}">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-group">
                        <label>First name</label>
                        <input class="form-control" type="text" name="first_name" value="<?php if(Request::old('first_name')){ echo Request::old('first_name');}elseif(isset($user)){echo $user->first_name;}?>">
                    </div>
                    <div class="form-group">
                        <label>Last name</label>
                        <input class="form-control" type="text" name="last_name" value="<?php if(Request::old('last_name')){ echo Request::old('last_name');}elseif(isset($user)){echo $user->last_name;}?>">
                    </div>
                    <div class="form-group">
                        <label>User name</label>
                        <input class="form-control" type="text" name="user_name" value="<?php if(Request::old('user_name')){ echo Request::old('user_name');}elseif(isset($user)){echo $user->user_name;}?>">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" value="<?php if(Request::old('email')){ echo Request::old('email');}elseif(isset($user)){echo $user->email;}?>">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" name="address"><?php if(Request::old('address')){ echo Request::old('address');}elseif(isset($user)){echo $user->address;}?></textarea>
                    </div>
                        <input type="hidden" value="2" name="user_type" />
                    <div class="form-group">
                        <label>New Password</label>
                        <input class="form-control" type="password" name="password" value="" />
                    </div>
                    <div class="form-group">
                        <label>Status : </label><br />
                        <?php $status =''; if(Request::old('status')){ $status= Request::old('status');}elseif(isset($user)){$status= $user->status;}?>
                        <select name="status">
                            <option value="">--Select status--</option>
                            
                            <option value="0" {{$status==0?"selected":''}}>Inactive</option>
                            <option value="1" {{$status==1?"selected":''}}>Active</option>
                        </select>
                    </div>
                    <hr />
                    <button type="submit" class="btn btn-lg btn-primary" style="float: right;">{{isset($user)?'Update user':'Create user'}}</button>
                </form>
            </div></div>
    </div></div>
@endsection