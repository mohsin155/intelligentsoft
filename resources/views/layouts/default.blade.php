<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>INTELLIGENT PROJECT</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{url('css/sb-admin.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{url('css/plugins/morris.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{url('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    
    <link href="{{url('css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="{{url('js/jquery.js')}}"></script>
    <style>
        #page-wrapper{
            min-height: 600px;
        }
        .table-responsive {
            overflow-x: visible;
        }
    </style>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        @if(!Auth::guest())
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('users/dashboard')}}"><img style="max-width:100px; margin-top: -7px;" src="{{url('logo.png')}}" /></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{Auth::user()->first_name}} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{url('users/update-user')}}/{{Auth::user()->user_id}}"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="{{url('users/change-password')}}/{{Auth::user()->user_id}}"><i class="fa fa-fw fa-user"></i>Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{url('users/logout')}}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            @include('layouts.sidebar')
            <!-- /.navbar-collapse -->
        </nav>
        @endif
        @yield('content')
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    
    <script src="{{url('js/jquery.dataTables.min.js')}}"></script>
    <script>
$(document).ready(function(){
    $('#list-table').DataTable();
});
</script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('js/bootstrap.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{url('js/plugins/morris/raphael.min.js')}}"></script>
    <script src="{{url('js/plugins/morris/morris.min.js')}}"></script>
    <script src="{{url('js/plugins/morris/morris-data.js')}}"></script>

</body>

</html>
