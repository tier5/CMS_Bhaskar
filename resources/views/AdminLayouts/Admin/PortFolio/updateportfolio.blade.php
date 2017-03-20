@extends('AdminLayouts.master')

    @section('content')
<script>
       
$(document).ready(function(){
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#previewHolder').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
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
                    		@if(isset($id))
                    			
                             <form role="form" method="Post" action="{{route('saveupdateportfolios')}}"  enctype="multipart/form-data" id="portfolioform" >
                                    {{csrf_field()}}
                                
                            <div class="form-group">
                                <label>Title:</label>
                                <input class="form-control" placeholder="Title" name="project_title" id="project_title" value="{{$id->project_title}}" required>
                                
                            </div>

                            <div class="form-group">
                                <label>Description:</label>
                                <textarea class="form-control" placeholder="Description" name="project_description" id="project_description" rows="3" required>{{$id->project_desc}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Details:</label>
                                <input class="form-control" placeholder="Details1" name="project_detail1" id="project_detail1" value="{{$id->project_details1}}" required>
                                
                            </div>


                             <div class="form-group">
                                
                                <input class="form-control" placeholder="Details2" name="project_detail2" id="project_detail2" value="{{$id->project_details2}}">
                                 
                            </div>
                            
                             <div class="form-group">
                                
                                <input class="form-control" placeholder="Details3" name="project_detail3" id="project_detail3" value="{{$id->project_details3}}">
                                 
                            </div>

                            <div class="form-group">
                                <span id="image">
                               <img id="previewHolder" src="{{url('/')}}/image/portfolio/fullsize/{{$id->project_image}}" name="preview" alt="Uploaded Image Preview Holder" width="250px" height="250px"/><br>
                                <label>Image:</label>
                                <input type="file" name="file_upload" id="fileupload" accept="image/gif,image/jpeg,image/jpg,image/png">
                                </span>
                            </div>

                            


                            <div class="form-group">
                                <label>Category</label>
                            <select class="form-control" multiple="multiple" name="project_category[]">
                                  @if(isset($id))
                                  @if(isset($selected))
                                  @if(isset($notselected))
                                        @foreach($selected as $select)
                                        @if($select->id!=1)
                                     <option value="{{$select->id}}" selected>{{$select->name}}</option>
                                        @endif
                                     @endforeach
                                     @foreach($notselected as $notselect)
                                     @if($notselect->id!=1)
                                     <option value="{{$notselect->id}}" >{{$notselect->name}}</option>
                                     @endif
                                     @endforeach
                                    @endif
                                    @endif
                                    @endif
                                </select>
                            </div>
                           
                            	<input type="hidden" value="{{encrypt($id->id)}}" name="project_id">
                            <div class="form-group">
                            <button type="submit" class="btn btn-success green" id="Submit"><i class="fa fa-upload"></i>SUBMIT</button>
                            </div>

                            </form>
                            	
                             @endif
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

    
    @endsection
