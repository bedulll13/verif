<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // $customer= Customer::where('code',$cust)->first();
        $users = User::get();
        return view('welcome', compact('users'));
    }
    public function login_get()
    {
        return view('login');
    }
    public function logout_post($cust)
    {
        Auth::logout();
        return redirect('/');
    }
    public function login_post(Request $request, $cust)
    {
        $customer= Customer::where('code',$cust)->first();
        $check = Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ]);
       
        if ($check == false) {
            return redirect()->back();
        }
        return redirect("/$cust/dashboards");
    }


    public function dashboards()
    {
        return view('dashboards');
    }
}
