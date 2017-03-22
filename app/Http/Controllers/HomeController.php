<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tenfef\IPFind\IPFind;
use Session;
use App\Tag;
use App\Client;
use App\Portfolio;
use Carbon\Carbon;


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
   
  if(!Session::has('key')){
     $ipfind = new IPFind('8e6e5fbb-bc85-41e4-8a90-8995894eb24d');
     $result = $ipfind->fetchIPAddress('8.8.8.8');
     $url = 'https://ipfind.co/flag?ip='.$result->ip_address."&auth=8e6e5fbb-bc85-41e4-8a90-8995894eb24d";
            $client=new Client();
            $client->session_id=Session::getid(); 
            $client->ip=$result->ip_address;
            $client->flag_img=$url;
            $client->browser_name=get_browser()->browser;
            $client->browser_platform=get_browser()->platform;
            $client->page=$request->path;
            $client->country=$result->country;
            $client->city=$result->city;
            $client->status=1;
            if($client->save())
              { Session::put('key',Session::getid());
                echo 'success';}
            else
              {echo 'error';}
     }
     else
     {
      echo 'already there';
     }
}


 public function portfolios()
    {
        if(Tag::first())
        {
                $tag_default=Tag::all();
                if(Portfolio::first())
                    { 
                        $portfolios=Portfolio::paginate(6);
                      
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


public function updateclient(Request $request)
{
 // return $request->id;
$var=$request->id;
$date=Carbon::now();
$update=Client::where('session_id',$var)->update(['updated_at'=>$date]);
if($update)
  {return 'success';}
else
{
  return 'error';
}

}

public function clientgone()
{
   $datetime1=Carbon::now()->addSeconds(-5);
   
 //  $clients=Client::where('updated_at','<=',$datetime1)->update(['status'=>0]);
   $clients=Client::all();
           foreach($clients as $client)
           {
             if($client->updated_at<=$datetime)
             {
                $client->status=0;
                $client->update();    
             }
             else
             {
              $client->status=1;
              $client->update();
             }
           }
}

public function getportfolio(Request $request)
{
$portfolio=Portfolio::find($request->id);
return json_encode($portfolio);
}


}
