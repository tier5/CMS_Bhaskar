<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS Home</title>

 <!-- Bootstrap Core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>



    <!-- Theme CSS -->
    <link href="/css/creative.min.css" rel="stylesheet">
   <link href="/css/chat.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script   src="https://code.jquery.com/jquery-3.1.1.js"   integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="   crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
   
  getip();
    $('#input-name').focus();
    $('#input-name').val("");

        $('#btn-sendname').click(function(){

            var name=$('#input-name').val();
            name = name.replace(/\s/g, "");
            if(name!="")
            {
                $.ajax({
                
                url:"{{route('updatename')}}",
                type:'post',
                data:{id:"{{Session::getid()}}",name:name, _token:"{{Session::token()}}"},

                success:function(response)
                {
                    if(response=='success')
                        {
                          console.log(response);
                            $('#input-chat').css('display','block');
                            $('#input-chat').val("");
                            $('#btn-chat').css('display','block');
                            $('#btn-sendname').css('display','none');
                            $('#input-name').css('display','none');
                            
                            var input = document.createElement("input");
                        

                        input.setAttribute("type", "hidden");
                        input.setAttribute("name", "session");
                        input.setAttribute("id", "session");
                        input.setAttribute("value", "{{Session::getid()}}");
                        document.getElementById("msg").appendChild(input);
                        }
                    else if(response=='error')
                    {
                      console.log(response);
                            $('#input-name').val(response);
                  
                             
                    }

                }
                });
            }
            else
            {
                    var input = document.getElementById("input-name");
                    input.setAttribute('placeholder','Enter-A-Name');
                    $('#input-name').focus();
            }
        });



        $('#btn-chat').click(function(){

            var text=$('#input-chat').val();
            var id=$('#session').val();
                   if(text==" ")
           { text = text.replace(/\s/g, "");}
            if(text!=''&&id)
            {
                $('#input-chat').val("");
                $.ajax({
                
                url:"{{route('sendmessage')}}",
                type:'post',
                data:{id:id,text:text, _token:"{{Session::token()}}"},

                success:function(response)
                {


                    if(response=='success')
                        {
                         setInterval(function(){$('#chat').load(window.location + ' #chat');},1000);  

                        }
                    else if(response=='error')
                    {
                           
                    }

                }
                });
            }
            else
            {
                var input = document.getElementById("input-chat");
                    input.setAttribute('placeholder','Write Something');
                    $('#input-chat').focus();
            }
        });


 // setInterval(function(){ timer() }, 1000);


    });


function getip()
{
   

          $.ajax({
                    url:"{{route('ip')}}",
                    type:"post",
                    data:{path:"{{Route::current()->getname()}}", _token:"{{Session::token()}}"},
                    success:function(response)
                          {             
                             if(response=='admin')
                             {
                              return;
                             }
                             else if(response=='success')
                             {
                              location.reload();
                               setInterval(function(){ timer() }, 1000);
                              
                             }
                             else if(response=='there')
                             {
                               setInterval(function(){ timer() }, 1000);
                             }
                             else if(response=='not there')
                             {
                               var win = window.open("about:blank", "_self"); 
                               win.close();
                             }
                             
                             else
                             {
                              return;
                             }
                          }
              
  });

}      


function timer()
{
   

          $.ajax({
                    url:"{{route('updateclient')}}",
                    type:"post",
                    data:{id:"{{Session::getid()}}", _token:"{{Session::token()}}"},
                    success:function(response)
                          {             
                          console.log(response);
                          }
  });
}      



    </script> 
 
</head>

<body id="page-top">

@include('Layout.nav')
@include('Layout.header')
@include('Layout.about')
@include('Layout.portfoliosection')

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2>See More Of Our Projects!</h2>
                <a href="{{route('portfolios')}}" class="btn btn-default btn-xl sr-button">See More!</a>
            </div>
        </div>
    </aside>

@include('Layout.contact')

@if(!Auth::check())
<div class="container chat-section" >
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-primary">
                <div class="panel-heading" id="accordion">
                    <span class="glyphicon glyphicon-comment"></span> Chat
                    <div class="btn-group pull-right">
                        <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                    </div>
                </div>

            <div class="panel-collapse collapse" id="collapseOne">
                <div class="panel-body">
                  <div id="chat">
                    <ul class="chat">
                        @if(isset($chatsall))
                                @foreach($chatsall as $chat)
                                    @if($chat->client_id==1)


                        <div class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix" id="chat_body">
                                <div class="header">
                                    <strong class="primary-font">{{$chat->client->user_name}}</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>{{$chat->created_at->diffforHumans()}}</small>
                                </div>
 
                          
                                  <p>
                                     {{$chat->message}}                              
                                   </p>
                            </div>
                        </div>
                        <hr>
                        @else
                        <div class="right clearfix"><span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>{{$chat->created_at->diffforHumans()}}</small>
                                    <strong class="pull-right primary-font">{{$chat->client->user_name}}</strong>
                                </div >
                                <p align="right">
                                   {{$chat->message}}                
                                </p>
                            </div>
                        </div>
                        <hr>
                        @endif
                          @endforeach
                                  @endif
                       
                    </ul>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="input-group" id="input">
                    <input id="input-name" type="text" class="form-control input-sm" placeholder="Enter Your Name" name="input_name" required/>
                        <input id="input-chat" type="text" class="form-control input-sm" placeholder="Type your message here..." name="input_chat" style="display:none" required />
                          <center><span id="msg"></span></center>
                        <span class="input-group-btn" >
                            <button class="btn btn-warning btn-sm" id="btn-sendname">
                                Send</button>

                                <button class="btn btn-warning btn-sm" id="btn-chat" style="display:none">
                                Chat</button>
                              
                        </span>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>     
@endif

  <!-- jQuery -->
    <script src="/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    
    <script src="/vendor/scrollreveal/scrollreveal.min.js"></script>
   
    <!-- Theme JavaScript -->
    <script src="/js/creative.min.js"></script>

</body>

</html>
