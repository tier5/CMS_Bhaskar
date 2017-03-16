<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<script   src="https://code.jquery.com/jquery-3.1.1.js"   integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="   crossorigin="anonymous"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    

</head>

<body>

    <div id="wrapper">

@include('AdminLayouts.nav')

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            @if(Route::current()->getName()=="Admin_home")
                            Home
                            @elseif(Route::current()->getName()=="createportfolios")
                            Portfolio
                            @elseif(Route::current()->getName()=="showportfoliotable")
                            Portfolio
                            @elseif(Route::current()->getName()=="createtags")
                            Tag
                            @elseif(Route::current()->getName()=="showtagtable")
                            Tag
                             @elseif(Route::current()->getName()=="showtagtable")
                            Tag
                            @elseif(Route::current()->getName()=="updateportfolios")
                            Portfolio
                            @else
                            Blank
                            @endif
                          
                            <small>@if(Route::current()->getName()=="Admin_home")
                            Visitors
                            @elseif(Route::current()->getName()=="showportfoliotable")
                            View Table
                            @elseif(Route::current()->getName()=="showtagtable")
                            View Table
                            @else
                            @endif</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"> @if(Route::current()->getName()=="Admin_home")
                            {{Route::current()->getName()}}
                            @elseif(Route::current()->getName()=="createportfolios")
                             {{Route::current()->getName()}}
                            @elseif(Route::current()->getName()=="showportfoliotable")
                             {{Route::current()->getName()}}
                            @elseif(Route::current()->getName()=="createtags")
                             {{Route::current()->getName()}}
                            @elseif(Route::current()->getName()=="showtagtable")
                             {{Route::current()->getName()}}
                            @else
                             {{Route::current()->getName()}}
                            @endif</i> 
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


    <!-- jQuery -->
    <script src="/js/jquery.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
