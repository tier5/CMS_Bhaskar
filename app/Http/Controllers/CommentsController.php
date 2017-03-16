<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Comment;

class CommentsController extends Controller
{
   
	public function store(Request $request)
	{	

		$this->validate($request,[
			'comment_body'=>'required'
			]);
		
			
		$comment=new Comment();
		$comment->post_id=decrypt($request->post_id);
		$comment->user_id=Auth::user()->id;
		$comment->body=$request->comment_body;
		if($comment->save())
			{
				echo 'success';
				
			}
		else
			{
				echo 'error';
				
			}
		
	}

	public function update(Request $request)
	{
		$comment=Comment::find($request->comment_id);
		$comment->body=$request->comment_body;
		if($comment->update())
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



		$comment=Comment::find($request->comment_id);
		if($comment->delete())
		{
			return \Response::json(array('status'=>'success'));
		}
		else
		{
			return \Response::json(array('status'=>'error'));
		}

	}	


    //
}
