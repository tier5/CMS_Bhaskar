@extends('Layouts.master')

@section('content')



<style>
    .timg {
    width:30%;
    float: left; 
}
.closeDiv {
    width: 20px;
  height: 21px;
  background-color: rgb(35, 179, 119);
  float: left;
  cursor: pointer;
  color: white;
  box-shadow: 2px 2px 7px rgb(74, 72, 72);
  text-align: center;
  margin: 5px;


}
.pDiv {
position: relative;
  min-height: 1px;
  padding-right: 15px;
  padding-left: 15px;
}

</style>



@if(Auth::check())
 <!-- Content Section -->
    <section>
       <div class="container">
            <div class="row">
                   <h1 class="section-heading">Create Blog Post</h1>
            </div>
    
                <div class="row">
    
                    <div class="col-md-6">
                       <div class="widget-area no-padding blank">
                          <div class="status-upload">
                             <form method="Post" action="{{route('createpost')}}"  enctype="multipart/form-data" >
                                    {{csrf_field()}}
                                <input type="text" name="post_title" placeholder="Title" required>

                                <textarea name="post_body" placeholder="What are you doing right now?" ></textarea>
                                        <ul>
                                            <li><a id="upload_music" data-toggle="tooltip" data-placement="bottom" data-original-title="Audio"><i class="fa fa-music"></i></a>
                                                <input type="file" id="audio_upload" name="audio_upload" multiple style="display: none">


                                            </li>

                                            <li><a id="upload_video" data-toggle="tooltip" data-placement="bottom" data-original-title="Video"><i class="fa fa-video-camera"></i></a>

                                            <input type="file" id="video_upload" name="video_upload" multiple style="display: none">

                                            </li>

                                            <li><a id="upload_record" data-toggle="tooltip" data-placement="bottom" data-original-title="Sound Record"><i class="fa fa-microphone"></i></a>

                                            <input type="file" id="record_upload" name="record_upload" multiple style="display: none">

                                            </li>

                                            <li><a id="upload_picture" title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Picture" enctype = "multipart/form-data"><i class="fa fa-picture-o"></i></a>

                                            <input type="file" id="pic_upload" name="pic_upload" multiple style="display: none"></li>
                                        
                                        </ul>
                                        <button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> Share</button>
                                   
                                        @if(Session::has('Post_SMessage'))
                                             {{Session::get('Success_Message')}}
                                        @endif
                                        @if(Session::has('Post_FMessage'))
                                             {{Session::get('Failed_Message')}}
                                        @endif

                                    </form>
                    
                                                           
                                 
                         
                                <div id="thumbnail"> </div>
                                <div class="row-fluid">
                             <div class="span12 text-center" id="Image_Upload_error" style="display:none">Invalid Image Format.Should be'gif','png','jpg','jpeg'
                             </div>
                                    </div>
                            
                                </div><!-- Status Upload  -->
                            </div><!-- Widget Area -->
                        </div>       
                    </div>
                </div>
    </section>

<aside class="image-bg-fixed-height"></aside>
    

@endif
    @if(isset($posts))
    <!-- Content Section -->
    <section>
        <div class="container">
            <div class="row">
                  <div class="col-md-10 blogShort">
               
                    <h1 class="section-heading">{{$posts->first()->title}}</h1>
                       <p class="lead">
                        by <a href="#">{{$posts->first()->user->name}}</a>
                      </p>
                      <p><span class="glyphicon glyphicon-time"></span> Posted on {{$posts->first()->created_at->toFormattedDateString()}} at {{$posts->first()->created_at->toTimeString()}}</p>
                      <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p class="section-paragraph">{{$posts->first()->body}}</p>
                      <a  class="btn btn-blog pull-right marginBottom10" href="{{route('showpost',['id'=>$posts->first()->id])}}">READ MORE</a> 

                </div>
            </div>
        </div>
    </section>

    <!-- Fixed Height Image Aside -->
    <!-- Image backgrounds are set within the full-width-pics.css file. -->
    <aside class="image-bg-fixed-height"></aside>

   
<section>
  <div class="container">
     <div id="blog" class="row"> 
         <h1 class="page-header">
                    Recent Posts
                    <small>Secondary Text</small>
        </h1>
            @foreach($posts as $post)


              @if($post->id!=$first_post_id)
              
             
                    <h1 class="section-heading">{{$post->title}}</h1>
                
                <p class="lead">
                    by <a href="#">{{$post->user->name}}</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->toFormattedDateString()}} at {{$post->created_at->toTimeString()}}</p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p>{{$post->body}}.</p>
                <a class="btn btn-primary" href="{{route('showpost',['id'=>$post->id])}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                

                @endif

                @endforeach
           @endif
            <!-- Blog Entries Column -->
            
             </div>
</div>
</section>


    

@endsection
