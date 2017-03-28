<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Client;
use App\Block;

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
			Session::flush();
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

public function blockuser(Request $request)
{

$blocked=new Block();
$blocked->client_id=$request->id;
$blocked->status=1;
$client=Client::where('id',$request->id)->update(['status'=>0]);
if($blocked->save()&&$client)
{
	return 'success';
}
else
{
	return 'error';
}

}
	
}
