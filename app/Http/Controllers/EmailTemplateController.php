<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Footer;
use App\Title;
use App\EmailTemplate;
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
class EmailTemplateController extends Controller
{
    //
    public function add(Request $request)
    {
        
        $emailtemplate= new EmailTemplate();
        $emailtemplate->name= $request['email_template_name'];
        $emailtemplate->email_subject= $request['email_subject'];
        $emailtemplate->email_body= $request['email_body'];
        $emailtemplate->created_at= date('Y-m-d H:i:s');
        $emailtemplate->updated_at= date('Y-m-d H:i:s');
        if($emailtemplate->save()){
            Session::flash('success', 'New Email Template Addeed Successfully');
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
        $data = EmailTemplate::where('id', '=', $id)->first();
        return view('admin.editemailtemplate')->with('emailtemplatedata',$data);
    }
    public function create()
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
        
        return view('admin.createemailtemplate');
    }
    public function update($id, Request $request)
	{
		$admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
		$emailtemplate = EmailTemplate::find($id);
        $emailtemplate->name= $request['email_template_name'];
		$emailtemplate->email_subject= $request['email_subject'];
        $emailtemplate->email_body= $request['email_body'];
        $emailtemplate->updated_at= date('Y-m-d H:i:s');
        
        if($emailtemplate->save()){
            Session::flash('success', 'Email Template Info Updated Successfully');
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
        

        $emailtemplatedata = EmailTemplate::all();
        return view('admin.emailtemplate')
        ->with('emailtemplatedata',$emailtemplatedata);
    }
    public function delete($id)
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
        EmailTemplate::where('id', $id)->delete();
        $response = array();
        $response['success'] = 'success';
        $response['id'] = $id;
        return \Response::json($response);
    }
}
