<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Portfolio;

class TagsController extends Controller
{
    
public function createtags()
{

	return view('AdminLayouts.Admin.Tag.createtags');
}



public function showtags()
{	
	if(Tag::first()){
	$tags=Tag::latest()->get();
	return view('AdminLayouts.Admin.Tag.showtags',compact('tags'));
	}

	return view('AdminLayouts.Admin.Tag.showtags');
}




public function storetags(Request $request)
{
	//dd($request);

	$this->validate($request,[

			'name'=>'required|unique:tags'
		]);

	$tags=new Tag();
	
	$tags->name=$request->name;
	if($tags->save())
	{
		return redirect()->route('createtags')->with('success','Posted Successfully');
	}
	else
	{
		
		return redirect()->route('createtags')->with('error','Error');

	}

}


public function edittags(Request $request)
{	$tag=Tag::find($request->id);
	return json_encode($tag);
	
}

public function updatetags(Request $request)
{	
	$this->validate($request,[
		'name' =>'required|unique:tags',
		]);
	$tag=Tag::find($request->tag_id);
	$tag->name=$request->name;
	if($tag->update())
	{
		return redirect()->route('createtags')->with('success','Posted Successfully');
	}
	else
	{
		
		return redirect()->route('createtags')->with('error','Error');

	}
	
}


public function deletetags(Request $request)
{	
	$tag=Tag::find($request->id);
	if($tag->delete())
	{
		$tag->portfolios()->detach(Portfolio::all());
		return 'success';
	}
	else
	{
	return 'error';
	}
}

}
