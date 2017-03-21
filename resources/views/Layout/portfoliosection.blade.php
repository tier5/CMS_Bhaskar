     <script>
         
          function startmodal(id)
    {
        if(id){
        $.ajax({
                    type:'post',
                    url:'{{route("getportfolio")}}',
                    data:{id:id, _token:"{{Session::token()}}" },
    
            success:function(response)
                {
                    //alert(response);
                     var data = response;
    
    var parsed = JSON.parse(data);


    $('#portfolioModalHeading').html(parsed.project_title);
    $('#portfolioModalImage').attr('src',"{{url('/')}}/image/portfolio/fullsize/"+parsed.project_image);
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
    $('#portfolioModal1').modal('toggle');
        
                }   
    
        });}
    else
    {
        alert('error');
    }


    }
     </script>

     <style>

.modal-dialog {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
}

.modal-content {
  height: auto;
  min-height: 100%;
  border-radius: 0;
}

     </style>
 <section class="no-padding" id="portfolio">
        <div class="container-fluid">
            <div class="row no-gutter popup-gallery">
            @if(isset($portfolios))
                @foreach($portfolios as $portfolio)
                <div class="col-lg-4 col-sm-6">
                    <a onclick="startmodal({{$portfolio->id}})" class="portfolio-box" data-toggle="modal">
                        <img src="{{url('/')}}/image/portfolio/fullsize/thumbnails/{{$portfolio->project_image}}" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    {{$portfolio->tags->pluck('name')}}
                                </div>
                                <div class="project-name">
                                    {{$portfolio->project_title}}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                @endif
              
    </section>

    
       

<div  class="modal fade" role="dialog" id="portfolioModal1">
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
                              <center>  <h2 id="portfolioModalHeading"></h2>
                                <p class="item-intro text-muted">Copyright CMS.</p>
                                <hr>
                                <img id="portfolioModalImage" class="img-responsive img-centered"  alt="">
                                <hr>
                                <p id="portfolioModalDescription"><strong>Description: </strong></p>
                                <hr>
                                <p>
                                    <strong>Take A Look: </strong>
                                 <a id="portfolioModalLink"></a></p>
                                 <hr></center>

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


