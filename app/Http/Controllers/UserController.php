<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users=User::get();
        return view('users', compact('users'));
    }
    public function create(){
        return view('user.create');
    }
    public function store(Request $request){
        $code = explode("/",$request->path())[0];
        $customer= Customer::where ("code",$code)->first();
        User::create([
            'username'=>$request->username,
            'password'=>$request->password,
            'jabatan'=>$request->jabatan,
            'customer_id'=>$customer->id,
        ]);
        return redirect("/$code/dashboards/users");
    }
    public function edit($cust, $id){
        $user=user::where('id', $id)->first();
        return view('user.edit',compact('user'));
    }
    public function destroy(Request $request,$cust,$id,){
        $user=User::where('id', $id)->first()->delete();
        $code = explode("/",$request->path())[0];
        return redirect("/$code/dashboards/users");
    }
    public function update(Request $request,$cust, $id) {
        $user = User::find($id);
        $code = explode("/",$request->path())[0];
        $user->update($request->all());
        return redirect("/$code/dashboards/users");
    }
}
