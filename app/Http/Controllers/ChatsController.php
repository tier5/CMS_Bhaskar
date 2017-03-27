<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use App\Client;

class ChatsController extends Controller
{

public function save(Request $request)
{
/*	$this->validate($request,[
		'input_chat'=>'required',
		]);*/
if($request->id)
{
if(Client::first())
{
	$client=Client::where('session_id','=',$request->id)->first();
}
else
{
	return 'no client';
}
}
	$chat=new Chat();
	$chat->client_id=$client->id;
	$chat->to=1;
	$chat->message=$request->text;
	if($chat->save())
	{
		return 'success';
	}else
	{
		return 'error';
	}
}



public function chatviewadmin(Client $id)
{
	if($id->chats->first()){
		$chats=Chat::whereIn('client_id',[1,$id->id])->whereIn('to',[$id->id,1])->get();
		//$chatadmin=Client::where('id','=',1)->first()->chats;
		return view('AdminLayouts.Admin.chat',compact('id','chats'));
	}else
	{
		return view('AdminLayouts.Admin.chat',compact('id'));
	}

}

public function sendmessageadmin(Request $request)
{
	$chat=new Chat();
	$chat->client_id=1;
	$chat->to=$request->id;
	$chat->message=$request->text;
	if($chat->save())
	{
		return 'success';
	}else
	{
		return 'error';
	}
}

public function viewchatlogs(Client $id)
{
	if($id->chats->first()){
		$chats=Chat::whereIn('client_id',[1,$id->id])->whereIn('to',[$id->id,1])->get();
		return view('AdminLayouts.Admin.viewchatlogs',compact('chats'));}
	else
	{
		return view('AdminLayouts.Admin.viewchatlogs');
	}
}
}
