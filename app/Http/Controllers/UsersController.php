<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

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
		return view('AdminLayouts.Admin.adminindex');
	}

}
