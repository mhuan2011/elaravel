<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

session_start();


class AdminController extends Controller
{
    public function index()
    {
        
        return view('admin-login');
    }
    public function showDashboard()
    {
        if(!isset($_SERVER['HTTP_REFERER'])){
            // redirect them to your desired location
            
            return view('error');  
        }
        return view('admin.dashboard');
    }
    public function dashboard(Request $request)
    {
        $admin_email = $request->admin_email;
        
        $admin_password = $request->admin_password;

        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password', $admin_password)->first();
        
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
        }else {
            Session::put('message','Mật khẩu hoặc tài khoảng không đúng !');
            return Redirect::to('/admin');
        }
    }
    public function logout()
    {
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
    public function error_page()
    {
        return view('error');
    }
}

