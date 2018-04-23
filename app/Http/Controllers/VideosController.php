<?php

namespace App\Http\Controllers;

use App\User;
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
use App\EmailTemplate;
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
    private function getYouTubeId($url)
    {
        $url = str_replace('https://', 'http://', $url);
        if (!stristr($url, 'http://') && (strlen($url) != 11)) {
            $url = 'http://' . $url;
        }
        $url = str_replace('http://www.', 'http://', $url);

        if (strlen($url) == 11) {
            $code = $url;
        } else if (preg_match('/http:\/\/youtu.be/', $url)) {
            $url = parse_url($url, PHP_URL_PATH);
            $code = substr($url, 1, 11);
        } else if (preg_match('/watch/', $url)) {
            $arr = parse_url($url);
            parse_str($arr['query'], $result);
            $code = $result['v'] ?? false;
        } else if (preg_match('/http:\/\/youtube.com\/v/', $url)) {
            $url = parse_url($url, PHP_URL_PATH);
            $code = substr($url, 3, 11);
        } else if (preg_match('/http:\/\/youtube.com\/embed/', $url, $matches)) {
            $url = parse_url($url, PHP_URL_PATH);
            $code = substr($url, 7, 11);
        } else if (preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=[0-9]/)[^&\n]+|(?<=v=)[^&\n]+#", $url, $matches) ) {
            $code = substr($matches[0], 0, 11);
        } else {
            $code = false;
        }

        if ($code && (strlen($code) < 11)) {
            $code = false;
        }

        return $code;
    }

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
        if (!DB::table('youtube_access_tokens')
            ->latest('created_at')
            ->where('user_id', $user_id_loggedin)
            ->first()) {
            Session::flash('error', 'Youtube account must be linked before creating videos');
            return redirect('settings');
        }

        $title = Title::first();
        $template_videos = DB::table('template_videos')->select("*", 'template_videos.id as video_id')
            ->leftJoin('template_group', 'template_group.id', '=', 'template_videos.template_group_id')
            ->where('flag', '=', 1)
            ->paginate(12);
        $category = Category::orderBy('name','ASC')->get();
        $emailtemplates = EmailTemplate::all();
        return view('videos.create')
        ->withTitle($title)
        ->with('template_videos',$template_videos)
        ->with('emailtemplates',$emailtemplates)
        ->with('category', $category);
    }

    public function insertVideo(Request $request)
    {

        $user_id_loggedin = Session::get('user_id_loggedin');

        if($user_id_loggedin == ''){
            return redirect()->action(
                'UserAuthController@getLogin'
            );
        }
        if ($request['youtubeUrl']) {
            $video = new UserVideos;
            $video->user_id = $user_id_loggedin;
            $video->status = 'hotspot';
            $video->options = json_encode($request['options']);
            parse_str( parse_url( $request['youtubeUrl'], PHP_URL_QUERY ), $parsedVars );
            if ($video->youtube_id = $this->getYouTubeId($request['youtubeUrl'])) {
                $video->save();
                Session::flash('success', 'Video added successfully');
            } else {
                Session::flash('error', 'Please enter valid youtube url');
            }
        }
        $title = Title::first();
        $template_videos = DB::table('template_videos')->select("*", 'template_videos.id as video_id')
            ->leftJoin('template_group', 'template_group.id', '=', 'template_videos.template_group_id')
            ->paginate(12);
        $category = Category::orderBy('name','ASC')->get();
        $emailtemplates = EmailTemplate::all();
        $data['video'] = null;
        return view('videos.insert', $data)
            ->withTitle($title)
            ->with('template_videos',$template_videos)
            ->with('emailtemplates',$emailtemplates)
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
                ->where('flag', '=', 1)
                ->paginate(12);
        }else{
            $template_videos = DB::table('template_videos')->select("*", 'template_videos.id as video_id')
            ->leftJoin('template_group', 'template_group.id', '=', 'template_videos.template_group_id')
            ->where('name', 'like', '%' . $search . '%')->orderBy($sort, 'ASC')
            ->where('flag', '=', 1)
            ->paginate(12);
        }
        return view('videos.page')->with('template_videos',$template_videos)->render();
    }

    public function createVideosReceive(Request $request)
    {
        // validate request
        try {
            $validatedData = $request->validate([
                'project_id' => 'required|exists:user_videos,project_id',
                'video_url' => 'required|url'
            ]);
        } catch (\Throwable $e) {
            return "Invalid data";
        }

        // update database record
        // TBD: extract
        $videoModel = UserVideos::where('project_id', $validatedData['project_id'])->first();
        $videoModel->video_url = $validatedData['video_url'];
        $videoModel->status = 'Completed';
        $videoModel->save();

        // if a direct download, exit here
        if ($videoModel->direct_download) {
            return "OK";
        }

        // upload video to youtube
        // TBD: extract
        $videoUrlParsed = explode('/', $request->input('video_url'));
        $filename = end($videoUrlParsed);

        // if the file doesn't exist locally, download it from S3:
        try {
            if (! Storage::disk('local')->has($filename)) {
                $mountManager = new MountManager([
                    's3' => Storage::disk('s3')->getDriver(),
                    'local' => Storage::disk('local')->getDriver(),
                ]);
                $mountManager->copy('s3://' . $filename, 'local://' . $filename);
            }
        } catch (\Throwable $e) {
            return "Cannot retrieve file from S3";
        }

        // construct the full path
        $pathPrefix = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $fullPath = $pathPrefix . $filename;

        try {

            // attempt a YouTube upload
            $video = Youtube::upload($fullPath, [
                        'title' => $videoModel->commonFields->customer_first_name . "'s Demo Video",
                        'description' => ''
                    ],
                    'unlisted', $videoModel->user_id);
            $videoModel->youtube_id = $video->getVideoId();
            $videoModel->save();
        } catch (\Throwable $e) {

            // if it fails (missing/incorrect token?), turn it
            // into a direct download
            $videoModel->youtube_id = null;
            $videoModel->direct_download = true;
            $videoModel->save();
        }

        // delete the local file
        if (Storage::disk('local')->has($filename)) {
            Storage::disk('local')->delete($filename);
        }

        // check again if it was turned into a direct download
        if ($videoModel->direct_download) {
            return "OK";
        }

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

        // check if it's a render-only project
        $directDownload = $request->has('directDownload')
                          && ($request['directDownload'] == 'checked');

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

            $templateData[$field->title] = '';
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
        foreach ($completeData as $key => $value) {
            if (is_null($value)) {
                 $completeData[$key] = "";
            }
        }
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
                'direct_download' => $directDownload,
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

        // gather common data - not specific to template
        $commonData = $request->only(CommonField::FILLABLE);

        // load common validation rules
        $validationRules = CommonField::VALIDATION_RULES;

        // load project-specific validation rules
        foreach ($video->group->fields as $field) {

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

        $cleanData = [];
        $response = [];

        // validate all rows
        foreach ($mappedData as $row) {

            // process common fields
            $commonData['customer_first_name'] = $row['customer_first_name'];
            $commonData['customer_last_name'] = $row['customer_last_name'];
            $templateData['customer_name'] = $commonData['customer_first_name'];
            $commonData['customer_email'] = $row['customer_email'];
            $commonData['customer_domain'] = $row['customer_domain'];

            foreach ($video->group->fields as $field) {
                $templateData[$field->title] = '';
                if ($row[$field->title]) {
                    $templateData[$field->title] = $row[$field->title];
                }
            }

            // merge common data and template data
            $completeData = array_merge($commonData, $templateData);

            // validate the complete data against the complete validation rules
            $validator = Validator::make(
                $completeData,
                $validationRules
            );

            if ($validator->fails()) {
                $response['success'] = 'failed';
                $response['errors'][] = $validator->errors();
            } else {
                $cleanData[] = [
                    'template' => $completeData,
                    'common'   => $commonData
                ];
            }
        }

        if (array_key_exists('errors', $response)) {
            return \Response::json($response);
        }

        // save the valid rows to the db and create jobs
        foreach ($cleanData as $row) {
            $templateData = $row['template'];
            $completeData = $templateData;
            $commonData = $row['common'];

            if ($userRepository->overDailyLimit(Auth::guard('user')->user())) {
                $response['errors'] = 'You are over the daily limit! The limit will be reset at midnight.';
                $response['success'] = 'failed';
                return \Response::json($response);
            }

            // generate random id for this row
            $randomId = md5(uniqid(mt_rand(), true));
            $completeData['id'] = $randomId;
            $completeData['output'] = $randomId;

            DB::beginTransaction();
            try {

                // save common fields
                $commonFieldId = CommonField::create($commonData)->id;

                // save user video
                $userVideoData = [
                    'project_id' => $completeData['id'],
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
            }

            try {

                // send SQS message
                foreach ($completeData as $key => $value) {
                    if (is_null($value)) {
                         $completeData[$key] = "";
                    }
                }
                $client->sendMessage($completeData);
            } catch (\Throwable $e) {
                DB::rollBack();
                $response['errors'] = 'Failed sending SQS message! DB data has been discarded.';
            }

            DB::commit();
        }

        if (array_key_exists('errors', $response)) {
            $response['success'] = 'failed';
        } else {
            $response['success'] = 'success';
        }
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
    public function createVideosUploadVideo(Request $request)
    {
        $user_id_loggedin = Session::get('user_id_loggedin');
        if($user_id_loggedin == ''){
            return redirect()->action(
                'UserAuthController@getLogin'
            );
        }
        $video = $request->file('uploadVidoefile');
        $videoTarget = $request->videoTarget;
        $videoName = 'video-'.time().'.'.$video->getClientOriginalName();
        $t = Storage::disk('s3')->put($videoName, file_get_contents($video), 'public');
        $videoName = Storage::disk('s3')->url($videoName);
        if($videoName){
            $response['success'] = 'success';
            $response['videoUrl'] = $videoName;
            $response['videoTarget'] = $videoTarget;
        }else{
            $response['success'] = 'failed';
        }
        return \Response::json($response);
    }
    public function createVideosUploadMusic(Request $request)
    {
        $user_id_loggedin = Session::get('user_id_loggedin');
        if($user_id_loggedin == ''){
            return redirect()->action(
                'UserAuthController@getLogin'
            );
        }
        $music = $request->file('uploadMusicfile');
        $musicTarget = $request->musicTarget;
        $musicName = 'music-'.time().'.'.$music->getClientOriginalName();
        $t = Storage::disk('s3')->put($musicName, file_get_contents($music), 'public');
        $musicName = Storage::disk('s3')->url($musicName);
        if($musicName){
            $response['success'] = 'success';
            $response['musicUrl'] = $musicName;
            $response['musicTarget'] = $musicTarget;
        }else{
            $response['success'] = 'failed';
        }
        return \Response::json($response);
    }

    public function showIframe($id)
    {
        return $this->showMyVideo($id, true);
    }

    public function showMyVideo($id, $iframe = false)
    {
        $logo = Logo::first();
        $social = SocialIcon::first();
        $contact = Contact::first();
        $title = Title::first();
        $footer = Footer::first();

        $data['video'] = UserVideos::orderBy('user_videos.id','DESC')->where("user_videos.id","=",$id)->leftJoin('common_field', 'user_videos.common_field_id', '=', 'common_field.id')->first();
        $data['video']['options'] = json_decode($data['video']['options'] ?: '{}
        ');
        if (empty($data['video']['options']) || empty($data['video']['options']->hotspots)) {
            $data['video']['options'] = json_decode('{"hotspots":[]}');
        }
        $data['iframe'] = $iframe;
        $data['imgCount'] = 0;
        foreach($data['video']['options']->hotspots as $hotspot) {
            if ($hotspot->thumb!='') $data['imgCount']++;
        }

        return view('videos.my_video',$data)
            ->withLogo($logo)
            ->withSocial($social)
            ->withContact($contact)
            ->withTitle($title)
            ->withFooter($footer);
    }

    public function configureMyVideo($id, Request $request)
    {
        if ($request['options']) {
            $video = UserVideos::find($id);
            $options = $request['options'];
            foreach ($options['hotspots'] as $key => $hotspot) {
                if (isset($hotspot['cartUrl']) && substr($hotspot['cartUrl'], 0, 7) != 'http://' && substr($hotspot['cartUrl'], 0, 8) != 'https://') {
                    $options['hotspots'][$key]['cartUrl'] = 'http://'.$hotspot['cartUrl'];
                }
            }
            $video->options = json_encode($options);
            $video->save();
        }
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
        $data['video'] = UserVideos::orderBy('user_videos.id','DESC')->where("user_id","=",$user_id_loggedin)->where("user_videos.id","=",$id)->first();
        $data['video']['options'] = json_decode($data['video']['options']);
        if (empty($data['video']['options']) || empty($data['video']['options']->hotspots)) {
            $data['video']['options'] = json_decode('{"hotspots":[{}]}');
        }
        return view('videos.configure',$data)
            ->withLogo($logo)
            ->withSocial($social)
            ->withContact($contact)
            ->withTitle($title)
            ->withFooter($footer);
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
        $data['pendingvideos'] = UserVideos::orderBy('user_videos.id','DESC')->where("user_id","=",$user_id_loggedin)->where("status","=",'Pending')->leftJoin('common_field', 'user_videos.common_field_id', '=', 'common_field.id')
            ->select([
                'user_videos.id',
                'user_videos.project_id',
                'user_videos.project_title',
                'common_field.customer_email',
                'common_field.customer_first_name',
                'common_field.customer_last_name',
                'user_videos.created_at',
                'user_videos.status',
            ])
            ->get();
        $data['completedvideos'] = UserVideos::orderBy('user_videos.updated_at','DESC')->where("user_id","=",$user_id_loggedin)->where("status","=",'Completed')->leftJoin('common_field', 'user_videos.common_field_id', '=', 'common_field.id')
            ->select([
                'user_videos.id',
                'user_videos.project_id',
                'user_videos.project_title',
                'common_field.customer_email',
                'common_field.customer_first_name',
                'common_field.customer_last_name',
                'user_videos.updated_at',
                'user_videos.youtube_id',
                'user_videos.video_url',
            ])
            ->get();
        return view('videos.my_videos',$data)
        ->withLogo($logo)
        ->withSocial($social)
        ->withContact($contact)
        ->withTitle($title)
        ->withFooter($footer);
    }
    
    public function getHotspotVideos()
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
        $data['hotspotvideos'] = UserVideos::orderBy('user_videos.id','DESC')->where("user_id","=",$user_id_loggedin)->where("status","=",'hotspot')->get();

        return view('videos.hotspot_videos',$data)
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
        UserVideos::where('user_id', '=', $user_id_loggedin)->where('id', $id)->delete();
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
        $data['premium'] = User::find($user_id_loggedin)->type == 'Premium';

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
    public function get_http_response_code($url){
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }
    public function createVideosImgToUrl(Request $request){
        $parsed_url = parse_url($request->url);
        if(!isset($parsed_url['scheme'])){
            $response = [];
            $response['result_image'] = array();
            $response['url'] = $request->url;
            $response['id'] = $request->id; 
        }else{
            try {
                $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
                $context = stream_context_create($opts);
                $html = file_get_html($request->url,false,$context);
                if(!$html){
                    $response = [];
                    $response['result_image'] = array();
                    $response['url'] = $request->url;
                    $response['id'] = $request->id; 
                }else{
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
                }
            }
            catch (Exception $e) {
                $response = [];
                $response['result_image'] = array();
                $response['url'] = $request->url;
                $response['id'] = $request->id; 
            }
        }
        return \Response::json($response);
    }

}