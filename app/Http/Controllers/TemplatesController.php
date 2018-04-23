<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use App\TemplateVideos;
use App\TemplateGroup;
use App\TemplateField;
use App\UserVideos;
use App\EmailTemplate;
use Auth;
use DB;
use Session;
use Storage;

class TemplatesController extends Controller
{

    public function getTableColumns($table)
    {
        return DB::getSchemaBuilder()->getColumnListing($table);
    }
    public function getTemplate($groupId)
    {

        $user_id_loggedin = Session::get('user_id_loggedin');

        if($user_id_loggedin == ''){
            return redirect()->action(
                'UserAuthController@getLogin'
            );
        }
        $project = TemplateGroup::select('project')->where("id",$groupId)->get()->first();
        $template_field = TemplateField::where("template_group_id",$groupId)->get();
        $common_field = $this->getTableColumns("common_field");
        $emailtemplates = EmailTemplate::all();
        $response['project'] = $project;
        $response['template_field'] = $template_field;
        $response['common_field'] = $common_field;
        $response['template_group_id'] = $groupId;
        $response['emailtemplates'] = $emailtemplates;
        return \Response::json($response);
        /*$group = TemplateGroup::select('project')->where("id",$groupId)->get()->first();
        if(isset($group['project'])){
            return View::make("partials.template".$group['project']);  
        }*/
        //

        /*$uservideos = UserVideos::orderBy('updated_at','DESC')->get();

        return view('videos.videos')
        ->withLogo($logo)
        ->withSocial($social)
        ->withContact($contact)
        ->withUservideos($uservideos)
        ->withTitle($title)
        ->withFooter($footer);*/
    }

}