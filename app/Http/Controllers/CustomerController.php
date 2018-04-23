<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\Admin;
use App\Footer;
use App\Title;
use App\User;
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
class CustomerController extends Controller
{
    private function processSale($order)
    {
        $maxItem = 0;
        $types = ['Basic', 'Standart', 'Premium'];
        foreach ($order->lineItems as $item) {
            if ($item->itemNo > $maxItem) {
                $maxItem = $item->itemNo;
            }
        }
        if ($user = User::where('email', '=', $order->customer->billing->email)->first()) {
            if ($maxItem && $maxItem > array_search($user->type, $types) + 1) {
                $user->type = $types[$maxItem-1];
                $user->save();
            }
        } else {
            $user = new User();
            $user->name = $order->customer->billing->fullName;
            $user->email = $order->customer->billing->email;
            $random_password = str_random(12);
            $user->password = Hash::make($random_password);
            if ($maxItem) {
                $user->type = $types[$maxItem-1];
            }
            $user->status = 1;

            $contact = Contact::first();
            if ($user->save()){
                $data = [
                    'name' => $user->name,
                    'contactemail' => $contact->email,
                    'email' => $user->email,
                    'password' => $random_password
                ];
                Mail::send('mail.registration', $data, function($message) use ($data) {
                    $message->to( $data['email'], $data['name'])->subject('Your VideoPlatform App Login Details');
                    $message->from($data['contactemail'], $data['contactemail']);
                });
            }
        }
        return $user;
    }
    private function processBill($order)
    {
        $user = User::where('email', '=', $order->customer->billing->email)->first();

        return $user;
    }
    private function processRefund($order)
    {
        $user = User::where('email', '=', $order->customer->billing->email)->first();
        $transaction = Transaction::where('receipt', $order->receipt)->where('type', '!=', 'RFND')->first();
        $transaction->refunded = true;
        $transaction->save();
        $this->updateUserPermissions($user);

        return $user;
    }
    private function findUser($order)
    {
        if (!$user = User::where('email', '=', $order->customer->billing->email)->first()) {
            $user = new User();
            $user->name = $order->customer->billing->fullName;
            $user->email = $order->customer->billing->email;
            if ($order->transactionType == 'TEST_SALE') {
                $user->type = 'test';
            }
            $user->save();
        }

        return $user;
    }
    private function updateUserPermissions($user)
    {
        $types = ['Basic', 'Standart'];
        $premium = false;
        $active = false;
        foreach (Transaction::where('user_id', $user->id)->where('type', 'SALE')->where('refunded', false)->get() as $transaction) {
            $order = json_decode($transaction->data);
            foreach ($order->lineItems as $item) {
                if ($item->itemNo == 3) {
                    $premium = true;
                } else {
                    $active = true;
                    $type = $item->itemNo;
                }
            }
        }
        if ($active) {
            $user->status = true;
            if ($premium) {
                $user->type = 'Premium';
            } else {
                $user->type = $types[$type-1];
            }
        } else {
            $user->status = false;
        }
        $user->save();
    }
    private function processClickbankCallback($decrypted)
    {
        $order = json_decode($decrypted);
        switch ($order->transactionType) {
            case 'SALE':
            case 'TEST_SALE':
                $user = $this->processSale($order);
                break;
            case 'BILL':
                $user = $this->processBill($order);
                break;
            case 'RFND':
                $user = $this->processRefund($order);
                break;
            default:
                $user = $this->findUser($order);
        }
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->type = $order->transactionType;
        $transaction->receipt = $order->receipt;
        $transaction->data = $decrypted;
        $transaction->save();
    }
    public function create()
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
        
        return view('admin.createcustomer');
    }
    public function edit($id)
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
        $data = User::where('id', '=', $id)->first();
        //print_r($data['email']);
        return view('admin.editcustomer')->with('userdata',$data);
    }
    public function add(Request $request)
	{
		if($request['new_customer_active']=='on'){
			$status = 1;
		}else $status = 0;
        $user= new User();
        $user->name= $request['new_customer_name'];
        $user->email= $request['new_customer_email'];
        $user->password= Hash::make($request['new_customer_password']);
        $user->phone= $request['new_customer_phone'];
        $user->status= $status;
        $user->type= $request['new_customer_type'];
        $contact = Contact::first();
        if($user->save()){
            Session::flash('success', 'New Customer Created Successfully');
            if($request['new_customer_confirm']=='on'){
                $data = array(
                    'name' => trim($request['new_customer_name']) == '' ? 'Customer' : $request['new_customer_name'],
                    'contactemail' => $contact->email,
                    'email' => $request['new_customer_email'],
                    'password' => $request['new_customer_password'],
                );
                Mail::send('mail.registration', $data, function($message) use ($data) {
                    $message->to( $data['email'], ucwords($data['name']) )->subject('Your VideoPlatform App Login Details');
                    $message->from($data['contactemail'], $data['contactemail']);
                });
            }
        }else{
            $request->session()->flash('message', 'There was error saving the info!');
        }
        return redirect()->back();
    }
    public function update($id, Request $request)
	{
		$admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
		$user = User::find($id);
		if($request['new_customer_active']=='on'){
			$status = 1;
		}else $status = 0;
        $user->name= $request['new_customer_name'];
        $user->email= $request['new_customer_email'];
        if($request['new_customer_password']) {
            $user->password= Hash::make($request['new_customer_password']);
        }
        $user->phone= $request['new_customer_phone'];
        $user->status= $status;
        $user->type= $request['new_customer_type'];
        $contact = Contact::first();
        echo $request['new_customer_confirm'];
        if($user->save()){
            Session::flash('success', 'Customer Info Updated Successfully');
		    $data = array(
                'name'=>$request['new_customer_name'],
                'contactemail'=>$contact->email,
                'email'=>$request['new_customer_email'],
                'password'=>$request['new_customer_password'],
                'bodyMessage'=>'Successfully Updated Customer Info. Here is updated login info. Email:'.$request['new_customer_email'].' Password:'.$request['new_customer_password']
            );
            Mail::send('mail.mail', $data, function($message) use ($data) {
             $message->to( $data['email'], 'Update Customer')->subject('Customer Info Updated');
             $message->from($data['contactemail'],'');
            });
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
        

        $customersdata = DB::table('users')
                 ->select(DB::raw('*, (SELECT count(*) FROM user_videos as v WHERE users.id = v.user_id and v.status = "Completed") as completed_video_num, (SELECT count(*) FROM user_videos as v WHERE users.id = v.user_id and v.status != "Completed") as rendering_video_num'))
                 ->get();
        $videos = DB::table('user_videos')
        		->where('status', 'Completed')
                 ->get();
        $videosdata = array();
        foreach($videos as $video) {
        	if(!isset($videosdata[$video->user_id])) {
        		$videosdata[$video->user_id] = array();
        	}
        	array_push($videosdata[$video->user_id], $video->video_url);
        }
        foreach($videosdata as $id => $v) {
        	$videosdata[$id] = json_encode($v);
        }
        return view('admin.viewcustomer')
        ->with('customersdata',$customersdata)
        ->with('videosdata',$videosdata);
    }
    public function typeUpdate(Request $request)
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
        User::where('id', $request['id'])->update(['type' => $request['type']]);
        $response = array();
        $response['success'] = 'success';
        $response['id'] = $request['id'];
        $response['type'] = $request['type'];
        return \Response::json($response);
    }
    public function delete($id)
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
        User::where('id', $id)->delete();
        $response = array();
        $response['success'] = 'success';
        $response['id'] = $id;
        return \Response::json($response);
    }
    public function suspend($id)
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
        $user = User::find($id);
        if($user['status']==1){
            User::where('id', $id)->update(['status' => '0']);
            $returnstatus = 0;
        }else{
            User::where('id', $id)->update(['status' => '1']);
            $returnstatus = 1;

        }
        $response = array();
        $response['success'] = 'success';
        $response['id'] = $id;
        $response['returnstatus'] = $returnstatus;
        return \Response::json($response);
    }
    public function clickbankCallback(Request $response)
    {
        $secretKey = env('CLICKBANK_CLIENT_SECRET', null); // secret key from your ClickBank account
        $message = json_decode($response->getContent()); // get JSON from raw body...

        $encrypted = $message->{'notification'}; // Pull out the encrypted notification
        $iv = $message->{'iv'}; // Pull out the initialization vector for AES/CBC/PKCS5Padding decryption

        $decrypted = trim(
            openssl_decrypt(base64_decode($encrypted), // decrypt the body...
                'AES-256-CBC',
                substr(sha1($secretKey), 0, 32),
                OPENSSL_RAW_DATA,
                base64_decode($iv)), "\0..\32");

        $this->processClickbankCallback($decrypted);

        $response = array();
        $response['success'] = 'success';
        return \Response::json($response);
    }
}
