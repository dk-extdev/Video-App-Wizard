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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/',['as'=>'home','uses'=>'UserAuthController@getLogin']);

//load templates
Route::get('/template/{template_id}', ['as'=>'template', 'uses'=>'TemplatesController@getTemplate']);

//load images from url
Route::post('/imgtourl', ['as'=>'imgtourl', 'uses'=>'VideosController@getImagesFromUrl']);

//User Registration Route List
Route::get('/user-login', ['as'=>'userlogin', 'uses'=>'UserAuthController@getLogin']);
Route::post('/user-login', ['as'=>'user_login', 'uses'=>'UserAuthController@postLogin']);

Route::get('/user-logout', ['as'=>'user-logout', 'uses' => 'UserAuthController@logout']);

//Password Change
Route::get('/password_change', ['as' => 'password_form', 'uses' => 'PasswordChangeController@getChangePassword']);
Route::post('/password_change', ['as' => 'password_form', 'uses' => 'PasswordChangeController@postChangePassword']);

Route::get('/latest_videos', ['as' => 'latest_videos', 'uses' => 'VideosController@getVideos']);

Route::get('/my_videos', ['as' => 'my_videos', 'uses' => 'VideosController@getMyVideos']);
Route::get('/my_purchases', ['as' => 'my_purchases', 'uses' => 'VideosController@my_purchases']);
/* Delete videos */
Route::post('/my_videos/delete/{id}', ['as' => 'my_videos', 'uses' => 'VideosController@deleteMyVideos']);

/* News & Update*/
Route::get('/news', ['as' => 'my_news', 'uses' => 'VideosController@getNews']);


/* user Forget Password */
Route::get('/user-forget-password',['as'=>'user-forget-password','uses'=>'HomeController@getForgetPassword']);
Route::get('/user-password-reset/{token}',['as'=>'user-password-reset','uses'=>'HomeController@resetForgetPassword']);
Route::post('/user-forget-password-submit',['as'=>'user-forget-password-submit','uses'=>'HomeController@submitForgetPassword']);
Route::post('/user-reset-password-submit',['as'=>'user-reset-password-submit','uses'=>'HomeController@ResetSubmitPassword']);

Route::get('/settings', ['as'=>'settings', 'uses'=>'UserAuthController@getProfile']);

Route::post('/update_user_info', ['as'=>'update_user_info', 'uses'=>'UserAuthController@update_user_info']);
Route::post('/update_user_password', ['as'=>'update_user_password', 'uses'=>'UserAuthController@update_user_password']);
Route::get('/create_videos', ['as' => 'create_videos', 'uses' => 'VideosController@createVideos']);
Route::post('/create_videos/page', ['as' => 'create_videos_search', 'uses' => 'VideosController@createVideosSearch']);
Route::post('/create_videos/search', ['as' => 'create_videos_search', 'uses' => 'VideosController@createVideosSearch']);
Route::post('/create_videos/render', ['as' => 'create_videos_render', 'uses' => 'VideosController@createVideosRender']);
Route::post('/create_videos/render-from-file', ['as' => 'create_videos_render_file', 'uses' => 'VideosController@createVideosRenderFromFile']);
Route::post('/receive', ['as' => 'create_videos_receive', 'uses' => 'VideosController@createVideosReceive']);
Route::post('/create_videos/upload', ['as' => 'create_videos_upload', 'uses' => 'VideosController@createVideosUpload']);
Route::post('/create_videos/imgtourl', ['as' => 'create_videos_imgtourl', 'uses' => 'VideosController@createVideosImgToUrl']);



/* Admin */
/*Route::get('/admin',function(){
	return view('admin.login');
});*/
Route::get('/admin',['as'=>'admin_home','uses'=>'AdminController@getLogin']);
Route::get('/admin/login', ['as'=>'adminlogin', 'uses'=>'AdminController@getLogin']);
Route::post('/admin/login', ['as'=>'admin_login', 'uses'=>'AdminController@postLogin']);
Route::get('/admin/dashboard', ['as' => 'admin_dashboard', 'uses' => 'AdminDashboardController@dashboard']);
Route::get('admin-logout', ['as'=>'admin-logout', 'uses' => 'AdminController@logout']);
Route::get('/admin/createcustomer', ['as'=>'admin_create_customer', 'uses'=>'CustomerController@create']);
Route::post('/admin/createcustomer', ['as'=>'admin_add_customer', 'uses'=>'CustomerController@add']);
Route::get('/admin/news', ['as' => 'admin_news', 'uses' => 'NewsController@view']);
Route::get('/admin/createnews', ['as'=>'admin_create_news', 'uses'=>'NewsController@create']);
Route::post('/admin/createnews', ['as'=>'admin_create_news', 'uses'=>'NewsController@add']);
Route::get('/admin/editnews/{id}', ['as' => 'admin_edit_news', 'uses' => 'NewsController@edit']);
Route::post('/admin/updatenews/{id}', ['as' => 'admin_update_news', 'uses' => 'NewsController@update']);
Route::post('/admin/deletenews/{id}', ['as' => 'admin_delete_news', 'uses' => 'NewsController@delete']);


Route::get('/admin/viewtemplate', ['as' => 'admin_view_template', 'uses' => 'TemplateController@view']);
Route::get('/admin/createtemplate', ['as'=>'admin_create_template', 'uses'=>'TemplateController@create']);
Route::post('admin/createtemplate', ['as'=>'admin_create_template', 'uses'=>'TemplateController@add']);





Route::get('/admin/viewcustomer', ['as'=>'admin_view_customer', 'uses'=>'CustomerController@view']);
Route::post('/admin/typeupdate', ['as' => 'typeupdate', 'uses' => 'CustomerController@typeUpdate']);
Route::get('/admin/editcustomer/{id}', ['as' => 'admin_edit_customer', 'uses' => 'CustomerController@edit']);//admin_update_customer
Route::post('/admin/updatecustomer/{id}', ['as' => 'admin_update_customer', 'uses' => 'CustomerController@update']);
Route::post('/admin/deletecustomer/{id}', ['as' => 'admin_delete_customer', 'uses' => 'CustomerController@delete']);

Route::get('/admin/setting', ['as' => 'admin_setting', 'uses' => 'AdminDashboardController@setting']);
Route::post('update_admin_password', ['as'=>'update_admin_password', 'uses'=>'AdminController@update_admin_password']);
Route::post('update_admin_email', ['as'=>'update_admin_email', 'uses'=>'AdminController@update_admin_email']);
Route::post('/admin/suspendcustomer/{id}', ['as' => 'admin_suspend_customer', 'uses' => 'CustomerController@suspend']);



//Route::get('/admin/viewcustomer/{id}', ['as' => 'admin_edit_customer', 'uses' => 'CustomerController@edit']);

/*Route::get('resetPassword/{token}', ['as' => 'resetPassword', function($token)
{
   return View::make('resetPassword')->with('token', $token); 
}]);*/
/*Route::get('admin/login', 'AdminAuth\AuthController@showLoginForm');
Route::post('admin/login', 'AdminAuth\AuthController@login');
Route::group(['middleware'=>['admin']],function(){
	Route::get('/admin','AdminController@index');
	Route::get('/admin/logout','AdminAuth\AuthController@logout');
});*/