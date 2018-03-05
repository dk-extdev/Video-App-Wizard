<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Footer;
use App\Title;
use App\News;
use DB;
use App\Contact;
use App\Logo;
use App\SocialIcon;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
class TemplateController extends Controller
{
    //
    public function add(Request $request)
    {
    	$project = $request->project;
    	$attr = json_decode($request->attr);
		
        if(isset($project)){
        	DB::table('template_group')->insert([
        		'project' => $project
        	]);	
        	$template_group_id = DB::table('template_group')->orderBy('id', 'desc')->first()->id;
        }
        foreach ($attr as $k => $v) {
        	DB::table('template_field')->insert([
        		'template_group_id' => $template_group_id,
        		'title' => $v[0],
        		'type' => $v[1],
        		'validation_rules' => $v[2]
        	]);    
        }
        $response['success'] = 'success';
        $response['project'] = $project;
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
        
        return view('admin.createtemplate');
    }
    public function view()
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }

        $templates = DB::table('template_group')
        ->select(DB::raw('*, (SELECT COUNT(*) FROM template_field as f WHERE f.template_group_id = template_group.id) as count'))->get();

        
        return view('admin.viewtemplate')
        ->with('templates',$templates);
    }
}
