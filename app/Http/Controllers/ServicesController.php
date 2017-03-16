<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Service;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Tag;

class ServicesController extends Controller
{

	public function index()
	{
		return view('PortFolio.Portfolios');
	}


	public function showbyid(Service $project_id)
		{	
			if(Service::first())
			{
			$related_projects=Service::where('id','!=',$project_id->id)->get();
			return view('Services.portfolio_details',compact('project_id','related_projects'));
			}

			return view('Services.portfolio_details',compact('project_id'));
		}


	public function showportfolios()
	{
		if(Service::first()){
		$services=Service::latest()->get();
		return view('AdminLayouts.Admin.PortFolio.showportfolio',compact('services'));
		}
		return view('AdminLayouts.Admin.PortFolio.showportfolio');
		
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
			'project_link'=>'required|url',
			'project_category'=>'required'
		]);
if($request->project_title&&)
    if($request->hasFile('file_upload')){

       $input=File::name($request->file_upload->getClientOriginalName()).time().mt_rand(0,mt_getrandmax()).".".$request->file_upload->getClientOriginalExtension();
		$destination=public_path()."/image/";


		

		if($request->file_upload->move($destination,$input))
			{


				$service=new Service();
				$service->project_title=$request->project_title;
				$service->project_desc=$request->project_description;
				$service->project_details1=$request->project_detail1;
				$service->project_details2=$request->project_detail2;
				$service->project_details3=$request->project_detail3;
				$service->project_image=$input;
				$service->project_link=$request->project_link;
				$service->project_category=$request->project_category;
				if($service->save())
				{
					return 'success';
				}	
				else
				{
				return 'error';
					
				}

			}
			
		}
		else
		{


				$service=new Service();
				$service->project_title=$request->project_title;
				$service->project_desc=$request->project_description;
				$service->project_details1=$request->project_detail1;
				$service->project_details2=$request->project_detail2;
				$service->project_details3=$request->project_detail3;
				$service->project_image="default.jpg";
				$service->project_link=$request->project_link;
				$service->project_category=$request->project_category;
				if($service->save())
				{
					return 'success';
				}	
				else
				{
				return 'error';
					
				}


		}

}


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
	$this->validate($request,[

			'tag_name'=>'required',
		]);

	$tags=new Tag();
	$tags->name=$request->tag_name;
	if($tags->save())
	{
		return 'success';
	}
	else
	{
		return 'error';

	}

}


}
    //
