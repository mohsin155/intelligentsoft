@extends('layouts.default')
@section('content')
<div id="page-wrapper" style="width:35%;text-align: center;margin-left: 204px;min-height:auto !important;">

    <div class="container-fluid">


        <div class="row">
            <div class="col-lg-12">@if(!empty($errors) && count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors as $messages)
                    <li> {{$messages}} </li>
                    @endforeach
                </ul>
            </div>
            @endif
                <form role="form" method="post" action="{{url('users/login')}}"}}">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-group">
                        <label>Username/Email</label>
                        <input type="text" class="form-control" name="email" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <button type="submit" class="btn btn-default">Log In</button>
                </form>
            </div></div>
    </div></div>

@endsection

