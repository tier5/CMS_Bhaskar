 @extends('Layouts.master')

@section('content')
<script>

$(document).ready(function(){

    $('#Comment_Submit').click(function(){

        var post_id=$('#post_id').val();
        var comment_body=$('#comment_body').val();
       if(post_id && comment_body)
       {
         
       
            $.ajax({
                type:'post',
                url:'{{route("createcomments")}}',
                data:{post_id:post_id,comment_body:comment_body, _token:"{{Session::token()}}" },
              
             success:function(response)
                {


                   if(response=='success')
                   {
                      $('#comment_post').html('Comment Posted Successfully').fadeOut(5000);
                      $('#comment_body').val(" ");
                      //$('.media-body').load(window.location +".media-body>");
                       $('#commentsection').load(window.location + ' #commentsection');  
                             }
                   else
                   {
                    $('#comment_post').append('Comment Not Posted').fadeOut(5000);
                      
                   }

                }
            });
       }

    });



  $('#Reply_Submit').click(function(){
    var post_id=$('#post_id').val();
      var comment_id=$('#comment_id').val();
        var reply_body=$('#reply_body').val();
    if(post_id&&comment_id&&reply_body)
    {
        $.ajax({

            type:'post',
            url:'{{route("createreplies")}}',
            data:{post_id:post_id,comment_id:comment_id,reply_body:reply_body,_token:"{{Session::token()}}"},
            success: function(response)
            {
                if(response=='success')
                {
                    $('#reply_message').html('Relpy Posted').fadeOut(5000);
                    $('#reply_body').val("");
                    $('#reply_section').load(window.location+' #reply_section');

                }
                else
                {   
                    $('#reply_message').html('Relpy Not Posted').fadeOut(5000);

                }
            }
        });
    }

    });

});



function edit(id)
{
    $('#commentbodytext_'+id).css('display','block').focus();
    $('#commentbody_'+id).css('display','none');
    $('#EditComment_'+id).css('display','none');
     $('#CancelComment_'+id).css('display','block');
    $('#ReplyComment_'+id).css('display','none');
    $('#DeleteComment_'+id).css('display','none');
}




function handle(e,id){
        if(e.keyCode === 13){
           
                var url='{{url("/")}}/updatecomments/'+id;
                var comment_id=id;
        
                var comment_body=$('#commentbodytext_'+id).val();
                if(comment_id&&comment_body)
                {
                    $.ajax({
                    type:'post',
                    url:url,
                    data:{comment_id:comment_id,comment_body:comment_body,_token:"{{Session::token()}}"},
                    success:function(response)
                    {
                        if(response.status=='success')
                        {
                           
                       $('#commentbody_'+id).html(comment_body);
                       $('#commentbody_'+id).css('display','block');
                       $('#commentbodytext_'+id).css('display','none');
                       $('#EditComment_'+id).css('display','block');
                       $('#CancelComment_'+id).css('display','none');
                       $('#ReplyComment_'+id).css('display','block');
                       $('#DeleteComment_'+id).css('display','block');
                         }else{
                             $('#commentbody_'+id).html(comment_body);
                         }
                    }


                    });
                    
                }




        }
    }


function cancel(id){
     $('#commentbodytext_'+id).css('display','none');
    $('#commentbody_'+id).css('display','block');
    $('#EditComment_'+id).css('display','block');
    $('#CancelComment_'+id).css('display','none');
     $('#ReplyComment_'+id).css('display','block');
    $('#DeleteComment_'+id).css('display','block');
}

function del(id){

    var url='{{url("/")}}/deletecomments/'+id;
                var comment_id=id;
        
                if(comment_id)
                {
                    $.ajax({
                    type:'post',
                    url:url,
                    data:{comment_id:comment_id,_token:"{{Session::token()}}"},
                    success:function(response)
                    {
                        if(response.status=='success')
                        {
                           $('#commentsection').load(window.location + ' #commentsection'); 
                    
                         }else{
                            $('#commentsection').load(window.location + ' #commentsection'); 
                         }
                    }
                });
                }
            }


function visibility(id)
{
   $('#reply_'+id).toggle(); 
}



function editreply(id)
{
    $('#replybodytext_'+id).css('display','block').focus();
    $('#replybody_'+id).css('display','none');
    $('#EditReply_'+id).css('display','none');
     $('#CancelReply_'+id).css('display','block');
    $('#ReplyReply_'+id).css('display','none');
    $('#DeleteReply_'+id).css('display','none');
}




function handlereply(e,id){
        if(e.keyCode === 13){
           
                var url='{{url("/")}}/updatereplies/'+id;
                var reply_id=id;
        
                var reply_body=$('#replybodytext_'+id).val();
                if(reply_id&&reply_body)
                {
                    $.ajax({
                    type:'post',
                    url:url,
                    data:{reply_id:reply_id,reply_body:reply_body,_token:"{{Session::token()}}"},
                    success:function(response)
                    {
                        if(response.status=='success')
                        {
                           
                       $('#replybody_'+id).html(reply_body);
                       $('#replybody_'+id).css('display','block');
                       $('#replybodytext_'+id).css('display','none');
                       $('#EditReply_'+id).css('display','block');
                       $('#CancelReply_'+id).css('display','none');
                       $('#ReplyReply_'+id).css('display','block');
                       $('#DeleteReply_'+id).css('display','block');
                         }else{
                             $('#replybody_'+id).html(reply_body);
                         }
                    }


                    });
                    
                }




        }}


function cancelreply(id){
     $('#replybodytext_'+id).css('display','none');
    $('#replybody_'+id).css('display','block');
    $('#EditReply_'+id).css('display','block');
    $('#CancelReply_'+id).css('display','none');
     $('#ReplyReply_'+id).css('display','block');
    $('#DeleteReply_'+id).css('display','block');
}

function delreply(id){

    var url='{{url("/")}}/deletereplies/'+id;
                var reply_id=id;
        
                if(reply_id)
                {
                    $.ajax({
                    type:'post',
                    url:url,
                    data:{reply_id:reply_id,_token:"{{Session::token()}}"},
                    success:function(response)
                    {
                        if(response.status=='success')
                        {
                           $('#reply_section').load(window.location + ' #reply_section'); 
                    
                         }else{
                            $('#reply_section').load(window.location + ' #reply_section'); 
                         }
                    }
                });
                }
            }





</script>

<style type="text/css">
 a:hover {
  cursor:pointer;
 }
</style>

 <!-- Page Content -->
    <div class="container">

        <div class="row">

                 <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>
            </div>

<hr>

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$postid->title}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">{{$postid->user->name}}</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> {{$postid->created_at->toFormattedDateString()}}</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead">{{$postid->body}}</p>

                <hr>
            </div>
        </div>
    </div>    
<aside class="image-bg-fixed-height"></aside>
                 <!-- Page Content -->
    <div class="container">

        <div class="row">

                <div class="col-lg-8">

                <!-- Blog Comments -->
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                   
                   <!--   <form role="form" action="{{route('createcomments')}}" method="POST">  -->
                    <!-- {{route('createcomments')}} -->
                           <!--  {{csrf_field()}} -->
                        <div class="form-group">
                            <input type="hidden" name="post_id" id="post_id" value="{{encrypt($postid->id)}}">
                            <textarea name="comment_body" id="comment_body" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" id="Comment_Submit" class="btn btn-primary">Submit</button>

                             <span id="comment_post"></span>                    
                     </form> 
                </div>

                <hr>
               

<div id="commentsection">
                <!-- Posted Comments -->
      @if(isset($getcomments))
      @foreach($getcomments as $comment)
      @if($comment->post->id==$postid->id)
                <!-- Comment -->
<div class="media" id="media">
    <a class="pull-left" href="#">
      <img class="media-object" src="http://placehold.it/64x64" alt="">
    </a>
                    
<div class="media-body">
  <h4 class="media-heading">Comments
    <small>{{$comment->created_at->toFormattedDateString()}} at {{$comment->created_at->toTimeString()}}</small>
  </h4>
                
 <span class="commentbody" id="commentbody_{{$comment->id}}">{{$comment->body}}</span>
                
<input type="text" class="commentbodytext" id="commentbodytext_{{$comment->id}}" value="{{$comment->body}}" onkeypress="handle(event,{{$comment->id}})" style="display:none">
                      
        <div class="interaction">
                       <a onclick="visibility({{$comment->id}})" id="ReplyComment_{{$comment->id}}">Reply</a>       
                         @if(Auth::check())
                          <a onclick="edit({{$comment->id}})" id="EditComment_{{$comment->id}}">Edit</a>
                          <a onclick="del({{$comment->id}} )" id="DeleteComment_{{$comment->id}}">Delete</a> 
                          <a onclick="cancel({{$comment->id}})" id="CancelComment_{{$comment->id}}" style="display:none">Cancel</a>
                          @endif 
                          </div>
                            <!-- Reply Form -->
                         <div id="reply_section">
                         @if(isset($getreplies))
                         @foreach($getreplies as $reply)
                                @if($reply->comment->id==$comment->id)
                          <div class="media" >
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Reply
                                    <small>{{$reply->created_at->toFormattedDateString()}} at {{$reply->created_at->toTimeString()}}</small>
                                </h4>
<span class="replybody" id="replybody_{{$reply->id}}">{{$reply->body}}</span>
<input type="text" class="replybodytext" id="replybodytext_{{$reply->id}}" value="{{$reply->body}}" onkeypress="handlereply(event,{{$reply->id}})" style="display:none">
                                @if(Auth::check())

<a onclick="editreply({{$reply->id}})" id="EditReply_{{$reply->id}}">Edit</a>
                          <a onclick="delreply({{$reply->id}} )" id="DeleteReply_{{$reply->id}}">Delete</a> 
                          <a onclick="cancelreply({{$reply->id}})" id="CancelReply_{{$reply->id}}" style="display:none">Cancel</a>
                                @endif
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endif
                                </div>



                         <!-- Reply Form -->
                        
                        <div class="media" style="display:none" id="reply_{{$comment->id}}">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                
                             
                            <div class="form-group">
                               
                            <input type="hidden" name="comment_id" id="comment_id" value="{{encrypt($comment->id)}}">

                            <textarea name="reply_body" id="reply_body" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="Reply_Submit">Submit</button>
                           <span id="reply_message"></span>
                
                            </div>
                        </div>

                    </div>
                </div>
                @endif
                @endforeach
                @endif
                </div>
              
                </div>



           
        

        </div>
        <!-- /.row -->

        <hr>

        
    </div>

@endsection