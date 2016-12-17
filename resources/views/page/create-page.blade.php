@extends('layouts.default')
@section('content')
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    {{isset($page)?'Update page':'Create page'}}
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
                <form role="form" method="post" action="{{isset($page)?url('page/update-page/'.$page->page_id):url('page/create-page')}}">
          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-group">
                        <label>Page title</label>
                        <input class="form-control" type="text" name="title" value="<?php if(Request::old('title')){ echo Request::old('title');}elseif(isset($page)){echo $page->title;}?>">
                    </div>
                  
                   
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"><?php if(Request::old('description')){ echo Request::old('description');}elseif(isset($page)){echo $page->description;}?></textarea>
                    </div>
                                          <hr />
                    <button type="submit" class="btn btn-lg btn-primary" style="float: right;">{{isset($page)?'Update page':'Create page'}}</button>
                </form>
            </div></div>
    </div></div>
@endsection