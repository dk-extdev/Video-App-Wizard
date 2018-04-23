<?php
namespace App\Http\Controllers;

use App\Footer;
use App\Title;
use App\User;
use Illuminate\Http\Request;
use Dawson\Youtube\Facades\Youtube;

use App\Contact;
use App\Logo;
use App\SocialIcon;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;


class UserAuthController extends Controller
{
    public function __construct()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }

    public function getLogin()
    {
      $user_id_loggedin = Session::get('user_id_loggedin');
        if($user_id_loggedin != ''){
            return redirect()->action(
                'VideosController@getNews'
            );
        }else{
            $logo = Logo::first();
            $social = SocialIcon::first();
            $contact = Contact::first();
            $title = Title::first();
            $footer = Footer::first();
            return view('user.login')
            ->withSocial($social)
            ->withContact($contact)
            ->withLogo($logo)
            ->withTitle($title)
            ->withFooter($footer);
        }
        
    }
    public function postLogin(Request $request)
    {

        if (Auth::guard('user')->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1
        ])){
            $user_exists = User::where('email', '=', $request->email)->first();
            Session::flash('success', 'Log In Successfully');
            Session::put('user','user');
            Session::put('user_id_loggedin',$user_exists->id);
            return redirect()->action('VideosController@getNews');

        }

        $request->session()->flash('message', 'Login incorrect!');
        return redirect()->back();
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        session()->forget('user');
        session()->forget('user_id_loggedin');
        session()->flash('success', 'Successfully Logged Out!');
        $logo = Logo::first();
        $social = SocialIcon::first();
        $contact = Contact::first();
        $title = Title::first();
        $footer = Footer::first();
        return redirect()->route('userlogin')
        ->withSocial($social)
        ->withContact($contact)
        ->withTitle($title)
        ->withFooter($footer)
        ->withLogo($logo);
    }

    public function youtubeCallback(Request $request)
    {
        if(!$request->has('code')) {
            throw new Exception('$_GET[\'code\'] is not set. Please re-authenticate.');
        }

        $user_id_loggedin = Session::get('user_id_loggedin');
        if($user_id_loggedin == ''){
            return redirect()->action(
                'UserAuthController@getLogin'
            );
        }

        $token = Youtube::authenticate($request->get('code'));
        if(isset($token['error'])) {
            throw new \Exception($token['error_description']);
        }

        DB::table('youtube_access_tokens')->insert([
            'user_id' => $user_id_loggedin,
            'access_token' => json_encode($token),
            'created_at'   => Carbon::createFromTimestamp($token['created'])
        ]);
        $url = 'https://www.googleapis.com/oauth2/v1/userinfo?alt=json&'.http_build_query(array(
                'access_token' => $token['access_token'],
            ));

        $user = User::find($user_id_loggedin);
        $user->googleInfo = file_get_contents($url);
        $user->save();

        return redirect('settings');
    }

    public function getProfile()
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

        $current_user_id = Session::get('user_id_loggedin');
        $data['current_user_info'] = User::where('id', '=', $current_user_id)->first();
        $data['youtube'] =  Youtube::createAuthUrl();

        $data['linked'] = is_object(DB::table('youtube_access_tokens')
            ->latest('created_at')
            ->where('user_id', $user_id_loggedin)
            ->first());

        $data['googleInfo'] = json_decode(DB::table('users')
            ->where('id', $user_id_loggedin)
            ->first()->googleInfo);

        return view('user.profile',$data)
        ->withSocial($social)
        ->withContact($contact)
        ->withLogo($logo)
        ->withTitle($title)
        ->withFooter($footer);
    }

    public function update_user_info(Request $request)
    {
        $full_name = $request->full_name;
        $email = $request->email;
        $phone = $request->phone;

        $current_user_id = Session::get('user_id_loggedin');

        $obj_user = User::find($current_user_id);

        $obj_user->name = $full_name;
        $obj_user->phone = $phone;

        if($obj_user->save()){
            Session::flash('success', 'User info updated Successfully');
        }else{
            $request->session()->flash('message', 'There was error saving the info!');
        }

        
        return redirect()->back();
        
    }

    public function update_user_password(Request $request)
    {
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $conf_password = $request->conf_password;

        $hashed_pass = Hash::make($new_password);

        $current_user_id = Session::get('user_id_loggedin');

        $obj_user = User::find($current_user_id);

        if($new_password == $conf_password){
            if (Hash::check($old_password, $obj_user->password)) {
                $obj_user->password = $hashed_pass;

                if($obj_user->save()){
                    Session::flash('success', 'Password updated Successfully');
                }else{
                    $request->session()->flash('message', 'There was error updating the password!');
                }
            }else{
                $request->session()->flash('message', 'Current password dosent match!');
            }
        }else{
            $request->session()->flash('message', 'New password and confirm password dosent match!');
        }

        

        return redirect()->back();

    }

}