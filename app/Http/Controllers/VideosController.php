<?php

namespace App\Http\Controllers;

use AWS;
use App\Category;
use App\CommonField;
use App\Contact;
use App\Footer;
use App\Http\Requests;
use App\Infrastructure\ReplicateQueueClient;
use App\Jobs\SendToRender;
use App\Logo;
use App\Mail\VideoRendered;
use App\News;
use App\Repositories\UserRepository;
use App\SocialIcon;
use App\Tags;
use App\TemplateField;
use App\TemplateGroup;
use App\TemplateVideos;
use App\Title;
use App\UserVideos;
use App\UserVideosFields;
use Auth;
use Aws\Exception\AwsException;
use Aws\Sqs\SqsClient;
use DB;
use Dawson\Youtube\Facades\Youtube;
use FFMpeg;
use Illuminate\Http\Request;
use Illuminate\Queue\SqsQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use League\Flysystem\MountManager;
use Log;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use Storage;
use Validator;

class VideosController extends Controller
{

    public function getNews()
    {

        $user_id_loggedin = Session::get('user_id_loggedin');

        if($user_id_loggedin == ''){
            return redirect()->action(
                'UserAuthController@getLogin'
            );
        }

        $logo = Logo::first();
        $social = SocialIcon::first();
        $contact = Contact::first();
        $title = Title::first();
        $footer = Footer::first();

        $usernews = News::orderBy('updated_at','DESC')->get();

        return view('videos.news')
        ->with('usernews',$usernews)
        ->withLogo($logo)
        ->withSocial($social)
        ->withContact($contact)
        ->withTitle($title)
        ->withFooter($footer);
    }

    public function getVideos()
    {

        $user_id_loggedin = Session::get('user_id_loggedin');

        if($user_id_loggedin == ''){
            return redirect()->action(
                'UserAuthController@getLogin'
            );
        }

        $logo = Logo::first();
        $social = SocialIcon::first();
        $contact = Contact::first();
        $title = Title::first();
        $footer = Footer::first();

        $uservideos = UserVideos::orderBy('updated_at','DESC')->get();

        return view('videos.videos')
        ->withLogo($logo)
        ->withSocial($social)
        ->withContact($contact)
        ->withUservideos($uservideos)
        ->withTitle($title)
        ->withFooter($footer);
    }

    public function createVideos()
    {

        $user_id_loggedin = Session::get('user_id_loggedin');

        if($user_id_loggedin == ''){
            return redirect()->action(
                'UserAuthController@getLogin'
            );
        }
        $title = Title::first();
        $template_videos = DB::table('template_videos')->select("*", 'template_videos.id as video_id')
            ->leftJoin('template_group', 'template_group.id', '=', 'template_videos.template_group_id')
            ->paginate(12);
        $category = Category::get();
        return view('videos.create')
        ->withTitle($title)
        ->with('template_videos',$template_videos)
        ->with('category', $category);
    }
    public function createVideosSearch(Request $request)
    {

        $user_id_loggedin = Session::get('user_id_loggedin');

        if($user_id_loggedin == ''){
            return redirect()->action(
                'UserAuthController@getLogin'
            );
        }
        //echo $request->category;
        $search = $request->searchkey;
        if($request->sort=="date"){
            $sort = "created_at";
        }else{
            $sort = "name";
        }
        if($request->category!=""){
            $categories = explode(",", $request->category);
            $template_videos = DB::table('template_videos')->select("*", 'template_videos.id as video_id')
                ->leftJoin('template_group', 'template_group.id', '=', 'template_videos.template_group_id')
                ->where('name', 'like', '%' . $search . '%')->whereIn('category_id', $categories)->orderBy($sort, 'ASC')
                ->paginate(12);
        }else{
            $template_videos = DB::table('template_videos')->select("*", 'template_videos.id as video_id')
            ->leftJoin('template_group', 'template_group.id', '=', 'template_videos.template_group_id')
            ->where('name', 'like', '%' . $search . '%')->orderBy($sort, 'ASC')
            ->paginate(12);
        }
        return view('videos.page')->with('template_videos',$template_videos)->render();
    }

    public function createVideosReceive(Request $request)
    {
        // validate request
        $validatedData = $request->validate([
            'project_id' => 'required|exists:user_videos,project_id',
            'video_url' => 'required|url'
        ]);

        // update database record
        // TBD: extract
        $videoModel = UserVideos::where('project_id', $validatedData['project_id'])->first();
        $videoModel->video_url = $validatedData['video_url'];
        $videoModel->status = 'Completed';
        $videoModel->save();

        // upload video to youtube
        // TBD: extract
        $videoUrlParsed = explode('/', $request->input('video_url'));
        $filename = end($videoUrlParsed);

        $mountManager = new MountManager([
            's3' => Storage::disk('s3')->getDriver(),
            'local' => Storage::disk('local')->getDriver(),
        ]);
        $mountManager->copy('s3://' . $filename, 'local://' . $filename . '.mov');

        $pathPrefix = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $fullPath = $pathPrefix . $filename . '.mov';
        $video = Youtube::upload($fullPath, [
                    'title' => $videoModel->commonFields->customer_first_name . "'s Demo Video",
                    'description' => 'Generated by VideoDashApp'
                ],
                'unlisted');

        $videoModel->youtube_id = $video->getVideoId();
        $videoModel->save();

        // send email to customer
        Mail::to($videoModel->commonFields->customer_email)
            ->send(new VideoRendered($videoModel));

        return "OK";
    }

     public function createVideosRender(
        Request $request,
        ReplicateQueueClient $client,
        UserRepository $userRepository)
    {

        // authorize user (TBD: extract)
        $currentUserId = Session::get('user_id_loggedin');
        if (! $currentUserId) {
            return redirect()->action(
                'UserAuthController@getLogin'
            );
        }

        // if over the daily limit, do not proceed
        if ($userRepository->overDailyLimit(Auth::guard('user')->user())) {
            $response['errors'] = 'You are over the daily limit! The limit will be reset at midnight.';
            $response['success'] = 'failed';
            return \Response::json($response);
        }

        // gather common data - not specific to template
        $commonData = $request->only(CommonField::FILLABLE);

        // load common validation rules
        $validationRules = CommonField::VALIDATION_RULES;

        // gather project fields - not specific to template
        $project = $request->only([
            'project_title',
            'template_video_id'
        ]);

        // gather template group and fields
        $video = TemplateVideos::with(['group', 'group.fields'])
                               ->findOrFail((int) $project['template_video_id']);

        // compile template data
        $templateData = [];
        $randomId = md5(uniqid(mt_rand(), true));
        $templateData['id'] = $randomId;
        $templateData['output'] = $randomId;
        $templateData['project'] = $video->group->project;
        $templateData['customer_main_video'] = $video->customer_main_video;
        $templateData['customer_name'] = $commonData['customer_first_name'];
        foreach ($video->group->fields as $field) {
            if ($request[$field->title]) {
                $templateData[$field->title] = $request[$field->title];
            }

            // add custom validation rules if present
            $rules = $field->validation_rules;
            if ($rules) {

                // if the field is not mandatory, only validate it if present
                if (! $field->mandatory) {
                    $rules = 'sometimes|' . $rules;
                }

                $validationRules[$field->title] = $rules;
            }
        }

        // merge common data and template data
        $completeData = array_merge($commonData, $templateData);

        $response = [];

        // validate the complete data against the complete validation rules
        $validator = Validator::make(
            $completeData,
            $validationRules
        );

        if ($validator->fails()) {
            $response['success'] = 'failed';
            $response['errors'] = $validator->errors();
            return \Response::json($response);
        }

        DB::beginTransaction();

        try {

            // save common fields
            $commonFieldId = CommonField::create($commonData)->id;

            // save user video
            $userVideoData = [
                'project_id' => $templateData['id'],
                'project_title' => $project['project_title'],
                'user_id' => $currentUserId,
                'common_field_id' => $commonFieldId,
                'template_video_id' => (int) $project['template_video_id'],
                'status' => 'Pending'
            ];
            $userVideoId = UserVideos::create($userVideoData)->id;

            // save user video <-> template field values
            foreach ($video->group->fields as $field) {
                UserVideosFields::create([
                    'user_videos_id' => (int) $userVideoId,
                    'template_fields_id' => (int) $field->id,
                    'value' => $templateData[$field->title] ?? '',
                ]);
            }

        } catch (\Throwable $e) {
            DB::rollBack();
            $response['errors'] = 'Saving project data to DB failed!';
            $response['success'] = 'failed';
            return \Response::json($response);
        }

        try {

            // send SQS message
            $client->sendMessage($completeData);
        } catch (\Throwable $e) {
            DB::rollBack();
            $response['errors'] = 'Failed sending SQS message! DB data has been discarded.';
            $response['success'] = 'failed';
            return \Response::json($response);
        }

        DB::commit();
        $response['success'] = 'success';
        return \Response::json($response);
    }

    public function createVideosRenderFromFile(
        Request $request,
        ReplicateQueueClient $client,
        UserRepository $userRepository)
    {

        // authorize user (TBD: extract)
        $currentUserId = Session::get('user_id_loggedin');
        if (! $currentUserId) {
            return redirect()->action(
                'UserAuthController@getLogin'
            );
        }

        // gather common data - not specific to template
        $commonData = $request->only(CommonField::FILLABLE);

        // load common validation rules
        $validationRules = CommonField::VALIDATION_RULES;

        // gather project fields - not specific to template
        $project = $request->only([
            'project_title',
            'template_video_id'
        ]);

        // gather template group and fields
        $video = TemplateVideos::with(['group', 'group.fields'])
                               ->findOrFail((int) $project['template_video_id']);

        // gather mapped data from the csv
        $mappedData = json_decode($request->input('mapped_data'), true);

        // compile template data
        $templateData = [];
        $templateData['project'] = $video->group->project;
        $templateData['customer_main_video'] = $video->customer_main_video;

        foreach ($mappedData as $row) {

            if ($userRepository->overDailyLimit(Auth::guard('user')->user())) {
                $response['errors'] = 'You are over the daily limit! The limit will be reset at midnight.';
                $response['success'] = 'failed';
                return \Response::json($response);
            }

            // generate random id for this row
            $randomId = md5(uniqid(mt_rand(), true));
            $templateData['id'] = $randomId;
            $templateData['output'] = $randomId;

            // process common fields
            $commonData['customer_first_name'] = $row['customer_first_name'];
            $commonData['customer_last_name'] = $row['customer_last_name'];
            $templateData['customer_name'] = $commonData['customer_first_name'];
            $commonData['customer_email'] = $row['customer_email'];

            foreach ($video->group->fields as $field) {
                if ($row[$field->title]) {
                    $templateData[$field->title] = $row[$field->title];
                }

                // add custom validation rules if present
                $rules = $field->validation_rules;
                if ($rules) {

                    // if the field is not mandatory, only validate it if present
                    if (! $field->mandatory) {
                        $rules = 'sometimes|' . $rules;
                    }

                    $validationRules[$field->title] = $rules;
                }
            }

            // merge common data and template data
            $completeData = array_merge($commonData, $templateData);

            $response = [];

            // validate the complete data against the complete validation rules
            $validator = Validator::make(
                $completeData,
                $validationRules
            );

            if ($validator->fails()) {
                $response['success'] = 'failed';
                $response['errors'] = $validator->errors();
                return \Response::json($response);
            }

            DB::beginTransaction();
            try {

                // save common fields
                $commonFieldId = CommonField::create($commonData)->id;

                // save user video
                $userVideoData = [
                    'project_id' => $templateData['id'],
                    'project_title' => $project['project_title'],
                    'user_id' => $currentUserId,
                    'common_field_id' => $commonFieldId,
                    'template_video_id' => (int) $project['template_video_id'],
                    'status' => 'Pending'
                ];
                $userVideoId = UserVideos::create($userVideoData)->id;

                // save user video <-> template field values
                foreach ($video->group->fields as $field) {
                    UserVideosFields::create([
                        'user_videos_id' => (int) $userVideoId,
                        'template_fields_id' => (int) $field->id,
                        'value' => $templateData[$field->title] ?? '',
                    ]);
                }

            } catch (\Throwable $e) {
                DB::rollBack();
                $response['errors'] = 'Saving project data to DB failed!';
                $response['success'] = 'failed';
                return \Response::json($response);
            }

            try {

                // send SQS message
                $client->sendMessage($completeData);
            } catch (\Throwable $e) {
                DB::rollBack();
                $response['errors'] = 'Failed sending SQS message! DB data has been discarded.';
                $response['success'] = 'failed';
                return \Response::json($response);
            }

            DB::commit();
        }

        $response['success'] = 'success';
        return \Response::json($response);
    }

    public function createVideosUpload(Request $request)
    {
        $user_id_loggedin = Session::get('user_id_loggedin');
        if($user_id_loggedin == ''){
            return redirect()->action(
                'UserAuthController@getLogin'
            );
        }
        $image = $request->file('uploadImgfile');
        $imgTarget = $request->imgTarget;
        $imageName = 'img-'.time().'.'.$image->getClientOriginalExtension();
        $t = Storage::disk('s3')->put($imageName, file_get_contents($image), 'public');
        $imageName = Storage::disk('s3')->url($imageName);
        if($imageName){
            $response['success'] = 'success';
            $response['imgUrl'] = $imageName;
            $response['imgTarget'] = $imgTarget;
        }else{
            $response['success'] = 'failed';
        }
        return \Response::json($response);
    }

    public function getMyVideos()
    {

        $logo = Logo::first();
        $social = SocialIcon::first();
        $contact = Contact::first();
        $title = Title::first();
        $footer = Footer::first();

        $user_id_loggedin = Session::get('user_id_loggedin');

        if($user_id_loggedin == ''){
            return redirect()->action(
                'UserAuthController@getLogin'
            );
        }
        $data['pendingvideos'] = UserVideos::orderBy('user_videos.id','DESC')->where("user_id","=",$user_id_loggedin)->where("status","!=",'Completed')->leftJoin('common_field', 'user_videos.common_field_id', '=', 'common_field.id')->get();
        $data['completedvideos'] = UserVideos::orderBy('user_videos.id','DESC')->where("user_id","=",$user_id_loggedin)->where("status","=",'Completed')->leftJoin('common_field', 'user_videos.common_field_id', '=', 'common_field.id')->get();
        return view('videos.my_videos',$data)
        ->withLogo($logo)
        ->withSocial($social)
        ->withContact($contact)
        ->withTitle($title)
        ->withFooter($footer);
    }
    public function deleteMyVideos($id)
    {
        $logo = Logo::first();
        $social = SocialIcon::first();
        $contact = Contact::first();
        $title = Title::first();
        $footer = Footer::first();

        $user_id_loggedin = Session::get('user_id_loggedin');

        if($user_id_loggedin == ''){
            return redirect()->action(
                'UserAuthController@getLogin'
            );
        }
        UserVideos::where('id', $id)->delete();
        $response = array();
        $response['success'] = 'success';
        return \Response::json($response);
    }

    public function my_purchases()
    {

        $user_id_loggedin = Session::get('user_id_loggedin');
        if($user_id_loggedin == ''){
            return redirect()->action(
                'UserAuthController@getLogin'
            );
        }

        $logo = Logo::first();
        $social = SocialIcon::first();
        $contact = Contact::first();
        $title = Title::first();
        $footer = Footer::first();

        $user_id_loggedin = Session::get('user_id_loggedin');
        $data['data_here'] = 'Data HEre';

        return view('videos.my_purchases',$data)
        ->withLogo($logo)
        ->withSocial($social)
        ->withContact($contact)
        ->withTitle($title)
        ->withFooter($footer);
    }

    public function make_video_test()
    {
        echo "string";

        $logger = '';

        $ffmpeg = FFMpeg\FFMpeg::create([
            'ffmpeg.binaries'  => '../assets/ffmpeg/bin/ffmpeg.exe',
            'ffprobe.binaries' => '../assets/ffmpeg/bin/ffprobe',
            'timeout'          => 3600,
            'ffmpeg.threads'   => 1,
        ]);
        $video = "http://www.dailymotion.com/cdn/H264-176x144-2/video/x56cpxc.mp4?auth=1483507736-2562-c6cmioov-b1be3ef782de022e4cdfedb4c674859b";
        $video = $ffmpeg->open($video);
        $video
        ->filters()
        ->resize(new FFMpeg\Coordinate\Dimension(320, 240))
        ->synchronize();
        $video
        ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(10))
        ->save('frame.jpg');
        $video
        ->save(new FFMpeg\Format\Video\X264(), 'export-x264.mp4')
        ->save(new FFMpeg\Format\Video\WMV(), 'export-wmv.wmv')
        ->save(new FFMpeg\Format\Video\WebM(), 'export-webm.webm');
    }
    public function createVideosImgToUrl(Request $request){
        //include(app_path() . '\functions\simple_html_dom.php');
        $html = file_get_html($request->url);
        //$html = str_get_html(file_get_contents('https://webdew.tech/'));
        $images = $html->find('img');
        $result_image = array();
        foreach($html->find('img') as $element) {
            $parsedUrl = parse_url($element->src);
            if(isset($parsedUrl['scheme']) && ($parsedUrl['scheme'] == 'https' || $parsedUrl['scheme'] == 'http')){
               if (preg_match('/(\.jpg|\.png|\.bmp)$/i', $element->src)) {
                   array_push($result_image, $element->src);
                }
            }else{
                $fullUrl = parse_url($request->url)['scheme']."://".parse_url($request->url)['host'];
                if (preg_match('/(\.jpg|\.png|\.bmp)$/i', $element->src)) {
                   array_push($result_image, $fullUrl.$element->src);
                }
            }
            
        }
        $response = [];
        $response['result_image'] = $result_image;
        $response['url'] = $request->url;
        $response['id'] = $request->id;
        return \Response::json($response);
    }

}