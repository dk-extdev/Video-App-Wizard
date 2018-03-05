<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Footer;
use App\Title;
use App\News;
use Mail;
use DB;

use App\Http\Requests;
use App\Contact;
use App\Logo;
use App\SocialIcon;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
class NewsController extends Controller
{
    //
    public function add(Request $request)
    {
        
        $news= new News();
        $news->app_name= $request['app_name'];
        $news->news_title= $request['news_title'];
        $news->news_description= $request['news_description'];
        $news->support_email= $request['support_email'];
        $news->created_at= date('Y-m-d H:i:s');
        $news->updated_at= date('Y-m-d H:i:s');
        if($news->save()){
            Session::flash('success', 'New News Addeed Successfully');
        }else{
            $request->session()->flash('message', 'There was error saving the info!');
        }
        return redirect()->back();
    }
    public function edit($id)
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
        $data = News::where('id', '=', $id)->first();
        //print_r($data);
        return view('admin.editnews')->with('newsdata',$data);
    }
    public function create()
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
        
        return view('admin.createnews');
    }
    public function update($id, Request $request)
	{
		$admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
		$news = News::find($id);
		$news->app_name= $request['app_name'];
        $news->news_title= $request['news_title'];
        $news->news_description= $request['news_description'];
        $news->support_email= $request['support_email'];
        $news->created_at= date('Y-m-d H:i:s');
        $news->updated_at= date('Y-m-d H:i:s');
        
        if($news->save()){
            Session::flash('success', 'News Info Updated Successfully');
        }else{
            $request->session()->flash('message', 'There was error saving the info!');
        }
        return redirect()->back();
    }
    public function view()
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
        

        $newsdata = News::all();
        //$newsdata->htmlspecialchars_decode
        return view('admin.news')
        ->with('newsdata',$newsdata);
    }
    public function delete($id)
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
        News::where('id', $id)->delete();
        $response = array();
        $response['success'] = 'success';
        $response['id'] = $id;
        return \Response::json($response);
    }
}
