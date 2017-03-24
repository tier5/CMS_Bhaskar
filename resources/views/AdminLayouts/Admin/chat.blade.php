 @extends('AdminLayouts.master')

    @section('content')



<script>
    $(document).ready(function(){
    
    $('#input-chat').focus();
    $('#input-chat').val("");



        $('#btn-chat').click(function(){

            var text=$('#input-chat').val();
            var id="{{$id->id}}";
            
            if(text!=''&&id)
            {
                $.ajax({
                
                url:"{{route('sendmessageadmin')}}",
                type:'post',
                data:{id:id,text:text, _token:"{{Session::token()}}"},

                success:function(response)
                {


                    if(response!='error')
                        {

                       		
                         setInterval(function(){$('#chat_body').load(window.location + ' #chat_body');},1000);  
                        }
                    else if(response=='error')
                    	{
                           $('#chat_body').html(response);
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


 // setInterval(function(){ timer() }, 1000);


    });

    </script>
            <div class="panel panel-primary">
                <div class="panel-heading" id="accordion">
                    <span class="glyphicon glyphicon-comment"></span> Chat
                    
                </div>

            <div >
                <div class="panel-body">
                    <ul class="chat">
                        <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix" id="chat_body">
                                <div class="header">
                                    <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                </div>

                               @if(isset($chat))
                                @foreach($chat as $chatsend)
                                  <p>
                                     {{$chatsend->message}}                              
                                   </p>
                                  @endforeach
                                  @endif
                              <hr>
                              @if(isset($chatadmin))
                                @foreach($chatadmin as $chatsend)
                                  <p>
                                     {{$chatsend->message}}                              
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
                    <div class="input-group" id="input">
              
                        <input id="input-chat" type="text" class="form-control input-sm" placeholder="Type your message here..." name="input_chat" />
                          <center><span id="msg"></span></center>
                        <span class="input-group-btn" >
                            

                                <button class="btn btn-warning btn-sm" id="btn-chat">
                                Chat</button>
                              
                        </span>
                    </div>
                </div>
            </div>
            </div>
  
    @endsection