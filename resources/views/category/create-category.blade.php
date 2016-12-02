@extends('layouts.default')
@section('content')
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Create Category
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
                <form role="form" method="post" action="">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    @if(!empty(old('category_title')))
                    @foreach(old('category_title') as $category)
                    <div class="form-group">
                        <label>Category Title</label>
                        <span  class="cat-input">
                        <input class="form-control cat-input" type="text" name="category_title[]" value="{{$category}}" style="margin-bottom: 10px;">
                        <a href="javascript:void(0);" class="delete"><i class="glyphicon glyphicon-trash"></i></a>
                        </span>
                    </div>
                    @endforeach
                    @else
                    <div class="form-group ">
                        <label>Category Title</label>
                        <span  class="cat-input" style="display:inline;">
                        <input class="form-control" type="text" name="category_title[]" value="{{old('category_title')}}" style="margin-bottom: 10px;">
                        <a href="javascript:void(0);" class="delete"><i class="glyphicon glyphicon-trash" ></i></a>
                        </span>
                    </div>
                    @endif
                    <div><a href="javascript:void(0);" id="add-more">Add More</a></div>
                    <hr />
                    <button type="submit" class="btn btn-lg btn-primary" style="float: right;">Create Category</button>
                </form>
            </div></div>
    </div></div>
<script>
$(function(){
    $("#add-more").click(function(){
       $(".cat-input:last").clone().insertAfter($(".cat-input").last());
       $(".cat-input:last").find('input').val(''); 
    });
    $("body").on('click','.delete',function(){
       if($('.cat-input').length>1){
        $(this).parent('.cat-input').remove(); 
       }
    });
});
</script>
@endsection