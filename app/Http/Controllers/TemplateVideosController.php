<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Footer;
use App\Title;
use App\TemplateGroup;
use App\TemplateVideos;
use App\Category;
use DB;
use App\Contact;
use App\Logo;
use App\SocialIcon;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
class TemplateVideosController extends Controller
{
    //
    public function add(Request $request)
    {
    	$project = $request->project;
    	$template_data = json_decode($request->template_data);
		
        foreach ($template_data as $k => $v) {
            $template_video = new TemplateVideos;
            $template_video->category_id= $v[0];
            $template_video->name= $v[1];
            $template_video->url= $v[2];
            $template_video->template_group_id= $v[3];
            if($template_video->save()){
                $response['success'] = 'success';
            }else{
                $response['success'] = 'error';
            }
        }
        return \Response::json($response);        
    }
    public function create()
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
        $templategroups = TemplateGroup::orderBy('project', 'ASC')->get();
        $categories = Category::all();
        return view('admin.createtemplatevideos')
        ->with('templategroups',$templategroups)
        ->with('categories',$categories);
    }
    public function view()
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
        $videos = TemplateVideos::with(['category','group'])->get();
        //print_r($video->category->name);
        return view('admin.viewtemplatevideos')
        ->with('templatevideos',$videos);
    }
    public function edit($id)
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
        $templategroups = TemplateGroup::all();
        $categories = Category::all();
        $templatevideo = TemplateVideos::where('id',$id)->first();
        
        return view('admin.edittemplatevideos')
        ->with('templategroups',$templategroups)
        ->with('categories',$categories)
        ->with('templatevideo',$templatevideo);
    }
    public function update($id, Request $request)
    {
        
        $templatevideo = TemplateVideos::find($id);
        
        $templatevideo->category_id= $request['category'];
        $templatevideo->name= $request['templatevideo_name'];
        $templatevideo->url= $request['templatevideo_url'];
        $templatevideo->template_group_id= $request['template_group'];
        if($templatevideo->update()){
            Session::flash('success', 'Customer Info Updated Successfully');
        }else{
            $request->session()->flash('message', 'There was error updating the info!');
        }
        return redirect()->back();
    }
    public function delete($id)
    {
        TemplateVideos::where('id', $id)->delete();
        $response = array();
        $response['success'] = 'success';
        $response['id'] = $id;
        return \Response::json($response);
    }
}
