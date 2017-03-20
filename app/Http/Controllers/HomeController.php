<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tenfef\IPFind\IPFind;
use Session;
use App\Tag;

class HomeController extends Controller
{

public function index()
{
    
	return view('Layout.home');
}

public function get_details(Request $request) {
   
$ipfind = new IPFind(NULL);
$result = $ipfind->fetchIPAddress('8.8.8.8');
$url = 'https://ipfind.co/map?ip='.$result->ip_address."&auth=".null;
$map= base64_encode(file_get_contents($url));
    $input['session']=Session::token();   
    $input['ip']=$result->ip_address;
    $input['browser_name']=get_browser()->browser;
    $input['browser_platform']=get_browser()->platform;
    $input['path']=$request->path;
    $input['country']=$result->country;
    $input['city']=$result->city;
    $input['status']=1;
    $input['flag_img']=$map;
    Session::put('key',Session::token());
    return $input;
   
}


 public function portfolios()
    {
        if(Tag::first())
        {
                $tag_default=Tag::all();
                
                return view('PortFolio.Portfolios',compact('tag_default'));}
            else
            {
                return view('PortFolio.Portfolios');  
            }
    }

public function changetag(Request $request)
{
    if($request)
    {$result='';
        if(Tag::first()){
                $tag=Tag::find($request->id);
                $portfolios=$tag->portfolios;
                foreach($portfolios as $portfolio)
                {
                $result.='<div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="'.url('/').'/image/thumbnails/'.$portfolio->project_image.'" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4>'.$portfolio->project_title.'</h4>
                        <p class="text-muted">'.$portfolio->project_desc.'</p>
                    </div>
                </div>';
                }

                return $result;
                // return json_encode($portfolio);
                }
        else
        {
            return '';
        }
    }
    else
    {
        return 'error fetching request';
    }

}
}
