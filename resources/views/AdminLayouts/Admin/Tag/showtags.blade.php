 @extends('AdminLayouts.master')

    @section('content')

<script>


function edittags(id)
  {
    var tag_id=id;
      if(tag_id)
        {
          $.ajax({
            type:"post",
            url:"{{route('edittags')}}",
            data:{id:tag_id, _token:"{{Session::token()}}"},
            success:function(response)
                    {
                       var data = response;
    
        var parsed = JSON.parse(data);
        $('#tag_name').val(parsed.name);
        var input = document.createElement("input");

        input.setAttribute("type", "hidden");

        input.setAttribute("name", "tag_id");
        input.setAttribute("id", "tag_id");
        input.setAttribute("value",id);
        document.getElementById("tagform").appendChild(input);
        $('#myModal').modal('toggle');

                    },
            error:function()
              {
           $('#tag_name').val('No Data');
              }

          });
        }
        else
        {
          alert('error');
        }
       
}



function deletetags(id)
  {
    var tag_id=id;
      if(id)
        {
          if(confirm("Are You Sure You Want To Delete?"))
          { $.ajax({
                      type:"post",
                      url:"{{route('deletetags')}}",
                      data:{id:tag_id, _token:"{{Session::token()}}"},
                      success:function()
                              {
                   $('#table').load(window.location + ' #table');  
                  $('#success').html('Deleted Sucessfully').fadeOut(5000);                 
                              },
                      error:function()
                        {
                  $('#success').html('Not Deleted').fadeOut(5000);  
                        }
          
                    });}
        }
       
}

</script>

 <style>


.modal-dialog {
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

                        <h2><center>TAGS</center></h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th><center>TITLE</center></th>
                                        <th colspan="2"><center>ACTION</center></th>
                                    </tr>
                                </thead>
                                @if(isset($tags))
                                    @foreach($tags as $tag)
                                    @if($tag->id!=1)
                                <tbody>
                                    <tr>
                                        <td><center>{{$tag->name}}</center></td>

<td><center><button  onclick="edittags({{$tag->id}})"type="button" class="btn btn-sm btn-warning" ><i class="fa fa-sm fa-pencil-square-o">Update</i></center></button></td>
<td><center><button onclick="deletetags({{$tag->id }})" type="button" class="btn btn-sm btn-danger"><i class="fa fa-sm fa-trash">Delete</i></button></center></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="3"></td>
                                    </tr>
                                </tbody>
                                @endif
                                 @endforeach
                                @else
                                <tr>
                                        <td></td>
                                        <td colspan="2"></td>
                                    </tr>
                                </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>

    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center><h4 class="modal-title">TAGS</h4> </center>
      </div>
      <div class="modal-body">
       
        <div class="row" id="formsection">
                    <div class="col-lg-4">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <center><h3 class="panel-title"><i class="fa fa-long-pencil"></i> UPDATE TAG DETAIL</h3></center>
                            </div>
                            <div class="panel-body">
                                <div class="container">

        <!-- Page Header -->
       
                                      <div class="row">
                                     <div class="col-lg-6" >

                              <form action="{{route('saveedittags')}}" method="post" id="tagform">
                             {{csrf_field()}}
                                
                            <div class="form-group">
                                <label>Title:</label>
                                <input class="form-control" placeholder="Tag-Title" name="name" id="tag_name" required>
                                
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