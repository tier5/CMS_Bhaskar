<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\Tag;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PortfoliosController extends Controller
{
    public function index()
	{
		return view('PortFolio.Portfolios');
	}



	public function showportfolios()
	{
		if(Portfolio::first()){
		$portfolios=Portfolio::latest()->get();
		return view('AdminLayouts.Admin.PortFolio.showportfolio',compact('portfolios'));
		}
		else{
				return view('AdminLayouts.Admin.PortFolio.showportfolio');
				}
	}


  public function createportfolios()
  {
  		if(Tag::first()){
		$tags=Tag::latest()->get();
		return view('AdminLayouts.Admin.PortFolio.createportfolios',compact('tags'));
		}
		return view('AdminLayouts.Admin.PortFolio.createportfolios');
		
  }


public function storeportfolios(Request $request)
{
	$this->validate($request,[

			'project_title'=>'required',
			'project_description'=>'required',
			'project_detail1'=>'required',
			'project_link'=>'required|url|unique:portfolios',
			
		]);

	$multiple='';

    if($request->hasFile('file_upload'))
    {
    if($request->file_upload->getClientOriginalExtension()=='png'||$request->file_upload->getClientOriginalExtension()=='jpeg'||$request->file_upload->getClientOriginalExtension()=='jpg'||$request->file_upload->getClientOriginalExtension()=='gif')
    {
       $file=$request->file('file_upload');	
		$input=File::name($file->getClientOriginalName()).time().mt_rand(0,mt_getrandmax()).".".$file->getClientOriginalExtension();

		if(!file_exists(public_path()."/image/"))
		{
			mkdir(public_path()."/image/",0777,true);
		}
		$destination=public_path()."/image/";

		if($file->move($destination,$input))
			{
					if(!file_exists(public_path()."/image/thumbnails/"))
						{
							mkdir(public_path()."/image/thumbnails/",0777,true);
						}
						$thumbs=Image::make(public_path()."/image/".$input)->resize(650,350)->save(public_path()."/image/thumbnails/".$input,50);
								
								$portfolio=new Portfolio();
								$portfolio->project_title=$request->project_title;
								$portfolio->project_desc=$request->project_description;
								$portfolio->project_details1=$request->project_detail1;
								$portfolio->project_details2=$request->project_detail2;
								$portfolio->project_details3=$request->project_detail3;
								$portfolio->project_image=$input;
								$portfolio->project_link=$request->project_link;
				
			    			if($request->project_category){
				
								if(Tag::latest()->first())
								{
									foreach ($request->project_category as $category) {
				
			    					$multiple.=$category.",";
								}

				 					$tag=Tag::whereIn('id',explode(',',$multiple))->get();
								}
								else
								{
									$tag=Tag::find(['id'=>1]);

								}
								
								if($portfolio->save())
								{
									$portfolio->tags()->attach($tag);
									return redirect()->route('createportfolios')->with('success','Posted Successfully');
								}	
								else
								{
									return redirect()->route('createportfolios')->with('error','Not Posted');	
								}
							}
				else
				{
					
			if(Tag::first())
				   {
					
					if(strpos($multiple,"1,")===false)
					{$multiple.="1".",";}	
					
				 $tag=Tag::whereIn('id',explode(',',$multiple))->get();
				}
				else
				{
					$tag=Tag::find(['id'=>1]);

				}

				if($portfolio->save())
				{
					$portfolio->tags()->attach($tag);
					return redirect()->route('createportfolios')->with('success','Posted Successfully');
				}	
				else
				{
				return redirect()->route('createportfolios')->with('error','Not Posted');	
					
				}

				}

			}
		}
		else
		{
			return redirect()->route('createportfolios')->with('invalid_file','Invalid File Format (.jpg .png .jpeg and .gif only)');	
		}

		}
		else
		{
			

				
				$portfolio=new Portfolio();
				$portfolio->project_title=$request->project_title;
				$portfolio->project_desc=$request->project_description;
				$portfolio->project_details1=$request->project_detail1;
				$portfolio->project_details2=$request->project_detail2;
				$portfolio->project_details3=$request->project_detail3;
				$portfolio->project_image="default.jpg";
				$portfolio->project_link=$request->project_link;
				if($request->project_category){
					if(Tag::latest()->first())
				   {
					foreach ($request->project_category as $category) {
					
			    		$multiple.=$category.",";
					}
					
					if(strpos($multiple,"1,")===false)
					{$multiple.="1".",";}	
					
				 $tag=Tag::whereIn('id',explode(',',$multiple))->get();
				}
				else
				{
					$tag=Tag::find(['id'=>1]);

				}

				if($portfolio->save())
				{
					$portfolio->tags()->attach($tag);
					return redirect()->route('createportfolios')->with('success','Posted Successfully');
				}	
				else
				{
				return redirect()->route('createportfolios')->with('error','Not Posted');	
					
				}


		}else
		{
			if(Tag::first())
				   {
					
					if(strpos($multiple,"1,")===false)
					{$multiple.="1".",";}	
					
				 $tag=Tag::whereIn('id',explode(',',$multiple))->get();
				}
				else
				{
					$tag=Tag::find(['id'=>1]);

				}

				if($portfolio->save())
				{
					$portfolio->tags()->attach($tag);
					return redirect()->route('createportfolios')->with('success','Posted Successfully');
				}	
				else
				{
				return redirect()->route('createportfolios')->with('error','Not Posted');	
					
				}

		}
   
}
}

public function viewportfolioadmin(Request $request)
{

$portfolio=Portfolio::find($request->id);
return json_encode($portfolio);
}


public function updateportfolioadmin(Portfolio $id)
{
	if(Tag::first()){

	$notselected=Tag::all()->diff($id->tags);
	$selected=Tag::all()->intersect($id->tags);
	
	return view('AdminLayouts.Admin.PortFolio.updateportfolio',compact('id','selected','notselected'));
	}
   return view('AdminLayouts.Admin.PortFolio.updateportfolio',compact('id'));	
	
}


public function saveupdatedportfolioadmin(Request $request)
{
	

$this->validate($request,[

			'project_title'=>'required',
			'project_description'=>'required',
			'project_detail1'=>'required',
		
			
		]);

	$multiple='';

    if($request->hasFile('file_upload'))
    {
    if($request->file_upload->getClientOriginalExtension()=='png'||$request->file_upload->getClientOriginalExtension()=='jpeg'||$request->file_upload->getClientOriginalExtension()=='jpg'||$request->file_upload->getClientOriginalExtension()=='gif')
    {
    /*	
       $input=File::name($request->file_upload->getClientOriginalName()).time().mt_rand(0,mt_getrandmax()).".".$request->file_upload->getClientOriginalExtension();
		$destination=public_path()."/image/";

*/
		$file=$request->file('file_upload');	
		$input=File::name($file->getClientOriginalName()).time().mt_rand(0,mt_getrandmax()).".".$file->getClientOriginalExtension();

		if(!file_exists(public_path()."/image/"))
		{
			mkdir(public_path()."/image/",0777,true);
		}
		$destination=public_path()."/image/";

		if($file->move($destination,$input))
			{
					if(!file_exists(public_path()."/image/thumbnails/"))
						{
							mkdir(public_path()."/image/thumbnails/",0777,true);
						}
						$thumbs=Image::make(public_path()."/image/".$input)->resize(650,350)->save(public_path()."/image/thumbnails/".$input,50);
				
								$portfolio=Portfolio::find(decrypt($request->project_id));
								$portfolio->project_title=$request->project_title;
								$portfolio->project_desc=$request->project_description;
								$portfolio->project_details1=$request->project_detail1;
								$portfolio->project_details2=$request->project_detail2;
								$portfolio->project_details3=$request->project_detail3;
								$portfolio->project_image=$input;
								if($request->project_category){
				
								if(Tag::latest()->first())
								{
									foreach ($request->project_category as $category) {
				
			    					$multiple.=$category.",";
								}

				 					$tag=Tag::whereIn('id',explode(',',$multiple))->get();
								}
								else
								{
									$tag=Tag::find(['id'=>1]);

								}
								
								if($portfolio->update())
								{
							$portfolio->tags()->detach(Tag::all()->diff(Tag::find(['id'=>1])));
							$portfolio->tags()->attach($tag);
									return redirect()->route('createportfolios')->with('success','Posted Successfully');
								}	
								else
								{
									return redirect()->route('createportfolios')->with('error','Not Posted');	
								}
							}
				else
				{	

				if(Tag::first())
				   {
					
					if(strpos($multiple,"1,")===false)
					{$multiple.="1".",";}	
					
				 $tag=Tag::whereIn('id',explode(',',$multiple))->get();
				}
				else
				{
					$tag=Tag::find(['id'=>1]);

				}

				if($portfolio->update())
				{$portfolio->tags()->detach(Tag::all()->diff(Tag::find(['id'=>1])));
					$portfolio->tags()->attach($tag);
				return redirect()->route('createportfolios')->with('success','Posted Successfully');
				}	
				else
				{
				return redirect()->route('createportfolios')->with('error','Not Posted');	
					
				}
				}

			}
		}
		else
		{
			return redirect()->route('createportfolios')->with('invalid_file','Invalid File Format (.jpg .png .jpeg and .gif only)');	
		}

		}
		else
		{
			
				
				$portfolio=Portfolio::find(decrypt($request->project_id));
				$portfolio->project_title=$request->project_title;
				$portfolio->project_desc=$request->project_description;
				$portfolio->project_details1=$request->project_detail1;
				$portfolio->project_details2=$request->project_detail2;
				$portfolio->project_details3=$request->project_detail3;
				$portfolio->project_image="default.jpg";
				if($request->project_category){
				
								if(Tag::latest()->first())
								{
									foreach ($request->project_category as $category) {
				
			    					$multiple.=$category.",";
								}

				 					$tag=Tag::whereIn('id',explode(',',$multiple))->get();
								}
								else
								{
									$tag=Tag::find(['id'=>1]);

								}
								
								if($portfolio->update())
								{	$portfolio->tags()->detach(Tag::all()->diff(Tag::find(['id'=>1])));
									$portfolio->tags()->attach($tag);
									return redirect()->route('createportfolios')->with('success','Posted Successfully');
								}	
								else
								{
									return redirect()->route('createportfolios')->with('error','Not Posted');	
								}
							}else
		{
			if(Tag::first())
				   {
					
					if(strpos($multiple,"1,")===false)
					{$multiple.="1".",";}	
					
				 $tag=Tag::whereIn('id',explode(',',$multiple))->get();
				}
				else
				{
					$tag=Tag::find(['id'=>1]);

				}

				if($portfolio->update())
				{	$portfolio->tags()->detach(Tag::all()->diff(Tag::find(['id'=>1])));
					$portfolio->tags()->attach($tag);
					return redirect()->route('createportfolios')->with('success','Posted Successfully');
				}	
				else
				{
				return redirect()->route('createportfolios')->with('error','Not Posted');	
					
				}
		}
   
}


}


public function changelink(Request $request)
{
$link=Portfolio::find($request->id);
return json_encode($link);

}

public function savelink(Request $request)
{
	$this->validate($request,[
		'project_link' => 'required|url|unique:portfolios'
		]);
$id=Portfolio::find($request->portfolio_id);
$id->project_link=$request->project_link;
if($id->update())
{
 return redirect()->route('createportfolios')->with('success','Posted Successfully');
}else
{
return redirect()->route('createportfolios')->with('error','Not Posted');}
}



public function deleteportfolio(Request $request)
{
	$portfolio=Portfolio::find($request->id);
	if($portfolio->delete())
	{
		$portfolio->tags()->detach(Tag::all());

		return 'success';
	}
	else
	{
	return 'error';
		
	}
}

public function addtags(Request $request)
{
 
$portfolio=Portfolio::find($request->id);
return json_encode(Tag::all()->diff($portfolio->tags));
	
}

public function saveaddtag(Request $request)
{
	$this->validate($request,[
		'project_category'=>'required',
		]);
	$multiple="";
	if($request->project_category){
				
								if($request->portfolio_id)
								{
									foreach ($request->project_category as $category) {
				
			    					$multiple.=$category.",";
								}
									$portfolio=Portfolio::find($request->portfolio_id);
				 					$tag=Tag::whereIn('id',explode(',',$multiple))->get();
									$portfolio->tags()->attach($tag);
									return redirect()->route('createportfolios')->with('success','Posted Successfully');
								}	
								else
								{
									return redirect()->route('createportfolios')->with('error','Not Posted');	
								}
							}

}


public function removetagid(Request $request)
{
 
$portfolio=Portfolio::find($request->id);
return json_encode(Tag::all()->intersect($portfolio->tags));
	
}


public function removetags(Request $request)
{
 
$this->validate($request,[
		'project_category'=>'required',
		]);
	$multiple="";
	if($request->project_category){
				
								if($request->portfolio_id)
								{
									foreach ($request->project_category as $category) {
				
			    					$multiple.=$category.",";
								}
									$portfolio=Portfolio::find($request->portfolio_id);
				 					$tag=Tag::whereIn('id',explode(',',$multiple))->get();
									$portfolio->tags()->detach($tag);
									return redirect()->route('createportfolios')->with('success','Removed Successfully');
								}	
								else
								{
									return redirect()->route('createportfolios')->with('error','Not Removed');	
								}
							}

}



}