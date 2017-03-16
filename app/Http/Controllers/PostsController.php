<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Auth;
use Session;
use App\Reply;

class PostsController extends Controller
{

  
 public function index()
 {


                   


	
  	if(Auth::user())
  	{
	   
	   if(Auth::user()->status==1)
	   {

		   if(Post::latest()->get()->first())
			{
			
			$posts=Post::latest()->get();
			$first_post_id=Post::latest()->first()->id;
			
	
			return view('Post.index',compact('posts','first_post_id'));			
			}

		else
		{
			
			return view('Post.index');
				}
	}

	else if(Auth::user()->status==0)
		{

		return view('Admin.adminindex');
		}

	}
	else{		
		if(Post::latest()->get()->first())
		{

			$posts=Post::latest()->get();
			$first_post_id=Post::latest()->first()->id;
				

		return view('Post.index',compact('posts','first_post_id'));			
		}
		else
		{
				
			return view('Post.index');
		}
			
	}

}



public function store(Request $request)
	{
		$this->validate($request,[

			'post_title'=>'required',
			'post_body'=>'required'

			]);

		$posts=new Post();
		$posts->user_id=\Auth::user()->id;
		$posts->title=$request->post_title;
		$posts->body=$request->post_body;
		if($posts->save())
		{
			return redirect()->route('welcome')->with('Post_SMessage',"Post Updated Successfully");
		}
		else
		{
			return redirect()->route('welcome')->with('Post_FMessage',"Post Did Not Updated");
		}



	}



	public function showbyid($id)
	{
		
		$postid=Post::find($id);
		if(Comment::latest()->get()->first())
		{

			$getcomments=Comment::latest()->get();
				if(Reply::latest()->get()->first())
					{
						$getreplies=Reply::where('comment_id','=',$getcomments->pluck('id'))->get();

		return view('Post.post',compact('postid','getcomments','getreplies'));
					}else{
			return view('Post.post',compact('postid','getcomments'));}
		}else
		{
			return view('Post.post',compact('postid'));
		}
	}


    //
}
