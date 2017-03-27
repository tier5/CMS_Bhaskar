@extends('PortFolio.portfoliomaster')

@section('content')
<script>
   
   function changetag(id)
   {
    if(id)
    {
        $.ajax({
                url:"{{route('changetag')}}",
                type:"post",
                data:{id:id, _token:"{{Session::token()}}"},
        
                success:function(response)
                        {
                           // alert(response);
                             $('#tags_portfolio').html(response); 
                        }}
                );
    }
    else
    {
        alert('error');
    }

   }

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
    {$('#portfolioDetails1').html("** "+parsed.project_details1+" **");}
    else
    {$("#portfolioDetails1").css("display", "none");}

    if(parsed.project_details2)
    {$('#portfolioDetails2').html("** "+parsed.project_details2+" **");}
    else
    {$("#portfolioDetails2").css("display", "none");}
    if(parsed.project_details3)
    {$('#portfolioDetails3').html("** "+parsed.project_details3+" **");}
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

@if(isset($tag_default))
<section id="tagbuttons" class="bg-darkest-gray">
<div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Tags</h2>
                    <h3 class="section-subheading text-muted">Available Tags.</h3>
                </div>
</div>
<div class="col-center"><center>
@foreach($tag_default as $tag)
<a class="btn btn-primary btn-sm " id="tag_{{$tag->id}}" onclick="changetag({{$tag->id}})">{{$tag->name}}</a>
@endforeach
</div>
</center>
</section>
@endif



  <section id="portfolio" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Portfolio</h2>
                    <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
                </div>
            </div>


<div id="start">
@if(isset($portfolios))
   
 <div class="row" id="tags_portfolio">
 @foreach($portfolios as $portfolio)
        <div class="col-md-4 col-sm-6 portfolio-item">
                    <a onclick="startmodal({{$portfolio->id}})" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="{{url('/')}}/image/portfolio/fullsize/thumbnails/{{$portfolio->project_image}}" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>{{$portfolio->project_title}}</h4>
                        <p class="text-muted">{{$portfolio->project_desc}}</p>
                    </div>
                </div>
                @endforeach
             
               
       
</div>

@endif
</div>

    </section>

 <div align="center">
        @if(isset($portfolios))
        {{$portfolios->links()}}
        @endif
        </div>
     

<div  class="modal fade" role="dialog" id="portfolioModal1">
   <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center><h4 class="modal-title">PORTFOLIOS</h4> </center>
      </div>

 <div class="modal-body">
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

                                <center><strong>Details: </strong>
                                <hr>
                                    <p id="portfolioDetails1"></p>
                                <hr>
                                    <p id="portfolioDetails2"></p>
                                <hr>
                                    <p id="portfolioDetails3"></p>
                                 <center>
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
</div>




      

@endsection('content')