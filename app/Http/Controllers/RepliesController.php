<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use Auth;
use App\Comment;

class RepliesController extends Controller
{

  
	public function store(Request $request)
	{	
		
		$this->validate($request,[
			'reply_body'=>'required'
			]);

		$reply=new Reply();
		$reply->comment_id=decrypt($request->comment_id);
		$reply->user_id=Auth::user()->id;
		$reply->body=$request->reply_body;
		if($reply->save())
			{
				echo 'success';
			}
		else
			{
				echo 'errror';
			}
	}

	public function update(Request $request)
	{


		$reply=Reply::find($request->reply_id);
		$reply->body=$request->reply_body;

		if($reply->update())
		{
		
			return \Response::json(array('status'=>'success'));
		}
		else
		{
			return \Response::json(array('status'=>'error'));
		}

	}	

	public function delete(Request $request)
	{



		$reply=Reply::find($request->reply_id);
		if($reply->delete())
		{
			return \Response::json(array('status'=>'success'));
		}
		else
		{
			return \Response::json(array('status'=>'error'));
		}

	}	


}
