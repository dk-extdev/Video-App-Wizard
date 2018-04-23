<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Footer;
use App\Title;
use App\Category;
use DB;

use App\Http\Requests;
use App\Contact;
use App\Logo;
use App\SocialIcon;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
class CategoryController extends Controller
{
    //
    public function add(Request $request)
    {
        $attr = json_decode($request->attr);
        foreach ($attr as $k => $v) {
            Category::insert([
                'name' => $v[0],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);  
        }
        $response['success'] = 'success';
        return \Response::json($response);   
    }
    public function edit($id)
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
        $data = Category::where('id', '=', $id)->first();
        return view('admin.editcategory')->with('category',$data);
    }
    public function create()
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
        
        return view('admin.createcategory');
    }
    public function update($id, Request $request)
	{
		$admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
		$category = Category::find($id);
		$category->name= $request['category_name'];
        $category->updated_at= date('Y-m-d H:i:s');
        
        if($category->save()){
            Session::flash('success', 'Category Info Updated Successfully');
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
        $categorydata = Category::all();
        return view('admin.category')
        ->with('categorydata',$categorydata);
    }
    public function delete($id)
    {
        $admin_id_loggedin = Session::get('admin_id_loggedin');

        if($admin_id_loggedin == ''){
            return redirect()->action(
                'AdminController@getLogin'
            );
        }
        Category::where('id', $id)->delete();
        $response = array();
        $response['success'] = 'success';
        $response['id'] = $id;
        return \Response::json($response);
    }
}
