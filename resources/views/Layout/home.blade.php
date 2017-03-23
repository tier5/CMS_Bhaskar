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


        $('#btn-sendname').click(function(){

            var name=$('#btn-input-name').val();
            if(name!=''.trim())
            {
                $.ajax({
                
                url:"{{route('updatename')}}",
                type:'post',
                data:{id:"{{Session::getid()}}",name:name, _token:"{{Session::token()}}"},

                success:function(response)
                {
                    if(response=='success')
                        {
                            $('#btn-input').css('display','block');
                            $('#btn-chat').css('display','block');
                            $('#btn-sendname').css('display','none');
                            $('#btn-input-name').css('display','none');
                            
                            var input = document.createElement("input");
                            input.setAttribute("type", "hidden");
                        input.setAttribute("name", "name");
                        input.setAttribute("id", "name");
                        input.setAttribute("value", name);

//append to form element that you want .
                document.getElementById("msg").appendChild(input);

                        }
                    else if(response=='error')
                    {
                            $('#msg').html(response);
                             
                    }

                }
                });
            }
            else
            {
                $('#msg').html('Name');
            }
        });



        $('#btn-chat').click(function(){

            var val=$('#btn-input').val();
            var name=$('#name').val();
            if(val!=''.trim()&&name)
            {
                $.ajax({
                
                url:"{{route('sendmessage')}}",
                type:'post',
                data:{val:val,name:name, _token:"{{Session::token()}}"},

                success:function(response)
                {
                    if(response=='success')
                        {
                           $('.chat-body clearfix').load(window.location + ' .chat-body clearfix');  

                        }
                    else if(response=='error')
                    {
                           
                    }

                }
                });
            }
            else
            {
                $('#msg').html('Name');
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
                          return
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
                          return
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
                    <ul class="chat">
                        <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                </div>
                              @if(isset($chats))
                                @foreach($chats as $chat)
                                  <p>
                                     {{$chat->message}}                              
                                   </p>
                                  @endforeach
                                  @endif
                            </div>
                        </li>
                        <li class="right clearfix"><span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>14 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="right clearfix"><span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>15 mins ago</small>
                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                    <input id="btn-input-name" type="text" class="form-control input-sm" placeholder="Enter Your Name" name="input_name" required/>
                        <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." name="input_chat" style="display:none" required />
                        <span class="input-group-btn" id="msg">
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
