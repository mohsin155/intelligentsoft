@extends('layouts.default')
@section('content')
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <span>Category List</span>
                    <span>
                        <a href="{{url('category/create-category')}}">
                            <button type="button" class="btn btn-primary" style="float:right;">Add Category</button>
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
                                <th>Category Id</th>
                                <th>Category title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($categories)>0)
                            @foreach($categories as $category)
                            <tr>
                                <td>{{$category->category_id}}</td>
                                <td>{{$category->category_title}}</td>
                                <td><a href="#" class="glyphicon glyphicon-edit"></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                    <a href="#" class="glyphicon glyphicon-trash"></a></td>
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
