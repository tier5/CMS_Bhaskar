<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;

class ChatsController extends Controller
{

public function save(Request $request)
{
/*	$this->validate($request,[
		'input_chat'=>'required',
		]);*/

	$chat=new Chat();
	$chat->name=$request->name;
	$chat->message=$request->val;
	if($chat->save())
	{
		return 'success';
	}else
	{
		return 'error';
	}
}

}
