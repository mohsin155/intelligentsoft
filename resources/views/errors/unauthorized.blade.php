@extends('layouts.default')
@section('content')
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <span>Unauthorized</span>
                    
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                @if(!empty($errors))
                <div class="alert alert-danger">
                    <ul>
                        <li> {{$errors}} </li>
                    </ul>
                </div>
                @endif
                
            </div>
        </div>
    </div>
</div>

@endsection
