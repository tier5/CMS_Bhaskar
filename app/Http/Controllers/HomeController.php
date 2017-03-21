<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tenfef\IPFind\IPFind;
use Session;
use App\Tag;
use App\Client;
use App\Portfolio;

class HomeController extends Controller
{

public function index()
{
    if(Portfolio::first())
    {
        $portfolios=Portfolio::take(6)->get();
        return view('Layout.home',compact('portfolios'));
    }
    else
    {
        return view('Layout.home');
    }
}

public function get_details(Request $request) {
   
  
   $ipfind = new IPFind('8e6e5fbb-bc85-41e4-8a90-8995894eb24d');
   $result = $ipfind->fetchIPAddress('8.8.8.8');
   $url = 'https://ipfind.co/flag?ip='.$result->ip_address."&auth=8e6e5fbb-bc85-41e4-8a90-8995894eb24d";
       $input['session']=Session::getid();   
       $input['ip']=$result->ip_address;
       $input['browser_name']=get_browser()->browser;
       $input['browser_platform']=get_browser()->platform;
       $input['path']=$request->path;
       $input['country']=$result->country;
       $input['city']=$result->city;
       $input['status']=1;
       $input['flag_img']=$url;
      //Session::put('key',Session::getid());
        //Session::getid();
    return $input;
   
}


 public function portfolios()
    {
        if(Tag::first())
        {
                $tag_default=Tag::all();
                if(Portfolio::first())
                    { 
                        $portfolios=Portfolio::latest()->get();
                        return view('PortFolio.Portfolios',compact('tag_default','portfolios'));
                         }else
                         {
                            return view('PortFolio.Portfolios',compact('tag_default'));
                          }
        }
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
                        <img src="'.url('/').'/image/portfolio/fullsize/thumbnails/'.$portfolio->project_image.'" class="img-responsive" alt="">
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


public function clientgone(Request $request)
{
    if(Client::first())
    {
        $client=Client::find($request->id);
       }
}

public function getportfolio(Request $request)
{
$portfolio=Portfolio::find($request->id);
return json_encode($portfolio);
}
}
