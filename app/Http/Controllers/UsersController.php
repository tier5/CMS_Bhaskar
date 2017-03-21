<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Client;

class UsersController extends Controller
{

public function adminlogin()
{
		return view('Auth.Login.Login');

}



public function login(Request $request)

 {
		
		 $name=$request->name;
		 $password=$request->password;
		
		if($name&&$password)
		{
		
		$valid=['name'=>$name,'password'=>$password];
	
		if(Auth::validate($valid))
		{
			if(Auth::attempt($valid,true))
				{
				
					return redirect()->intended('adminhome');		
				}
			else
				{
					return redirect()->route('adminlogin')->with('Invalid_User','Invalid Username Or Password');
				}
		}
				
		else
		{
			
			return redirect()->route('adminlogin')->with('Invalid_User','Invalid Username Or Password');
		}

		}
		else
		{
			if(!$name)
			{
				return redirect()->route('adminlogin')->with('Validation_Required','Validate Name');
			}
			if(!$password)
			
			{return redirect()->route('adminlogin')->with('Validation_Required','Validate Password');}

		}

	}


public function home()

	{
			return redirect()->route('Home');
	}


		public function logout()

	{
			Auth::logout();
			return redirect()->route('Home');
	}


	public function loginredirect()
	{

		return redirect()->route('Home');
	}



	public function adminhome()
	{

		if(Client::first())
		{
			$clients=Client::all();
			return view('AdminLayouts.Admin.adminindex',compact('clients'));		
		}
		else
		{
			return view('AdminLayouts.Admin.adminindex');		
		}
	}


	public function storeclientdetails(Request $request)
	{
		if($request){
					$client=new Client();
					$client->session_id=$request->data['session'];
					$client->ip=$request->data['ip'];
					$client->flag_img=$request->data['flag_img'];
					$client->browser_name=$request->data['browser_name'];
					$client->browser_platform=$request->data['browser_platform'];
					$client->page=$request->data['path'];
					$client->country=$request->data['country'];
					$client->city=$request->data['city'];
					$client->status=$request->data['status'];
					if($client->save())
						{	Session::put('key',Session::getid());
							echo 'success';}
					else
						{echo 'error';}
		}
	}
}
