@extends('AdminLayouts.master')

    @section('content')

<div class="panel panel-primary">
                <div class="panel-heading" id="accordion">
                    <span class="glyphicon glyphicon-comment"></span> Chat
                    
                </div>

            <div >
                <div class="panel-body">
                    <ul class="chat">
                    <div id="chat_div">
                     @if(isset($chats))
                        @foreach($chats as $chat)
                            @if($chat->client_id!=1)
                        <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix" id="chat_body">
                                <div class="header">
                                    <strong class="primary-font">{{$chat->client->user_name}}</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>{{$chat->created_at->diffForHumans()}}</small>
                                </div>

                              
                                
                                  <p>
                                     {{$chat->message}}                              
                                   </p>
                            </div>
                        </li>
                        <hr>
                        @else
                        <li class="right clearfix"><span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>{{$chat->created_at->diffForHumans()}}</small>
                                    <strong class="pull-right primary-font">{{$chat->client->user_name}}</strong>
                                </div>
                                <p align="right">
                                    {{$chat->message}} 
                                </p>
                            </div>
                        </li>
                        <hr>
                        @endif
                            @endforeach
                                @endif
                     </div>
                    </ul>
                </div>
               
            </div>
            </div>
  
  
    @endsection