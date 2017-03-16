 @extends('AdminLayouts.master')

    @section('content')


<script>

    
function startmodal(id)
{
    if(id){
            $.ajax({
                    type:'post',
                    url:'{{route("viewportfolioadmin")}}',
                    data:{id:id, _token:"{{Session::token()}}" },
    
            success:function(response)
                {
                    //alert(response);
                     var data = response;
    
    var parsed = JSON.parse(data);



    $('#portfolioModalHeading').html(parsed.project_title);
    $('#portfolioModalImage').attr('src',"{{url('/')}}/image/"+parsed.project_image);
    $('#portfolioModalDescription').html(parsed.project_title);
    $('#portfolioModalLink').attr('href',parsed.project_link);
    $('#portfolioModalLink').html(parsed.project_link);

    if(parsed.project_details1)
    {$('#portfolioDetails1').html(parsed.project_details1);}
    else
    {$("#portfolioDetails1").css("display", "none");}

    if(parsed.project_details2)
    {$('#portfolioDetails2').html(parsed.project_details2);}
    else
    {$("#portfolioDetails2").css("display", "none");}
    if(parsed.project_details3)
    {$('#portfolioDetails3').html(parsed.project_details3);}
    else
    {$("#portfolioDetails3").css("display", "none");}
    $('#portfolioModalDate').html(parsed.created_at);
    $('#portfolioModalCategory').html(parsed.project_category);
    $('#portfolioModal').modal('toggle');
        
                }   
    
        });}
    else
    {
        alert('error');
    }

}

function deleteportfolio(id)
{
var answer = confirm ("Are you sure you want to delete ?");
var project_id=id;
 
 if(project_id){       
 if (answer)
 {
     $.ajax({
 
         type:"post",
         url:"{{route('deleteportfolios')}}",
         data:{id:project_id, _token:"{{Session::token()}}" },
        
        success:function(response)
                {
                 $('#table').load(window.location + ' #table');  
                  $('#success').html('Deleted Sucessfully').fadeOut(5000);  
                },
        error:function()
                {
                    $('#success').html('Not Deleted').fadeOut(5000);  
                },
 
     });
 }
}else
{
    alert('error');
}

}


function changeLink(id)
{
    if(id){
            $.ajax({
                    type:'post',
                    url:'{{route("changelink")}}',
                    data:{id:id, _token:"{{Session::token()}}" },
    
            success:function(response)
                {
                    
                     var data = response;
    
        var parsed = JSON.parse(data);

        var input = document.createElement("input");

        input.setAttribute("type", "hidden");

        input.setAttribute("name", "portfolio_id");
        input.setAttribute("id", "portfolio_id");
        input.setAttribute("value",id);
        document.getElementById("updatelinkform").appendChild(input);
        $('#link_name').val(parsed.project_link);
        $('#changeLink').modal('toggle');
                }   
    
        });}
    else
    {
        alert('error');
    }

}



</script>
 


   <style>


.modal-dialog2 {
  width: 100%;
  height: 50%;
  margin: 0;
  padding: 0;
}

.modal-content {
  height: auto;
  min-height: 100%;
  border-radius: 0;
}

     </style>

 <div class="row">
 <div class="col-lg-6">

                        <h2><center>PORTFOLIOS</center></h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th><center>TITLE</center></th>
                                        <th><center>DESCRIPTION</center></th>
                                        <th><center>LINK</center></th>
                                        <th><center>CHANGE LINK</center></th>
                                        <th><center>CATEGORY</center></th>
                                        <th colspan="3"><center>ACTION</center></th>
                                        
                                    </tr>
                                </thead>
                                @if(isset($portfolios))
                                    @foreach($portfolios as $portfolio)
                                <tbody>
                                    <tr>
                                        <td><center>{{$portfolio->project_title}}</center></td>
                                        <td><center>{{$portfolio->project_desc}}</center></td>

<td><center><button type="button" class="btn btn-sm btn-link">{{$portfolio->project_link}}</button></center></td>
<td><center><button type="button" class="btn btn-sm btn-info" onclick="changeLink({{$portfolio->id}})"><i class="fa fa-sm fa-link"> Change Link</i></button></center></td>
                            <td><center>@foreach($portfolio->tags->pluck('name') as $name)
                            @if(count($portfolio->tags->pluck('name'))>1)
                            @if($name!="Default")
                            {{$name." "}}
                            @endif
                            @endif
                            @if(count($portfolio->tags->pluck('name'))==1)
                            @if($name=="Default")
                            {{$name}}
                            @endif
                            @endif
                            @endforeach</center></td>

<td><center><button type="button" class="btn btn-sm btn-info" onclick="startmodal({{$portfolio->id}})"><i class="fa fa-sm fa-eye"> View Page</i></button></center></td>

<td><center><a href="{{route('updateportfolios',['id'=> $portfolio->id ])}}" type="button" class="btn btn-sm btn-warning"><i class="fa fa-sm fa-pencil-square-o">Update</i></center></a></td>

<td><center><a onclick="deleteportfolio({{$portfolio->id}})" class="btn btn-sm btn-danger"><i class="fa fa-sm fa-trash">Delete</i></a></center></td>
                                    </tr>

                                    @endforeach
                                @else
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="3"></td>
                                        
                                    </tr>
                                </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>


   


<div  class="modal fade" role="dialog" id="portfolioModal">
   <div class="modal-dialog2">
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
                              <center>  <h2 id="portfolioModalHeading"></h2>
                                <p class="item-intro text-muted">Copyright CMS.</p>
                                <hr>
                                <img id="portfolioModalImage" class="img-responsive img-centered"  alt="">
                                <hr>
                                <p id="portfolioModalDescription"><strong>Description: </strong></p>
                                <hr>
                                <p>
                                    <strong>Take A Look: </strong>
                                 <a id="portfolioModalLink"></a></p></center>
                                 <hr>

                                <ul><strong>Details: </strong>
                                    <li id="portfolioDetails1"></li>
                                    <li id="portfolioDetails2"></li>
                                    <li id="portfolioDetails3"></li>
                                </ul> 
                                <hr>
                                <center><ul class="list-inline">
                                    <li id="portfolioModalDate"><strong>Date:</strong></li>
                                    <li>Client: Round Icons</li>
                                    <li id="portfolioModalCategory"></li>
                                </ul> </center>
                               <center> <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>



   <div id="changeLink" class="modal fade" role="dialog">
  <div class="modal-dialog2">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center><h4 class="modal-title">CHANGE LINK</h4> </center>
      </div>
      <div class="modal-body">
       
        <div class="row" id="formsection">
                    <div class="col-lg-4">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <center><h3 class="panel-title"><i class="fa fa-long-pencil"></i> UPDATE LINK</h3></center>
                            </div>
                            <div class="panel-body">
                                <div class="container">

        <!-- Page Header -->
       
                                      <div class="row">
                                     <div class="col-lg-6" >

                             <form id="updatelinkform" method="post" action="{{route('savelink')}}">
                                {{csrf_field()}}
                            <div class="form-group">
                                <label>Name:</label>
                                <input class="form-control" placeholder="Link-Name" name="project_link" id="link_name" required>
                                
                            </div>

                         
                            <div class="form-group">
                            <center><button type="submit" class="btn btn-warning yellow" id="Submit"><i class="fa fa-upload"></i>SUBMIT</button></center>
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
                      
                            

                     </div>
        <!-- /.row -->


                </div>
                                
                
            </div>
        </div>



      </div>
     

  </div>
</div>



    @endsection