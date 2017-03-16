@extends('AdminLayouts.master')

    @section('content')
   <script>
       
       $(document).ready(function(){
       $('#project_title').focus();


$("#portfolioform").submit(function(event){
 
  //disable the default form submission
  event.preventDefault();
 
  //grab all form data  
  var formData = new FormData($(this)[0]);
 
  $.ajax({
    url: "{{route('storeportfolios')}}",
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
            success: function () {

                $('#success').html('Portfolio Added Successfully').fadeOut(5000);
                $("#Submit").prop("disabled", false);

            },
            error: function () {

                $('#success').html('Portfolio Not Added').fadeOut(5000);
                $("#Submit").prop("disabled", false);

            }
        });

    });


$('#file_upload').change(function(){
var allowedTypes = ["jpg", "jpeg", "gif", "png"];

var path = $('#file_upload').val();
alert(path);
var ext = path.substring(path.lastIndexOf('.') + 1).toLowerCase();

if ($.inArray(ext, allowedTypes) < 0) {

$('#file_type').html('File Extension Should Be .gif .png .jpg .jpeg').fadeOut(5000);
}
});

   });

   </script> 

 <div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Pie Chart Example with Tooltips</h3>
                            </div>
                            <div class="panel-body">
                                <div class="container">

        <!-- Page Header -->
       
                <div class="row">
                    <div class="col-lg-6">

                             <form role="form" method="Post" action="{{route('storeportfolios')}}"  enctype="multipart/form-data" id="portfolioform" >
                                    {{csrf_field()}}
                                
                            <div class="form-group">
                                <label>Project Title:</label>
                                <input class="form-control" placeholder="Project-Title" name="project_title" id="project_title" required>
                                
                            </div>

                            <div class="form-group">
                                <label>Project Description:</label>
                                <textarea class="form-control" placeholder="Project-Description" name="project_description" id="project_description" rows="3" required></textarea>
                            </div>

                            <div class="form-group">
                                <label>Project Details1:</label>
                                <input class="form-control" placeholder="Project-Details1" name="project_detail1" id="project_detail1" required>
                                
                            </div>


                             <div class="form-group">
                                <label>Project Details2:</label>
                                <input class="form-control" placeholder="Project-Details2" name="project_detail2" id="project_detail2">
                                 
                            </div>
                            
                             <div class="form-group">
                                <label>Project Details3:</label>
                                <input class="form-control" placeholder="Project-Details3" name="project_detail3" id="project_detail3">
                                 
                            </div>

                            <div class="form-group">
                                <label>File input</label>
                                <input type="file" name="file_upload">
                                <span id="file_type"></span>
                            </div>

                            <div class="form-group">
                                <label>Project Link:</label>
                                <input class="form-control" placeholder="Project-Link" name="project_link" id="project_link" required>
                                 
                            </div>


                            <div class="form-group">
                                <label>Project Category:</label>
                                <input class="form-control" placeholder="Project-Category" name="project_category" id="project_category" required>
                                
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