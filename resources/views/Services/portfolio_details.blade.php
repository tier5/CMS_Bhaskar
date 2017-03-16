  
@extends('Layouts.master')


@section('content')
 

  <!-- Page Content -->
    <div class="container">

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Portfolio Item
                    <small>Item Subheading</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-8">
                <img class="img-responsive" src="{{url('/')}}/image/{{$project_id->project_image}}" alt="">
            </div>

            <div class="col-md-4">
                <h3>Project Description</h3>
                <p>{{$project_id->project_desc}}</p>
                <h3>Project Details</h3>
               <p>
                    {{$project_id->project_details}}
               <p>           
                </div>

        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">

            <div class="col-lg-12">
                <h3 class="page-header">Related Projects</h3>
            </div>
           
            @if(isset($related_projects))
            @foreach($related_projects as $related_project)
            <div class="col-sm-3 col-xs-6">
                <a href="{{route('showprojectbyid',['project_id'=> $related_project->id])}}">
                    <img class="img-responsive portfolio-item" src="{{url('/')}}/image/{{$related_project->project_image}}" alt="">
                </a>
            </div>
           
            @endforeach
           @endif
            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

        </div>
        <!-- /.row -->




        <hr>

















    </div>
    <!-- /.container -->
@endsection