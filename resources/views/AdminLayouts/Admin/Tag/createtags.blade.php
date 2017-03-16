@extends('AdminLayouts.master')

    @section('content')
   <script>
       
       $(document).ready(function(){
       $('#project_title').focus();



 if("{{Session::has('success')}}"){
 $('#success').html("{{Session::get('success')}}").fadeOut(5000);
 }
 if("{{Session::has('error')}}"){
 $('#success').html("{{Session::get('error')}}").fadeOut(5000);
 }


   });



   </script> 

   <style>
.form-control {
    display: block;
    height: 34px;
    width: 75% !important;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}

   </style>

 <div class="row" id="formsection">
                    <div class="col-lg-4">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-tags"></i> TAGS</h3>
                            </div>
                            <div class="panel-body">
                                <div class="container">

        <!-- Page Header -->
       
                                      <div class="row">
                                     <div class="col-lg-6" >

                             <form method="POST" action="{{route('storetags')}}">
                             {{csrf_field()}}
                                
                            <div class="form-group">
                                <label>Title:</label>
                                <input class="form-control" placeholder="Tag-Title" name="name" id="tag_name" required>
                                
                            </div>

                         
                            <div class="form-group">
                            <button type="submit" class="btn btn-warning yellow" id="Submit"><i class="fa fa-upload"></i>SUBMIT</button>
                            </div>

                          
                            </form>
                               </div>
                            </div>
                
                        </div>


                        <center><span id="success"></span></center>

                        <div id="errors">  
                        @if(count($errors)>0)
                        <div class='alert alert-danger'>
                        <ul>
                        @foreach($errors->all() as $error)
                        <li><strong><center>{{$error}}</center></strong></li>
                        @endforeach
                        </ul>
                        </div>
                        @endif
                        </div>
                      
                             <div class="text-right">
                            <a href="#portfolioModal1">View Details <i class="fa fa-arrow-circle-right"></i></a>
                            </div>

                     </div>
        <!-- /.row -->


                </div>
                                
                
            </div>
        </div>
   @endsection