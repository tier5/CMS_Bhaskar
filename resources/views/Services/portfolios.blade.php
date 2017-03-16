@extends('Layouts.master')


@section('content')
    <div class="container">

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Page Heading
                    <small>Secondary Text</small>

                </h1>

                <div class="widget-area no-padding blank">
                          <div class="status-upload">
                             <form method="Post" action="{{route('createprojects')}}"  enctype="multipart/form-data" >
                                    {{csrf_field()}}
                                <input type="text" name="project_title" placeholder="Title" required>

                                <textarea name="project_body" placeholder="Description" ></textarea>

                                <textarea name="project_details" placeholder="Details" ></textarea>
                            
                            <input type="file" name="file_upload">
                            <button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> Share</button>
                               </form>
                               @if(Session::has('Success'))
                                {{Session::get('Success')}}
                                @endif
                                @if(Session::has('Error'))
                                {{Session::get('Error')}}
                                @endif
                               
                               </div>
                            </div>
                
                        </div>
                     </div>
        <!-- /.row -->
        </div>
        <aside class="image-bg-fixed-height"></aside>
    
     <div class="container">

        <div class="row">
            @if(isset($services))
                @foreach($services as $service)
        <!-- Projects Row -->
               
                 <div class="col-md-4 portfolio-item">
                     <a href="{{route('showprojectbyid',['project_id'=> $service->id])}}">
                    <img class="img-responsive" src="{{url('/')}}/image/{{$service->project_image}}" alt="">
                     </a>
                 </div>
        @endforeach
          @endif
            
        </div>
        <!-- /.row -->

       

        <!-- Pagination -->
        <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li>
                        <a href="#">&laquo;</a>
                    </li>
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.row -->

</div>
    <!-- /.container -->


@endsection