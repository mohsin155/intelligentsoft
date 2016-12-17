@extends('layouts.default')
@section('content')
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <span>Page List</span>
                    <span>
                        <a href="{{url('page/create-page')}}">
                            <button type="button" class="btn btn-primary" style="float:right;">Add Page</button>
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
                                <th>Page Id</th>
                                <th>Page title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($pages)>0)
                            @foreach($pages as $page)
                            <tr>
                                <td>{{$page->page_id}}</td>
                                <td>{{$page->title}}</td>
                                <td><a href="{{url('page/update-page')}}/{{$page->page_id}}" class="glyphicon glyphicon-edit"></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                    <a href="{{url('page/delete')}}/{{$page->page_id}}" class="glyphicon glyphicon-trash"></a></td>
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
