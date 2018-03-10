<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Footer;
use App\Title;
use App\TemplateGroup;
use App\TemplateField;
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
                'html_label' => $v[1],
                'type' => $v[2],
                'validation_rules' => $v[3]
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

        $template_fields = DB::select("SELECT *, (SELECT COUNT(*) FROM template_field as f WHERE ff.template_group_id = f.template_group_id) as count FROM template_field as ff WHERE 1");
        $template_groups = DB::table('template_group')->get();
        return view('admin.viewtemplate')
        ->with('template_fields',$template_fields)
        ->with('template_groups',$template_groups);
    }
    public function edit($id)
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
        $templategroupdata = TemplateGroup::where('id', '=', $id)->first();
        $templatefielddata = TemplateField::where('template_group_id', '=', $id)->get();
        return view('admin.edittemplate')
        ->with('templategroupdata',$templategroupdata)
        ->with('templatefielddata',$templatefielddata);
    }
    public function update($id, Request $request)
    {
        $project = $request->project;
        $attr = json_decode($request->attr);
        DB::table('template_group')->where('id', $id)->update( ['project' => $project]);
        DB::table('template_field')->where('template_group_id', '=', $id)->delete(); 
        foreach ($attr as $k => $v) {
            DB::table('template_field')->insert([
                'template_group_id' => $id,
                'title' => $v[0],
                'html_label' => $v[1],
                'type' => $v[2],
                'validation_rules' => $v[3]
            ]);    
        }
        $response = array();
        $response['success'] = 'success';
        return \Response::json($response);
    }
    public function delete($id)
    {
        TemplateGroup::where('id', $id)->delete();
        TemplateField::where('template_group_id', $id)->delete();
        $response = array();
        $response['success'] = 'success';
        $response['id'] = $id;
        return \Response::json($response);
    }
}
