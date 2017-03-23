<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middlewareGroups'=>['web']],function(){
// session([
	
// 	]);
//Session::put('ip',$ip=getRealIpAddr());
//Session::put('name',$browser_name=browser_name());
//Session::put('platform',$browser_platform=browser_platform());
//Session::put('version',$browser_version=browser_version());

Route::get('/','HomeController@index')->name('Home');

Route::post('/changetag','HomeController@changetag')->name('changetag');

Route::get('/home','UsersController@home')->name('redirect');

Route::get('/backend/admin','UsersController@adminlogin')->name('adminlogin')->middleware('guest');

Route::get('/login','UsersController@loginredirect')->name('redirect');

Route::post('/signin','UsersController@login')->name('login');

Route::get('/showportfolios','HomeController@portfolios')->name('portfolios');

Route::post("/getip",'HomeController@get_details')->name('ip');


Route::get("/goneclient",'HomeController@clientgone')->name('client_gone');

Route::post('/getportfolio',"HomeController@getportfolio")->name('getportfolio');

Route::post('/updateclient',"HomeController@updateclient")->name('updateclient');

Route::post('/storeclientname',"HomeController@storename")->name('updatename');

Route::post('/sendmessage','ChatsController@save')->name('sendmessage');
});










Route::group(['middleware'=>['web','auth']],function(){


Route::get('/adminhome','UsersController@adminhome')->name('Admin_home');

Route::get('/logout','UsersController@logout')->name('logout');


Route::get('/createportfolios','PortfoliosController@createportfolios')->name('createportfolios');

Route::post('/storeportfolios','PortfoliosController@storeportfolios')->name('storeportfolios');

Route::get('/showportfoliotable','PortfoliosController@showportfolios')->name('showportfoliotable');

Route::post('/viewportfolioadmin','PortfoliosController@viewportfolioadmin')->name('viewportfolioadmin');

Route::get('/updateportfolioadmin/{id}','PortfoliosController@updateportfolioadmin')->name('updateportfolios');

Route::post('/saveupdatedportfolio','PortfoliosController@saveupdatedportfolioadmin')->name('saveupdateportfolios');

Route::post('/changelink','PortfoliosController@changelink')->name('changelink');

Route::post('/savelink','PortfoliosController@savelink')->name('savelink');

Route::post('/deleteportfolios','PortfoliosController@deleteportfolio')->name('deleteportfolios');

Route::post('/addtags','PortfoliosController@addtags')->name('addTag');

Route::post('/saveaddtag','PortfoliosController@saveaddtag')->name('saveaddtag');

Route::post('/removetagid','PortfoliosController@removetagid')->name('removeTagid');

Route::post('/removetags','PortfoliosController@removetags')->name('removetags');


Route::get('/createtags','TagsController@createtags')->name('createtags');

Route::post('/storetags','TagsController@storetags')->name('storetags');

Route::get('/showtagstable','TagsController@showtags')->name('showtagtable');

Route::post('/edittags','TagsController@edittags')->name('edittags');

Route::post('/deletetags','TagsController@deletetags')->name('deletetags');

Route::post('/updatetags','TagsController@updatetags')->name('saveedittags');



/*
Route::get('/auth/register', function () {
  
	return view('Auth.auth');

})->name('register')->middleware('guest');

Route::get('/auth/login', function () {
    return view('Auth.auth');
})->name('login')->middleware('guest');


Route::post('/registration','UsersController@register')->name('registration');*/

//Route::post('/login','UsersController@login')->name('login')->middleware('auth');

// Route::get('/login','UsersController@logredirect')->name('logredirect');

/*

Route::post('/createpost','PostsController@store')->name('createpost')->middleware('auth');



Route::get('/show/{id}','PostsController@showbyid')->name('showpost');

Route::post('/createcomments','CommentsController@store')->name('createcomments')->middleware('auth');

Route::post('/createreplies','RepliesController@store')->name('createreplies')->middleware('auth');

Route::get('/home','UsersController@home');

Route::get('/services','ServicesController@show')->name('services')->middleware('auth');

Route::post('/createprojects','ServicesController@create')->name('createprojects')->middleware('auth');


Route::get('/showproject/{project_id}','ServicesController@showbyid')->name('showprojectbyid')->middleware('auth');

Route::post('/updatecomments/{id}','CommentsController@update')->name('updatecomments')->middleware('auth');

Route::post('/deletecomments/{id}','CommentsController@delete')->name('deletecomments')->middleware('auth');

Route::post('/updatereplies/{id}','RepliesController@update')->name('updatereplies')->middleware('auth');

Route::post('/deletereplies/{id}','RepliesController@delete')->name('deletereplies')->middleware('auth');

Route::post('/createsessions','SessionsController@store')->name('createsessions');*/


});