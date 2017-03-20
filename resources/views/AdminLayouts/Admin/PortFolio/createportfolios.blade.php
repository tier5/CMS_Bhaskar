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

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        $("#preview").css("display", "block");
    }
    else
    {
        $("#preview").css("display", "none");
    }
}

$("#fileupload").change(function(){
    readURL(this);
});
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





 <div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                               <center> <h3 class="panel-title"><i class="fa fa-book">PORTFOLIO</i> </h3></center>
                            </div>
                            <div class="panel-body">
                                <div class="container">

        <!-- Page Header -->
       
                <div class="row">
                    <div class="col-lg-6">

                             <form role="form" method="Post" action="{{route('storeportfolios')}}"  enctype="multipart/form-data" id="portfolioform" >
                                    {{csrf_field()}}
                                
                            <div class="form-group">
                                <label>Title:</label>
                                <input class="form-control" placeholder="Title" name="project_title" id="project_title" required>
                                
                            </div>

                            <div class="form-group">
                                <label>Description:</label>
                                <textarea class="form-control" placeholder="Description" name="project_description" id="project_description" rows="3" required></textarea>
                            </div>

                            <div class="form-group">
                                <label>Details:</label>
                                <input class="form-control" placeholder="Details1" name="project_detail1" id="project_detail1" required>
                                
                            </div>


                             <div class="form-group">
                                
                                <input class="form-control" placeholder="Details2" name="project_detail2" id="project_detail2">
                                 
                            </div>
                            
                             <div class="form-group">
                                
                                <input class="form-control" placeholder="Details3" name="project_detail3" id="project_detail3">
                                 
                            </div>

                            <div class="form-group">
                                <label>Image:</label>
                                <img src="" height="200px" width="200px" style="display: none" id="preview">
                                <input type="file" name="file_upload" id="fileupload" accept="image/gif,image/jpeg,image/jpg,image/png">
                                
                            </div>

                            <div class="form-group">
                                <label>Link:</label>
                                <input class="form-control" placeholder="Project-Link" name="project_link" id="project_link" required>
                                 
                            </div>



                            <div class="form-group">
                                <label>Category:</label>
                            <select class="form-control" multiple="multiple" name="project_category[]">
                               
                                  @if(isset($tags))
                                    @foreach($tags as $tag)
                                    @if($tag->id!=1)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                                <p class="help-block">****Takes "Default" As Tag If No Category Is Available.</p>
                            </div>
                            

                            <div class="form-group">
                            <button type="submit" class="btn btn-success green" id="Submit"><i class="fa fa-upload"></i>SUBMIT</button>
                            </div>

                            </form>

                               </div>
                            </div>
                
                        </div>


                        <center><span id="success"></span></center>

                        <div id="errors">  
                        
                        @if(count($errors)>0)
                        <div class='alert alert-danger'>
                        @foreach($errors->all() as $error)
                        <strong><center>{{$error}}</center></strong><br>
                        @endforeach
                        </div>
                        @endif

                         @if(Session::has('invalid_file'))
                                  <div class='alert alert-danger'>
                                <center>{{Session::get('invalid_file')}}</center>
                                </div>
                                @endif


                        @if(Session::has('tagerror'))
                                  <div class='alert alert-danger'>
                                <center>{{Session::get('tagerror')}}</center>
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
   

<div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="#" alt="">
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                <p>
                                    <strong>Want these icons in this portfolio item sample?</strong>You can download 60 of them for free, courtesy of <a href="https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc">RoundIcons.com</a>, or you can purchase the 1500 icon set <a href="https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc">here</a>.</p>
                                <ul class="list-inline">
                                    <li>Date: July 2014</li>
                                    <li>Client: Round Icons</li>
                                    <li>Category: Graphic Design</li>
                                </ul>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  



    @endsection